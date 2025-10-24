<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">
    <h1>Create a New Post</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <!-- Name Field -->
        <div class="mb-3">
            <label for="name" class="form-label">Post Name</label>
            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}" required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Status Field -->
        <div class="mb-3">
            <label for="status" class="form-label">Post Status</label>
            <input type="text" name="status" id="status" class="form-control @error('status') is-invalid @enderror" value="{{ old('status') }}" required>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Comments ID Field (Optional) -->
        <div class="mb-3">
            <label for="comments_id" class="form-label">Comments ID (Optional)</label>
            <input type="number" name="comments_id" id="comments_id" class="form-control @error('comments_id') is-invalid @enderror" value="1">
            @error('comments_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Create Post</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
