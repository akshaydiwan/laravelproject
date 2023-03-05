<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = \App\Models\User::with(['profile', 'roles'])->get();
        return view('dashboard.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = \App\Models\Country::all();
        $roles =\App\Models\Role::all();
        return view('dashboard.users.create', compact('countries', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = [
            'username'=> $request->username,
            'name'=> $request->name,
            'email'=> $request->email,
            'password'=> Hash::make('password'),
        ];
        $user = User::create($user);
        $filename = sprintf('thumbnail_%s', random_int(1,1000));
        if($request->hasFile('photo')){
            $filename = $request->file('photo')->storeAs('profiles', $filename, 'public');
        }
        if($user){
            $profile = new \App\Models\Profile([
                'user_id'=>$user->id,
                'address'=> $request->address,
                'phone'=>$request->phone,
                'photo'=>$filename,
                'city'=>$request->city,

                'country_id'=>$request->country,
            ]);
            $user->profile()->save($profile);
            $user->roles()->attach($request->roles);
            return redirect()->route('users.index');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $countries = \App\Models\Country::all();
        $roles = \App\Models\Role::all();
        return view('dashboard.users.show',compact('user','roles','countries'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::with(['profile', 'roles'])->
        where('id', $id)->first();
       
        $countries = \App\Models\Country::all();
        $roles = \App\Models\Role::all();
        return view('dashboard.users.edit',compact('user','countries','roles'));
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
      
        $user->name = $request->name;
        $user->email = $request->email;
        
               
       
        $filename = sprintf('thumbnail_%s.jpg', random_int(1,1000));
        if($request->hasFile('photo')){
            $filename = $request->file('photo')->storeAs('profiles', $filename, 'public');
        } else{
            $filename = $user->profile->photo;
        }
       if($user->save()){
            $profile = 
                [
                'city'=> $request->city,
                'country_id'=>$request->country,
                'address'=>$request->address,
                'photo'=>$filename,
                'phone'=>$request->phone,
            ];

            $user->profile()->update($profile);
            $user->roles()->sync($request->roles);
            return redirect()->route('users.index');
       }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->profile()->delete();
        $user->roles()->detach();
        $user->delete();
        return redirect()->route('users.index');
    }
}
