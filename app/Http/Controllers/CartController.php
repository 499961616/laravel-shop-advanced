<?php

namespace App\Http\Controllers;

use App\Http\Requests\AddCartRequest;
use App\Models\CartItem;
use App\Models\ProductSku;
use App\Services\CartService;
use Illuminate\Http\Request;

class CartController extends Controller
{

    protected  $cartService;

    public function __construct(CartService  $cartService)
    {
        $this->cartService = $cartService;
    }

    public function index(Request $request)
    {
        $carItems = $request->user()->cartItems()->with(['productSku.product'])->get();

        $addresses = $request->user()->addresses()->orderBy('last_used_at', 'desc')->get();

        return view('cart.index', ['cartItems' => $carItems, 'addresses' => $addresses]);
    }

    public function add(AddCartRequest $request)
    {

        $this->cartService->add($request->input('sku_id'), $request->input('amount'));

    }

    public function remove(ProductSku  $sku,Request $request)
    {
       $this->cartService->remove($sku->id);

        return [];
    }
}
