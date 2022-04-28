<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\Company;
use App\Models\File;

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
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required|max:20',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|min:6|same:password',
            'logo_id' => 'required|mimes:gif,jpeg,jpg,png|max:2048',
            'remember' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::Make($input['password']);

        $upload = $request->file('logo_id');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        $uploadName = time() . '_' . $fileName;

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

        $input['role_id'] = 4;

        $user = Company::create($input);

        return redirect()->route('login')
            ->with('success', "L'usuari " . $user->name . " s'ha creat correctament.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('companies.edit');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
