@extends ('layouts.app')

@section('content')
    <div>
        <form>
            @csrf
            <label id="task_desc">Task</label>
            <input type="text" id="task_desc" name="task_desc" required>

            <label id="status">Status</label>
            <input type="text" id="status" name="status">

            <button type="submit">Create</button>
        </form>
    </div>
@endsection
