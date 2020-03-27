<?php

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            ['id' => 1, 'parent_id' => 0, 'name' => 'دبستان', 'image' => '', 'description' => ''],
            ['id' => 2, 'parent_id' => 0, 'name' => 'دبیرستان', 'image' => '', 'description' => ''],
            ['id' => 3, 'parent_id' => 0, 'name' => 'عمومی', 'image' => '', 'description' => ''],
        ];

        foreach ($items as $item) {
            Category::updateOrCreate([
                'id' => $item['id']
            ], $item);
        }
    }
}
