<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicatedOffer;
use App\Models\Company;
use App\Models\File;
use App\Models\Offer;

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


    public function destroy(Offer $offer)
    {
        $applicated = ApplicatedOffer::where('offer_id', "=", $offer->id)->get();

        foreach ($applicated as $app){
            $app->delete();
            File::where('id', "=", $app->curriculum)->delete();
        }

        $offer->delete();

        return redirect()->route('companies.show', $offer->company_id)
            ->with('success', 'The offer with ID'. ' '.$offer->id .' '.'has been eliminated');
    }

}
