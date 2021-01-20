<?php

namespace App\Http\Controllers;

use App\Models\Jugador;
use App\Models\User;
use Illuminate\Http\Request;

class JugadorController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth')->only('create','store');
        $this->middleware('auth')->except('show','index');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json([
            "jugadores" => Jugador::orderBy('created_at','DESC')->get()           
        ]);
    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $jugador = new Jugador();
        $jugador->documento = request()->documento;
        $jugador->nombres = request()->nombres;
        $jugador->apellidos = request()->apellidos;
        $jugador->telefono = request()->telefono;
        $jugador->direccion = request()->direccion;
        $jugador->dinero = 15000;
        $jugador->save();

        $user = new User();
        $user->name = request()->nombres;
        $user->email = request()->email;
        $contra = "1234";
        $user->password = bcrypt($contra);
        $user->rol = 2;
        $user->jugador_id =$jugador->id;
        $user->save();

        return response()->json([
            "result"=>"exito"
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function show(Jugador $jugador)
    {
        return response()->json([
            "nombres" => $jugador->nombres,
            "dinero" => $jugador->dinero,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function update(Jugador $jugador)
    {        
        $jugador->documento = request()->documento;
        $jugador->nombres = request()->nombres;
        $jugador->apellidos = request()->apellidos;
        $jugador->telefono = request()->telefono;
        $jugador->direccion = request()->direccion;
        $jugador->dinero = request()->dinero;
        $jugador->save();



        return response()->json([
            "result"=>"exito"
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Jugador  $jugador
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jugador $jugador)
    {
        $jugador->delete();
        return response()->json([
            "result"=>"exito"
        ]);
    }
}
