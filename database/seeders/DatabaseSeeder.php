<?php

namespace Database\Seeders;

use Database\Seeders\AdminTableSeeder;
use Database\Seeders\PageMetaSeoSeeder;
use Database\Seeders\SettingTableSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminTableSeeder::class);
        $this->call(SettingTableSeeder::class);
        $this->call(PageMetaSeoSeeder::class);
    }
}
