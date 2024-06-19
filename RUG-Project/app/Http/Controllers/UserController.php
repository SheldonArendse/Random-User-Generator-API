<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    // fetch all users in the database
    public function index()
    {
        $users = User::all();

        // return the user data to the view
        return view('users.index', ['users' => $users]);
    }

    // Create a new user
    public function create()
    {
        return view('users.create');
    }


    // Store a newly created user in DB
    public function store(Request $request)
    {
        // Check the requested data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users|max:255',
        ]);

        // Create a new user object
        $user = new User();

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        // return success message
        return redirect()->route('users.index')->with('success', 'User created successfully!');
    }


    // Display user by ID
    public function show($id)
    {
        // iterates through list of user ids and returns it or fails to find it
        $user = User::findOrFail($id);

        // return specified user to the "show" view
        return view('users.show', ['user' => $user]);
    }

    // Edit user by ID
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', ['user' => $user]);
    }


    // Update user by ID
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:users,email,' . $id,
        ]);

        // Fetch user by ID and update details
        $user = User::findOrFail($id);

        $user->name = $validatedData['name'];
        $user->email = $validatedData['email'];
        $user->save();

        return redirect()->route('users.index')->with('success', 'User updated successfully.');
    }

    // Delete user by ID
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('success', 'User deleted successfully.');
    }
}
