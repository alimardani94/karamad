<?php

use App\Models\Admin;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
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
}
