@extends('welcome')

@section('content')
<div class="container">    
    <div class="row justify-content-center">
        <div class="md-8">
            <div class="card">
                <div class="card-header">Projects</div>
                <div class="card-body">
                <ul  class="list-group">
                        @foreach ($projects as $project)
                        <li class="list-group-item">
                            <a href="{{ route('projects.show', $project->id) }}">
                                {{ $project->name }}
                            </a>
                        </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div> 
    
</div>
@endsection