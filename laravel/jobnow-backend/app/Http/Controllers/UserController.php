<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use App\Models\User;
use App\Models\File;
use App\Models\Role;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("users.index", [
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
        return view("users.create");
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
            'surnames' => 'required',
            'email' => 'required|email',
            'birth_date' => 'required|date',
            'phone' => 'required|max:20',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'avatar_id' => 'required|mimes:gif,jpeg,jpg,png|max:2048',
            'remember' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::Make($input['password']);

        $upload = $request->file('avatar_id');
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
            $input['avatar_id'] = $file->id;
        }

        $input['role_id'] = 4;
        $input['terms'] = 1;
        
        $user = User::create($input);

        Auth::login($user);
        $user->sendEmailVerificationNotification();
        Auth::logout($user);
        

        return redirect()->route('login')
            ->with('success', "The user " . $user->name . " was created successfully. Please check your email for verify your account.");
    }

    /**
     * Display the specified user.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $file = File::where('id', $user->avatar_id)->first();

        return view('users.show',  [
            "user" => $user,
            "file" => $file
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view("users.edit", [
            "user" => $user,
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
    public function update(Request $request, User $user)
    {

        $this->validate($request, [
            'name' => 'required',
            'surnames' => 'required',
            'email' => 'required|email',
            'birth_date' => 'required|date',
            'phone' => 'required|max:20',
            'avatar_id' => 'mimes:gif,jpeg,jpg,png|max:2048',
        ]);

        if($request->hasFile('avatar_id'))
        {
            $file = File::where('id', $user->avatar_id)->first();

            $antigua_ruta = $file->filename;
            $upload = $request->file('avatar_id');
            $fileName = $upload->getClientOriginalName();
            $fileSize = $upload->getSize();
    
            $uploadName = time() . '_' . $fileName;
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

        $user->name = $request->name;
        $user->surnames = $request->surnames;
        $user->email = $request->email;
        $user->birth_date = $request->birth_date;
        $user->phone = $request->phone;
        $user->save();

        return redirect()->route('users.show', $user)
            ->with('success', "The profile user " .$user->name. " has been edited successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $file = File::where('id', $user->avatar_id)->first();

        $user->delete();
        $file->delete();
        Storage::disk('public')->delete($file->filepath);

        return redirect()->route("login")
            ->with('success', "The user " . $user->name . " was deleted successfully.");
    }
}