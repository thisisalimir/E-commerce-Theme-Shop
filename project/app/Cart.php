<?php

namespace App;


//here we dont use Eloquent For this class we use simple PHP class
class Cart
{
    public $items = NULL;
    public $totalQty = 0;
    public $totalPrice = 0;

      //id user already has and old cart we set it
    public function __construct($oldCart)
    {
      if ($oldCart) {
        $this->items = $oldCart->items;
        $this->totalQty = $oldCart->totalQty;
        $this->totalPrice = $oldCart->totalPrice;
      }
    }

       //method to add item
    public function add($item,$id)
    {
      //declare our user purchase
      $storedItem = [
        'qty' => 0,
        'price' => $item->price,
        'item'  => $item
      ];
      //also if user already add that item we just overwrite
      //it becuase we dont want to have several same item
      if ($this->items) {
         if (array_key_exists($id,$this->items)) {
            $storedItem = $this->items[$id];
         }
      }
        //also after purchase we increment our quantity
      $storedItem['qty']++;
      //and also set price like: 10$ * 3 item
      $storedItem['price'] = $item->price * $storedItem['qty'];
      //and finally store that item with id
      $this->items[$id] = $storedItem;
       //also totalQty will increase after purchase
      $this->totalQty++;
      //and also price
      $this->totalPrice += $item->price;
    }


}
