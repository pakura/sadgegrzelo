<?php

use Illuminate\Support\Facades\DB;

class CmsUsersTableSeeder extends DatabaseSeeder
{
    /**
     * Run cms_users table seeder.
     *
     * @return void
     */
    public function run()
    {
        $currentDate = date('Y-m-d H:i:s');

        DB::table('cms_users')->truncate();

        DB::table('cms_users')->insert([
            [
                'email' => 'admin@admin.com',
                'first_name' => 'admin',
                'last_name' => 'Admin',
                'role' => 'admin',
                'blocked' => 0,
                'password' => \Illuminate\Support\Facades\Hash::make('admin100'),
                'created_at' => $currentDate
            ]
        ]);

        DB::table('cms_settings')->truncate();

        DB::table('cms_settings')->insert([
            [
                'cms_user_id' => 1,
                'created_at'  => $currentDate
            ]
        ]);
    }
}
