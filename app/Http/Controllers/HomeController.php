<?php

namespace App\Http\Controllers;

use App\Models\Email;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function email(Request $request){
        $request->validate([
            'email' => 'required',
        ]);

        if(Email::where('email', $request->email)->count() == 0){
            Email::create([
                'email' => $request->email
            ]);
        }

        return back()->with('success', true);
    }
}
