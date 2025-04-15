<?php

namespace App\Http\Controllers;

use App\Models\Regencis;
use Illuminate\Http\Request;

class RegencisController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $provinceId = $request->query('provinces_id');

            if (!$provinceId) {
                return response()->json(['error' => 'provinces_id tidak ditemukan'], 400);
            }

            $regencies = Regencis::where('province_id', $provinceId)->get();

            return response()->json($regencies);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
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
    public function show(Regencis $regencis)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Regencis $regencis)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Regencis $regencis)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Regencis $regencis)
    {
        //
    }
}
