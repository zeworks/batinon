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
            'name' => 'User Name',
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
            'website_name' => 'My website Name',
            'website_account_email' => 'info@website.pt',
            'website_legal_name' => 'Website',
            'website_desc' => 'Website',
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
            ['title' => 'Main Menu', 'status' => 1],
            ['title' => 'Footer Menu', 'status' => 0]
        ];
        
        foreach ($nav as $key => $navItem) {
            DB::table('navigations')->insert($navItem);    
        }
        
    }
}
