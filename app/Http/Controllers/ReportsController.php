<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use App\Models\Village;
use App\Models\Regencis;
use App\Models\Districts;
use App\Models\Provinces;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Excel;
use App\Exports\ComplaintExport;
use Illuminate\Support\Facades\Log;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public function index(Request $request)
    {
        try {
            $query = Reports::with(['provinces', 'village', 'regencie']);
    
            if ($request->filled('province')) {
                $query->whereHas('provinces', function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->province . '%');
                });
            }
    
            if ($request->filled('category')) {
                $query->where('name', 'like', '%' . $request->category . '%');
            }
    
            $complaint = $query->latest()->get();
            $provinces = Provinces::pluck('name'); // Ambil nama provinsi
    
            return view('complaint.index', compact('complaint', 'provinces'));
    
        } catch (\Exception $e) {
            \Log::error('Error in Complaint Index: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memuat data pengaduan.');
        }
    }
    
    

    /**
     * Show the form for creating a new resource.
     */
    public function create()
        {
            $provinces = Provinces::all();
            $regencies = Regencis::all();
            $districts = Districts::all();
            $villages = Village::all();

            return view('complaint.store', compact('provinces','districts','regencies','villages'));
        }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Log::info('Request masuk:', $request->all());

            // Validasi request
            $request->validate([
                'provinces_id' => 'required',
                'regencis_id' => 'required',
                'districts_id' => 'required',
                'villages_id' => 'required',
                'name' => 'required|string|max:255',
                'description' => 'required|string',
                'image_path' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:5120'
            ]);

            $data = Reports::create([
                'user_id' => auth()->id(), // Pastikan user sedang login
                'provinces_id' => $request->provinces_id,
                'regencis_id' => $request->regencis_id,
                'districts_id' => $request->districts_id,
                'villages_id' => $request->villages_id,
                'name' => $request->name,
                'description' => $request->description,
                'is_verified' => $request->has('is_verified'),
            ]);

            Log::info('Data tersimpan:', $data->toArray());

            // Simpan gambar jika ada
            if ($request->hasFile('image_path')) {
                $file = $request->file('image_path');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = 'complain-img/' . $fileName;

                $file->move(public_path('complain-img'), $fileName);
                $data->update(['image_path' => $filePath]);
            }

            return redirect()->route('pengaduan.index')->with('success', 'Pengaduan berhasil dikirim!');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $complaint = Reports::with(['provinces', 'village', 'regencie'])->findOrFail($id);
            return view('complaint.show', compact('complaint'));
        } catch (\Exception $e) {
            \Log::error('Gagal menampilkan detail pengaduan: ' . $e->getMessage());
            return redirect()->route('pengaduan.index')->with('error', 'Terjadi kesalahan saat menampilkan pengaduan.');
        }
    }


    public function updateStatus(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required',
            ]);

            $complaint = Reports::findOrFail($id);
            $complaint->status = $request->status;
            $complaint->save();

            return redirect()->route('complaints.show', $complaint->id)->with('success', 'Pengaduan berhasil!');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function done(Request $request, $id)
    {
        try {
            $request->validate([
                'status' => 'required',
            ]);

            $complaint = Reports::findOrFail($id);
            $complaint->status = $request->status;
            $complaint->save();

            return redirect()->route('complaints.show', $complaint->id)->with('success', 'Pengaduan Selesai!');
        } catch (\Exception $e) {
            Log::error('Terjadi kesalahan: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function export()
    {
        try {
            $excel = app(Excel::class);  // Atau App::make(Excel::class)

            // Memanggil metode download menggunakan instance tersebut
            return $excel->download(new ComplaintExport, 'complaints.xlsx');
        } catch (\Exception $e) {
            Log::error('Error Export Complaints: ' . $e->getMessage());
            return redirect()->route('pengaduan.staff.index')->with('error', 'Gagal melakukan ekspor.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reports $reports)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reports $reports)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reports $reports)
    {
        //
    }
}
