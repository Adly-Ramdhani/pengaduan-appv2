@extends('layouts.app')

@section('content')
<div class="container py-4">
    <h3 class="mb-4">Detail Pengaduan</h3>
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
                    <div>
                        <img src="{{ asset($complaint->image_path) }}"
                        onerror="this.onerror=null;this.src='https://via.placeholder.com/400x300?text=No+Image';"
                        class="img-thumbnail"
                        style="max-width: 400px;"
                        alt="Gambar Pengaduan">
                    </div>
                </div>
            @endif
            @if ($complaint->progresses && $complaint->progresses->count() > 0)
                <div class="mt-4">
                    <h5>Riwayat Progres</h5>
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Komentar</th>
                                <th>Tanggal</th>
                                @if ($complaint->status !== 'done')
                                <th class="px-6 py-3 text-center text-sm font-medium text-gray-500">Aksi</th>
                               @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($complaint->progresses as $progress)
                                <tr>
                                    <td>{{ $progress->komentar ?? '-' }}</td>
                                    <td>{{ \Carbon\Carbon::parse($progress->created_at)->translatedFormat('d F Y H:i') }}</td>
                                    @if ($complaint->status !== 'done')
                                        <td class="text-center">
                                            <form action="{{ route('complaints.progress.destroy', $progress->id) }}" method="POST" onsubmit="return confirm('Yakin ingin menghapus progress ini?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger">Hapus</button>
                                            </form>
                                        </td>
                                    @endif
                                </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            @endif 
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('pengaduan.staff.index') }}" class="btn btn-secondary">Kembali</a>

                @if (!in_array($complaint->status, ['done', 'reject']))
                    <form action="{{ route('complaints.done', $complaint->id) }}" method="POST" class="ms-2">
                        @csrf
                        <input type="hidden" name="status" value="done">
                        <button type="submit" class="btn btn-success">
                            Tandai Selesai
                        </button>
                    </form>

                    <button type="button" class="btn btn-primary ms-2" data-bs-toggle="collapse" data-bs-target="#progressForm" aria-expanded="false" aria-controls="progressForm">
                        Tambah Progress
                    </button>
                @endif
            </div>



            <!-- Form progress yang akan tampil/disembunyikan -->
            <div class="collapse mt-3" id="progressForm">
                <div class="card card-body">
                    <form action="{{ route('complaints.progress.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="report_id" value="{{ $complaint->id }}">
                        <div class="mb-3">
                            <label for="komentar" class="form-label">Komentar Staf</label>
                            <textarea name="komentar" id="komentar" class="form-control" rows="3" placeholder="Tambahkan komentar progres..."></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan Progres</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
