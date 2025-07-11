<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\Recap;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class TaskController extends Controller
{
    public function create()
    {
        $recaps = Recap::orderBy('nama_perusahaan', 'asc')->get();
        return view('task.create', compact('recaps'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'recap_id' => 'required|exists:recaps,id',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'place' => 'required|string|max:255',
            'implementor' => 'required|string|max:255',
        ]);

        $datetime = Carbon::parse($request->date . ' ' . $request->time);
        $this->validateScheduleConflict($request->implementor, $datetime);

        Task::create([
            'recap_id' => $request->recap_id,
            'description' => $request->description,
            'datetime' => $datetime,
            'place' => $request->place,
            'implementor' => $request->implementor,
            'status' => 'pending',
        ]);

        // Update status Recap menjadi "scheduled"
        $recap = Recap::find($request->recap_id);
        if ($recap && $recap->status !== 'completed') {
            $recap->status = 'scheduled';
            $recap->save();
        }

        return redirect()->route('calendar.index')
            ->with('success', 'Task berhasil ditambahkan ke calendar!');
    }

    public function complete(Task $task)
    {
        $task->update([
            'status' => 'completed',
            'completed_at' => Carbon::now('Asia/Jakarta')
        ]);

        // Jika semua task recap sudah selesai, set recap ke "completed"
        $recap = $task->recap;
        if ($recap) {
            $hasOtherPending = $recap->tasks()->where('status', '!=', 'completed')->exists();
            if (!$hasOtherPending) {
                $recap->status = 'completed';
                $recap->save();
            }
        }

        return redirect()->route('tasks.index')
            ->with('success', 'Task berhasil ditandai sebagai selesai pada ' .
                   Carbon::now('Asia/Jakarta')->format('d M Y H:i') . '!');
    }

    public function uncomplete(Task $task)
    {
        $task->update(['status' => 'pending', 'completed_at' => null]);

        $recap = $task->recap;
        if ($recap && $recap->status === 'completed') {
            $recap->status = 'scheduled';
            $recap->save();
        }

        return redirect()->route('tasks.history')
            ->with('success', 'Task berhasil dikembalikan ke daftar!');
    }

    public function index(Request $request)
    {
        $query = Task::with('recap')->where('status', 'pending');

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

        if ($request->filled('company')) {
            $query->whereHas('recap', function($q) use ($request) {
                $q->where('nama_perusahaan', 'like', '%' . $request->company . '%');
            });
        }

        $tasks = $query->orderBy('datetime', 'asc')->get();
        return view('task.index', compact('tasks'));
    }

    public function history(Request $request)
    {
        $query = Task::with('recap')->where('status', 'completed');

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

        if ($request->filled('company')) {
            $query->whereHas('recap', function($q) use ($request) {
                $q->where('nama_perusahaan', 'like', '%' . $request->company . '%');
            });
        }

        $tasks = $query->orderBy('completed_at', 'desc')->get();
        return view('task.history', compact('tasks'));
    }

    public function show(Task $task)
    {
        $task->load('recap');
        return view('task.show', compact('task'));
    }

    // Fixed edit method - now accepts Task model directly
    public function edit(Task $task)
    {
        $task->load('recap');
        $recaps = Recap::orderBy('nama_perusahaan', 'asc')->get();
        return view('task.edit', compact('task', 'recaps'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'recap_id' => 'required|exists:recaps,id',
            'description' => 'required|string',
            'date' => 'required|date',
            'time' => 'required',
            'place' => 'required|string|max:255',
            'implementor' => 'required|string|max:255',
        ]);

        $datetime = Carbon::parse($request->date . ' ' . $request->time);
        $this->validateScheduleConflict($request->implementor, $datetime, $task->id);

        $task->update([
            'recap_id' => $request->recap_id,
            'description' => $request->description,
            'datetime' => $datetime,
            'place' => $request->place,
            'implementor' => $request->implementor,
        ]);

        return redirect()->route('calendar.index')
            ->with('success', 'Task berhasil diperbarui!');
    }

    // Fixed destroy method - now accepts Task model directly
    public function destroy(Task $task)
    {
        $task->delete();
        return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
    }

    private function validateScheduleConflict($implementor, $datetime, $excludeTaskId = null)
    {
        $query = Task::where('implementor', $implementor)
            ->where('datetime', $datetime)
            ->where('status', 'pending');

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

    public function getAvailableTimeSlots(Request $request)
    {
        $implementor = $request->get('implementor');
        $date = $request->get('date');
        $excludeTaskId = $request->get('exclude_task_id');

        if (!$implementor || !$date) {
            return response()->json(['error' => 'Implementor dan tanggal harus diisi'], 400);
        }

        $allTimeSlots = ['10:00', '13:00', '15:00'];

        $query = Task::where('implementor', $implementor)
            ->whereDate('datetime', $date)
            ->where('status', 'pending');

        if ($excludeTaskId) {
            $query->where('id', '!=', $excludeTaskId);
        }

        $usedTimeSlots = $query->pluck('datetime')
            ->map(function ($datetime) {
                return Carbon::parse($datetime)->format('H:i');
            })
            ->toArray();

        $availableTimeSlots = array_diff($allTimeSlots, $usedTimeSlots);

        return response()->json([
            'available_slots' => array_values($availableTimeSlots),
            'used_slots' => $usedTimeSlots
        ]);
    }

    public function dashboard()
    {
        $today = Carbon::today('Asia/Jakarta');
        $startOfWeek = $today->copy()->startOfWeek();
        $endOfWeek = $today->copy()->endOfWeek();

        $tasks = Task::with('recap')
            ->where('status', 'pending')
            ->orderBy('datetime', 'asc')
            ->get();

        $totalTasks = $tasks->count();

        $todayTasks = $tasks->filter(fn($task) => $task->datetime->setTimezone('Asia/Jakarta')->isSameDay($today))->count();

        $weekTasks = $tasks->filter(fn($task) => $task->datetime->between($startOfWeek, $endOfWeek))->count();

        $upcomingTasks = $tasks->filter(fn($task) => $task->datetime->isAfter($today))->count();

        return view('dashboard', compact('tasks', 'totalTasks', 'todayTasks', 'weekTasks', 'upcomingTasks'));
    }
}