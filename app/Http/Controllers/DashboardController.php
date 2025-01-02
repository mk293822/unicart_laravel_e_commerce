<?php

namespace App\Http\Controllers;

use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;



class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // dd(session('cartProducts'));

        $categories = Categories::all();


        $query = $request->input("q");
        $guery = $request->input("g");

        view()->share(['categories' => $categories, 'cate_id' => $guery]);

        if ($query) {
            $query_products = Products::where('name', 'like', "%{$query}%")->get();
            return view("dashboard.index", [
                "products" => Products::whereNot('name', 'like', "%{$query}%")->get()->sortByDesc('created_at'),
                "query" => $query_products,
            ]);
        } else if ($guery) {
            return view("dashboard.index", [
                "products" => Products::where('category_id', 'like', "%{$guery}%")->get()->sortByDesc('created_at'),
            ]);
        } else {
            return view("dashboard.index", [
                "products" => Products::all()->sortByDesc('created_at'),
            ]);
        }
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
        $user = $request->user();

        if (!$user) {
            return response()->json(['message' => 'User is not authenticated.'], 401);
        }

        $cart = $user->cart;

        if (!$cart) {
            return response()->json(['message' => 'Cart not found for user.'], 404);
        }

        $cart_id = $cart->id;
        $product_json = $request->input('product');
        $product = json_decode($product_json, true);
        $quantity = $request->input('quantity');

        $cart = Session::get("cartProducts", []);

        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity'] += $quantity;
        } else {
            $cart[$product['id']] = [
                'index' => count($cart) + 1,
                'cart_id' => $cart_id,
                'name' => $product['name'],
                'slug' => $product['slug'],
                'price' => $product['price'],
                'rating' => $product['rating'],
                'quantity' => $quantity,
                'image' => $product['image'],
                'description' => $product['description'],
                'category_id' => $product['category_id'],
                'at' => (new \DateTime())->getTimestamp(),
            ];
        }

        Session::put('cartProducts', $cart);

        return redirect()->route('dashboard.index');
    }
    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        return view("dashboard.show", [
            "product" => $product,
        ]);
    }



    public function add_cart(Request $request)
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

        $product_id = $request->input('product_id');
        $product = Products::where('id', $product_id)->first();
        if (!$product) {
            return response()->json(['message' => 'Product not found.'], 404);
        }

        $cart = Session::get("cartProducts", []);
        if (isset($cart[$product->id])) {
            $cart[$product->id]['quantity'] += 1;
        } else {

            $cart[$product->id] = [
                'index' => count($cart) + 1,
                'cart_id' => $cart_id,
                'name' => $product->name,
                'slug' => $product->slug,
                'price' => $product->price,
                'rating' => $product->rating,
                'quantity' => 1,
                'image' => $product->image,
                'description' => $product->description,
                'category_id' => $product->category_id,
                'at' => (new \DateTime())->getTimestamp(),
            ];
        }
        try {
            Session::put('cartProducts', $cart);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error'
            ]);
        }

        return response()->json([
            'message' => 'Success'
        ]);
    }
}
