<?php

namespace App\Http\Controllers;

use App\Models\Entrada;
use App\Models\Pelicula;
use App\Models\Proyeccion;
use Illuminate\Http\Request;

class PeliculaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('peliculas.index', [
            'peliculas' => Pelicula::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('peliculas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Pelicula::create([
            'titulo' => $request->titulo
        ]);
        return redirect()->route('peliculas.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Pelicula $pelicula)
    {
        $entradas = Entrada::selectRaw('count(entradas.id)')
                ->join('proyecciones', 'entradas.proyeccion_id', '=', 'proyecciones.id')
                ->join('peliculas', 'proyecciones.pelicula_id', '=', 'peliculas.id')
                ->where('peliculas.id', '=', $pelicula->id)
                ->groupBy('entradas.id')
                ->get();
        $total = 0;
        foreach ($entradas as $entrada){
            $total += $entrada->count;
        }

        return view('peliculas.show', [
            'pelicula' => $pelicula,
            'entradas' => $total,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pelicula $pelicula)
    {
        return view('peliculas.edit', [
            'pelicula' => $pelicula
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pelicula $pelicula)
    {
        $pelicula->update([
            'titulo' => $request->titulo
        ]);

        return redirect()->route('peliculas.index');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pelicula $pelicula)
    {
        Pelicula::findOrFail($pelicula->id);
        $pelicula->delete();
        return redirect()->route('peliculas.index');
    }
}
