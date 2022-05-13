<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RouteOffersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("offers.index", ['authUserId' => \Auth::user()->id]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("offers.create", ['authUserId' => \Auth::user()->id]);
    }
}
