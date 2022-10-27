<?php

namespace App\Http\Controllers;

use App\Models\Todo;
use Illuminate\Http\Request;
use App\Models\Category;

class TodosController extends Controller
{
    // index para mostrar todos los toDos
    // store para guardar un toDo
    // update para actualizar un toDo
    // destroy para eliminar un toDO
    // edit para mostrar el formulario de edición

    public function store(Request $request){
        $request->validate([
            'title' => 'required|min:3'
        ]);

        $todo = new Todo();
        $todo->title = $request->title;
        $todo->category_id = $request->category_id;
        $todo->save();

        return \redirect()->route('todos')->with
        ('success', 'tarea creada correctamente');
    }

    public function index(){
        $todos = Todo::all();
        $categories = Category::all();
        return view('todos.index', ['todos' => $todos, 'categories' => $categories]);
    }

    public function show($id){
        $todo = Todo::find($id);
        return view('todos.show', ['todo' => $todo]);
    }

    public function update(Request $request, $id){
        $todo = Todo::find($id);
        $todo->title = $request->title;
        $todo->save();
        return redirect()->route('todos')->with('success', 'Tarea actualizada!');
    }

    public function destroy($id){
        $todo = Todo::find($id);
        $todo->delete();
        return redirect()->route('todos')->with('success', 'La tarea ha sido eliminada!');
    }
}
