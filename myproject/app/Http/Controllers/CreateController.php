<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function index()
    {
        return view('create');
    }
    public function storedata(Request $request)
    {

    dd(
        $request->input('jtitle'),
        $request->all(),
        $request->get('jtitle'),
        $request->post('jdetail')
    );

    dd($request->all());

    dd($request->get('jtitle'));

    dd($request->post('jdetail'));

    dd($request->all());



    }
}
