<?php

namespace App\Http\Controllers;

use App\Receta;
use App\Profile;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function show(Profile $profile)
    {

        $recetas = Receta::where('user_id', $profile->user_id)->paginate(10);
        
        return view('perfiles.show', compact('profile', 'recetas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $this->authorize('view', $profile);
        
        return view('perfiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {

        //Execute the policy
        $this->authorize('update', $profile);

        //Validation
        $data = request()->validate([
            'name' => 'required',
            'webpage' => 'required',
            'biography' => 'required'
        ]);

        //If user add an image
        if($request['image']){
            //Get the image url
            $image_route = $request['image']->store('uploads/profiles', 'public');

            //Image resize
            $img = Image::make(public_path("storage/{$image_route}"))->fit(600,600);
            $img->save();

            //Create array of image
            $array_image = ['image' => $image_route];
        }

        //Update info to user (name and webpage)
        auth()->user()->webpage = $data['webpage'];
        auth()->user()->name = $data['name'];
        auth()->user()->save();

        //Add biography to profiles
        //Delete info from data on user once updated.
        unset($data['webpage']);
        unset($data['name']);
        //Update info to profile (biography and image)
        auth()->user()->profile()->update(array_merge(
            $data,
            $array_image ?? []
        ));


        return redirect()->action('RecetaController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
