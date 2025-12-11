@extends('layouts.mainLayout')

@section('title')
    Add pages to chapter
@endsection

@section('content')
    <p>Be sure to upload in order if you do many at once</p>
    <form action="{{ route('chapters.uploadPages', [$manga_id, $chapter_id]) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="hidden" name = 'manga_id' value="{{ $manga_id }}">
        <input type="hidden" name = 'chapter_id' value="{{ $chapter_id }}">
        <label for="pages">Upload Pages (multiple images)</label>
        <input type="file" name="pages[]" id="pages" accept="image/*" multiple required>

        <button type="submit">Upload</button>
    </form>
@endsection
