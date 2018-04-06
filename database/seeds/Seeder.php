<?php

use Illuminate\Database\Seeder as BaseSeeder;

if (!defined('MENU_ITEMS'))
    include storage_path() . '/staticizer/columns.php';

class Seeder extends BaseSeeder
{
    var $sourceDir;
    var $freeDir;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    }

    /**
     * @param $article
     * @param $fields 注意，这些字段即使是markdown格式　也不会解析成 html  只为了 z-free
     */
    function encodeFieldsIndependently(&$article, $uniqName, $fields)
    {
        chdir(base_path());
        foreach ($fields as $field) {
            if (!isset($article[$field]))
                continue;
            if (false !== strpos($article[$field], '<z-free>')) {
                echo PHP_EOL, 'SYS nodejs ./resources/jsbin/encode_content.js independently.js for ', $field, PHP_EOL;
                $sourceFile = $this->sourceDir . " $uniqName _ $field  .src";
                $outputFile = $this->sourceDir . " $uniqName _ $field  .out";
                file_put_contents($sourceFile, $outputFile);
                $cmd = "nodejs ./resources/jsbin/encode_content.js -I -i $sourceFile -o $outputFile";
                system($cmd);
                $article[$field] = file_get_contents($outputFile);
//                echo "cmd is : $cmd \n";
            }
        }

    }

    function encodeBody(&$article, $uniqName, $field, $md_field, $parseMD = false)
    {


        if(array_key_exists($field, $article)){
            $sourceFile = $this->freeDir.'src/' . $uniqName . ($field == 'body' ? '' : '_' . $field) . '.src';
        }else{
            // 必须存在源
            $sourceFile = $this->sourceDir . $uniqName . ($field == 'body' ? '' : '_' . $field) . '.src';
            if (!is_file($sourceFile)) {
                throw new \Exception("Seeder.php : not found markdown file for {$sourceFile}");
            }
        }

        // 如果不用md 且没有z-free 就不需要调用free.js
        if (!$parseMD) {
            $sourceText = array_key_exists($field, $article) ? $article[$field] : file_get_contents($sourceFile);
            if (empty($sourceText) || strpos($sourceText, '<z-free>') === false) {
                $article[$field] = $sourceText;
                $article['codes'] = null;
                return;
            }
        }

        @mkdir($this->freeDir.'src/', 0777, true);
        $_file = $this->freeDir . $uniqName . $field;
        $outputFile = $_file . '.out';
        $codesFile = $_file . '.c';
        $htmlFile = $parseMD ? $_file . '.html' : '';


        if (isset($article[$field]))
            file_put_contents($sourceFile, $article[$field]);

        if (!(
            ($parseMD ? is_file($htmlFile) : true)
            && is_file($codesFile) && filectime($sourceFile) < filectime($codesFile)) // 即使源中不存在z-free 也会生成一个codesFile 所以可用它来判断
        ) {
            echo  'EXEC nodejs free.js for ', $uniqName, $field, PHP_EOL;
            chdir(base_path());
            $cmd = "nodejs ./resources/jsbin/encode_content.js -i $sourceFile -o $outputFile -c $codesFile -h $htmlFile ";
//            echo "cmd is : $cmd \n";
            $a = exec($cmd, $out, $status);

//            var_dump( $a, $out,$status);
            if ($status != 0) {
                var_dump($out);
                throw new \Exception("exec wrong: $cmd");
            }
        } else {
            echo  'SKIP exec nodejs encode_content.js for ', $uniqName, $field, PHP_EOL;
        }


        $codes = file_get_contents($codesFile);
        $article['codes'] = $codes ?: null;

        $article[$field] = file_get_contents($htmlFile);

        if ($parseMD)
            $article[$md_field] = file_get_contents($outputFile);
    }

    function addQuotes($items, $quoteable_id = null, $quoteable_type = null, $data = [])
    {
        foreach ($items as &$item) {
            $key = str_replace("'",'',$item['slug']??$item['_slug']);
            $this->encodeFieldsIndependently($item,$key, ['author', 'comment']);

            if ($quoteable_id) {
                $item['quoteable_id'] = $quoteable_id;
            }
            if ($quoteable_type) {
                $item['quoteable_type'] = $quoteable_type;
            }

            if (isset($item['quoteable_type']) && $item['quoteable_type'] == 'App\Article' && $item['type'] == 'top') {
                // 不作为 markdown 格式
                $this->encodeBody($item,$key, 'body', 'md', false);
            } else {
                $this->encodeBody($item, $key, 'body', 'md', true);
                if (isset($item['body_long'])) {
                    if ($item['body_long'] == '_') unset($item['body_long']); // 使用文件
                    $this->encodeBody($item,$key, 'body_long', 'md_long', true);
                }
            }

            $place_infos = [];
            if (isset($item['_place'])) {
                $place_infos = $this->insertPlaces([$item['_place']], 'App\Quote');
            } elseif (isset($article['_places'])) {
                $place_infos = $this->insertPlaces($item['_places'], 'App\Quote');
            }

            if (isset($item['_image'])) {
                $imgID = DB::table('images')->insertGetId($item['_image']);
                $item['image_id'] = $imgID;
            }

            unset($item['_slug'], $item['_image'], $item['_places'], $item['_place']);


            foreach ($data as $k => $v) {
                $item[$k] = $v;
            }

            $qID = DB::table('quotes')->insertGetId($item);


            $this->insertPlaceInfos($place_infos, $qID);

        }

        return $qID??null; // return the last quote id

    }

    function insertPlaces($places, $type = 'App\Article')
    {
        if(!$places) return [];

        $place_infos = [];
        foreach ($places as $order => $place) {
            $place_info = $place['info'] ?? [];
            $oldOrPoint = $place['oldOrPoint'] ?? [];
            unset($place['info'], $place['oldOrPoint']);

            if (isset($place['_id'])) {
                $id = $place['_id'];
            } else {
                if ( !($place['name']??null) && isset($place['name_en'])) {
                    $place['name'] = $place['name_en'];
                }

                $id = DB::table('places')->insertGetId($place);
            }

            if ($oldOrPoint) {
                $oldOrPoint['relate_id'] = $id;
                $oldOrPoint['lat'] = $place['lat'];
                $oldOrPoint['lng'] = $place['lng'];
                $id = DB::table('places')->insertGetId($oldOrPoint);
            }


            $place_info['place_id'] = $id;
            $place_info['placeable_type'] = $type;
            $place_info['order'] = $place['order'] ?? $order;
            $place_infos[] = $place_info;
        }
        return $place_infos;
    }

    function insertPlaceInfos($place_infos, $id)
    {
        foreach ($place_infos as $place_info) {
            $place_info['placeable_id'] = $id;
            DB::table('placeables')->insert($place_info);
        }
    }

    function addArticles($articles,$default_type = 'first', $default_articleable_id=null , $articleable_type = 'App\Column',$default_volume_id=null)
    {
        foreach ($articles as &$article) {


            $_slug = $article['_slug'] ?? $article['slug'];
            $quotes = $article['_quotes'] ?? [];
            $notes = $article['_notes'] ?? (isset($article['_note']) ? [$article['_note']] : null);
            $brothers = $article['_brothers'] ?? null;

            $article['type'] = $article['type'] ?? $default_type;

            $volume_id=$default_volume_id;
            if ($articleable_type == 'App\Column') {
                if ( !$default_volume_id &&  isset($article['_vol'])) {

                    if (isset($article['created_at']))
                        $article['_vol']['created_at'] = $article['created_at'];

                    $volume_id= DB::table('volumes')->insertGetId($article['_vol']);

                }
                $article['volume_id']=$volume_id;

            }
            $articleable_id=$article['articleable_id'] = $article['articleable_id'] ??  $default_articleable_id;
            $article['articleable_type'] = $article['articleable_type'] ?? $articleable_type;

            $place_infos = [];
            if (isset($article['_place'])) {
                $place_infos = $this->insertPlaces([$article['_place']]);
            } elseif (isset($article['_places'])) {
                $place_infos = $this->insertPlaces($article['_places']);
            }
            unset(
                $article['_slug'], $article['_quotes'], $article['_notes'], $article['_note'], $article['_vol'], $article['_brothers'],
                $article['_place'],
                $article['_places']
            );

            $this->encodeBody($article, $_slug, 'body', 'md', true);
//            $this->encodeFieldsIndependently($article, ['title', 'intro', 'origin', 'comment']);
            $this->encodeFieldsIndependently($article, $_slug, ['title',]);


            $articleID = DB::table('articles')->insertGetId($article);

            if ($notes) {
                $this->addArticles($notes,'note', $articleable_id,$articleable_type,$volume_id);
            }
            if ($brothers) {
                $this->addArticles($brothers, 'normal',$articleable_id,$articleable_type,$volume_id);
            }

            if ($quotes) {
                $this->addQuotes($quotes, $articleID, 'App\Article');
            }

            $this->insertPlaceInfos($place_infos, $articleID);

        }

    }
}
