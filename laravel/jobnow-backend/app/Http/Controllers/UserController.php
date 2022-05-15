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
use App\Models\Notification;
use App\Models\ApplicatedOffer;
use App\Models\Like;
use App\Models\Message;
use App\Models\Post;
use App\Models\Offer;
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
            'name' => 'required|max:20',
            'surnames' => 'required|max:50',
            'email' => 'required|email|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|max:20',
            'password' => 'required|min:8',
            'password_confirmation' => 'required|min:8|same:password',
            'avatar_id' => 'required|mimes:gif,jpeg,jpg|max:2048',
            'remember' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::Make($input['password']);

        $upload = $request->file('avatar_id');
        $fileName = $upload->getClientOriginalName();
        $fileSize = $upload->getSize();
        $fileExtension = $upload->getClientOriginalExtension();
        $uploadName = time() . '_' . $fileName;
        
        if($fileExtension == 'gif')
        {
            return redirect()->route('users.create')
                ->with('error', "You cannot use a gif as a profile picture if you are not a premium user.");
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

        $input['role_id'] = 4;
        $input['terms'] = 1;
        
        try {
            $user = User::create($input);

        } catch (\Illuminate\Database\QueryException $ex) {
            
            $message = $ex->getMessage();

            if(str_contains($message, 'users_phone_unique'))
            {
                return redirect()->route('users.create')->with('error', "The phone is already taken.");

            }else{
                return redirect()->route('users.create')->with('error', "The email is already taken.");
            }
        }

        Auth::login($user);
        $user->sendEmailVerificationNotification();

        Notification::create([
            'title' => "Jobnow Team",
            'description' => "Welcome to jobnow, enjoy! :)",
            'author_id' => $user->id,
        ]);
        
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
        $follows = Follower::where('profile_id', $user->id)->count();
        $validate = Follower::where('profile_id', $user->id)->where('follower_id', Auth::user()->id)->first();
        $posts = Post::where('author_id', $user->id)->get();
        $companies = Company::where('author_id', $user->id)->get();
        $files = File::all();

        return view('users.show',  [
            "users" => User::all(),
            "validate" => $validate,
            "user" => $user,
            "file" => $file,
            "follows" => $follows,
            "posts" => $posts,
            "files" => $files,
            "companies" => $companies,
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
            'name' => 'required|max:20',
            'surnames' => 'required|max:50',
            'email' => 'required|email|max:255',
            'birth_date' => 'required|date',
            'phone' => 'required|max:20',
            'avatar_id' => 'mimes:gif,jpeg,jpg|max:2048',
        ]);

        if($request->hasFile('avatar_id'))
        {
            $file = File::where('id', $user->avatar_id)->first();
            
            $antigua_ruta = $file->filename;
            $upload = $request->file('avatar_id');
            $fileName = $upload->getClientOriginalName();
            $fileExtension = $upload->getClientOriginalExtension();
            $fileSize = $upload->getSize();
            $uploadName = time() . '_' . $fileName;

            if($fileExtension == 'gif' && Auth::user()->premium == 0)
            {
                return redirect()->route('users.edit', $user)
                    ->with('error', "You cannot use a gif as a profile picture if you are not a premium user.");
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

        $user->name = $request->name;
        $user->surnames = $request->surnames;
        $user->email = $request->email;
        $user->birth_date = $request->birth_date;
        $user->phone = $request->phone;
        
        try {

            $user->save();

        } catch (\Illuminate\Database\QueryException $ex) {

            $message = $ex->getMessage();

            if(str_contains($message, 'users_phone_unique'))
            {
                return redirect()->route('users.edit', $user)->with('error', "The phone is already taken.");

            }else{
                return redirect()->route('users.edit', $user)->with('error', "The email is already taken.");
            }
        }

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
        $companies = Company::where('author_id', "=", $user->id)->get();

        foreach($companies as $company) {

            $offers = Offer::where('company_id', "=", $company->id)->get();
            
            foreach ($offers as $offer) {

                ApplicatedOffer::where('offer_id', "=", $offer->id)->delete();
            }

            Offer::where('company_id', "=", $company->id)->delete();
            
        }
        
        Company::where('author_id', "=", $user->id)->delete();
        Follower::where('profile_id', "=", $user->id)->delete(); 
        Follower::where('follower_id', "=", $user->id)->delete();
        ApplicatedOffer::where('user_id', "=", $user->id)->delete();
        Like::where('user_id', "=", $user->id)->delete();
        Message::where('author_id', "=", $user->id)->delete();
        Message::where('receiver_id', "=", $user->id)->delete();
        Post::where('author_id', "=", $user->id)->delete();
        Notification::where('author_id', "=", $user->id)->delete();

        $user->delete();
        $file->delete();

        Storage::disk('public')->delete($file->filepath);

        return redirect()->route("login")
            ->with('success', "The user " . $user->name . " was deleted successfully.");
    }
}