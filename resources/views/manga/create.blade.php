@extends('layouts.mainLayout')

@section('title')
    Create manga
@endsection

@section('content')
    <form action = "{{ route('manga.create') }}" method = "POST">
        @csrf
        <label for="title">Title</label>
        <input type="text" name="title">

        <label for="description">Description</label>
        <input type="textarea" name="description">
        <button>Create manga</button>
    </form>
@endsection
