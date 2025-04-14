<?php

namespace App\Exports;

use App\Models\Complaint;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Illuminate\Support\Facades\Log;

class ComplaintExport implements FromCollection, WithHeadings, WithMapping
{
    public function collection()
    {
        // Ambil data pengaduan
        $complaints = Complaint::with(['user', 'provinces', 'regencie', 'district', 'village'])->get();

        // Log data pengaduan yang diambil
        Log::info('Data complaints fetched for export:', $complaints->toArray());

        return $complaints;
    }

    public function headings(): array
    {
        // Judul kolom di Excel
        return [
            'Pengirim',
            'Lokasi',
            'Tanggal Pengaduan',
            'Deskripsi',
            'Jumlah Vote',
            'Status',
        ];
    }

    public function map($item): array
    {
        // Log data yang sedang diproses untuk setiap baris
        Log::info('Mapping complaint data:', [
            'email' => $item->user->email ?? '-',
            'location' => $item->provinces->name . ', ' . $item->regencie->name . ', ' . $item->district->name . ', ' . $item->village->name,
            'created_at' => $item->created_at->format('d F Y'),
            'detail' => $item->detail,
            'votes' => $item->votes ?? 0,
            'status' => $item->status,
        ]);

        // Mapping data untuk setiap baris di Excel
        return [
            $item->user->email ?? '-',
            $item->provinces->name . ', ' . $item->regencie->name . ', ' . $item->district->name . ', ' . $item->village->name,
            $item->created_at->format('d F Y'),
            $item->detail,
            $item->votes ?? 0,
            $item->status,
        ];
    }
}

