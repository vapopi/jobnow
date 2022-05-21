<?php

namespace App\Http\Controllers;

use App\Models\Notification;
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
        $this->validate($request, [
            'card_number' => 'required|regex:/\b\d{13,16}\b/',
            'expiration_date' => 'required|date',
            'cvv' => 'required|regex:/[0-9]{3}/|max:3'
        ]);

        $user = Auth::user();

        $user['premium'] = 1;
        $user->save();        

        Notification::create([
            'title' => "Premium",
            'description' => "Congrats, you are now a premium user!",
            'author_id' => $user->id,
        ]);

        return redirect()->route('users.show', $user)
            ->with('success', "Congrats, you are now premium!");
    }
}
