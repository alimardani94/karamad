<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\User;
use Illuminate\Contracts\Filesystem\FileNotFoundException;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * @throws FileNotFoundException
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
            'password' => Hash::make('12345678'),
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

    /**
     * @throws FileNotFoundException
     */
    private function createProvince()
    {
        DB::unprepared(File::get(__DIR__ . '/sql/provinces.sql'));
    }

    /**
     * @throws FileNotFoundException
     */
    private function createCity()
    {
        DB::unprepared(File::get(__DIR__ . '/sql/cities.sql'));
    }
}
