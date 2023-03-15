<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Imageable;
use App\Models\Travel;
use App\Models\TravelTravelUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        // $users = User::all();
        // $object = [
        //     Image
        // ];
        // return response()->json($users);
        $var = Imageable::all()->where('parentable_id', '=', $id)->where('parentable_type', '=', 'User')->value('image_id');
        $imageableId = Image::find($var);
        return $imageableId;

        // $images = Storage::files('public/images');
        // $imageUrls = array_map(function ($image) {
        //     return asset(str_replace('public', 'storage', $image));
        // }, $images);

        // return response()->json(['images' => $imageUrls]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }

    public function showTravel(User $user) {
        foreach ($user->travels as $travel) {
            return $travel->images;
        }
        
        // dd($user->travels());
        // $var = $user->travels();
        // dd($var);
        // $travelId = Travel::all()->where("user_id", "=", $id)->value("id");
        // $viajes = Travel::all()->where("user_id", "=", $id)->pluck(['destiny']);

        // $fecha1 = Travel::all()->where("user_id", "=", $id)->value('start_date');
        // $fecha2 = Travel::all()->where("user_id", "=", $id)->value('end_date');
        // $dias = strtotime($fecha1) - strtotime($fecha2) / 86400;

        // $participantes = TravelTravelUsers::all()->where('travel_id', "=", $travelId)->count();

        // $foto = Imageable::all()->where('parentable_id', '=', $travelId)->where('parentable_type', '=', 'Travel')->value('image_id');
        // $foto = Image::find($foto)->value("name");
        // $array = [

        // ];
        // return $foto;
        // return $travelId;
    }
}