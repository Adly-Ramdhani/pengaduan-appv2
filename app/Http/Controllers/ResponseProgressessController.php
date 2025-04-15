<?php

namespace App\Http\Controllers;

use App\Models\response_progressess;
use Illuminate\Http\Request;

class ResponseProgressessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        try {
            $request->validate([
                'report_id' => 'nullable|uuid|exists:report,id',
                'komentar'     => 'nullable|string',
            ]);

            // Simpan progress pengaduan
            response_progressess::create([
                'report_id' => $request->report_id,
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
    public function show(response_progressess $response_progressess)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(response_progressess $response_progressess)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, response_progressess $response_progressess)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(response_progressess $response_progressess)
    {
        //
    }
}
