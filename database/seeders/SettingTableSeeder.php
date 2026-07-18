<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SettingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $this->settingCreate();
            DB::commit();
            $this->command->info('Setting info successfully seeded.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    private function settingCreate()
    {
        $setting = Setting::firstOrCreate();
        $setting->site_title = env('APP_NAME');
        $setting->save();
        return true;
    }
}
