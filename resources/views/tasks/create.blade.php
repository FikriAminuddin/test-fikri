@extends('layouts.app') <!-- Extending the main app layout -->

@section('content') <!-- Starting a content section -->
<div class="container"> 
    <div class="row justify-content-center"> <!-- Centering the content -->
        <div class="col-md-8"> <!-- Creating a column for medium-sized screens -->
            <div class="card"> <!-- Creating a Bootstrap card -->
                <div class="card-header" href="{{ route('tasks.index')}}">ToDo List</div> <!-- Card header with a link -->

                <div class="card-body">

                @if ($errors->any()) <!-- Checking for validation errors -->
                    <div class="alert alert-danger"> <!-- Displaying validation errors -->
                        <ul>
                            @foreach ($errors->all() as $error) <!-- Looping through validation errors -->
                                <li>{{ $error }}</li> <!-- Displaying each error -->
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form method="post" action="{{ route('tasks.store') }}"> <!-- Creating a form -->
                    @csrf <!-- CSRF token for security -->
                <div class="mb-3">
                    <label class="form-label">Title</label> <!-- Label for the title input -->
                    <input type="text" name="title" class="form-control"> <!-- Text input for title -->
                </div>
                <div class="mb-3">
                    <label class="form-label">Description</label> <!-- Label for description input -->
                    <input name="description" class="form-control" cols="5" rows="5"> <!-- Textarea for description -->
                </div>  
                
                
                <button type="submit" class="btn btn-primary">Submit</button> <!-- Submit button -->
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection <!-- Ending the content section -->
