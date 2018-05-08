<?php

namespace App\Http\Controllers;

use App\User;
use App\Type;
use App\Breed;
use Illuminate\Http\Request;
use Storage;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, User $user)
    {
    
        $types = Type::all();

        $breeds = Breed::select()->where('type_id', $user->type_id)->get();

        if(! $request->old()){
            $request->replace($user->toArray());
            $request->flash();
        }
        
        return view('edit_profile', compact(['user', 'types', 'breeds']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $input = $request->all();
        $request->validate([
            'photo'         =>  'nullable|image',
            'description'   =>  'nullable|string',
            'name'          =>  'required|string|max:255',
            'age'           =>  'required|integer|min:0|max:100',
            'password'      =>  'required|string|min:6|confirmed',
        ]);
        if ($request->hasFile('photo') && $request->file('photo')->isValid()) {
            $path = $request->photo->store('images');
            $input['photo'] = $path; 
        }
        $input['password']= bcrypt($input['password']);
        $user->fill($input)->save();
        return redirect('home');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    public function getFile($url){
        if (Storage::exists('images/'.$url)) {
            return response()->file(storage_path('app/images/'.$url));
        }
        return 'none';
        
    }
}
