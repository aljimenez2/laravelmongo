<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::orderBy('position')->get();
        $counter = User::all()->count();
        return view('welcome', compact('users', 'counter'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createInitial()
    {
        $position = User::all()->count();
        $user = new User;
        $user->position = $position+1;
        $user->photo = "wolverine.jpg";
        $user->description = "Wolverine X-MEN";
        if($user->save()){
            return "success";
        }else{
            return "Error saving initial data";
        }
    }

    public function saveOrder(Request $request){
        $userArray = $request->input('userArray');
        foreach ($userArray[0] as $index => $_user){
            $mUser = new User();
            $user = $mUser->where('_id', $_user)->first();
            $user->position = ($index + 1);
            $user->save();
        }
    }

    public function updateUserList(){
        $users = User::orderBy('position')->get();
        return view("partials.usersItems", compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $position = User::all()->count();
        $user = new User;
        $user->position = $position+1;
        $user->description =  $request->input('description');
        $_photo = $request->file("photo");
        $photoname = uniqid() . time() . '.' . $_photo->getClientOriginalExtension();
        $user->photo =$photoname;
        $img = Image::make($_photo->getRealPath());
        $img->resize(320, 320, function ($constrain) {
            $constrain->aspectRatio();
        });
        $img->stream();
        Storage::disk('public')->put($photoname, $img, 'public');
        $user->save();
        $users = User::orderBy('position')->get();
        return view("partials.usersItems", compact('users'));
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
    public function edit(Request $request)
    {
        $id = $request->input('id');
        $users = new User();
        $user = $users->where("_id", $id)->first();
        return $user;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $position = User::all()->count();
        $uuser = new User();
        $id_user = $request->input('id_user');
        $user = $uuser->where("_id", $id_user)->first();
        $description  = ($request->input('description') !== null) ? $request->input('description') : "";
        $photo  = ($request->input('photo') !== null) ? $request->input('photo') : "";
        $user->description =  $description;
        if($photo != "") {
            $_photo = $request->file("photo");
            $photoname = uniqid() . time() . '.' . $_photo->getClientOriginalExtension();
            $user->photo = $photoname;
            $img = Image::make($_photo->getRealPath());
            $img->resize(320, 320, function ($constrain) {
                $constrain->aspectRatio();
            });
            $img->stream();
            Storage::disk('public')->put($photoname, $img, 'public');
        }
        $user->update();
        $users = User::orderBy('position')->get();
        return view("partials.usersItems", compact('users'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $dUser = new User();
        $id = $request->input("id");
        $user = $dUser->where('_id', $id)->delete();
        $users = User::orderBy('position')->get();
        return view("partials.usersItems", compact('users'));
    }
}
