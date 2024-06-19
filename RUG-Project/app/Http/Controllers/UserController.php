<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use GuzzleHttp\Client;

class UserController extends Controller
{
    // fetch all users in the database
    public function index()
    {
        $users = User::all();

        // return the user data to the view
        return view('users.index', compact('users'));
    }

    // Create a new user
    public function create()
    {
        return view('users.create');
    }


    // Store a newly created user in DB
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:10',
        ]);

        if ($request->has(['name', 'email', 'phone'])) {
            // Use manually inputted data
            $user = new User();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->phone = $request->input('phone');
        } else {
            // Fetch user data from API
            $client = new Client();
            $response = $client->get('https://randomuser.me/api/');
            $data = json_decode($response->getBody(), true);

            $randomUser = $data['results'][0];

            // Storing the user
            $user = new User();
            $user->name = $randomUser['name']['first'] . ' ' . $randomUser['name']['last'];
            $user->email = $randomUser['email'];
            $user->phone = $randomUser['phone'];
        }

        // Provide default password in the meanwhile bc of error
        $user->password = bcrypt('defaultpassword');
        $user->save();

        // Show success message on index page
        return redirect()->route('users.index')->with('SUCCESS!', 'User created successfully.');
    }


    // Display user by ID
    public function show($id)
    {
        // iterates through list of user ids and returns it or fails to find it
        $user = User::findOrFail($id);

        // return specified user to the "show" view
        return view('users.show', compact('user'));
    }

    // Edit user by ID
    public function edit($id)
    {
        $user = User::findOrFail($id);

        return view('users.edit', compact('user'));
    }


    // Update user by ID
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
        ]);

        $user = User::findOrFail($id);
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->phone = $request->input('phone');
        $user->save();

        return redirect()->route('users.index')->with('SUCCESS!', 'User updated successfully.');
    }

    // Delete user by ID
    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('users.index')->with('SUCCESS!', 'User deleted successfully.');
    }


    public function storeRandom()
    {
        $client = new Client();
        $response = $client->get('https://randomuser.me/api/');
        $data = json_decode($response->getBody(), true);

        $randomUser = $data['results'][0];

        // Store the user data
        $user = new User();
        $user->name = $randomUser['name']['first'] . ' ' . $randomUser['name']['last'];
        $user->email = $randomUser['email'];
        $user->phone = $randomUser['phone'];
        // remove this after password bug is fixed
        $user->password = bcrypt('defaultpassword');
        $user->save();

        return redirect()->route('users.index')->with('success', 'Random user created successfully.');
    }
}
