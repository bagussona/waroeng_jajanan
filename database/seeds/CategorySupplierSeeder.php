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
            'name' => 'Bolu Cake',
            'slug' => 'bolu-cake'
        ]);

        Category::create([
            'name' => 'Biskuit',
            'slug' => 'biskuit'
        ]);

        Category::create([
            'name' => 'Kerupuk',
            'slug' => 'kerupuk'
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
