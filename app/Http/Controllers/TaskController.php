<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    // Display a listing of tasks
    public function index()
    {
        // Retrieve tasks belonging to the authenticated user
        $tasks = Task::where('user_id', Auth::id())->get();
        // Pass tasks data to the 'tasks.index' view
        return view('tasks.index', compact('tasks'));
    }

    // Show the form for creating a new task
    public function create()
    {
        // Return the view for creating a new task
        return view('tasks.create');
    }

    // Store a newly created task in storage
    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
        ]);

        // Create a new task in the database
        Task::create([
            'title' => $request->title,
            'description' => $request->description,
            'is_completed' => false,
            'user_id' => Auth::id(),
        ]);

        // Redirect to the tasks index with a success message
        return redirect()->route('tasks.index')->with('alert-success', 'Task created successfully');
    }

    // Display the specified task
    public function show(Task $task)
    {
        // Authorize the user to view the task
        $this->authorize('view', $task);
        // Pass task data to the 'tasks.show' view
        return view('tasks.show', compact('task'));
    }

    // Show the form for editing the specified task
    public function edit(Task $task)
    {
        // Authorize the user to edit the task
        $this->authorize('update', $task);
        // Pass task data to the 'tasks.edit' view
        return view('tasks.edit', compact('task'));
    }

    // Update the specified task in storage
    public function update(Request $request, Task $task)
    {
        // Validate the incoming request data
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'is_completed' => 'required|boolean',
        ]);

        // Authorize the user to update the task
        $this->authorize('update', $task);

        // Update the task's fields with the new data
        $task->update($request->all());

        // Redirect to the tasks index with an info message
        return redirect()->route('tasks.index')->with('alert-info', 'Task updated successfully');
    }

    // Remove the specified task from storage
    public function destroy(Task $task)
    {
        // Authorize the user to delete the task
        $this->authorize('delete', $task);

        // Delete the task from the database
        $task->delete();

        // Redirect to the tasks index with a success message
        return redirect()->route('tasks.index')->with('alert-success', 'Task deleted successfully');
    }
}
