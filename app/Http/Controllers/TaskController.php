<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

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
            'datetime' => 'required|date',
            'place' => 'required|string|max:255',
            'implementor' => 'required|string|max:255',
        ]);

        Task::create($request->all());

        return redirect()->back()->with('success', 'Task berhasil ditambahkan.');
    }

    public function index() {
        $tasks = Task::orderBy('datetime', 'asc')->get();
        return view('task.index', compact('tasks'));
    }

}
