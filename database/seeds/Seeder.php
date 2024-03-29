<?php

use Illuminate\Database\Seeder as BaseSeeder;

if (!defined('MENU_ITEMS'))
    include storage_path() . '/cache/columns.php';

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
        return;
    }

    function encodeBody(&$article, $uniqName, $field, $md_field, $writeFile = false)
    {

        if (!$writeFile) {
            $article[$md_field] = $article[$field];
            $article[$field] = app('markdown')->encode($article[$field]);
            return;
        }

        @mkdir($this->freeDir . 'src/', 0777, true);

        if (array_key_exists($field, $article)) {
            $sourceFile = $this->freeDir . 'src/' . $uniqName . ($field === 'body' ? '' : '_' . $field) . '.src';
            file_put_contents($sourceFile, $article[$field]);
        } else {
            // 必须存在源
            $sourceFile = $this->sourceDir . $uniqName . ($field === 'body' ? '' : '_' . $field) . '.src';
            if (!is_file($sourceFile)) {
                throw new \Exception("Seeder.php : not found markdown file for {$sourceFile}");
            }
        }

        $_file = $this->freeDir . $uniqName . $field;
        $htmlFile = $_file . '.html';


        if (!(is_file($htmlFile) && filemtime($sourceFile) < filemtime($htmlFile))) {
            echo 'EXEC nodejs encode_markdown_file_to_html.js for ', $uniqName, $field, PHP_EOL;
            chdir(base_path());
            $cmd = "nodejs ./resources/bin/encode_markdown_file_to_html.js -i $sourceFile -h $htmlFile ";
//            echo "cmd is : $cmd \n";
            $a = exec($cmd, $out, $status);

//            var_dump( $a, $out,$status);
            if ($status != 0) {
                var_dump($out);
                throw new \Exception("exec wrong: $cmd");
            }
        } else {
            echo 'SKIP exec nodejs encode_markdown_file_to_html.js for ', $uniqName, $field, PHP_EOL;
        }


        $article[$field] = file_get_contents($htmlFile);
        $article[$md_field] = file_get_contents($sourceFile);

    }

    function addQuotes($items, $quoteable_id = null, $quoteable_type = null, $data = [])
    {
        foreach ($items as &$item) {
            $key = str_replace("'", '', $item['slug'] ?? $item['_slug']);
            $this->encodeFieldsIndependently($item, $key, ['author', 'comment']);

            if ($quoteable_id) {
                $item['articleable_id'] = $quoteable_id;
            }
            if ($quoteable_type) {
                $item['articleable_type'] = $quoteable_type;
            }

            if ($item['quoteable_type'] ?? null) {
                $item['articleable_type'] = $item['quoteable_type'];
                $item['articleable_id'] = $quoteable_id ?? $item['quoteable_id'];
                unset($item['quoteable_type'], $item['quoteable_id']);
            }
            if ($item['articleable_type'] == 'Article') {
                $item['articleable_type'] = 'App\Article';
            }

            if (!isset($item['intro'])) {
                $item['intro'] = $item['body'];
                unset($item['body']);
            }

            $this->encodeBody($item, $key, 'intro', 'intro_md', false);
            if (isset($item['body_long'])) {
                if ('_' === $item['body_long']) unset($item['body_long']); // 使用文件
                $this->encodeBody($item, $key, 'body_long', 'md_long', true);
            }


            $place_infos = [];
            if (isset($item['_place'])) {
                $place_infos = $this->insertPlaces([$item['_place']], 'App\Article');
            } elseif (isset($item['_places'])) {
                $place_infos = $this->insertPlaces($item['_places'], 'App\Article');
            }

            if (isset($item['_image'])) {
                $imgID = DB::table('images')->insertGetId($item['_image']);
                $item['image_id'] = $imgID;
            }

            $tags = $item['_tags'] ?? [];

            unset($item['_slug'], $item['_image'], $item['_places'], $item['_place'],
                $item['_tags']);


            foreach ($data as $k => $v) {
                $item[$k] = $v;
            }


            $body = $item['body_long'] ?? null;
            $md = $item['md_long'] ?? null;
            unset($item['body_long'], $item['md_long']);
            if ($body) {
                $item['short'] = 3;
            } else {
                $item['short'] = 2;

            }

            $article = $item;
            if (!isset($article['zh'])) {
                $article['zh'] = [
                    'title' => $article['title'] ?? null,
                    'sub_title' => $article['sub_title'] ?? null,
                    'desc' => $article['desc'] ?? null,
                    'intro' => $article['intro'] ?? null,
                    'intro_md' => $article['intro_md'] ?? null,
                ];
            }
            unset($article['title'], $article['sub_title'], $article['desc'], $article['intro'], $article['intro_md']);

            if (isset($article['created_at']))
                $article['created_at'] = date('Y-m-d H:i:s', strtotime($article['created_at']));

            $item = \App\Article::create($article);
            $item->save();
            $qID = $item->id;
            // $qID = DB::table('articles')->insertGetId($item);

            if ($body)
                DB::table('contents')->insert([
                    'body' => $body,
//                    'contentable_type' => 'App\Quote',
                    'article_id' => $qID,
                ]);
            if ($md) {
                DB::table('contents')->insert([
                    'body' => $md,
                    'md' => true,
//                    'contentable_type' => 'App\Quote',
                    'article_id' => $qID,
                ]);
            }

            $this->insertPlaceInfos($place_infos, $qID);

            $this->insertTags($tags, 'App\Quote', $qID);

        }

        return $qID ?? null; // return the last quote id

    }

    function insertTags($tags, $taggable_type = null, $taggable_id = null)
    {
        foreach ($tags as $index => $oneTag) {
            $objTag = \App\Tag::firstOrCreate($oneTag);
            if ($taggable_type) {

                DB::table('taggables')->insert([
                    'tag_id' => $objTag->id,
                    'taggable_type' => $taggable_type,
                    'taggable_id' => $taggable_id,
                    'order' => $index,
                ]);
            }
        }
    }

    function insertPlaces($places, $type = 'App\Article')
    {
        if (!$places) return [];

        $place_infos = [];
        foreach ($places as $order => $place) {
            $place_info = $place['info'] ?? [];
            $oldOrPoint = $place['oldOrPoint'] ?? [];
            unset($place['info'], $place['oldOrPoint']);

            if (isset($place['_id'])) {
                $id = $place['_id'];

            } elseif (isset($place['_name'])) {
                //$id = DB::table('places')->where('name', $place['_name'])->first()->id;
                $id = \App\Place::whereTranslation('name', $place['_name'])->first()->id;
            } else {
                if (!($place['name'] ?? null) && isset($place['english_name'])) {
                    $place['name'] = $place['english_name'];
                }

                if ($place['name'] ?? false) {
                    $place['zh'] = ['name' => $place['name']];
                }

                if (isset($place['english_name']) && $place['english_name']) {
                    $place['en'] = ['name' => $place['english_name']];
                }

                unset($place['name'], $place['english_name']);

                $item = \App\Place::create($place);
                $item->save();
                $id = $item->id;
            }

            if ($oldOrPoint) {
                $oldOrPoint['relate_id'] = $id;
                $oldOrPoint['lat'] = $place['lat'];
                $oldOrPoint['lng'] = $place['lng'];

                if ($oldOrPoint['name'] ?? false) {
                    $oldOrPoint['zh'] = ['name' => $oldOrPoint['name']];
                }
                if (isset($oldOrPoint['english_name']) && $oldOrPoint['english_name']) {
                    $oldOrPoint['en'] = ['name' => $oldOrPoint['english_name']];
                }
                unset($oldOrPoint['name'], $oldOrPoint['english_name']);

                $item = \App\Place::create($oldOrPoint);
                $item->save();
                $id = $item->id;
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
            // DB::table('placeables')->insert($place_info);

            if (!isset($place_info['zh']))
                $place_info['zh'] = [
                    'info_name' => $place_info['info_name'] ?? ($place_info['place_name'] ?? null),
                    'title' => $place_info['title'] ?? null,
                    'intro' => $place_info['intro'] ?? null,
                ];

            if (null === $place_info['zh']['info_name'] && null === $place_info['zh']['title'] && null === $place_info['zh']['intro'])
                unset($place_info['zh']);

            unset($place_info['place_name'], $place_info['title'], $place_info['intro']);

            //if($place_info['place_english_name']??null){}

            // var_dump($data);exit();
            $item = \App\Placeable::create($place_info);
            $item->save();


        }
    }

    function addArticles($articles, $default_type = 'first', $default_articleable_id = null, $articleable_type = 'App\Column', $default_volume_id = null)
    {
        foreach ($articles as &$article) {


            $_slug = $article['_slug'] ?? $article['slug'];
            $quotes = $article['_quotes'] ?? [];
            $notes = $article['_notes'] ?? (isset($article['_note']) ? [$article['_note']] : null);
            $brothers = $article['_brothers'] ?? null;

            $article['type'] = $article['type'] ?? $default_type;

            $volume_id = $default_volume_id;
            if ($articleable_type == 'App\Column') {
                if (!$default_volume_id && isset($article['_vol'])) {

                    if (isset($article['created_at']))
                        $article['_vol']['created_at'] = $article['created_at'];

                    $volume_id = DB::table('volumes')->insertGetId($article['_vol']);

                }
                $article['volume_id'] = $volume_id;

            }
            $articleable_id = $article['articleable_id'] = $article['articleable_id'] ?? $default_articleable_id;
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


            $body = $article['body'];
            $md = $article['md'] ?? null;
            unset($article['body'], $article['md']);

            // $articleID = DB::table('articles')->insertGetId($article);

            if (!isset($article['zh'])) {
                $article['zh'] = [
                    'title' => $article['title'] ?? null,
                    'sub_title' => $article['sub_title'] ?? null,
                    'desc' => $article['desc'] ?? null,
                    'intro' => $article['intro'] ?? null,
                    'intro_md' => $article['intro_md'] ?? null,
                ];
            }
            unset($article['title'], $article['sub_title'], $article['desc'], $article['intro'], $article['intro_md']);

            if (isset($article['created_at']))
                $article['created_at'] = date('Y-m-d H:i:s', strtotime($article['created_at']));

            $item = \App\Article::create($article);
            $item->save();
            $articleID = $item->id;

            DB::table('contents')->insert([
                'body' => $body,
//                'contentable_type' => 'App\Article',
                'article_id' => $articleID,
            ]);
            if ($md) {
                DB::table('contents')->insert([
                    'body' => $md,
                    'md' => true,
//                    'contentable_type' => 'App\Article',
                    'article_id' => $articleID,
                ]);
            }

            if ($notes) {
                $this->addArticles($notes, 'note', $articleable_id, $articleable_type, $volume_id);
            }
            if ($brothers) {
                $this->addArticles($brothers, 'normal', $articleable_id, $articleable_type, $volume_id);
            }

            if ($quotes) {
                $this->addQuotes($quotes, $articleID, 'App\Article');
            }

            $this->insertPlaceInfos($place_infos, $articleID);

        }

    }
}
