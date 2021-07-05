@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center"  >{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">




                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    <a class="nav-item nav-link active" href="#">Home <span class="sr-only">(current)</span></a>
                                    <a class="nav-item nav-link" href="{{ route('task.index') }}">Create A Task</a>


                                </div>
                            </div>
                        </nav>




                        <div class="text-center">

                        <!--this line is alternative of start and end tag of php with echo 'You are logged in! inside' -->

                            {{ __('You are logged in!') }}



                        </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
