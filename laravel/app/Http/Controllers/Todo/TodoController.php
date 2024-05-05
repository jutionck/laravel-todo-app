<?php

namespace App\Http\Controllers\Todo;

use App\Http\Controllers\Controller;
use App\Models\Todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Memulai query builder dengan sorting
        $query = Todo::orderBy('created_at', 'desc');

        // Mengecek apakah ada pencarian dan menambahkannya ke query
        if (request('search')) {
            $query = $query->where('task', 'like', '%' . request('search') . '%');
        }

        // Mendapatkan hasil query dengan pagination
        $todos = $query->paginate(5); // set pagination dengan 5 items per page

        // Mengirimkan data ke view
        return view('todo.app', compact('todos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Membuat validasi inputan
        $request->validate(
            [
                'task' => 'required|min:3',
            ],
            [
                'task.required' => ':attribute wajib diisi.',
                'task.min' => ':attribute harus memiliki minimal :min karakter.',
            ]
        );

        $data = [
            'task'      => $request->input('task'),
            'is_done'   => false,
        ];

        Todo::create($data);
        return redirect('/todos')->with('success', 'Task berhasil disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Membuat validasi inputan
        $request->validate(
            [
                'task' => 'required|min:3',
            ],
            [
                'task.required' => ':attribute wajib diisi.',
                'task.min' => ':attribute harus memiliki minimal :min karakter.',
            ]
        );

        $data = [
            'task'      => $request->input('task'),
            'is_done'   => $request->input('is_done'),
        ];

        Todo::where('id', $id)->update($data);
        return redirect('/todos')->with('success', 'Task berhasil dirubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $todo = \App\Models\Todo::findOrFail($id);
        $todo->delete();
        return back()->with('success', 'Task berhasil dihapus!');
    }
}
