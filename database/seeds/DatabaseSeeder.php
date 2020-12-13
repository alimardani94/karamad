<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->createAdminUser();
        $this->createProvince();
        $this->createCity();
    }

    private function createAdminUser()
    {
        $user = [
            'id' => 1,
            'name' => 'محمد',
            'surname' => 'علیمردانی',
            'cell' => '09198959530',
            'email' => 'alimardani94@gmail.com',
            'password' => '$2y$10$v5UsZMnnHbWHgfDKYScHMOjOQfPt0ovVH0MbbZegEOb01EVsk.19e',
        ];

        $admin = [
            'id' => 1,
            'user_id' => 1,
        ];

        User::updateOrCreate([
            'id' => $user['id']
        ], $user);

        Admin::updateOrCreate([
            'id' => $admin['id']
        ], $admin);
    }

    private function createProvince()
    {
        DB::unprepared(File::get(__DIR__ . '/sql/provinces.sql'));
    }

    private function createCity()
    {
        DB::unprepared(File::get(__DIR__ . '/sql/cities.sql'));
    }
}
