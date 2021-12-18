<?php

use Illuminate\Support\Facades\DB;

class CollectionTableSeeder extends DatabaseSeeder
{
    /**
     * Run cms_users table seeder.
     *
     * @return void
     */
    public function run()
    {

        DB::table('collections')->truncate();

        DB::table('collections')->insert([
            [
                'title' => 'სადღეგრძელოები',
                'type' => 'sadgegrzeloebi',
                'admin_order_by' => 'position',
                'admin_sort' => 'desc',
                'admin_per_page' => 20,
                'web_order_by' => 'position',
                'web_sort' => 'desc',
                'web_per_page' => '1'
            ],
            [
                'title' => 'კატეგორიები',
                'type' => 'categories',
                'admin_order_by' => 'position',
                'admin_sort' => 'desc',
                'admin_per_page' => 20,
                'web_order_by' => 'position',
                'web_sort' => 'desc',
                'web_per_page' => '1'
            ],
        ]);

    }
}
