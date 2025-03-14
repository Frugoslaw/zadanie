@extends('layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4">➕ Dodaj Zwierzaka</h1>
        <div class="row">
            <div class="col-md-6">
                <form action="{{ route('storePet') }}" method="POST" id="addPetForm">
                    @csrf

                    {{-- Nazwa --}}
                    <div class="mb-3">
                        <label for="name" class="form-label fw-bold">🐶 Imię:</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>

                    {{-- Kategoria --}}
                    <div class="mb-3">
                        <label for="category_name" class="form-label fw-bold">📌 Kategoria:</label>
                        <input type="text" class="form-control" id="category_name" name="category_name"
                            placeholder="np. Pies, Kot" required>
                    </div>

                    {{-- Status --}}
                    <div class="mb-3">
                        <label for="status" class="form-label fw-bold">📋 Status:</label>
                        <select class="form-select" id="status" name="status" required>
                            @foreach ($statuses as $key => $label)
                                <option value="{{ $key }}">{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    {{-- Tagi --}}
                    <div class="mb-3">
                        <label for="tags" class="form-label fw-bold">🏷️ Tagi (oddzielone przecinkiem):</label>
                        <input type="text" class="form-control" id="tags" name="tags"
                            placeholder="np. mały, biały, energiczny">
                    </div>

                    {{-- Linki do zdjęć --}}
                    <div class="mb-3">
                        <label for="photoUrls" class="form-label fw-bold">🖼️ Zdjęcia (oddzielone przecinkiem):</label>
                        <textarea id="photoUrls" class="form-control" name="photoUrls" rows="3"
                            placeholder="Wklej linki, oddzielone przecinkiem"></textarea>
                    </div>

                    {{-- Przycisk wysyłania --}}
                    <button type="submit" class="btn btn-success">🚀 Dodaj Zwierzaka</button>
                </form>
            </div>
        </div>
    </div>
@endsection
