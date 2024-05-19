<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Task</title>
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container {
            padding-top: 20px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Edit Task</h2>
        <a href="{{ route('tasks.index') }}" type="button" class="btn btn-success mb-2">Back</a>

        <form action="{{ route('tasks.update', $task->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="editTitle">Title:</label>
                <input type="text" class="form-control" id="editTitle" name="title"
                    value="{{ old('title', $task->title) }}" required>
            </div>
            <div class="form-group">
                <label for="editDescription">Description:</label>
                <textarea class="form-control" id="editDescription" name="description" required>{{ old('description', $task->description) }}</textarea>
            </div>
            <div class="form-group">
                <label for="category_id">Category:</label>
                <select class="form-control" id="category_id" name="category_id" required>
                    <option value="">{{ optional($task->category)->name }}</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="editTaskStatus">Status:</label>
                <select class="form-control" id="editTaskStatus" name="status" required>
                    <option value="to-do" {{ old('status', $task->status) == 'to-do' ? 'selected' : '' }}>To-Do
                    </option>
                    <option value="in-progress" {{ old('status', $task->status) == 'in-progress' ? 'selected' : '' }}>In
                        Progress</option>
                    <option value="done" {{ old('status', $task->status) == 'done' ? 'selected' : '' }}>Done</option>
                </select>
            </div>
            <button type="submit" class="btn btn-success">Update Task</button>
            <a href="{{ route('tasks.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
