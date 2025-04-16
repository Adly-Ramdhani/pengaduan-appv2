<?php

namespace App\Http\Controllers;

// use App\Models\Staff;
use App\Models\Reports;
use Illuminate\Http\Request;

class StaffProvincesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $staff = Reports::with('user')->latest()->get();
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
    public function show(Request $request, $id)
    {
        try {
            // Mengambil data pengaduan beserta relasi yang diperlukan
            $complaint = Reports::with(['provinces', 'regencie', 'district', 'village']) // Pastikan relasi yang benar
                                ->findOrFail($id); // Menangkap data pengaduan berdasarkan id
    
            // Jika ditemukan, tampilkan view dengan data yang telah diambil
            return view('staff.show', compact('complaint'));
        } catch (\Exception $e) {
            // Tangani error dengan memberikan pesan yang lebih jelas
            return redirect()->route('pengaduan.staff.index')
                             ->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }
    

    /**
     * Show the form for editing the specified resource.
     */

}
