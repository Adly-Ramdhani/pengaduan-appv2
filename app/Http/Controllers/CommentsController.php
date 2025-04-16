<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use App\Models\Comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
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
    public function store(Request $request, Comments $comments)
    {
        try {
            $data = $request->validate([
                'comment' => 'required|string|max:1000',
            ]);

            $data['user_id'] = Auth::id();
            $data['report_id'] = $request->report_id;

            Comments::create($data);

            return redirect()->route('complaint.show', $data['report_id'])
                             ->with('success', 'Komentar berhasil ditambahkan.');
        } catch (\Exception $e) {
            Log::error('Gagal menyimpan komentar: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Terjadi kesalahan saat menambahkan komentar.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            // Ambil data komentar beserta relasinya
            $comment = Comments::with(['user', 'report'])->findOrFail($id);

            // Kirim data ke view
            return view('comments.show', compact('comment'));

        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return redirect()->route('pengaduan.index')->with('error', 'Komentar tidak ditemukan.');
        } catch (\Exception $e) {
            return redirect()->route('pengaduan.index')->with('error', 'Terjadi kesalahan saat menampilkan komentar.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Comments $comments)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comments $comments)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comments $comments)
    {
        //
    }
}
