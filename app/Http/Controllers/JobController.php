<?php

namespace App\Http\Controllers;

use App\Models\Jobs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class JobController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response|void
     */
    public function index()
    {
        if (Auth::user()->hasRole('manager'))
        {
            $jobs = Jobs::all();
            return view('joblist', compact('jobs'));

        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->hasRole('manager'))
        {
            return view('storejob');
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
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        if (Auth::user()->hasRole('manager'))
        {

            $requestData = $request->validate([


                'j_title' => 'required|max:255',
                'j_description' => 'required|max:255',
            ]);
            $userData=array ("user_id"=>$request->user()->id);
            $storeData=array_merge($userData,$requestData);



            Jobs::create($storeData);
            return redirect('job/create')->with('success', 'Saved successfully!');
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


            $job_with_id = Jobs::find(Crypt::decrypt(Crypt::decrypt($id)));
            return view('editjob', compact('job_with_id'));
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
            'j_title' => 'required|max:255',
            'j_description' => 'required|max:255',
            ]);
            $userData=array ("user_id"=>$request->user()->id);
            $storeData=array_merge($userData,$requestData);
            Jobs::whereId($id)->update($storeData);

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

            $job = jobs::findOrFail(Crypt::decrypt(Crypt::decrypt($id)));
            $job->delete();


            return redirect('job')->with('completed', 'Job record has been deleted');
        }
        else
        {
            return abort(403, 'Unauthorized action.');
        }
    }
}
