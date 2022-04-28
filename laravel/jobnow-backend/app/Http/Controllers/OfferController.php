<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OfferController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(int $company_id)
    {
        $offers = Offer::where('company_id', '=', $company_id)->get();

        return response($offers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(int $company_id, Request $request)
    {
        $request->validate([
            'offer' => 'required|max:255',
            'company_id' => 'required'
        ]);

        $all = $request->all();
        $all['company_id'] = $company_id;
        $offer = Offer::create($all);

        return response($offer);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id, int $company_id)
    {
        $offer = Offer::where('company_id', '=', $company_id)
        ->find($id);

        return response($offer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, int $id, int $company_id)
    {
        $offer = Offer::where('company_id', '=', $company_id)
        ->find($id)
        ->update($request->all());

        return response($offer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id, int $company_id)
    {
        Offer::where('company_id', '=', $company_id);
        Offer::destroy($id);

        // return response(content: "Success. The offer ${id} has been eliminated");
    }
}
