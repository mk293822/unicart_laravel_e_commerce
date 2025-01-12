<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Categories;
use App\Models\Products;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;


class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        Products::where('stock', 0)->delete();
        $q = $request->get('q');  // Search query
        $s = $request->get('s', 'id');  // Sort by column, default to 'id'
        $direction = $request->get('direction', 'desc');  // Sort direction, default to 'desc'

        $query = Products::query();

        // dd(Products::all());

        if ($q) {
            if (is_numeric($q)) {
                if ($s == 'id') {
                    $query->where('id', '=', (int)$q);
                } elseif ($s == 'stock') {
                    $query->where('stock', '=', $q);
                } elseif ($s == 'total') {
                    $query->whereRaw('price * stock = ?', [$q]);
                } else {
                    $query->where($s, '=', $q);
                }
            } else {
                // If it's a text search, perform a LIKE search
                $query->where('name', 'like', "%{$q}%");
            }
        }

        if ($s == 'total') {
            $query->orderByRaw('price * stock ' . strtoupper($direction));
        } else {
            $query->orderBy($s, $direction);
        }

        // Execute the query
        $products = $query->paginate('10');

        return view('admin.products.index', [
            'products' => $products,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view("admin.products.create", [
            "categories" => Categories::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $slug = Str::slug($request->input('name'));

        $validator = Validator::make($request->all(), [
            "name" => "required|string|max:255",
            "description" => "required|string|max:1000",
            "price" => "required|numeric",
            "stock" => "required|integer|min:1",
            "image" => "required|file|image|mimes:jpg,png,svg,jpeg,gif|max:2048",
            "category" => "required|string",
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }


        // dd($slug);

        $image =  $request->file('image');

        $imagePath = $image->store('products', 'public');

        $category_id = Categories::where("name", $request->input('category'))->first()->id;

        // dd($request->input('image'));
        Products::create([
            "name" => $request->input("name"),
            "description" => $request->input("description"),
            "price" => $request->input("price"),
            "stock" => $request->input("stock"),
            "image" => $imagePath,
            "category_id" => $category_id,
            "slug" => $slug,
        ]);

        return redirect()->route("admin.products.index")->with("success", "true");
    }

    /**
     * Display the specified resource.
     */
    public function show(Products $product)
    {
        if (!$product) {
            return redirect()->route("admin.errors.404")->with("error", "true");
        }
        return view("admin.products.show", [
            'product' => $product,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Products $product)
    {
        return view('admin.products.edit', [
            'product' => $product,
            'categories' => Categories::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Products $product)
    {
        $default_image = Products::where('id', $product->id)->first()->image;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imagePath = $image->store('products', 'public');
        } else {
            $imagePath = $default_image;
        }
        $name = $request->input('name');
        $description = $request->input('description');
        $stock = $request->input('stock');
        $price = $request->input('price');
        $category_id = Categories::where('name', $request->input('category'))->first()->id;


        Products::where('id', $product->id)->update([
            'name' => $name,
            'description' => $description,
            'price' => $price,
            'stock' => $stock,
            'image' => $imagePath,
            'category_id' => $category_id,
        ]);

        $product = Products::where('id', $product->id)->first();

        return redirect()->route('admin.products.show', $product)->with('success', 'true');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Products $product)
    {
        Products::where('id', $product->id)->delete();
        return redirect()->route('admin.products.index')->with('success', 'true');
    }
}
