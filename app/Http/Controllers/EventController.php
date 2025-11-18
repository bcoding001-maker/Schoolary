<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::with('user')->get();
        $upcomingCount = Event::where('status', 'upcoming')->count();
        $ongoingCount = Event::where('status', 'ongoing')->count();
        $completedCount = Event::where('status', 'completed')->count();
        
        return view('admin.events.index', compact('events', 'upcomingCount', 'ongoingCount', 'completedCount'));
    }

    public function create()
    {
        return view('admin.events.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'required|in:upcoming,ongoing,completed'
        ]);

        $data = [
            'event_name' => $request->event_name,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'status' => $request->status,
            'created_by' => Auth::id(),
            'created_at' => now()
        ];

        if ($request->hasFile('thumbnail')) {
            // Pastikan direktori ada
            if (!file_exists(storage_path('app/public/events'))) {
                mkdir(storage_path('app/public/events'), 0755, true);
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Move file langsung ke public path
            $file->move(public_path('storage/events'), $filename);
            
            $data['thumbnail'] = $filename;
        }

        try {
            Event::create($data);
            return redirect()->route('admin.events.index')
                            ->with('success', 'Event berhasil ditambahkan!');
        } catch (\Exception $e) {
            return redirect()->route('admin.events.index')
                            ->with('error', 'Gagal menambahkan event. Silakan coba lagi.');
        }
    }

    public function edit(Event $event)
    {
        return view('admin.events.edit', compact('event'));
    }

    public function update(Request $request, Event $event)
    {
        $request->validate([
            'event_name' => 'required|string|max:255',
            'description' => 'required',
            'event_date' => 'required|date',
            'location' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg|max:10240',
            'status' => 'required|in:upcoming,ongoing,completed'
        ]);

        $data = [
            'event_name' => $request->event_name,
            'description' => $request->description,
            'event_date' => $request->event_date,
            'location' => $request->location,
            'status' => $request->status
        ];

        if ($request->hasFile('thumbnail')) {
            // Delete old thumbnail
            if ($event->thumbnail) {
                $oldPath = public_path('storage/events/' . $event->thumbnail);
                if (file_exists($oldPath)) {
                    unlink($oldPath);
                }
            }

            // Pastikan direktori ada
            if (!file_exists(storage_path('app/public/events'))) {
                mkdir(storage_path('app/public/events'), 0755, true);
            }

            $file = $request->file('thumbnail');
            $filename = time() . '_' . $file->getClientOriginalName();
            
            // Move file langsung ke public path
            $file->move(public_path('storage/events'), $filename);
            
            $data['thumbnail'] = $filename;
        }

        try {
            $event->update($data);
            return redirect()->route('admin.events.index')
                            ->with('success', 'Event berhasil diperbarui!');
        } catch (\Exception $e) {
            return redirect()->route('admin.events.index')
                            ->with('error', 'Gagal memperbarui event. Silakan coba lagi.');
        }
    }

    public function destroy(Event $event)
    {
        // Delete thumbnail if exists
        if ($event->thumbnail) {
            Storage::delete('public/events/' . $event->thumbnail);
        }

        try {
            $event->delete();
            return redirect()->route('admin.events.index')
                            ->with('success', 'Event berhasil dihapus!');
        } catch (\Exception $e) {
            return redirect()->route('admin.events.index')
                            ->with('error', 'Gagal menghapus event. Silakan coba lagi.');
        }
    }
} 