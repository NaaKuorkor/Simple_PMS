@extends ('layouts.app')

@section ('content')
    <div>
        <form>
            @csrf

            <label id="project_title">Title</label>
            <input type="text" name="project_id" id="project_id" required >

            <label id="description">Description</label>
            <input type="text" name="description" id="description">

            <label id="start_date">Start Date</label>
            <input type="date" name="start_date" id="start_date">

            <label id="end_date">End Date</label>
            <input type="date" name="end_date" id="end_date">

            <label id="status">Status</label>
            <select id="status">
                <option value="Pending">Pending</option>
                <option value="In Progress">In Progress</option>
                <option value="Complete">Complete</option>
            </select>

            <button type="submit">Create Project</button>
        </form>
    </div>

@endsection
