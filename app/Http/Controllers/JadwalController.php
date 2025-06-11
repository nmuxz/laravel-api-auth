<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Jadwal;
use Carbon\Carbon;

class JadwalController extends Controller
{
    public function index()
    {
        $jadwal = Jadwal::all();
        return response()->json([
            'message' => 'Daftar jadwal berhasil diambil.',
            'data' => $jadwal,
        ]);
    }
    
    public function store(Request $request)
    {
        $validated = $request->validate([
            'mata_kuliah' => 'required|string',
            'waktu_mulai' => 'required|date_format:H:i:s',
            'waktu_selesai' => 'required|date_format:H:i:s|after:waktu_mulai',
            'ruang' => 'required|string',
            'tanggal' => 'required|date',
        ]);

        $jadwal = Jadwal::create($validated);

        return response()->json([
            'message' => 'Jadwal berhasil disimpan.',
            'data' => $jadwal,
        ], 201);
    }

    public function update(Request $request, $id)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal not found'], 404);
        }

        $validated = $request->validate([
            'mata_kuliah' => 'required|string',
            'tanggal' => 'required|date',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'ruang' => 'required|string',
        ]);

        $jadwal->update($validated);

        return response()->json(['message' => 'Jadwal updated', 'jadwal' => $jadwal]);
    }

    public function destroy($id)
    {
        $jadwal = Jadwal::find($id);
        if (!$jadwal) {
            return response()->json(['message' => 'Jadwal not found'], 404);
        }

        $jadwal->delete();

        return response()->json(['message' => 'Jadwal deleted']);
    }

    
}
