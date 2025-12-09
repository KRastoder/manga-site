@extends('layouts.mainLayout')

@section('title')
    My mangas
@endsection

@section('content')
    @foreach ($mangas as $manga)
        <section>
            <h1> {{ $manga->title }}</h1>
            <p>{{$manga->description  }}</p>

            <form action="" method="get">
                <button>Add a chapter</button>
            </form>
        </section>
    @endforeach
@endsection
