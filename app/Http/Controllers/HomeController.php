<?php

namespace App\Http\Controllers;

use App\Models\Reports;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        try {
            // Hitung status total
            $kategori1Count = Reports::whereIn('status', ['on_progress', 'reject', 'done'])->count();
            $kategori2Count = Reports::where('status', 'pending')->count();

            // Data untuk chart
            $labels = ['Laporan']; // hanya satu label
            $kategori1Data = [$kategori1Count];
            $kategori2Data = [$kategori2Count];

            return view('home', compact(
                'kategori1Data',
                'kategori2Data',
                'labels'
            ));
        } catch (\Exception $e) {
            Log::error('Error fetching dashboard data: ' . $e->getMessage());
            return redirect()->route('dashboard')->with('error', 'Something went wrong!');
        }
    }


}
