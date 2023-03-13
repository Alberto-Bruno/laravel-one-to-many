@if (session('msg'))
    <div class="alert alert-{{ session('type' ?? 'info') }} mt-3">
        {{ session('msg') }}
    </div>
@endif
