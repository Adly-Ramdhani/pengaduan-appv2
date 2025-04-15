    @extends('layouts.app')

    @section('content')
    <div class="container py-4">
        <h3 class="mb-4">Detail Pengaduan</h3>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

        <div class="card shadow">
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Nama Pengaduan</label>
                        <div class="border p-2 rounded bg-light">{{ $complaint->name }}</div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Email Pengadu</label>
                        <div class="border p-2 rounded bg-light">{{ $complaint->user->email ?? '-' }}</div>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label class="fw-bold">Status Pengaduan</label>
                        <div class="border p-2 rounded bg-light text-capitalize">
                            {{ $complaint->status ?? '-' }}
                        </div>
                    </div>
                    <div class="col-md-6">
                        <label class="fw-bold">Tanggal Pengaduan</label>
                        <div class="border p-2 rounded bg-light">
                            {{ \Carbon\Carbon::parse($complaint->created_at)->translatedFormat('d F Y') }}
                        </div>
                    </div>
                </div>

                <div class="mb-3">
                    <label class="fw-bold">Lokasi</label>
                    <ul class="list-group">
                        <li class="list-group-item">Provinsi: {{ $complaint->provinces->name ?? '-' }}</li>
                        <li class="list-group-item">Kabupaten: {{ $complaint->regencie->name ?? '-' }}</li>
                        <li class="list-group-item">Kecamatan: {{ $complaint->district->name ?? '-' }}</li>
                        <li class="list-group-item">Desa: {{ $complaint->village->name ?? '-' }}</li>
                    </ul>
                </div>

                @if ($complaint->image_path)
                    <div class="mb-3">
                        <label class="fw-bold">Gambar</label>
                        <div style="max-width: 100%; overflow: auto;" class="border rounded">
                            <img src="{{ asset($complaint->image_path) }}"
                                onerror="this.onerror=null;this.src='https://via.placeholder.com/400x300?text=No+Image';"
                                class="img-fluid"
                                style="object-fit: contain; width: 100%; height: auto; border-radius: 8px;"
                                alt="Gambar Pengaduan">
                        </div>

                    </div>
                @endif

                {{-- @if ($complaint->progresses && $complaint->progresses->count() > 0)
                    <div class="mt-4">
                        <h5>Riwayat Progres</h5>
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Komentar</th>
                                    <th>Tanggal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($complaint->progresses as $progress)
                                    <tr>
                                        <td>{{ $progress->komentar ?? '-' }}</td>
                                        <td>{{ \Carbon\Carbon::parse($progress->created_at)->translatedFormat('d F Y H:i') }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @endif --}}

                {{-- Komentar Tambahan --}}
                @if ($complaint->comments && $complaint->comments->count() > 0)
                    <div class="mt-4">
                        <h5>Komentar Tambahan</h5>
                        <ul class="list-group">
                            @foreach ($complaint->comments as $comment)
                                <li class="list-group-item">
                                    <div class="fw-semibold">{{ $comment->user->email ?? 'Pengguna' }}</div>
                                    <div>{{ $comment->comment }}</div>
                                    <small class="text-muted">{{ $comment->created_at->translatedFormat('d F Y H:i') }}</small>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                {{-- Form Tambah Komentar --}}
                <form action="{{ route('comments.store', $complaint->id) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="comment" class="form-label">Komentar</label>
                        <textarea name="comment" class="form-control" rows="3" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Kirim Komentar</button>
                </form>




                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </div>
        </div>
    </div>
    @endsection
