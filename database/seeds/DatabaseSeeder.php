<?php

namespace Database\Seeders;

use App\Models\ProductCategory;
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
        $this->createCourseCategories();
        $this->createProductCategories();
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

    private function createCourseCategories()
    {

    }

    private function createProductCategories()
    {
        $categories = [
            [
                'id' => 1,
                'parent_id' => null,
                'name' => 'مواد غذایی',
            ], [
                'id' => 2,
                'parent_id' => 1,
                'name' => 'نوشیدنی‌ها',
            ], [
                'id' => 3,
                'parent_id' => 1,
                'name' => 'شیرینی‌جات',
            ], [
                'id' => 4,
                'parent_id' => 1,
                'name' => 'لبنیات',
            ], [
                'id' => 5,
                'parent_id' => 1,
                'name' => 'ادویه‌جات',
            ], [
                'id' => 6,
                'parent_id' => 1,
                'name' => 'خشکبار',
            ], [
                'id' => 7,
                'parent_id' => null,
                'name' => 'پوشاک',
            ], [
                'id' => 8,
                'parent_id' => 7,
                'name' => 'زنانه',
            ], [
                'id' => 9,
                'parent_id' => 7,
                'name' => 'مردانه',
            ], [
                'id' => 10,
                'parent_id' => 7,
                'name' => 'بچه‌گانه',
            ], [
                'id' => 11,
                'parent_id' => null,
                'name' => 'صنایع دستی',
            ], [
                'id' => 12,
                'parent_id' => 11,
                'name' => 'هنرهای تجسمی',
            ], [
                'id' => 13,
                'parent_id' => 11,
                'name' => 'محصولات چوبی و حصیری',
            ], [
                'id' => 14,
                'parent_id' => 11,
                'name' => 'محصولات سنگی',
            ], [
                'id' => 15,
                'parent_id' => 11,
                'name' => 'محصولات فلزی',
            ], [
                'id' => 16,
                'parent_id' => 11,
                'name' => 'محصولات شیشه و آبگینه',
            ], [
                'id' => 17,
                'parent_id' => 11,
                'name' => 'محصولات چرم',
            ], [
                'id' => 18,
                'parent_id' => 11,
                'name' => 'سفال, کاشی و چینی',
            ], [
                'id' => 19,
                'parent_id' => 11,
                'name' => 'دکوری و تزئینی',
            ], [
                'id' => 20,
                'parent_id' => null,
                'name' => 'عطاری',
            ], [
                'id' => 21,
                'parent_id' => 20,
                'name' => 'دارو و روغن های درمانی',
            ], [
                'id' => 22,
                'parent_id' => 20,
                'name' => 'گیاهان دارویی',
            ], [
                'id' => 23,
                'parent_id' => 20,
                'name' => 'عرقیجات',
            ], [
                'id' => 24,
                'parent_id' => null,
                'name' => 'فرهنگی, آموزشی و سرگرمی',
            ], [
                'id' => 25,
                'parent_id' => 24,
                'name' => 'بازی و سرگرمی',
            ], [
                'id' => 26,
                'parent_id' => 24,
                'name' => 'کتاب',
            ], [
                'id' => 27,
                'parent_id' => null,
                'name' => 'خدمات',
            ], [
                'id' => 28,
                'parent_id' => 27,
                'name' => 'گرافیک, طراحی و عکاسی',
            ]
        ];

        ProductCategory::insertOrIgnore($categories);
    }
}
