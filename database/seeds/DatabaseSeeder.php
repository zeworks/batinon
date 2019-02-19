<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(SettingsTableSeeder::class);
        $this->call(NavigationTableSeeder::class);
    }
}

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'name' => 'Diana Pampols',
            'email' => 'admin@admin.pt',
            'password' => Hash::make('admin'),
        ]);
    }
}

class SettingsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('settings')->insert([
            'website_name' => 'Just For you',
            'website_account_email' => 'info@justforyou.pt',
            'website_legal_name' => 'Just For You',
            'website_desc' => 'Just For You',
        ]);
    }
}

class NavigationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $nav = [
            ['title' => 'Main Menu'],
            ['title' => 'Footer Menu']
        ];
        
        foreach ($nav as $key => $navItem) {
            DB::table('navigations')->insert($navItem);    
        }
        
    }
}
