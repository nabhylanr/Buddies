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

        // Redirect ke calendar setelah berhasil create task
        return redirect()->route('calendar.index')
            ->with('success', 'Task berhasil ditambahkan ke calendar!');
    }

    public function index() 
    {
        $tasks = Task::orderBy('datetime', 'asc')->get();
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
            'datetime' => 'required|date',
            'place' => 'required|string|max:255',
            'implementor' => 'required|string|max:255',
        ]);

        $task->update($request->all());

        return redirect()->route('calendar.index')
            ->with('success', 'Task berhasil diperbarui!');
    }

    public function destroy($id)
{
    $task = Task::findOrFail($id);
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task berhasil dihapus.');
}

}