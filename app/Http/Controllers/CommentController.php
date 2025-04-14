<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Complaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
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
    public function store(Request $request, Complaint $complaint)
    {
        try {
            $data = $request->validate([
                'comment' => 'required|string|max:1000',
            ]);
    
            $data['user_id'] = Auth::id();
            $data['complaint_id'] = $complaint->id; // Diambil otomatis dari route
    
            Comment::create($data);
    
            return redirect()->route('complaint.show', $complaint->id)
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
            $comment->load(['user', 'complaint']); // Eager load relasi
                dd($comment);
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
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comment $comment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comment $comment)
    {
        //
    }
}
