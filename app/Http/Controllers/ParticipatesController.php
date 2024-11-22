<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Participate;

class ParticipatesController extends Controller
{
    // Show the participation form
    public function index()
    {
        return view('participate'); // Ensure `participate.blade.php` exists in the `resources/views` folder
    }

    // Handle form submission
    public function store(Request $request)
    {
        // Validate input
        $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:participates,email',
            'phone' => 'required|string|max:20',
        ]);

        // Store in the database
        Participate::create([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
        ]);

        // Redirect to the Thank You page
        return redirect()->route('thanks');
    }
}
