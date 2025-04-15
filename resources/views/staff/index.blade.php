@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h3 class="mb-4">Pengaduan</h3>


    <div class="table-responsive">
        <table class="table table-bordered">
            <div class="d-flex justify-content-between mb-4">
                <a href="{{ route('complaints.export') }}" class="btn btn-success">
                    <i class="fas fa-file-excel"></i> Export ke Excel
                </a>
            </div>
            <thead class="table-light">
                <tr>
                    <th>Pengirim</th>
                    <th>Lokasi & Tanggal</th>
                    <th>Deskripsi</th>
                    <th>Jumlah Vote</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($staff as $item)
                <tr>
                    <td>
                        <div class="d-flex align-items-center">
                            <img src="{{ asset($item->image_path) }}"
                            onerror="this.onerror=null;this.src='https://via.placeholder.com/40';"
                            class="rounded-circle me-2" width="40" height="40" alt="User">
                            <a href="mailto:{{ $item->user->email ?? '-' }}">{{ $item->user->email ?? '-' }}</a>
                        </div>
                    </td>

                    <td>

                        {{ $item->provinces->name}},
                         {{ $item->regencie->name}},
                        {{ $item->district->name}},
                        {{ $item->village->name}}
                        <br>
                        {{ \Carbon\Carbon::parse($item->created_at)->format('d F Y') }}
                    </td>
                    <td>{{ Str::limit($item->detail, 50) }}</td>
                    <td>{{ $item->votes ?? 0 }}</td>
                    <td>
                        <!-- TOMBOL AKSI -->
                        <div class="dropdown">
                            <button class="btn btn-sm btn-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                Aksi
                            </button>
                            <ul class="dropdown-menu">
                                @if ($item->status == 'on_progress')
                                    <li>
                                        <a class="dropdown-item text-primary" href="#" data-bs-toggle="modal" data-bs-target="#modalTindakLanjuti-{{ $item->id }}">
                                            Tindak Lanjuti
                                        </a>
                                    </li>
                                @elseif ($item->status == 'on_progress' || $item->status == 'reject' || $item->status == 'done')
                                    <li>
                                        <a class="dropdown-item text-primary" href="{{ route('complaints.show', $item->id) }}">
                                            Tindak Lanjuti
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>

                        <!-- MODAL TINDAK LANJUTI -->
                        <div class="modal fade" id="modalTindakLanjuti-{{ $item->id }}" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title">Tindak Lanjuti Pengaduan</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Tutup"></button>
                            </div>
                            <div class="modal-body">
                                <p>Silakan pilih tindakan untuk pengaduan ini:</p>
                                <form method="POST" action="{{ route('complaints.updateStatus', $item->id) }}">
                                @csrf
                                @method('PUT')
                                <button type="submit" name="status" value="proses" class="btn btn-warning">Proses</button>
                                <button type="submit" name="status" value="reject" class="btn btn-danger">Tolak</button>
                                </form>
                            </div>
                            </div>
                        </div>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
