<?php

use Illuminate\Database\Seeder;

/*
php artisan  db:seed  --class=FinanceRecordsTableSeeder
*/
class FinanceRecordsTableSeeder extends Seeder
{

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('finance_records')->truncate();

        DB::table('finance_records')->insert([
            ['date' => '2009.11.11', 'title' => '购买域名 zhenc.org', 'amount' => -325, 'memo' => '在万网购买了三年 2009.11.11-2012.11.11',],
            ['date' => '2010.03.03', 'title' => '续期域名 zhenc.org', 'amount' => -49.04, 'memo' => '域名转移，续费一年到2013.11.11；通过支付宝支付$7.17',],
            ['date' => '2013.08.27', 'title' => '续期域名 zhenc.org', 'amount' => -182.92, 'memo' => '续费三年到2016.11.11；通过支付宝支付$29.82',],
            ['date' => '2015.03.21', 'title' => '续期域名 zhenc.org', 'amount' => -494.73, 'memo' => '续费八年到2024.11.11；通过支付宝支付$79.52',],
//            ['date'=>'2015.03.30','title'=>'购买服务器','amount'=>-407,'memo'=>'购买阿里云服务器器 2015.05.20-2016-05-20。带宽：1Mbps按固定带宽；CPU：1核； 操作系统：Ubuntu12.04 64位； 内存：512MB；包年495元，使用代金券88元。'],
        ]);

        DB::table('finance_records')->insert([
//            ['date' => '2015.03.31', 'title' => '市民捐赠', 'amount' => 1458.69,'another_type'=>'citizen','another_id'=>1, 'memo' => '形式捐赠，只为在财务表上平衡之前的支出。',],
            ['date' => '2016.01.10', 'title' => '公共捐赠', 'amount' => 2930.5, 'another_type'=>null,'another_id'=>null,'memo' => '点击查看<a class="baihui-share" title="捐赠清单" href="https://docs.baihui.com/sheet/published.do?rid=4bw549fc0edd09a7341ef80c50e018667af56&mode=html" g-url="https://docs.google.com/spreadsheets/d/1R_LSS0yzfvqNfxiBt3pcTr-SmlsbF7wojUVHSz_6oDA/edit?usp=sharing">《捐赠明细表》</a>。以后不再进行公共募捐。',],
        ]);

        DB::table('finance_records')->insert([
            ['date' => '2017-01-11', 'title' => '购买域名 zhenc.cc', 'amount' => -177, 'memo' => '在阿里云购买了三年 2017.01.11.11-2020.01.11',],
            ['date' => '2017.11.11', 'title' => '购买服务器', 'amount' => -673.92, 'memo' => '云服务器ECS（包年）。可用区： 华北 3 可用区 A；带宽：1Mbps按固定带宽；CPU：1核；内存：1GB；到期时间：2018-11-12 00:00:00',],
            ['date' => '2017.11.27', 'title' => '购买服务器', 'amount' => -660.01, 'memo' => '云服务器ECS（包年）。地域： 美国西部 1 (硅谷)；带宽：1Mbps按固定带宽；CPU：1核；内存：1GB；到期时间： 2019-11-28 00:00:00',],
//            ['date'=>'2015.03.30','title'=>'购买服务器','amount'=>-407,'memo'=>'购买阿里云服务器器 2015.05.20-2016-05-20。带宽：1Mbps按固定带宽；CPU：1核； 操作系统：Ubuntu12.04 64位； 内存：512MB；包年495元，使用代金券88元。'],
        ]);

        ( new \App\Http\Controllers\Staticizer)->createFinanceData();
    }

}
