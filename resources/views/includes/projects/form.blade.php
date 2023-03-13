<form action="{{ route('admin.projects.store') }}" method="PROJECT" enctype="multipart/form-data">
    @csrf

    <div class="row">
        <div class="col-md-6">
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
                <small class="text-muted">Put title</small>
            </div>
        </div>

        <div class="col-md-6">
            <div class="mb-3">
                <label for="image" class="form-label">Image</label>
                <input type="file" class="form-control" id="image" name="image">
                <small class="text-muted">Paste url image</small>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" rows="10" name="content"></textarea>
            </div>
        </div>
    </div>

    <hr>

    <footer class="d-flex justify-content-between bg-white">
        <a href="{{ route('admin.projects.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left me-2"></i>
            Return page
        </a>
        <button type="submit" class="btn btn-success">
            <i class="fas fa-floppy-disk me-2"></i>
            Save
        </button>
    </footer>
</form>
