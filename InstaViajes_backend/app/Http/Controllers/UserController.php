<?php

namespace App\Http\Controllers;

use App\Models\Image;
use App\Models\Imageable;
use App\Models\Travel;
use App\Models\TravelTravelUsers;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

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

    public function indexTravels(User $user)
    {
        $travels = $user->travels->toArray();
        $newTravels = array_map(function ($travel) {
            // Calcula el número de días
            $startDate = Carbon::parse($travel['start_date']);
            $endDate = Carbon::parse($travel['end_date']);
            $days = $endDate->diffInDays($startDate);
            // Número de participantes
            $participantes = TravelTravelUsers::all()->where('travel_id', "=", $travel['id'])->count();
            // Nombre de usuario creador
            $userName = User::all()->where('id', "=", $travel['user_id'])->value('name');
            // Imagen viaje
            $fotoTravel = Imageable::all()->where('imageable_id', '=', $travel['id'])->where('imageable_type', '=', 'Travel')->value('image_id');
            if ($fotoTravel) { // Evita errores
                $fotoTravel = Image::find($fotoTravel)->value("name");
            }
            // Imagen user
            $fotoUser = Imageable::all()->where('imageable_id', '=', $travel['user_id'])->where('imageable_type', '=', 'User')->value('image_id');
            if ($fotoUser) { // Evita errores
                $fotoUser = Image::find($fotoUser)->value("name");
            }

            return [
                'id' => $travel['id'],
                'user_id' => $travel['user_id'],
                'username' => $userName,
                'image' => asset('images/' . $fotoTravel),
                'imageuser' => asset('images/' . $fotoUser),
                'travel_state_id' => $travel['travel_states_id'],
                'description' => $travel['description'],
                'start_date' => $travel['start_date'],
                'end_date' => $travel['end_date'],
                'days' => $days,
                'location' => $travel['origin'],
                'destiny' => $travel['destiny'],
                'budget' => $travel['budget'],
                'created_at' => $travel['created_at'],
                'updated_at' => $travel['updated_at'],
                'NumUsers' => $participantes,
            ];
        }, $travels);

        // Imprimir los nuevos registros con los campos renombrados
        foreach ($newTravels as $travel) {
            echo json_encode($travel) . "\n";
        }

        // echo $user->friendships->where("state", "=", "true");

        // $travelId = Travel::all()->where("user_id", "=", $id)->value("id");
        // $viajes = Travel::all()->where("user_id", "=", $id)->pluck(['destiny']);
    }

    public function indexFriendTravels(User $user)
    {
        $friends = $user->friendships;
        foreach ($friends as $friend) {
            return $friend;
            $travels = $user->travels->toArray();
            $newTravels = array_map(function ($travel) {
                // Calcula el número de días
                $startDate = Carbon::parse($travel['start_date']);
                $endDate = Carbon::parse($travel['end_date']);
                $days = $endDate->diffInDays($startDate);
                // Número de participantes
                $participantes = TravelTravelUsers::all()->where('travel_id', "=", $travel['id'])->count();
                // Nombre de usuario creador
                $userName = User::all()->where('id', "=", $travel['user_id'])->value('name');
                // Imagen viaje
                $fotoTravel = Imageable::all()->where('imageable_id', '=', $travel['id'])->where('imageable_type', '=', 'Travel')->value('image_id');
                if ($fotoTravel) { // Evita errores
                    $fotoTravel = Image::find($fotoTravel)->value("name");
                }
                // Imagen user
                $fotoUser = Imageable::all()->where('imageable_id', '=', $travel['user_id'])->where('imageable_type', '=', 'User')->value('image_id');
                if ($fotoUser) { // Evita errores
                    $fotoUser = Image::find($fotoUser)->value("name");
                }

                return [
                    'id' => $travel['id'],
                    'user_id' => $travel['user_id'],
                    'username' => $userName,
                    'image' => asset('images/' . $fotoTravel),
                    'imageuser' => asset('images/' . $fotoUser),
                    'travel_state_id' => $travel['travel_states_id'],
                    'description' => $travel['description'],
                    'start_date' => $travel['start_date'],
                    'end_date' => $travel['end_date'],
                    'days' => $days,
                    'location' => $travel['origin'],
                    'destiny' => $travel['destiny'],
                    'budget' => $travel['budget'],
                    'created_at' => $travel['created_at'],
                    'updated_at' => $travel['updated_at'],
                    'NumUsers' => $participantes,
                ];
            }, $travels);

            // Imprimir los nuevos registros con los campos renombrados
            foreach ($newTravels as $travel) {
                echo json_encode($travel) . "\n";
            }
        }
    }
}