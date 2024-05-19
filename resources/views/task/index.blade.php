<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task List</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            padding-top: 20px;
        }

        .table-hover tbody tr:hover {
            background-color: #f5f5f5;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Task List</h2>
        <button type="button" class="btn btn-success mb-2" data-toggle="modal" data-target="#createTaskModal">
            Create Task
        </button>

        <div class="row">
            <div class="col-md-12">
                <table class="table table-bordered table-hover">
                    <thead class="thead-dark">
                        <tr>
                            <th>Task ID</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Status</th>
                            <th>Created At</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $task->title }}</td>
                                <td>{{ $task->description }}</td>
                                <td>{{ $task->status }}</td>
                                <td>{{ $task->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a href="{{ route('tasks.edit', $task->id) }}"
                                        class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-danger btn-sm">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center">No tasks available</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Create Task Modal -->
        <div class="modal fade" id="createTaskModal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title">Create New Task</h4>
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('tasks.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title:</label>
                                <input type="text" class="form-control" id="title" name="title"
                                    value="{{ old('title') }}" placeholder="Enter title" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description:</label>
                                <textarea class="form-control" id="description" name="description" placeholder="Enter description" required>{{ old('description') }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="taskStatus">Status:</label>
                                <select class="form-control" id="taskStatus" name="status" required>
                                    <option>Select Status</option>
                                    <option value="to-do">To-Do</option>
                                    <option value="in-progress">In Progress</option>
                                    <option value="done">Done</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-success">Create Task</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
