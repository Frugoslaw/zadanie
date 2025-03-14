@extends('layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">✏️ Edytuj Zwierzaka</h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form action="{{ route('updatePet') }}" method="POST">
                    @csrf
                    @method('PUT')

                    {{-- ID (readonly, bo API wymaga, ale użytkownik nie powinien edytować) --}}
                    <div class="mb-3">
                        <label for="id" class="form-label fw-bold">🔢 ID:</label>
                        <input type="number" class="form-control" id="id" name="id" value="{{ $pet['id'] }}"
                            readonly>
                    </div>

                    {{-- Imię --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">🐶 Imię:</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $pet['name'] }}"
                            required>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">📋 Status:</label>
                        <select class="form-select" id="status" name="status" required>
                            <option value="available" {{ $pet['status'] == 'available' ? 'selected' : '' }}>Dostępny
                            </option>
                            <option value="pending" {{ $pet['status'] == 'pending' ? 'selected' : '' }}>Oczekuje</option>
                            <option value="sold" {{ $pet['status'] == 'sold' ? 'selected' : '' }}>Sprzedany</option>
                        </select>
                    </div>

                    {{-- Linki do zdjęć --}}
                    <div class="mb-3">
                        <label for="photoUrls" class="form-label fw-bold">🖼️ Zdjęcia (oddzielone przecinkiem):</label>
                        <textarea id="photoUrls" class="form-control" name="photoUrls" rows="3" required>{{ implode(',', $pet['photoUrls']) }}</textarea>
                    </div>

                    {{-- Przycisk wysyłania --}}
                    <button type="submit" class="btn btn-warning w-100">🔄 Zapisz zmiany</button>
                </form>
            </div>
        </div>
    </div>
@endsection
