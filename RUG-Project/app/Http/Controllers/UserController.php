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
            'title' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'required|string|max:15',
        ]);

        if ($request->has(['title', 'name', 'surname', 'email', 'phone'])) {
            // Use manually inputted data
            $user = new User();
            $user->title = $request->input('title');
            $user->name = $request->input('name');
            $user->surname = $request->input('surname');
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
            'title' => 'required|string|max:10',
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $id,
            'phone' => 'required|string|max:15',
        ]);

        $user = User::findOrFail($id);
        $user->title = $request->input('title');
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
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
        $user->title = $randomUser['name']['title'];
        $user->name = $randomUser['name']['first'];
        $user->surname = $randomUser['name']['last'];
        $user->email = $randomUser['email'];
        $user->phone = $randomUser['phone'];
        $user->picture = $randomUser['picture']['large'];

        // $user->password = bcrypt('defaultpassword');
        $user->save();

        return redirect()->route('users.index')->with('SUCCESS!', 'Random user created successfully.');
    }
}
