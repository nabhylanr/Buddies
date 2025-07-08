<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function create()
    {
        return view('task.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'place' => 'required|string|max:255',
            'implementor' => 'required|string|max:255',
        ]);

        $datetime = Carbon::parse($request->date . ' ' . $request->time);

        // Validasi konflik jadwal
        $this->validateScheduleConflict($request->implementor, $datetime);

        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'datetime' => $datetime,
            'place' => $request->place,
            'implementor' => $request->implementor,
        ]);

        return redirect()->route('calendar.index')
            ->with('success', 'Task berhasil ditambahkan ke calendar!');
    }

    public function index(Request $request)
    {
        $query = Task::query();
        
        if ($request->filled('date')) {
            $query->whereDate('datetime', $request->date);
        }
        
        if ($request->filled('time')) {
            $query->whereTime('datetime', $request->time);
        }
        
        if ($request->filled('place')) {
            $query->where('place', $request->place);
        }
        
        if ($request->filled('implementor')) {
            $query->where('implementor', $request->implementor);
        }

        $tasks = $query->orderBy('datetime', 'asc')->get();
        
        return view('task.index', compact('tasks'));
    }

    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('task.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'place' => 'required|string|max:255',
            'implementor' => 'required|string|max:255',
        ]);

        $datetime = Carbon::parse($request->date . ' ' . $request->time);

        // Validasi konflik jadwal (kecuali untuk task yang sedang diedit)
        $this->validateScheduleConflict($request->implementor, $datetime, $task->id);

        $task->update([
            'title' => $request->title,
            'description' => $request->description,
            'datetime' => $datetime,
            'place' => $request->place,
            'implementor' => $request->implementor,
        ]);

        return redirect()->route('calendar.index')
            ->with('success', 'Task berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        
        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
    }

    /**
     * Validasi konflik jadwal untuk implementor
     */
    private function validateScheduleConflict($implementor, $datetime, $excludeTaskId = null)
    {
        $query = Task::where('implementor', $implementor)
                    ->where('datetime', $datetime);

        // Jika sedang update, exclude task yang sedang diedit
        if ($excludeTaskId) {
            $query->where('id', '!=', $excludeTaskId);
        }

        $existingTask = $query->first();

        if ($existingTask) {
            throw ValidationException::withMessages([
                'time' => "Implementor {$implementor} sudah memiliki task pada tanggal " . 
                         $datetime->format('d M Y') . " jam " . $datetime->format('H:i') . 
                         ". Silakan pilih waktu yang berbeda."
            ]);
        }
    }

    /**
     * API endpoint untuk mendapatkan waktu yang tersedia untuk implementor tertentu
     */
    public function getAvailableTimeSlots(Request $request)
    {
        $implementor = $request->get('implementor');
        $date = $request->get('date');
        $excludeTaskId = $request->get('exclude_task_id'); // untuk edit mode

        if (!$implementor || !$date) {
            return response()->json(['error' => 'Implementor dan tanggal harus diisi'], 400);
        }

        // Daftar semua slot waktu yang tersedia
        $allTimeSlots = ['10:00', '13:00', '15:00'];
        
        // Ambil waktu yang sudah digunakan oleh implementor pada tanggal tersebut
        $query = Task::where('implementor', $implementor)
                    ->whereDate('datetime', $date);

        if ($excludeTaskId) {
            $query->where('id', '!=', $excludeTaskId);
        }

        $usedTimeSlots = $query->pluck('datetime')
                              ->map(function ($datetime) {
                                  return Carbon::parse($datetime)->format('H:i');
                              })
                              ->toArray();

        // Filter slot waktu yang masih tersedia
        $availableTimeSlots = array_diff($allTimeSlots, $usedTimeSlots);

        return response()->json([
            'available_slots' => array_values($availableTimeSlots),
            'used_slots' => $usedTimeSlots
        ]);
    }
}