<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Discount;
use App\Models\Admin;
use App\Models\Attribute;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Attribute::create([
            'name' => 'Color',
            'value' => 'red,black,white,yellow,green'
        ]);
        Attribute::create([
            'name' => 'Size',
            'value' => '13,14,15,16,17'
        ]);
        Attribute::create([
            'name' => 'Wireless',
            'value' => 'true,false'
        ]);
        Category::factory()->create([
            'name' => 'Computers & Accessories',
            'image' => '/storage/category/Computers & Accessories.jpg',
        ]);
        Category::factory()->create([
            'name' => 'Mobile Skin Stickers',
            'image' => '/storage/category/Mobile Skin Stickers.jpeg',
        ]);
        Category::factory()->create([
            'name' => 'Power Banks',
            'image' => '/storage/category/Power Banks.jpeg',
        ]);
        Category::factory()->create([
            'name' => 'Wireless Chargers',
            'image' => '/storage/category/Wireless Chargers.jpeg',
        ]);
        Category::factory()->create([
            'name' => 'CPU',
            'image' => '/storage/category/cpu.png',
        ]);
        Category::factory()->create([
            'name' => 'Keyboard',
            'image' => '/storage/category/keyboard.png',
        ]);
        Category::factory()->create([
            'name' => 'Mouse',
            'image' => '/storage/category/mouse.png',
        ]);
        Category::factory()->create([
            'name' => 'Printer',
            'image' => '/storage/category/printer.png',
        ]);


        Brand::factory()->count(10)->create();
        Discount::factory()->count(5)->create();
    }
}
