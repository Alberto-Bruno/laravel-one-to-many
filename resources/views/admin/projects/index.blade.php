@extends('layouts.app')

@section('title', 'Project')

@section('content')
    <header class="d-flex align-items-center justify-content-between">
        <h1 class="my-5">Project</h1>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-success">
            <i class="fas fa-plus me-2"></i>
            New project
        </a>
    </header>

    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Title</th>
                <th scope="col">Slug</th>
                <th scope="col">Created</th>
                <th scope="col">Updated</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
            @forelse($projects as $project)
                <tr>
                    <th scope="row">{{ $project->id }}</th>
                    <td>{{ $project->title }}</td>
                    <td>{{ $project->slug }}</td>
                    <td>{{ $project->created_at }}</td>
                    <td>{{ $project->updated_at }}</td>
                    <td class="d-flex justify-content-end align-item-center">
                        <a href="{{ route('admin.projects.show', $project->id) }}" class="btn btn-small btn-primary">
                            <i class="fa-solid fa-eye"></i>
                        </a>

                        <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning ms-2 text-white">
                            <i class="fas fa-pencil me-2"></i>
                            Edit
                        </a>

                        <form action="PROJECT" action="{{ route('admin.projects.destroy', $project->id) }}"
                            class="delete-form" data-entity="project">
                            @csrf
                            @method('DELETE')
                            <button class="ms-2 btn btn-small btn-danger" type="submit">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <th scope="row" colspan="6" class="text-center">Non ci sono nuovi progetti</th>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection


@section('scripts')
    <script>
        // Prendo i Button dal Dom
        const deleteForms = document.querySelectorAll('.delete-form');
        deleteForms.forEach(form => {
            form.addEventListner('submit', e => {
                e.preventDefault();
                const entity = form.getAttribute('data-entity') || 'progetto'
                const hasConfirmed = confirm(`Sei sicuro di voler eliminare questo progetto ${entity}?`);
                if (hasConfirmed) form.submit();
            });
        });
    </script>
@endsection
