@extends ('layouts.app')

@section ('content')
    <div>

        {{ $project->project_id}}
        <form action="{{$project->exists ? route('projects.update', $project):route('projects.store')}}" method='POST'>
            @if($project->exists)
                @method('PUT')
            @endif
            @csrf

            <label id="project_title">Title</label>
            <input type="text" name="project_title" id="project_title" required  value="{{ old('project_title', $project->project_title)}}">

            <label id="description">Description</label>
            <input type="text" name="description" id="description" value="{{ old('description', $project->description)}}">

            <label id="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date" value="{{old('start_date', $project->start_date)}}">

            <label id="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date" value="{{ old('end_date', $project->end_date)}}">

            <label id="status" name="status">Status</label>
            <select id="status" name="status">
                <option value="Pending" @selected(old('status', $project->status) == 'Pending')>Pending</option>
                <option value="In Progress" @selected(old('status', $project->status) == 'In Progress')>In Progress</option>
                <option value="Complete" @selected(old('status', $project->status) == 'Complete')>Complete</option>
            </select>

            <button type="submit">"{{ $project->exists ? 'Save Changes' : 'Create Project'}}"</button>
        </form>
    </div>

@endsection
