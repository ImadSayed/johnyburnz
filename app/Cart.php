<?php

namespace App;


class Cart
{
    public $items = null;
    public $totalQty = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQty = $oldCart->totalQty;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    /* following method is for adding multiple copies of same item
     public function add($item, $id)
    {
        $storedItem = ['qty' => 0, 'price' => $item->price, 'item' => $item];
        if($this->items) {
            if(array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['qty']++;
        $storedItem['price'] = $item->price * $storedItem['qty'];
        $this->items[$id] = $storedItem;
        $this->totalQty++;
        $this->totalPrice += $item->price;
    }
     * */

    //following add method only adds item if it doesn't already exist in cart
    public function add($item, $id)
    {
        $storedItem = ['price' => $item->price, 'item' => $item];
        if($this->items) {
            if(array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            } else {
                $this->totalPrice += $item->price;
                $this->totalQty++;
            }
        }
        else
        {
            $this->totalPrice += $item->price;
            $this->totalQty++;
        }
        $this->items[$id] = $storedItem;
    }

    public function remove($id)
    {

        if($this->items) {
            if(array_key_exists($id, $this->items)) {
                $itemPrice = $this->items[$id]['price'];
                unset($this->items[$id]);
                $this->totalPrice -= $itemPrice;
                $this->totalQty--;
            }
        }
    }
}
