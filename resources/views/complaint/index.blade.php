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
    .category a {
        font-size: 13px;
        margin-right: 5px;
        color: #17a2b8;
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

    <form method="GET" action="{{ route('pengaduan.index') }}" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <select name="province" class="form-control">
                    <option value="">-- Semua Provinsi --</option>
                    @foreach ($provinces as $province)
                        <option value="{{ $province }}" {{ request('province') == $province ? 'selected' : '' }}>
                            {{ $province }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-md-6">
                <select name="category" class="form-control">
                    <option value="" disabled {{ request('category') == '' ? 'selected' : '' }}>Pilih Kategori...</option>
                    <option value="sosial" {{ request('category') == 'sosial' ? 'selected' : '' }}>Sosial</option>
                    <option value="pembangun" {{ request('category') == 'pembangun' ? 'selected' : '' }}>Pembangun</option>
                    <option value="kejahatan" {{ request('category') == 'kejahatan' ? 'selected' : '' }}>Kejahatan</option>
                </select>
            </div>
            <div class="col-md-12 mt-2">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </div>
    </form>

    <div class="row">
        {{-- Pengaduan List --}}
        <div class="col-md-8">
            @forelse ($complaint as $item)
                <div class="news-card mb-3">
                    <img src="{{ url($item->image_path) }}" alt="Gambar Pengaduan">
                    <div class="news-content">
                        <a href="{{ route('complaint.show', $item->id) }}" class="news-title">{{ $item->description }}</a>

                        <div class="category mt-1">
                            <a href="#">#{{ $item->name }}</a>
                            <a href="#">#{{ $item->provinces->name }}</a>
                        </div>

                        <div class="news-time mt-2">{{ $item->created_at->diffForHumans() }}</div>
                    </div>
                    <div class="d-flex align-items-center ms-3">
                        {{-- Voting (Opsional) --}}
                        {{-- <i class="bi bi-heart vote-icon" data-id="{{ $item->id }}" onclick="toggleVote(this)"></i>
                        <span class="ms-1 vote-count">{{ $item->total_likes }}</span> --}}
                    </div>
                </div>
            @empty
                <p>Tidak ada pengaduan ditemukan.</p>
            @endforelse
        </div>

        {{-- Info Sidebar --}}
        <div class="col-md-4">
            <div class="info-box">
                <h5><i class="bi bi-info-circle-fill text-warning"></i> Informasi Pembuatan Pengaduan</h5>
                <ol class="mt-2">
                    <li>Pengaduan hanya dapat dibuat oleh pengguna terdaftar.</li>
                    <li>Pastikan seluruh data yang Anda masukkan benar dan dapat dipertanggungjawabkan.</li>
                    <li>Isi semua data yang diminta secara lengkap.</li>
                    <li>Pengaduan akan ditanggapi dalam waktu maksimal 2x24 jam.</li>
                    <li>Periksa tanggapan kami di dashboard Anda setelah login.</li>
                    <li>Untuk membuat pengaduan, klik: <a href="{{ route('pengaduan.create') }}">Halaman Pengaduan</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>

{{-- Voting Script --}}
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

            let voteCount = icon.nextElementSibling;
            if (voteCount) {
                voteCount.textContent = data.total_likes;
            }
        })
        .catch(error => console.error("Error:", error));
    }
</script>
@endsection
