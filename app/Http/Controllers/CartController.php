<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User is not authenticated.'], 401);
        }

        $cart = $user->cart;

        if (!$cart) {
            return response()->json(['message' => 'Cart not found for user.'], 404);
        }

        $cart_id = $cart->id;

        $cart = Session::get("cartProducts", []);
        if (empty($cart)) {
            return view("cart.index", ["cartItems" => []]);
        }
        $cartItems = collect($cart)->where("cart_id", $cart_id);

        return view("cart.index", [
            "cartItems" => $cartItems,
        ]);
    }


    public function updateQuantity(Request $request)
    {
        $cart = Session::get('cartProducts', []);

        if (isset($cart[$request->id])) {
            if ($request->quantity == 0) {
                unset($cart[$request->id]);
            } else {
                $cart[$request->id]['quantity'] = $request->quantity;
            }
            Session::put('cartProducts', $cart);

            return response()->json(["success" => true]);
        }
        return response()->json([
            "data" => "Error",
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}