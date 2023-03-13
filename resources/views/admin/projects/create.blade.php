@extends('layouts.app')

@section('title', 'Crea nuovo progetto')

@section('content')
    <header>
        <h1>Created Project</h1>
    </header>

    <hr>

    @include('includes.projects.form')

@endsection
