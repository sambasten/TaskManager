@extends('welcome')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            @if (session('success'))
                <div x-data="{show: true}" x-init="setTimeout(() => show = false, 2000)" x-show="show">
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                </div>
            @endif
            
            @if (session('error'))
                <div class="alert alert-danger mt-2">
                    {{ session('error') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header">Tasks</div>

                <div class="card-body">
                    <ul  class="list-group" id="task-group">
                        @foreach ($tasks as $task)
                        <li class="list-group-item" style="cursor: pointer;" itemid="{{ $task->id }}">
                            <a href="{{ route('tasks.edit', $task->id) }}">
                                {{ $task->name }}
                            </a>
                            <form action="{{ route('tasks.destroy', $task) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm float-right">Delete</button>
                            </form>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection