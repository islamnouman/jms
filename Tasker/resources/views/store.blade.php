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

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div><br />
                    @endif

                    @if(session()->get('success'))
                        <div class="alert alert-success">
                            {{ session()->get('success') }}
                        </div><br />
                    @endif
                        <nav class="navbar navbar-expand-lg navbar-light bg-light">


                            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                                <div class="navbar-nav">
                                    <a class="nav-item nav-link " href="{{ url('/home') }}">Home </a>
                                    <a class="nav-item nav-link active" href="#">Create A Task <span class="sr-only">(current)</span></a>


                                </div>
                            </div>
                        </nav>






                        <form method="post" action="{{ route('task.store') }}" >
                            @csrf
                            <div class="form-group">
                                <label for="inputTitle">Title</label>
                                <input type="text" class="form-control" id="inputTitle" aria-describedby="taskTitleHelp" placeholder="Title" name="task_title">

                            </div>
                            <div class="form-group">
                                <label for="inputDetail">Details</label>
                                <input type="text" class="form-control" id="inputDetail" placeholder="Detail" name="task_detail">
                            </div>

                            <button type="submit" class="btn btn-primary">Post</button>
                        </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
