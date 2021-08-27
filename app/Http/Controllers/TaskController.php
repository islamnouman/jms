<?php

namespace App\Http\Controllers;


use App\Models\Jobs;
use App\Models\task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if (Auth::user()->hasRole('manager'))
        {

            $parent_job_id=Crypt::decrypt(Crypt::decrypt(array_keys($request->query())[0]));
            $tasks = task::all()->where('j_id',$parent_job_id);
            return view('tasklist', compact('tasks','parent_job_id'));


        }
        else if (Auth::user()->hasRole('officer'))
        {
            $crnt_usr_id=$request->user()->id;
            $mytasks = Jobs::join('tasks','jobs.id','=','tasks.j_id')
                ->where('tasks.t_a_u_id', $crnt_usr_id)
                ->get(['jobs.*','tasks.id as t_id','tasks.t_title','tasks.t_description']);

            return view('mytasklist', compact('mytasks'));
        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if (Auth::user()->hasRole('manager'))
        {
            $userlist = User::where('id', '!=', auth()->id())->get();
            $parent_job_id=Crypt::decrypt(Crypt::decrypt(array_keys($request->query())[0]));

            return view('storetask', compact('parent_job_id','userlist'));
        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasRole('manager'))
        {
            $rec_parent_job_id=Crypt::decrypt(Crypt::decrypt(array_keys($request->query())[0]));
            $parent_job_id=Crypt::encrypt(Crypt::encrypt($rec_parent_job_id));
            $parent_job_id_arr = array('j_id' => Crypt::decrypt(Crypt::decrypt(array_keys($request->query())[0])));
            $requestData = $request->validate([


                't_title' => 'required|max:255',
                't_description' => 'required|max:255',
                't_a_u_id' => 'required|max:255',
            ]);
            $storeData=array_merge($parent_job_id_arr,$requestData);


            task::create($storeData);
            return redirect()->route('task.index',[$parent_job_id])->with('completed', 'Task saved successfully!');

        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }
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

        if (Auth::user()->hasRole('manager'))
        {

            $userlist = User::where('id', '!=', auth()->id())->get();
            $tasks = task::find(Crypt::decrypt(Crypt::decrypt($id)));
            return view('edittask', compact('tasks','userlist'));
        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }






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
        if (Auth::user()->hasRole('manager'))
        {

            $requestData = $request->validate([
                't_title' => 'required|max:255',
                't_description' => 'required|max:255',
                't_a_u_id' => 'required|max:255',
            ]);
            task::whereId($id)->update($requestData);

            return redirect('job')->with('completed', 'Record has been updated');


        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (Auth::user()->hasRole('manager'))
        {

            $job = task::findOrFail(Crypt::decrypt(Crypt::decrypt($id)));
            $job->delete();


            return redirect('job')->with('completed', 'Task record has been deleted');
        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }
    }
}
