<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicatedOffer;
use App\Models\Notification;
use App\Models\File;
use Illuminate\Support\Facades\Auth;

class ApplicatedOffersApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicatedOffers = ApplicatedOffer::all();
        return response($applicatedOffers);
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
            'user_id' => 'required',
            'curriculum' => 'required|mimes:pdf|max:2048',
            'offer_id' => 'required',
        ]);

        $input = $request->all();
        
        $upload = $request->file('curriculum');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        $fileExtension = $upload->getClientOriginalExtension();
        $uploadName = time() . '_' . $fileName;

        $filePath = $upload->storeAs(
            'uploads',    
            $uploadName,   
            'public'        
        );

        if (\Storage::disk('public')->exists($filePath)) {

            $fullPath = \Storage::disk('public')->path($filePath);

            $file = File::create([
                'filename' => $filePath,
                'filesize' => $fileSize,
            ]);

            $upload->filepath = $filePath;
            $upload->filesize = $fileSize;
            $input['curriculum'] = $file->id;
        }

        $applicatedOffer = ApplicatedOffer::create($input);
        
        Notification::create([
            'title' => "Applicated Offer",
            'description' => "You applicated the offer with ID " . $input['offer_id'] . " successfully.",
            'author_id' => $request['user_id'],
        ]);

        return \response("You have applicated to the offer successfully!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(int $id) 
    {
        $applicatedOffer = ApplicatedOffer::find($id);
        return \response($applicatedOffer);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(int $oid, Request $request, int $aoId)
    {
        $applicatedOffer = ApplicatedOffer::where('offer_id', '=', $oid)
        ->find($aoId)
        ->update($request->all());

        return response($applicatedOffer);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $oid, int $aoId)
    {
        ApplicatedOffer::where('offer_id', '=', $oid);
        ApplicatedOffer::destroy($aoId);

        // return response(content: "Success. The applicated offer ${aoId} has been eliminated");
    }
}