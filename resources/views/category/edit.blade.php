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
    <!-- Navbar -->

    <div class="container">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav">

                    <a class="nav-item nav-link active" href="{{ route('tasks.index') }}">Task</a>
                    <a class="nav-item nav-link" href="{{ route('categories.index') }}">Category</a>

                </div>
            </div>
        </nav>
    </div>
    <!-- Navbar -->

    <div class="container">
        <h2>Edit Category</h2>
        <a href="{{ route('categories.index') }}" type="button" class="btn btn-success mb-2">Back</a>

        <form action="{{ route('categories.update', $category->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="editCategory">Category:</label>
                <input type="name" class="form-control" id="editCategory" name="name"
                    value="{{ old('name', $category->name) }}" required>
            </div>
            <button type="submit" class="btn btn-success">Update Category</button>
            <a href="{{ route('categories.index') }}" class="btn btn-secondary">Cancel</a>
        </form>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
