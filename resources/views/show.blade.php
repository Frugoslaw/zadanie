@extends('layout')
@section('content')
    <h1 class="mt-4"></h1>
    <div class="row">
        <div class="col-6">
            <h1>Pet Details</h1>
            <p>ID: {{ $pet['id'] }}</p>
            <p>Name: {{ $pet['name'] }}</p>
            <p>Status: {{ $pet['status'] }}</p>
            <!-- Wyświetlenie zdjęć -->
            @if (!empty($pet['photoUrls']))
                <h2>Photos</h2>
                @foreach ($pet['photoUrls'] as $photoUrl)
                    <img src="{{ $photoUrl }}" alt="Pet Image">
                @endforeach
            @endif
        </div>
    </div>
@endsection
