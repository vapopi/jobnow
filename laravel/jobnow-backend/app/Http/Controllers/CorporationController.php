<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\Offer;
use App\Models\File;
use App\Models\ApplicatedOffer;
use Illuminate\Http\Request;

class CorporationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('corporations.index', [
            'corporations' => Company::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $corporation)
    {
        $offers = Offer::where('company_id', $corporation->id)->get();
        return view('corporations.show', [
            "corporation" => $corporation,
            "offers" => $offers, 
            "file" => File::where('id', $corporation->logo_id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $corporation)
    {
        return view('corporations.edit',[
            "corporation" => $corporation,
            "file" => File::find($corporation->logo_id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $corporation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $corporation)
    {
        $request->validate([

            'name' => 'required|max:50',
            'email' => 'required|email|max:255',

        ]);

        $user = User::where('id', $corporation->author_id)->first();


        if($request->hasFile('logo')) {

            $file = File::where('id', $corporation->logo_id)->first();

            $oldPath = $file->filename;
            $upload = $request->file('logo');
            $fileName = $upload->getClientOriginalName();
            $fileExtension = $upload->getClientOriginalExtension();
            $fileSize = $upload->getSize();
            $uploadName = time() . '_' . $fileName;

            if($fileExtension == 'gif' && $user->premium == 0)
            {
                return redirect()->route('corporations.edit', $corporation)
                    ->with('error', "You cannot use a gif as a profile picture if the user is not premium.");
            }

            $filePath = $upload->storeAs(
                'uploads',    
                $uploadName,   
                'public'        
            );

            if (\Storage::disk('public')->exists($filePath)) {

                $fullPath = \Storage::disk('public')->path($filePath);
                $file->filename = $filePath;
                $file->filesize = $fileSize;
                $file->save();

                \Storage::disk('public')->delete($oldPath);
            }
        }

        $corporation->name = $request->name;
        $corporation->email = $request->email;

        try {
            $corporation->save();

        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->route('corporations.edit', $corporation)->with('error', "The email is already taken.");
        }

        return redirect()->route('corporations.index')
            ->with('success', "The company " . $corporation->name . " has been changed successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $corporation)
    {
        $file = File::where('id', $corporation->logo_id)->first();
        $offer = Offer::where('company_id', "=", $corporation->id)->get(); 

        foreach ($offer as $o)
        {
            $offer = ApplicatedOffer::where('offer_id', "=", $o->id)->delete(); 

        }

        $offer = Offer::where('company_id', "=", $corporation->id)->delete(); 
        $corporation->delete();
        $file->delete();

        \Storage::disk('public')->delete($file->filepath);

        return redirect()->route("corporations.index")
            ->with('success', "Company " . $corporation->name . " was deleted successfully");
    }
}
