<?php

namespace App\Http\Controllers;

use App\Models\Complaint;
use Illuminate\Http\Request;
use App\Models\ComplaintProgres;

class ComplaintProgresController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'complaint_id' => 'required|uuid|exists:complaints,id',
                'komentar'     => 'nullable|string',
            ]);

            // Simpan progress pengaduan
            ComplaintProgres::create([
                'complaint_id' => $request->complaint_id,
                'komentar'     => $request->komentar,
            ]);

            $complaint = Complaint::find($request->complaint_id);

            return redirect()->route('complaints.show', $complaint->id)
                            ->with('success', 'Progres pengaduan berhasil disimpan!');
        } catch (\Exception $e) {
            \Log::error('Terjadi kesalahan saat menyimpan progres pengaduan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menyimpan progres pengaduan!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(ComplaintProgres $complaintProgres)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ComplaintProgres $complaintProgres)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ComplaintProgres $complaintProgres)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ComplaintProgres $complaintProgres)
    {
        //
    }
}
