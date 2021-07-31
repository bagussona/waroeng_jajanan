<?php

use App\Category;
use App\Supplier;
use Illuminate\Database\Seeder;

class CategorySupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'name' => 'Bolu Cake'
        ]);

        Category::create([
            'name' => 'Biskuit'
        ]);

        Category::create([
            'name' => 'Kerupuk'
        ]);

        Supplier::create([
            'name' => 'Waroeng Jajanan'
        ]);

        Supplier::create([
            'name' => 'Wandi Grosir'
        ]);

        Supplier::create([
            'name' => 'Agung Swalayan'
        ]);
    }
}
