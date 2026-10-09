@extends ('layouts.app')

@section('content')
    <div>
        <div>
            <p>Project: {{$project->project_title}}</p>

        </div>
        <div>
        <p>Description: {{$project->description}}</p>

        </div>
        <div>
            <p>Start date: {{$project->start_date}}</p>

        </div>
        <div>
            <p>End date: {{$project->end_date}}</p>

        </div>

        <div>
        <p>Status: {{$project->status}}</p>

        </div>

        <button type="button"><a href="{{route('projects.edit', $project)}}">Edit</a></button>
    </div>

@endsection
