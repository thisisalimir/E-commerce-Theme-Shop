<?php

use Illuminate\Database\Seeder;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $product = new \App\Product([
         'imagePath' => 'https://thebookspyblog.files.wordpress.com/2016/05/the-whistler-preview.jpg',
         'title'     => 'The Whistler',
         'description' => 'From John Grisham, America’s #1 bestselling author, ',
         'price'       => 14
       ]);
       $product->save();
    }
}
