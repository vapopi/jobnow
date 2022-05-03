<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PremiumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("premium.index");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("premium.create");
    }

        /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Mastercard
        $this->validate($request, [
            'card_number' => 'required|regex:/5[1-5][0-9]{14}/',
            'expiration_date' => 'required|date',
            'cvv' => 'required|max:3'
        ]);

        $user = Auth::user();

        $user['premium'] = 1;
        $user->save();        

        return redirect()->route('users.show', $user)
            ->with('success', "Congrats, you are now premium!");
    }
}
