@extends('layout')
@section('content')
    <h1 class="mt-4"></h1>
    <div class="row">
        <div class="col-6">
            <h1 class="mb-4">Show Pet</h1>
            <h5 class="card-title">Name: {{ $pet['name'] }}</h5>
            <p class="card-text">ID: {{ $pet['id'] }}</p>
            <p class="card-text">Status: {{ $pet['status'] }}</p>
            <form action="{{ route('delete', $pet['id']) }}" method="POST">
                @csrf
                @method('delete')
                <button class="btn btn-danger">Delete</button>
            </form>
        </div>
    </div>
@endsection
