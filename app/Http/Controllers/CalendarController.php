<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Carbon\Carbon;

class CalendarController extends Controller
{
    public function index()
    {
        return view('calendar');
    }

    public function getEvents(Request $request)
    {
        $start = $request->input('start');
        $end = $request->input('end');

        // Join dengan tabel recaps untuk mendapatkan status real-time
        $tasks = Task::with('recap')
            ->whereBetween('datetime', [$start, $end])
            ->orderBy('datetime', 'asc')
            ->get();

        $events = [];
        foreach ($tasks as $task) {
            $dateKey = $task->date_key;
            
            if (!isset($events[$dateKey])) {
                $events[$dateKey] = [];
            }

            // Ambil status dari recap jika ada, fallback ke task status
            $status = $task->recap && $task->recap->status ? $task->recap->status : $task->status;
            
            $events[$dateKey][] = [
                'id' => $task->id,
                'title' => $task->title,
                'description' => $task->description,
                'time' => $task->time,
                'datetime' => $task->iso_datetime,
                'place' => $task->place,
                'implementor' => $task->implementor,
                'status' => $status, // Status dari recap
                'recap_id' => $task->recap_id,
                'company_name' => $task->recap ? $task->recap->nama_perusahaan : 'Unknown',
                'branch' => $task->recap ? $task->recap->cabang : 'Unknown',
            ];
        }

        return response()->json($events);
    }
}