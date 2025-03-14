<html>

<head>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
            line-height: 1.6;
            background-color: #f4f4f4;
        }

        .container {
            max-width: 900px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h1,
        h2 {
            color: #333;
        }

        code {
            background: #eee;
            padding: 2px 5px;
            border-radius: 4px;
        }

        pre {
            background: #222;
            color: #fff;
            padding: 10px;
            border-radius: 4px;
            overflow-x: auto;
        }

        ul {
            list-style: square;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1>🐾 PetStore Laravel API Integration</h1>
        <p><strong>PetStore Laravel API Integration</strong> to aplikacja umożliwiająca zarządzanie zwierzętami poprzez
            integrację z <a href="https://petstore.swagger.io/" target="_blank">Swagger PetStore API</a>. Umożliwia
            dodawanie, edytowanie, usuwanie oraz wyświetlanie zwierzaków.</p>
        <h2>📌 Instalacja</h2>
        <p>Uruchom poniższe polecenia, aby skonfigurować projekt:</p>
        <pre><code>git clone https://github.com/twoj-repo/petstore-laravel.git
cd petstore-laravel
composer install
cp .env.example .env
php artisan key:generate
php artisan serve</code></pre>

        <h2>🛠 Wymagania</h2>
        <ul>
            <li>PHP 8.0+</li>
            <li>Laravel 9+</li>
            <li>Composer</li>
            <li>Internet (do komunikacji z API)</li>
        </ul>

        <h2>📂 Struktura projektu</h2>
        <ul>
            <li><strong>app/Http/Controllers/PetController.php</strong> - zarządzanie żądaniami</li>
            <li><strong>app/Services/PetService.php</strong> - logika API</li>
            <li><strong>app/Http/Requests/PetRequest.php</strong> - walidacja</li>
            <li><strong>app/Constants/PetConstants.php</strong> - stałe (URL API, statusy)</li>
            <li><strong>resources/views/</strong> - widoki</li>
            <li><strong>routes/web.php</strong> - routing aplikacji</li>
        </ul>

        <h2>💡 SOLID & Refaktoryzacja</h2>
        <ul>
            <li><strong>Single Responsibility Principle (SRP)</strong>: Walidacja, obsługa API i kontrolery są
                oddzielone.</li>
            <li><strong>Open/Closed Principle (OCP)</strong>: Można łatwo dodać nowe metody API.</li>
            <li><strong>Dependency Inversion Principle (DIP)</strong>: Wstrzykiwanie `PetService` w kontrolerze.</li>
        </ul>

        <h2>🔄 API Endpoints</h2>
        <ul>
            <li><code>GET /pets</code> - lista zwierząt</li>
            <li><code>POST /pets</code> - dodanie zwierzaka</li>
            <li><code>GET /pets/{id}</code> - szczegóły zwierzaka</li>
            <li><code>PUT /pets/update</code> - edycja zwierzaka</li>
            <li><code>DELETE /pets/{id}</code> - usunięcie zwierzaka</li>
        </ul>

        <h2>🌍 Routing</h2>
        <pre><code>
Route::prefix('pets')->name('pets.')->group(function () {
    Route::get('/', [PetController::class, 'create'])->name('create');
    Route::post('/', [PetController::class, 'store'])->name('store');
    Route::get('/{id}', [PetController::class, 'show'])->name('show');
    Route::get('/edit/{id}', [PetController::class, 'edit'])->name('edit');
    Route::put('/update', [PetController::class, 'update'])->name('update');
    Route::delete('/{id}', [PetController::class, 'destroy'])->name('destroy');
});
        </code></pre>

        <h2>🎨 Widoki</h2>
        <ul>
            <li><strong>index.blade.php</strong> - lista zwierząt</li>
            <li><strong>add.blade.php</strong> - dodawanie nowego zwierzaka</li>
            <li><strong>edit.blade.php</strong> - edycja zwierzaka</li>
            <li><strong>show.blade.php</strong> - szczegóły zwierzaka</li>
        </ul>

        <h2>🚀 Przykładowe użycie</h2>
        <p>Dodanie nowego zwierzaka:</p>
        <pre><code>
POST /pets
Content-Type: application/json
{
    "name": "Rex",
    "status": "available",
    "photoUrls": ["https://example.com/rex.jpg"],
    "category_name": "Pies",
    "tags": "duży, energiczny"
}
        </code></pre>

        <h2>📜 Licencja</h2>
        <p>Projekt dostępny na licencji MIT.</p>

        <h2>👨‍💻 Autor</h2>
        <p>Twórca: <strong>Twoje Imię</strong> | <a href="https://github.com/twoj-github" target="_blank">GitHub</a></p>
    </div>
</body>

</html>
