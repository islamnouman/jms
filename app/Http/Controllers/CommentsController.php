<?php

namespace App\Http\Controllers;

use App\Models\comments;
use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class CommentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $crnt_usr_id=$request->user()->id;
        $task = Jobs::join('tasks','jobs.id','=','tasks.j_id')

            ->where('tasks.id',array_keys($request->query())[0])
            ->get(['jobs.*','tasks.id as t_id','tasks.t_title','tasks.t_description']);
        $comments = comments::join('users','users.id','=','Comments.c_u_id')
            ->where('comments.t_id',array_keys($request->query())[0])
            ->get(['comments.*','users.name as c_u_n','users.id as c_u_i']);
                return view('taskcomments', compact('task','comments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([

            't_id'=>'required|max:255',
            'comment'=>'required|max:255',
            'c_u_id'=>'required|max:255',

        ]);
        $task_id=$request->t_id;


        comments::create($requestData);
        return redirect()->route('comments.index',[$task_id])->with('completed', 'Comment saved successfully!');


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
