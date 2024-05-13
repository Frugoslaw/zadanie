@extends('layout')
@section('content')
    <h1 class="mt-4"></h1>
    <div class="row">
        <div class="col-6">
            <h1 class="mb-4">Search pet on status</h1>
            <form action="{{ route('searchPetsByStatus') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Status:</label>
                    <input type="text" class="form-control" id="status" name="status" required>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
        <div class="col-6">
            <h1 class="mb-4">Search pet on ID</h1>
            <form action="{{ route('searchPetById') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Id:</label>
                    <input type="number" class="form-control" id="status" name="id" required>
                </div>
                <button type="submit" class="btn btn-primary">Search</button>
            </form>
        </div>
    </div>
@endsection
