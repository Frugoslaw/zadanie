@extends('layout')
@section('content')
    <h1 class="mt-4"></h1>
    <div class="row">
        <div class="col-6">
            <h1 class="mb-4">Edit Pet</h1>
            <form action="{{ route('updatePet') }}" method="POST" id="addPetForm">
                @method('PUT')
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Id:</label>
                    <input type="number" class="form-control" id="id" name="id" required>
                </div>
                <div class="mb-3">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3">
                    <label for="status" class="form-label">Status:</label>
                    <input type="text" class="form-control" id="status" name="status" required>
                </div>
                <button type="submit" class="btn btn-warning">Edytuj</button>
            </form>
        </div>
    </div>
@endsection
