<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\TodoList;
use App\Models\TodoItem;
use Illuminate\Http\Request;

class TodoListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('todo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('todo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $task = TodoList::create([
          'name' => $request->title,
          'user_id' => Auth::user()->id,
          'priority' => $request->priority ?? \Config::get('Option.priority.Low'),
          'status' => $request->status ?? \Config::get('Option.task_status.Active'),
        ]);

        foreach($request->t_title as $title){
          TodoItem::create([
            'text' => $title,
            'list_id' => $task->id,
            'status' => $request->status ?? \Config::get('Option.task_status.Active'),
          ]);
        }
        return redirect()->route('todo.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function show(TodoList $todoList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function edit(TodoList $todoList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, TodoList $todoList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\TodoList  $todoList
     * @return \Illuminate\Http\Response
     */
    public function destroy(TodoList $todoList)
    {
        //
    }

    public function addTaskBlock(Request $request){
      $temp = $request->temp++ ?? 1;
      return response()->json(['view' => view('todo.task',compact('temp'))->render()]);
    }
}
