<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;
use App\Models\response_progressess;

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
                'report_id' => 'nullable|uuid|exists:reports,id', // Pastikan nama tabel sudah benar
                'komentar' => 'nullable|string',
            ]);
    
            // Mencari objek report dengan ID yang diberikan
            $report = Reports::find($request->report_id);
    
            if (!$report) {
                // Jika report tidak ditemukan, kembalikan error
                return redirect()->back()->with('error', 'Pengaduan tidak ditemukan!');
            }
    
            // Simpan progres pengaduan
            response_progressess::create([
                'report_id' => $request->report_id,
                'komentar' => $request->komentar,
            ]);
    
            return redirect()->route('complaints.show', $report->id)
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
    public function destroy($id)
    {
        try {
            $progress = response_progressess::findOrFail($id);
            $progress->delete();

            return redirect()->route('complaints.show')->with('success', 'Progress berhasil dihapus.');
        } catch (\Exception $e) {
            // Bisa juga pakai Log::error($e) kalau mau dicatat di log
            return redirect()->back()->with('error', 'Gagal menghapus progress: ' . $e->getMessage());
        }
    }

}
