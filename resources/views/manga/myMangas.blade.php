@extends('layouts.mainLayout')

@section('title')
    My mangas
@endsection

@section('content')
    @foreach ($mangas as $manga)
        <section>
            <h1>{{ $manga->title }}</h1>

            @foreach ($manga->chapters as $chapter)
                <a href="my-mangas/{{ $manga->id }}/{{ $chapter->chapter_number }}">Chapter {{ $chapter->chapter_number }}</a>
            @endforeach

            <form action="{{ route('chapter.create', [$manga->id]) }}" method="POST">
                @csrf
                <button>Add chapter</button>
            </form>

        </section>
    @endforeach
@endsection
