@extends ('layouts.app')

@section('content')
    <div>
        <form action=" @if($task->exists) {{ route('tasks.update', ['id' => $task->id])}}@else{{ route('tasks.store', ['project' => $project->id]) }}@endif" method="POST">
            @if($task->exists)
                @method('PUT')
            @endif
            @csrf
            <label for="task_desc">Task</label>
            <input type="text" id="task_desc" name="task_desc" required value={{ old('task_desc', $task->task_desc)}}>

            <label for="status">Status</label>
            <select id="status" name="status">
                <option value="Pending" @selected(old('status', $task->status) == 'Pending')>Pending</option>
                <option value="In Progress" @selected(old('status', $task->status) == 'In Progress')>In Progress</option>
                <option value="Complete" @selected(old('status', $task->status) == 'Complete')>Complete</option>
            </select>



            <button type="submit">{{ $task->exists ? 'Save changes' : 'Create'}}</button>
        </form>
    </div>
@endsection
