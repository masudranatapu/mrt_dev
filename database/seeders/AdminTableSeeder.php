<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    public function run(): void
    {
        try {
            DB::beginTransaction();
            $this->adminCreate();
            DB::commit();
            $this->command->info('Admin successfully seeded.');
        } catch (\Throwable $th) {
            DB::rollBack();
            $this->command->info($th->getMessage());
        }
    }

    private function adminCreate()
    {
        $admin = new User();
        $admin->first_name = 'Masud Rana';
        $admin->last_name = 'Tapu';
        $admin->username = 'masudranatapu';
        $admin->email = 'masudranatapu@gmail.com';
        $admin->unknown = base64_encode('password');
        $admin->password = Hash::make('password');
        $admin->status = 'Active';
        $admin->save();
    }

}
