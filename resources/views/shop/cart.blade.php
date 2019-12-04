@extends('layouts.app')

@section('title', 'Johny Burnz - Cart')


@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <h1>Cart</h1>
                @if(Session::has('cart'))
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">

                            <table class="list-group pt-5 pb-5">
                                @foreach($items as $item)
                                    <tr class="list-group-item" style="width: 500px; height: 60px; display: flex; flex-direction: row; justify-content: space-between; align-items: baseline;">
                                        <td style="padding-bottom: 10px; width: 100px;">
                                            <strong>
                                                {{ $item['item']['title'] }}
                                            </strong>
                                        </td>
                                        <td style="padding-bottom: 10px;">
                                            <span style="margin-bottom: 10px; max-height: 28px; padding-right: 4px; padding-left: 4px; display: flex; flex-direction: row; justify-content: center; background-color: rgba(107,113,113,0.65); color: #faebd7; border-radius: 10px;">
                                                {{ $item['price'] > 0 ? $item['price'] : 'Free' }}
                                            </span>
                                        </td>
                                        <td style=" width: 100px; align-content: center">
                                            <button type="button" class="btn btn-primary" style="margin-bottom: 10px; max-height: 28px; display: flex; flex-direction: column; justify-content: center;" onclick="window.location='{{ url("/cart/removeFromCart/".$item['item']->id) }}'">
                                                Remove
                                            </button>
                                        </td>
                                    </tr>
                                @endforeach
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                            <strong>Total to pay: £{{ $totalPrice }}</strong>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                            <button type="button" class="btn btn-success" onclick="window.location='{{ url("/checkout") }}'">Checkout</button>
                        </div>
                    </div>
                @else
                    <div class="row">
                        <div class="col-sm-6 col-md-6 col-md-offset-3 col-sm-offset-3">
                            <h2>No Items In Cart</h2>
                        </div>
                    </div>
                @endif

            </div>
        </div>
    </div>

@endsection
