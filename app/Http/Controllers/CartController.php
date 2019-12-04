<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Media;
//use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Session;
//use Session;
use Illuminate\Http\Request;
use Stripe\Exception\ApiErrorException;
use Stripe\Stripe;
use function Sodium\add;

//use App\Http\Requests;

class CartController extends Controller
{

    public function show()
    {
        //$cart = Session::has('cart') ? Session::get('cart') : null;
        if(!Session::has('cart')) {
            return view('/shop/cart');//,  ['items' => null]
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        //dd($cart->items);
        return view('/shop/cart', [
            'items' => $cart->items,
            'totalPrice' => $cart->totalPrice,
        ]);
    }

    public function add(Request $req, $id) {
        $media = Media::find($id);
        //dd($media);----------------------------------------------------------------------------------
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($media, $media->id);

        Session::put('cart', $cart);
        //dd(Session::get('cart'));-------------------------------------------------------------
        return redirect('/mediaGallery');
    }

    public function destroy($id)
    {
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($id);
        Session::put('cart', $cart);
        return redirect('/cart');
    }

    public function checkout()
    {
        if(!Session::has('cart')) {
            return view('/shop/cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;
        $desc = 'itemIDs';
        $items = $cart->items;
        foreach($items as $item) {
            $a = $item['item']['id'];
            $desc .= " ".$a;
        }

        Stripe::setApiKey('sk_test_E4s7W0SZECfLxQcwByCvUys500NrdrU9Fy');//development publish key: sk_test_E4s7W0SZECfLxQcwByCvUys500NrdrU9Fy


        try {
            $intent = \Stripe\PaymentIntent::create([
                'amount' => $total * 100,
                'currency' => 'gbp',
                'description' => $desc,
                'statement_descriptor' => 'JohnyBlaze Music',
            ]);
        } catch (ApiErrorException $e) {
            dd("CartController checkout() => ".$e);
        }
        //dd($intent);
        return view('/shop/checkout', ['total' => $total, 'intent' => $intent,]);
    }

    function console_log($output, $with_script_tags = true) {
        $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) .
            ');';
        if ($with_script_tags) {
            $js_code = '<script>' . $js_code . '</script>';
        }
        echo $js_code;
    }

    public function postCheckout(Request $request)
    {
        if(!Session::has('cart')) {
            //return view('/shop/cart');
            return redirect()->to('/cart');
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        $total = $cart->totalPrice;

        Session::put('items', $cart);
        Session::forget('cart');
        return redirect()->to("/shop/downloads");

        /**/
        //return redirect()->to('downloadPage')----------------------------------------------------------------------------**finish this off**
    }

    public function downloads()
    {
        $oldCart = Session::get('items');
        $cart = new Cart($oldCart);


        return view('/shop/downloads', [
            'items' => $cart->items,
        ]);
    }

}
