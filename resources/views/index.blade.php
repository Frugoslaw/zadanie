@extends('layout')

@section('content')
    <div class="container mt-4">
        <h1 class="mb-4 text-center">🐾 Lista Zwierzaków 🐾</h1>

        {{-- Przycisk dodawania --}}
        <div class="d-flex justify-content-between align-items-center mb-3">
            <a href="{{ route('addPet') }}" class="btn btn-success">➕ Dodaj nowego zwierzaka</a>
        </div>

        <div class="card shadow-sm p-4">
            <h4 class="mb-3">📋 Pełna lista zwierzaków</h4>

            {{-- Select do filtrowania po statusie --}}
            <div class="row mb-3">
                <div class="col-md-4">
                    <label for="filterStatus" class="form-label fw-bold">📌 Filtruj po statusie:</label>
                    <select id="filterStatus" class="form-select">
                        <option value="">Wszystkie</option>
                        <option value="Dostępny">Dostępny</option>
                        <option value="Oczekuje">Oczekuje</option>
                        <option value="Sprzedany">Sprzedany</option>
                    </select>
                </div>
            </div>

            <div class="table-responsive">
                <table id="petsTable" class="table table-striped table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th>ID</th>
                            <th>Imię</th>
                            <th>Status</th>
                            <th>Zdjęcia</th>
                            <th>Pokaż</th>
                            <th>Edytuj</th>
                            <th>Usuń</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($pets as $pet)
                            <tr>
                                <td>{{ $pet['id'] }}</td>
                                <td>{{ $pet['name'] ?? 'Brak nazwy' }}</td>
                                <td class="status-column">
                                    @if ($pet['status'] == 'available')
                                        <span class="badge bg-success">Dostępny</span>
                                    @elseif ($pet['status'] == 'pending')
                                        <span class="badge bg-warning">Oczekuje</span>
                                    @else
                                        <span class="badge bg-danger">Sprzedany</span>
                                    @endif
                                </td>
                                <td>
                                    @if (!empty($pet['photoUrls']))
                                        @foreach ($pet['photoUrls'] as $url)
                                            <img src="{{ $url }}" alt="Pet image" class="img-thumbnail"
                                                width="70">
                                        @endforeach
                                    @else
                                        Brak zdjęcia
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('showPet', ['id' => $pet['id']]) }}" class="btn btn-info btn-sm">
                                        👁️ Pokaż
                                    </a>
                                </td>
                                <td>
                                    <a href="{{ route('editPet', ['id' => $pet['id']]) }}" class="btn btn-warning btn-sm">✏️
                                        Edytuj</a>
                                </td>
                                <td>
                                    <form action="{{ route('deletePet', ['id' => $pet['id']]) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('Na pewno chcesz usunąć?')">
                                            ❌ Usuń
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>

    <script>
        $(document).ready(function() {
            let table = $('#petsTable').DataTable({
                "language": {
                    "lengthMenu": "Pokaż _MENU_ rekordów na stronę",
                    "zeroRecords": "Nic nie znaleziono",
                    "info": "Strona _PAGE_ z _PAGES_",
                    "infoEmpty": "Brak dostępnych rekordów",
                    "infoFiltered": "(przefiltrowano z _MAX_ rekordów)",
                    "search": "Szukaj:",
                    "paginate": {
                        "first": "Pierwsza",
                        "last": "Ostatnia",
                        "next": "Następna",
                        "previous": "Poprzednia"
                    }
                }
            });

            // Filtrowanie po statusie
            $('#filterStatus').on('change', function() {
                let status = $(this).val();
                if (status) {
                    table.column(2).search(status, true, false).draw();
                } else {
                    table.column(2).search("").draw();
                }
            });
        });
    </script>
@endsection
