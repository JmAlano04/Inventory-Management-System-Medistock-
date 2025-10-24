<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\User;

class AccountController extends Controller
{
    //
    public function index(){

        $Account = User::all();
        return view ('profile.account' , compact('Account'));
    }
    public function update(Request $request, $id){

         $Account = User::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,user',
            'email' => 'required|string|max:255',
           
        ]);

        $Account->update($validated);
 
        return redirect()->back()->with('success', 'Account updated successfully!');
        
    }
    public function store(Request $request){

         $validated = $request->validate([
            'name' => 'required|string|max:255',
            'role' => 'required|string|in:admin,user',
            'email' => 'required|string|max:255',
            'password' => 'required|string|max:255',
         ]);

        $Account = User::firstOrCreate( [
           'name'    => $validated['name'],
           'role'        => $validated['role'],
           'email'      => $validated['email'],
            'password'      => $validated['password'],
        ]);

         $Account->User()->create([
            'name'    => $validated['name'],
            'role'        => $validated['role'],
            'email'      => $validated['email'],
            'password'      => $validated['password'],
        ]);

         return redirect()->route('profile.account')->with('success', 'Account added successfully.');
        

    }

}
