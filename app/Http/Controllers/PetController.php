<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    public function index()
    {
        $statuses = ['available', 'pending', 'sold'];
        $pets = [];

        foreach ($statuses as $status) {
            $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus', [
                'status' => $status
            ]);

            if ($response->successful()) {
                $pets = array_merge($pets, $response->json());
            }
        }
        // dd($pets);

        return view('index', compact('pets'));
    }

    public function searchPetsByStatus(Request $request)
    {
        $status = $request->input('status');

        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus', [
            'status' => $status
        ]);

        $pets = $response->successful() ? $response->json() : [];

        return view('index', compact('pets'));
    }

    public function searchPetById(Request $request)
    {
        $id = $request->input('id');

        $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");

        $pets = $response->successful() ? [$response->json()] : [];

        return view('index', compact('pets'));
    }



    public function create()
    {
        return view('add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required',
            'status' => 'required',
            'photoUrls' => 'required',
            'category_name' => 'required', // Dodajemy kategorię
            'tags' => 'nullable', // Tagi są opcjonalne
        ]);

        $photoUrls = explode(',', $validatedData['photoUrls']);
        $photoUrls = array_filter($photoUrls);

        // Tworzenie obiektu kategorii (API wymaga ID, ale możemy ustawić np. 0)
        $category = [
            'id' => 0,
            'name' => $validatedData['category_name'],
        ];

        // Tworzenie obiektu tagów, jeśli istnieją
        $tags = [];
        if (!empty($validatedData['tags'])) {
            $tagsArray = explode(',', $validatedData['tags']);
            foreach ($tagsArray as $tagName) {
                $tags[] = ['id' => 0, 'name' => trim($tagName)];
            }
        }

        $data = [
            'category' => $category,
            'name' => $validatedData['name'],
            'photoUrls' => $photoUrls,
            'tags' => $tags,
            'status' => $validatedData['status'],
        ];

        $response = Http::post('https://petstore.swagger.io/v2/pet', $data);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Nie udało się dodać zwierzaka. Spróbuj ponownie.');
        }

        $pet = $response->json();

        if (!isset($pet['id'])) {
            return redirect()->back()->with('error', 'Nie udało się pobrać ID nowego zwierzaka.');
        }

        return redirect()->route('showPet', $pet['id'])->with('success', "Zwierzaka dodano pomyślnie! 🐾");
    }



    public function show($id)
    {
        $response = Http::get('https://petstore.swagger.io/v2/pet/' . $id);
        if ($response->failed()) {
            return redirect()->back()->with('error', 'Pet not found');
        }
        $pet = $response->json();
        return view('show', compact('pet'));
    }

    public function searchByStatus(Request $request)
    {
        $status = $request->input('status');

        $response = Http::get('https://petstore.swagger.io/v2/pet/findByStatus', [
            'status' => $status
        ]);

        $pets = $response->json();
        // dd($pets);

        return view('status', compact('pets', 'status'));
    }

    public function edit($id)
    {
        $response = Http::get("https://petstore.swagger.io/v2/pet/{$id}");

        if ($response->failed()) {
            return redirect()->route('index')->with('error', 'Nie znaleziono zwierzaka.');
        }

        $pet = $response->json();

        return view('edit', compact('pet'));
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'status' => 'required',
            'photoUrls' => 'required',
        ]);

        $photoUrls = explode(',', $validatedData['photoUrls']);
        $photoUrls = array_filter($photoUrls);

        $response = Http::put('https://petstore.swagger.io/v2/pet', [
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'photoUrls' => $photoUrls,
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Nie udało się zaktualizować zwierzaka.');
        }

        return redirect()->route('showPet', $validatedData['id'])->with('success', 'Zwierzaka zaktualizowano pomyślnie!');
    }


    public function destroy($id)
    {
        $response = Http::delete('https://petstore.swagger.io/v2/pet/' . $id);

        if ($response->successful()) {
            return redirect()->route('index')->with('success', 'Pet deleted successfully');
        } else {
            return redirect()->back()->with('error', 'Failed to delete pet');
        }
    }
}
