@extends('layouts.app')

@section('content')
<style>
    body {
        background-color: white;
    }
    .news-card {
        background: white;
        border-radius: 10px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        padding: 15px;
        display: flex;
        align-items: center;
    }
    .news-card img {
        width: 120px;
        height: 80px;
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
    }
    .news-title:hover {
        text-decoration: underline;
    }
    .news-meta {
        font-size: 14px;
        color: #6c757d;
    }
    .news-tags a {
        font-size: 14px;
        color: #007bff;
        text-decoration: none;
    }
    .news-tags a:hover {
        text-decoration: underline;
    }
    .vote-icon {
        font-size: 20px;
        cursor: pointer;
        transition: 0.3s;
    }
    .vote-icon.active {
        color: red;
    }
</style>
</head>
<body>

<div class="container py-4">
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="news-card mb-3">
            <img src="https://via.placeholder.com/120x80" alt="Gambar Berita">
            <div class="news-content">
                <a href="#" class="news-title">Kabupaten Bogor, Jawa Barat Mengalami Menjadi...</a>
                <div class="news-meta mt-1">
                    <span><i class="bi bi-eye"></i> 129</span>
                    <span class="ms-3"><i class="bi bi-heart-fill text-danger"></i> 35</span>
                </div>
                <div class="news-tags mt-2">
                    <a href="#">#sosial</a> <a href="#">#jawa_barat</a>
                </div>
                <div class="news-time mt-2">2 weeks ago</div>
            </div>
            <div class="d-flex align-items-center ms-3">
                <i class="bi bi-heart vote-icon" onclick="toggleVote(this)"></i>
                <span class="ms-1">vote</span>
            </div>
        </div>

        <div class="news-card">
            <img src="https://via.placeholder.com/120x80" alt="Gambar Berita">
            <div class="news-content">
                <a href="#" class="news-title">Lorem Ipsum...</a>
                <div class="news-meta mt-1">
                    <span><i class="bi bi-eye"></i> 25</span>
                    <span class="ms-3"><i class="bi bi-heart-fill text-danger"></i> 20</span>
                </div>
                <div class="news-tags mt-2">
                    <a href="#">#pembangunan</a> <a href="#">#sulawesi_utara</a>
                </div>
                <div class="news-time mt-2">2 weeks ago</div>
            </div>
            <div class="d-flex align-items-center ms-3">
                <i class="bi bi-heart vote-icon" onclick="toggleVote(this)"></i>
                <span class="ms-1">vote</span>
            </div>
        </div>
    </div>

    <!-- Sidebar Informasi -->
    <div class="col-md-4">
        <div class="card">
            <div class="card-header bg-warning text-dark">
                <i class="bi bi-info-circle-fill"></i> Informasi Pembuatan Pengaduan
            </div>
            <div class="card-body">
                <ol>
                    <li>Pengaduan bisa dibuat hanya jika Anda telah membuat akun sebelumnya.</li>
                    <li>Keseluruhan data pada pengaduan bernilai <strong>BENAR dan DAPAT DIPERTANGGUNG JAWABKAN</strong>.</li>
                    <li>Seluruh bagian data perlu diisi.</li>
                    <li>Pengaduan Anda akan ditanggapi dalam 2x24 Jam.</li>
                    <li>Periksa tanggapan Kami, pada <strong>Dashboard</strong> setelah Anda <strong>Login</strong>.</li>
                    <li>Pengaduan dapat dilakukan pada halaman berikut: <a href="{{ route('') }}">Ikuti Tautan</a></li>
                </ol>
            </div>
        </div>
    </div>
</div>
</div>



@endsection
