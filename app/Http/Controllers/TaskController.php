<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if (Auth::id()) {
            $role = Auth::user()->role;

            if ($role == 'user') {

                $category_id = $request->get('category_id');
                $status = $request->get('status');
                $sort_by = $request->get('sort_by', 'created_at');
                $sort_order = $request->get('sort_order', 'desc');

                $query = Task::query();

                if ($role == 'user') {
                    $query->where('user_id', Auth::id());
                }

                if ($category_id) {
                    $query->where('category_id', $category_id);
                }

                if ($status) {
                    $query->where('status', $status);
                }

                $query->orderBy($sort_by, $sort_order);

                $tasks = $query->paginate(10);
                $categories = Category::all();

                return view('task.index', compact('tasks', 'categories'));

            } elseif ($role == 'admin') {

                $category_id = $request->get('category_id');
                $status = $request->get('status');
                $sort_by = $request->get('sort_by', 'created_at');
                $sort_order = $request->get('sort_order', 'desc');

                $query = Task::query();

                if ($category_id) {
                    $query->where('category_id', $category_id);
                }

                if ($status) {
                    $query->where('status', $status);
                }

                $query->orderBy($sort_by, $sort_order);

                $tasks = $query->paginate(10);
                $categories = Category::all();

                return view('task.index', compact('tasks', 'categories'));
            }
        }
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::all();
        return view('task.index', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $validated['user_id'] = Auth::id(); // Add the authenticated user's ID

        Task::create($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('task.show', compact('task'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        $categories = Category::all();
        return view('task.edit', compact('task', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        $validated = $request->validate([
            'title' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'status' => 'required',
        ]);

        $task->update($validated);

        return redirect()->route('tasks.index')
            ->with('success', 'Task updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')
            ->with('success', 'Task deleted successfully.');
    }
}
