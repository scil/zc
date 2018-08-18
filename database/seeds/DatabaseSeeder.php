<?php

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        // $this->call(UsersTableSeeder::class);
        $this->call(MenuItemsTableSeeder::class);
        $this->call(FinanceRecordsTableSeeder::class);
        $this->call(ReferencesTableSeeder::class);
        // 必须在 QuotesTableSeeder 和 ArticlesTalbeSeeder 之前，因为它们需要查询 persons 表中的数据
        $this->call(PersonsTableSeeder::class);

        $this->call(QuotesTableSeeder::class);
        $this->call(ArticlesTableSeeder::class);

        $this->call(BooksTableSeeder::class);
        $this->call(VideosTableSeeder::class);

        $this->call(TreesTableSeeder::class);

        Model::reguard();
    }
}
