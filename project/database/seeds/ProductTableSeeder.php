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

         'imagePath' => 'http://ec274d2b83908af176bc-b9dc8e81a637a12128f9ef8b61676311.r69.cf2.rackcdn.com/images/detail/district-individual.jpg',
         'title'     => 'District Clothing',
         'description' => 'How do you infuse a Nexternal ecommerce website for fashion basics with color and personality? Find out in the District Clothing case study.',
         'price'       =>  30

       ]);
       $product->save();


       $product = new \App\Product([

         'imagePath' => 'http://ec274d2b83908af176bc-b9dc8e81a637a12128f9ef8b61676311.r69.cf2.rackcdn.com/images/detail/uag-individual.jpg',
         'title'     => 'Urban Armor Gear',
         'description' => 'UAG wanted to throw down in one of the most competitive ecommerce verticals. They picked the right ecommerce design and marketing firm to help.',
         'price'       => 35

       ]);
       $product->save();


       $product = new \App\Product([

         'imagePath' => 'http://ec274d2b83908af176bc-b9dc8e81a637a12128f9ef8b61676311.r69.cf2.rackcdn.com/images/detail/spinning-individual.jpg',
         'title'     => 'Spinning',
         'description' => 'Find out how Coalitions team helped a global brand re-establish itself as the industry leader in a new venue- search.',
         'price'       => 27

       ]);
       $product->save();


       $product = new \App\Product([

         'imagePath' => 'http://ec274d2b83908af176bc-b9dc8e81a637a12128f9ef8b61676311.r69.cf2.rackcdn.com/images/detail/swimspot-individual.jpg',
         'title'     => 'SwimSpot',
         'description' => 'Coalition carried this struggling startup from a paltry $4,000 a month to $1,000,000 + a year. How did we do it? Find out more here.',
         'price'       => 34

       ]);
       $product->save();


       $product = new \App\Product([

         'imagePath' => 'http://ec274d2b83908af176bc-b9dc8e81a637a12128f9ef8b61676311.r69.cf2.rackcdn.com/images/detail/artofcharm-individual.jpg',
         'title'     => 'The Art of Charm',
         'description' => 'Turning ordinary men into extraordinary gentlemen, requires an extraordinary web marketing team. Good thing The Art of Charm chose Coalition.',
         'price'       => 50

       ]);
       $product->save();




    }
}
