@extends('layouts.mainLayout')

@section('title')
    Dodacu kasnije title
@endsection

@section('content')
    <div class="flex flex-col items-center w-full">
        @foreach ($chapters as $chapter)
            <div class="mb-8 shadow-lg rounded-xl overflow-hidden bg-gray-800 w-full max-w-3xl">
                <img src="{{ asset('storage/' . $chapter->path_to_page) }}" alt="Page {{ $chapter->page_number }}"
                    class="w-full object-contain">
            </div>
        @endforeach
    </div>
@endsection
