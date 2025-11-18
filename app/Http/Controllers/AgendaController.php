<?php

namespace App\Http\Controllers;

use App\Models\Agenda;
use Illuminate\Http\Request;
use Carbon\Carbon;

class AgendaController extends Controller
{
    public function index()
    {
        $agendas = Agenda::with('user')->latest()->get();
        return view('admin.agenda.index', compact('agendas'));
    }

    public function create()
    {
        return view('admin.agenda.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed'
        ]);

        $validated['user_id'] = auth()->user()->id;
        
        // Convert dates to Carbon instances
        $validated['tanggal_mulai'] = Carbon::parse($request->tanggal_mulai);
        $validated['tanggal_selesai'] = Carbon::parse($request->tanggal_selesai);
        
        Agenda::create($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil ditambahkan');
    }

    public function edit(Agenda $agenda)
    {
        // Convert string dates to Carbon instances
        $agenda->tanggal_mulai = Carbon::parse($agenda->tanggal_mulai);
        $agenda->tanggal_selesai = Carbon::parse($agenda->tanggal_selesai);
        
        return view('admin.agenda.edit', compact('agenda'));
    }

    public function update(Request $request, Agenda $agenda)
    {
        $validated = $request->validate([
            'judul' => 'required|string|max:255',
            'deskripsi' => 'required|string',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after_or_equal:tanggal_mulai',
            'lokasi' => 'required|string|max:255',
            'status' => 'required|in:upcoming,ongoing,completed'
        ]);

        // Convert dates to Carbon instances
        $validated['tanggal_mulai'] = Carbon::parse($request->tanggal_mulai);
        $validated['tanggal_selesai'] = Carbon::parse($request->tanggal_selesai);

        $agenda->update($validated);

        return redirect()->route('admin.agenda.index')
            ->with('success', 'Agenda berhasil diperbarui');
    }

    public function destroy(Agenda $agenda)
    {
        try {
            $agenda->delete();
            return redirect()->route('admin.agenda.index')
                            ->with('success', 'Agenda berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.agenda.index')
                            ->with('error', 'Gagal menghapus agenda. Silakan coba lagi.');
        }
    }
} 