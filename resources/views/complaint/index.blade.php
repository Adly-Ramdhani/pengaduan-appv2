@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: #f9f9f9;
    }
    .news-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px;
        display: flex;
        align-items: center;
        border-left: 6px solid #22e8f2;
    }
    .news-card img {
        width: 180px;
        height: 120px;
        object-fit: cover;
        border-radius: 8px;
    }
    .news-content {
        flex: 1;
        margin-left: 15px;
    }
    .news-title {
        font-size: 18px;
        font-weight: bold;
        color: #007bff;
        text-decoration: none;
        display: block;
    }
    .news-title:hover {
        text-decoration: underline;
    }
    .news-meta {
        font-size: 14px;
        color: #6c757d;
    }
    .vote-icon {
        font-size: 20px;
        cursor: pointer;
        transition: 0.3s;
    }
    .vote-icon.active {
        color: red;
    }
    .info-box {
        background: white;
        padding: 15px;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
    }
    .province {
        font-size: 14px;
        font-weight: bold;
        color: #555;
    }
    .alert-success {
        background: #d4edda;
        padding: 10px;
        border-radius: 5px;
    }
</style>

<div class="container py-4">
    @if(session('success'))
    <div class="alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="row">
        <div class="col-md-8">
            @foreach ($complaint as $item)
            <div class="news-card mb-3">
                <img src="{{ url($item->image_path) }}" alt="Gambar Pengaduan">
                <div class="news-content">
                    <a href="{{ route('complaint.show', $item->id) }}" class="news-title">{{ $item->description }}</a>
                     <div class="news-meta mt-1">
                        <span><i class="bi bi-eye"></i> {{ $item->views }}</span>
                        <span class="ms-3"><i class="bi bi-heart-fill text-danger"></i> {{ $item->likes }}</span>
                    </div>
                     <div class="category">
                        <a href="#">#{{ $item->name }}</a>
                        <a href="#">#{{ $item->provinces->name }}</a>
                    </div>
                    <div class="news-time mt-2">{{ $item->created_at->diffForHumans() }}</div>
                </div>
                <div class="d-flex align-items-center ms-3">
                    {{-- <i class="bi bi-heart vote-icon"
                        data-id="{{ $item->id }}"
                       onclick="toggleVote(this)"></i> --}}
                     {{-- <span class="ms-1 vote-count">{{ $item->total_likes }}</span> --}}
                </div>

            </div>
            @endforeach
        </div>

        <div class="col-md-4">
            <div class="info-box">
                <h5><i class="bi bi-info-circle-fill text-warning"></i> Informasi Pembuatan Pengaduan</h5>
                <ol>
                    <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                    <li>Keseluruhan data pada pengaduan bernilai <strong>BENAR dan DAPAT DIPERTANGGUNG JAWABKAN</strong>.</li>
                    <li>Seluruh bagian data perlu diisi.</li>
                    <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>
                    <li>Periksa tanggapan Kami, pada <strong>Dashboard</strong> setelah Anda <strong>Login</strong>.</li>
                    <li>Pengaduan dapat dilakukan pada halaman berikut: <a href="{{ route('pengaduan.create') }}">Ikuti Tautan</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleVote(icon) {
        let complaintId = icon.getAttribute("data-id");

        fetch(`/complaint/${complaintId}/like`, {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').getAttribute("content"),
            },
            body: JSON.stringify({})
        })
        .then(response => response.json())
        .then(data => {
            if (data.error) {
                alert("Anda harus login terlebih dahulu untuk memberikan like.");
                return;
            }

            if (data.liked) {
                icon.classList.remove("bi-heart");
                icon.classList.add("bi-heart-fill", "text-danger");
            } else {
                icon.classList.remove("bi-heart-fill", "text-danger");
                icon.classList.add("bi-heart");
            }

            // Update jumlah like
            let voteCount = icon.nextElementSibling;
            if (voteCount) {
                voteCount.textContent = data.total_likes;
            }
        })
        .catch(error => console.error("Error:", error));
    }
</script>

@endsection
