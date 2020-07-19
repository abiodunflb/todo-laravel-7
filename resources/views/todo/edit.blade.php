@extends('layouts.app')

@section('content')

<div class="w-100 h-100 d-flex justify-content-center align-items-center">
    <div style="width:40%" class="text-center">
        <h1 class="display-4 text-white">Edit Task</h1>
        <form action="{{route('todo.update', $todo->id)}}" method="POST" autocomplete="off">
                @csrf
                @method('PUT')
                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        
                            @foreach($errors->all() as $error)
                                {{$error}}

                            @endforeach
                        
                    </div>
                @endif
            
                <div class="input-group w-100 mb-3">
                <input type="text" class="form-control form-control-lg" value="{{$todo->name}}" name="name">

                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Edit</button>
                </div>
            </div>
        </form>

        
    </div>
    
</div>
    
@endsection