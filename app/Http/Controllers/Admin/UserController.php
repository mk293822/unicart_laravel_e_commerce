<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query()->with('order.ordered_products.products');
        // dd($query);

        $q = $request->get('q');  // Search query
        $u = $request->get('u', 'id');  // Sort by column, default to 'id'
        $direction = $request->get('directionUser', 'desc');  // Sort direction, default to 'desc'


        if ($q) {
            if (is_numeric($q)) {
                if ($u == 'id') {
                    $query->where('id', '=', (int)$q);
                } elseif ($u == 'ordered_products') {
                    $query;
                }
            } else {
                // If it's a text search, perform a LIKE search
                if ($u == 'email') {
                    $query->where('email', 'like', "%{$q}%");
                } else if ($u == "name") {
                    $query->where('name', 'like', "%{$q}%");
                }
            }
        }
        // dd($users);
        if ($u == "ordered_products") {
            $query->orderBy('id', $direction);
        } else {
            $query->orderBy($u, $direction);
        }
        $users = $query->paginate("10");
        return view("admin.users.index", [
            "users" => $users,
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
    public function show(User $user)
    {
        // dd($user);
        return view("admin.users.show", [
            'user' => $user
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', [
            'user' => $user
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $name = $request->input('name');
        $email = $request->input('email');
        $password = $request->input('password');

        if (Hash::check($password, $user->password)) {
            $user->name = $name;
            $user->email = $email;
            $user->save();
        }
        return redirect()->route('admin.users.show', $user);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        User::where('id', $user->id)->delete();
        return redirect()->route('admin.users.index');
    }
}
