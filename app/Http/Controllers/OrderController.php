<?php

namespace App\Http\Controllers;

use App\Models\OrderedProducts;
use App\Models\Orders;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
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


        $orders = Orders::where('user_id', $user->id)->with('ordered_products.products')->get();

        // dd($orders);
        return view("order.index", [
            "orders" => $orders,
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
     * Pending
Processing
Shipped
Delivered
Cancelled
Returned
Refunded
Failed
On Hold
     */
    public function store(Request $request)
    {
        // Check if the user is authenticated
        $user = $request->user();
        if (!$user) {
            return response()->json(['message' => 'User is not authenticated.'], 401);
        }

        // Validate the request
        $validator = Validator::make($request->all(), [
            'address' => 'required|string',
            'total' => 'required|numeric',
            'cartItems' => 'required|json',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Get the inputs
        $address = $request->input('address');
        $total = $request->input('total');
        $cartitems = json_decode($request->input('cartItems'), true); // Decode cartItems

        try {

            // Create the order
            $order = Orders::create([
                "user_id" => $user->id,
                "status" => "pending",
                "total_price" => $total,
                "address" => $address,
            ]);

            foreach ($cartitems as $key => $item) {
                $product_id = $key;
                $quantity = $item['quantity'];
                $price = $item['price'];

                OrderedProducts::create([
                    "order_id" => $order->id,
                    "product_id" => $product_id,
                    "quantity" => $quantity,
                    "price" => $price,
                ]);

                $product = Products::where('id', $product_id)->first();
                $product->stock = $product->stock - $quantity;
                $product->save();
            }

            session()->forget('cartProducts');

            return redirect(route("order.index"))->with("success", "Success");
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An error occurred while processing the order.',
                'error' => $e->getMessage(),
            ], 500);
        }
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
