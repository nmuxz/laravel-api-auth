<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class TaskController extends Controller
{
    // Get all tasks
    public function index()
    {
        return Task::all();
    }

    // Create new task
    public function store(Request $request)
    {
        $validated = $request->validate([
            'namaTugas' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'deadline' => 'required|date',
            'ingatkan' => 'nullable|boolean',
            'jenisNotifikasi' => 'nullable|string',
        ]);

        // Sesuaikan nama field dari request ke kolom DB
        $task = Task::create([
            'nama_tugas' => $validated['namaTugas'],
            'deskripsi' => $validated['deskripsi'] ?? null,
            'deadline' => $validated['deadline'],
            'ingatkan' => $validated['ingatkan'] ?? false,
            'jenis_notifikasi' => $validated['jenisNotifikasi'] ?? null,
            'is_done' => false,
        ]);

        return response()->json($task, 201);
    }

    // Update task (contoh untuk mark done)
    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);

        // Update is_done status kalau ada
        if ($request->has('is_done')) {
            $task->is_done = (bool) $request->input('is_done');
        }

        $task->save();

        return response()->json($task);
    }

    // Delete task
    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        return response()->json(null, 200);
    }

    
}
