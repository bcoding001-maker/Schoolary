<?php

namespace App\Http\Controllers;

use App\Models\Berita;
use App\Models\Agenda;
use App\Models\Album;
use App\Models\Kategori;
use App\Models\Visitor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalBerita = Berita::count();
        $totalAgenda = Agenda::count();
        $totalAlbums = Album::count();
        $totalKategori = Kategori::count();
        
        // Hitung unique visitors berdasarkan IP address yang berbeda
        // Cek apakah tabel visitors ada
        try {
            $totalVisitors = DB::table('visitors')
                ->select('ip_address')
                ->distinct()
                ->count('ip_address');
        } catch (\Exception $e) {
            // Jika tabel belum ada, set default 0
            $totalVisitors = 0;
        }
        
        // Tambahkan data kategoris dan allAlbums untuk welcome preview
        $kategoris = Kategori::with(['albums' => function($query) {
            $query->whereNull('parent_id')->with(['photos', 'children']);
        }])->get();
        
        $allAlbums = Album::with(['photos', 'children', 'kategori'])
            ->whereNull('parent_id')
            ->latest()
            ->get();
            
        // Tambahkan data berita
        $beritas = Berita::with('user')->latest()->get();
        
        // Tambahkan data agenda dan hitung status
        $agendas = Agenda::with('user')->latest()->get();
        $upcomingCount = Agenda::where('status', 'upcoming')->count();
        $ongoingCount = Agenda::where('status', 'ongoing')->count();
        $completedCount = Agenda::where('status', 'completed')->count();
        
        return view('dashboard', compact(
            'totalBerita', 
            'totalAgenda', 
            'totalAlbums', 
            'totalKategori', 
            'totalVisitors',
            'kategoris',
            'allAlbums',
            'beritas',
            'agendas',
            'upcomingCount',
            'ongoingCount',
            'completedCount'
        ));
    }
} 