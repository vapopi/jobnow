<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\User;
use App\Models\File;
use Illuminate\Http\Request;

class AdminCompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admincompanies.index', [
            'companies' => Company::all(),
            'users' => User::all()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $file = File::where('id', $company->logo_id)->first();

        return view('companies.show', [
            'company' => $company,
            'file' => $file,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
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
     * @param  \App\Models\Company  $company
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

            if($fileExtension == 'gif' && \Auth::user()->premium == 0)
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

                \Storage::disk('public')->delete($oldPath);
            }
        }

        $company->name = $request->name;
        $company->email = $request->email;
        $company->author_id = \Auth::user()->id;

        try {
            $company->save();

        } catch (\Illuminate\Database\QueryException $ex) {

            return redirect()->route('companies.edit', $company)->with('error', "The email is already taken.");
        }

        return redirect()->route('companies.index')
            ->with('success', "Company " . $company->name . " changed successfully");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $company)
    {
        $file = File::where('id', $company->logo_id)->first();

        $company->delete();
        $file->delete();
        \Storage::disk('public')->delete($file->filepath);

        return redirect()->route("companies.index")
            ->with('success', "Company " . $company->name . " was deleted successfully");
    }
}
