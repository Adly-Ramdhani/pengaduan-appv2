<?php

namespace App\Http\Controllers;

use App\Models\Staff;
use App\Models\Complaint;
use Illuminate\Http\Request;

class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $staff = Complaint::with('user')->latest()->get();// Pastikan ada 'user' di dalam with()
            return view('staff.index', compact('staff'));
        } catch (\Exception $e) {
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }

        // return view('staff.index');
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
    public function show(Request $request,Staff $staff, $id)
    {
        try {
            $complaint = Complaint::with(['provinces', 'village', 'regencie'])->findOrFail($id);
            return view('staff.show', compact('complaint'));
        } catch (\Exception $e) {
            return redirect()->route('pengaduan.staff.index')->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Staff $staff)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Staff $staff)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Staff $staff)
    {
        //
    }
}
