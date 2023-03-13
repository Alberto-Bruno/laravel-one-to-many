@extends('layouts.app')

@section('title', $project->title)

@section('content')
    <header>
        <h1 class="my-5">{{ $project->title }}</h1>
    </header>
    <div class="clearfix">
        @if ($project->image)
            <img class="me-2 float-start" src="{{ $project->image }}" alt="{{ $project->slug }}">
        @endif
        <p>{{ $project->content }}</p>
        <div>
            <strong>Creato il:</strong>
            <p>{{ $project->created_at }}</p>
            <strong>Ultima modifica:</strong>
            <p>{{ $project->updated_at }}</p>
        </div>
        <div class="d-flex justify-content-end">

            <a href="{{ route('admin.projects.edit', $project->id) }}" class="btn btn-warning me-2 text-white">
                <i class="fas fa-pencil me-2"></i>
                Edit
            </a>

            <form action="PROJECT" action="{{ route('admin.projects.destroy', $project->id) }}" class="delete-form"
                data-entity="project">
                @csrf
                @method('DELETE')
                <button class="me-2 btn btn-danger" type="submit">
                    <i class="fa-solid fa-trash"></i>
                    Delete
                </button>
            </form>

            <a class="btn btn-secondary" href="{{ route('admin.projects.index') }}">
                <i class="fa-solid fa-arrow-left me-2"></i>
                Return page
            </a>
        </div>
    </div>
@endsection
