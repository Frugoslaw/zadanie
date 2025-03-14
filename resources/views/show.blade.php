@extends('layout')

@section('content')
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow-lg">
                    <div class="card-body">
                        <h2 class="card-title text-center">🐾 Szczegóły Zwierzaka</h2>
                        <hr>

                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>ID:</strong> {{ $pet['id'] }}</p>
                                <p><strong>Imię:</strong> {{ $pet['name'] }}</p>
                                <p><strong>Status:</strong>
                                    @if ($pet['status'] == 'available')
                                        <span class="badge bg-success">Dostępny</span>
                                    @elseif ($pet['status'] == 'pending')
                                        <span class="badge bg-warning">Oczekuje</span>
                                    @else
                                        <span class="badge bg-danger">Sprzedany</span>
                                    @endif
                                </p>
                                <p><strong>Kategoria:</strong> {{ $pet['category']['name'] ?? 'Brak kategorii' }}</p>

                                <p><strong>Tagi:</strong>
                                    @if (!empty($pet['tags']))
                                        @php
                                            $filteredTags = array_filter($pet['tags'], function ($tag) {
                                                return isset($tag['name']) && !empty($tag['name']);
                                            });
                                        @endphp

                                        @if (count($filteredTags) > 0)
                                            @foreach ($filteredTags as $tag)
                                                <span class="badge bg-secondary">{{ $tag['name'] }}</span>
                                            @endforeach
                                        @else
                                            <span class="text-muted fw-light">Brak tagów</span>
                                        @endif
                                    @else
                                        <span class="text-muted fw-light">Brak tagów</span>
                                    @endif
                                </p>
                            </div>

                            <div class="col-md-6">
                                @if (!empty($pet['photoUrls']) && count($pet['photoUrls']) > 0)
                                    <h5 class="text-center">📸 Zdjęcia</h5>
                                    <div id="carouselPetPhotos" class="carousel slide" data-bs-ride="carousel">
                                        <div class="carousel-inner">
                                            @foreach ($pet['photoUrls'] as $index => $photoUrl)
                                                <div class="carousel-item {{ $index == 0 ? 'active' : '' }}">
                                                    <img src="{{ $photoUrl }}" class="d-block w-100 rounded"
                                                        alt="Pet Image">
                                                </div>
                                            @endforeach
                                        </div>
                                        <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselPetPhotos" data-bs-slide="prev">
                                            <span class="carousel-control-prev-icon"></span>
                                        </button>
                                        <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselPetPhotos" data-bs-slide="next">
                                            <span class="carousel-control-next-icon"></span>
                                        </button>
                                    </div>
                                @else
                                    <p class="text-muted text-center">📷 Brak zdjęć</p>
                                @endif
                            </div>
                        </div>

                        <div class="text-center mt-4">
                            <a href="{{ route('index') }}" class="btn btn-primary">🔙 Powrót</a>
                            <form action="{{ route('deletePet', $pet['id']) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Na pewno chcesz usunąć?')">
                                    ❌ Usuń Zwierzaka
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
