<?php

namespace App\Http\Controllers;

use App\Models\Districts;
use Illuminate\Http\Request;

class DistrictsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $districts = $request->query('regencis_id');

            if (!$districts) {
                return response()->json(['error' => 'regencis_id tidak ditemukan'], 400);
            }

            $villages = Districts::where('regencis_id', $districts)->get();

            return response()->json($villages);
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
    public function show(Districts $districts)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Districts $districts)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Districts $districts)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Districts $districts)
    {
        //
    }
}
