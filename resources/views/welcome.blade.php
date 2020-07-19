@extends('layouts.app')

@section('content')

<div class="w-100 h-100 d-flex justify-content-center align-items-center">
    <div style="width:40%" class="text-center">
        <h1 class="display-2 text-white">Todo - App</h1>
        <h2 class="text-white pt-5">Made by Afolabi Abiodun</h2>
        <form action="{{route('todo.store')}}" method="POST" autocomplete="off">
                @csrf
                
                @if(session()-> has('message'))
        
                    <div class="alert alert-success alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{session()->get('message')}}
                    </div>

                @endif

                @if(session()-> has('edited'))
        
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{session()->get('edited')}}
                    </div>

                @endif

                @if(session()-> has('deleted'))
        
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        {{session()->get('deleted')}}
                    </div>

                @endif

                @if ($errors->any())
                    <div class="alert alert-danger alert-dismissible">
                        <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                        
                            @foreach($errors->all() as $error)
                                {{$error}}

                            @endforeach
                        
                    </div>
                @endif
            
                <div class="input-group w-100 mb-3">
                <input type="text" class="form-control form-control-lg" name="name" placeholder="Enter Task...." aria-describedby="button-addon2">

                <div class="input-group-append">
                    <button class="btn btn-success" type="submit">Add</button>
                </div>
            </div>
        </form>

        <h2 class="text-white">My Tasks:</h2>
        <div class="bg-white w-100">
            @forelse($todos as $todo)
            <div class="w-100 d-flex align-items-center justify-content-between">
                <div class="p-2">
                    @if ($todo->completed == 0)
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-chevron-right" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF5722" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <polyline points="9 6 15 12 9 18" />
                        </svg>
                    @else

                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-check" width="44" height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#009688" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z"/>
                        <path d="M5 12l5 5l10 -10" />
                        </svg>

                    @endif

                    

                    {{$todo->name}}
                    
                </div>
                <div class="mr-4 d-flex align-items-center" >
                    @if($todo->completed == 0)
                    <form action="{{route('todo.update', $todo->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="text" name="completed" value="1" hidden>
                    <button class="btn btn-success btn-sm" type="submit">Mark As Done</button>
                    
                    </form>

                    @else

                    <form action="{{route('todo.update', $todo->id)}}" method="POST">
                        @method('PUT')
                        @csrf
                        <input type="text" name="completed" value="0" hidden>
                    <button class="btn btn-warning btn-sm" type="submit">Mark As Uncompleted</button>
                    
                    </form>

                    @endif

                <form action="{{route('todo.destroy', $todo->id)}}" method="POST">
                @method('DELETE')
                @csrf
                <button type="submit" class="btn btn-danger btn-sm ml-2">X</button>
                
                </form>

            <a href="{{route('todo.edit', $todo->id)}}">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit ml-2" width="24" height="24" viewBox="0 0 24 24" stroke-width="1.5" stroke="#FF5722" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z"/>
                    <path d="M9 7 h-3a2 2 0 0 0 -2 2v9a2 2 0 0 0 2 2h9a2 2 0 0 0 2 -2v-3" />
                    <path d="M9 15h3l8.5 -8.5a1.5 1.5 0 0 0 -3 -3l-8.5 8.5v3" />
                    <line x1="16" y1="5" x2="19" y2="8" />
                    </svg>
            </a>

                    
                </div>
            </div>
            
            @empty

            No Task 
            @endforelse
        </div>
    </div>
    
</div>
    
@endsection