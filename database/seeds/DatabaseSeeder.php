<?php

namespace Database\Seeders;

use App\Models\Role;
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
        $role = Role::updateOrCreate([
            'title' => 'super_admin'
        ], [
            'permissions' => json_encode(['super-admin']),
        ]);

        $user = User::updateOrCreate([
            'id' => 1
        ], [
            'id' => 1,
            'name' => 'محمد',
            'surname' => 'علیمردانی',
            'cell' => '09198959530',
            'email' => 'alimardani94@gmail.com',
            'password' => Hash::make('12345678'),
        ]);

        $user->roles()->save($role);
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
