<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\File;
use App\Models\Role;
use App\Models\Company;
use App\Models\Follower;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("accounts.index", [
            "users" => User::all(),
            "roles" => Role::all()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("accounts.create", [
            "roles" => Role::all(),
        ]);
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
            'name' => 'required|max:20',
            'surnames' => 'required|max:50',
            'email' => 'required|email|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|max:20',
            'password' => 'required|min:8',
            'role_id' => 'required',
            'terms' => 'required',
            'premium' => 'required',
            'password_confirmation' => 'required|min:8|same:password',
            'avatar_id' => 'required|mimes:gif,jpeg,jpg,png|max:2048',
        ]);

        $input = $request->all();
        $input['password'] = Hash::Make($input['password']);

        $upload = $request->file('avatar_id');
        $fileName = $upload->getClientOriginalName();
        $fileExtension = $upload->getClientOriginalExtension();
        $fileSize = $upload->getSize();
        $uploadName = time() . '_' . $fileName;

        if($fileExtension == 'gif' && $input['premium'] == 0)
        {
            return redirect()->route('accounts.create')
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
            $input['avatar_id'] = $file->id;
        }
        
        try {
            $account = User::create($input);

        } catch (\Illuminate\Database\QueryException $ex) {
            
            $message = $ex->getMessage();

            if(str_contains($message, 'users_phone_unique'))
            {
                return redirect()->route('accounts.create')->with('error', "The phone is already taken.");

            }else{
                return redirect()->route('accounts.create')->with('error', "The email is already taken.");
            }
        }
        
        $account->sendEmailVerificationNotification();

        return redirect()->route('accounts.index')
            ->with('success', "The user " . $account->name . " was created successfully. A verfication email was sent to the user created.");
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $account
     * @return \Illuminate\Http\Response
     */
    public function show(User $account)
    {
        $file = File::where('id', $account->avatar_id)->first();

        return view('accounts.show',  [
            "account" => $account,
            "file" => $file
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $account)
    {
        return view("accounts.edit", [
            "account" => $account,
            "roles" => Role::all()

        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $account)
    {

        $this->validate($request, [
            'name' => 'required|max:20',
            'surnames' => 'required|max:50',
            'email' => 'required|email|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|max:20',
            'role_id' => 'required',
            'terms' => 'required',
            'premium' => 'required',
            'avatar_id' => 'mimes:gif,jpeg,jpg,png|max:2048',
        ]);


        if($request->hasFile('avatar_id'))
        {
            $file = File::where('id', $account->avatar_id)->first();

            $antigua_ruta = $file->filename;
            $upload = $request->file('avatar_id');
            $fileName = $upload->getClientOriginalName();
            $fileExtension = $upload->getClientOriginalExtension();
            $fileSize = $upload->getSize();
            $uploadName = time() . '_' . $fileName;

            if($fileExtension == 'gif' && $request->premium == 0)
            {
                return redirect()->route('accounts.edit', $account)
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

                Storage::disk('public')->delete($antigua_ruta);
            }
        }

        $account->name = $request->name;
        $account->surnames = $request->surnames;
        $account->email = $request->email;
        $account->birth_date = $request->birth_date;
        $account->phone = $request->phone;
        $account->role_id = $request->role_id;
        $account->terms = $request->terms;
        $account->premium = $request->premium;

        try {

            $account->save();

        } catch (\Illuminate\Database\QueryException $ex) {

            $message = $ex->getMessage();

            if(str_contains($message, 'users_phone_unique'))
            {
                return redirect()->route('accounts.edit', $account)->with('error', "The phone is already taken.");

            }else{
                return redirect()->route('accounts.edit', $account)->with('error', "The email is already taken.");
            }
        }

        return redirect()->route('accounts.index', $account)
            ->with('success', "The profile user " .$account->name. " has been edited successfully.");
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $account)
    {
        $file = File::where('id', $account->avatar_id)->first();

        Company::where('author_id', "=", $account->id)->delete();
        Follower::where('profile_id', "=", $account->id)->delete(); 
        Follower::where('follower_id', "=", $account->id)->delete(); 
        $account->delete();
        $file->delete();

        Storage::disk('public')->delete($file->filepath);

        return redirect()->route("account.index")
            ->with('success', "The user " . $account->name . " was deleted successfully.");
    }
}
