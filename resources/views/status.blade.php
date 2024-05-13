@extends('layout')
@section('content')
    <h1 class="mt-4"></h1>
    <div class="row">
        <div class="col-6">
            <h1 class="mb-4">Pets with Status: {{ $status }}</h1>
            @if (count($pets) > 0 || $pets == null)
                <ul class="list-group">
                    @foreach ($pets as $pet)
                        <li class="list-group-item">{{ $pet['name'] }} - Status: {{ $pet['status'] }}</li>
                    @endforeach
                </ul>
            @else
                <p>No pets found with status: {{ $status }}</p>
            @endif
        </div>
    </div>
@endsection
