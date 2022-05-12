<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\Offer;
use App\Models\File;
use App\Models\User;
use App\Models\ApplicatedOffer;
use Illuminate\Support\Facades\Auth;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("companies.index", [
            "companies" => Company::all(),
            "users" => User::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("companies.create");
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

            'name' => 'required|max:50',
            'email' => 'required|email|max:255',
            'logo' => 'required|mimes:gif,jpeg,jpg|max:2048',
        ]);

        $input = $request->all();

        $upload = $request->file('logo');
        $fileName = $upload->getClientOriginalName();
        $fileExtension = $upload->getClientOriginalExtension();
        $fileSize = $upload->getSize();
        $uploadName = time() . '_' . $fileName;

        if($fileExtension == 'gif' && Auth::user()->premium == 0)
        {
            return redirect()->route('companies.create')
                ->with('error', "You cannot use a gif as a profile picture if the user is not premium.");
        }

        $filePath = $upload->storeAs(
            'uploads',    
            $uploadName,   
            'public'        
        );

        if (Storage::disk('public')->exists($filePath)) {

            $fullPath = Storage::disk('public')->path($filePath);

            $file = File::create([
                'filename' => $filePath,
                'filesize' => $fileSize,
            ]);

            $upload->filepath = $filePath;
            $upload->filesize = $fileSize;
            $input['logo_id'] = $file->id;
        }

        $input['author_id'] = Auth::user()->id;

        try {
            $company = Company::create($input);

        } catch (\Illuminate\Database\QueryException $ex) {
            
            return redirect()->route('companies.create')->with('error', "The email is already taken.");
        }

        return redirect()->route('menu.index')->with('success', "Company ". $company->name . " created successfully");            
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $offers = Offer::where('company_id', $company->id)->get();

        return view('companies.show', [
            "company" => $company,
            "offers" => $offers, 
            "file" => File::where('id', $company->logo_id)->first()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company)
    {

        return view('companies.edit',[

            "company" => $company,
            "file" => File::find($company->logo_id)
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company)
    {
        $request->validate([

            'name' => 'required|max:50',
            'email' => 'required|email|max:255',

        ]);

        if($request->hasFile('logo')) {

            $file = File::where('id', $company->logo_id)->first();

            $oldPath = $file->filename;
            $upload = $request->file('logo');
            $fileName = $upload->getClientOriginalName();
            $fileExtension = $upload->getClientOriginalExtension();
            $fileSize = $upload->getSize();
            $uploadName = time() . '_' . $fileName;

            if($fileExtension == 'gif' && Auth::user()->premium == 0)
            {
                return redirect()->route('companies.edit', $company)
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

                Storage::disk('public')->delete($oldPath);
            }
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->author_id = Auth::user()->id;

        try {
            $company->save();

        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->route('companies.edit', $company)->with('error', "The email is already taken.");
        }

        return redirect()->route('menu.index')
            ->with('success', "Company " . $company->name . " changed successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $file = File::where('id', $company->logo_id)->first();
        $offer = Offer::where('company_id', "=", $company->id)->get(); 

        foreach ($offer as $o)
        {
            $offer = ApplicatedOffer::where('offer_id', "=", $o->id)->delete(); 

        }

        $offer = Offer::where('company_id', "=", $company->id)->delete(); 
        $company->delete();
        $file->delete();

        Storage::disk('public')->delete($file->filepath);

        return redirect()->route("menu.index")
            ->with('success', "Company " . $company->name . " was deleted successfully");
    }
}
