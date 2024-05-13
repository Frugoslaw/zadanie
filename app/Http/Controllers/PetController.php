<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    public function index()
    {
        return view('search');
    }

    public function create()
    {
        return view('add');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'status' => 'required',
            'photoUrls' => 'required',
        ]);

        $photoUrls = explode(',', $validatedData['photoUrls']);

        $photoUrls = array_filter($photoUrls);

        $data = [
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'photoUrls' => $photoUrls,
        ];

        Http::post('https://petstore.swagger.io/v2/pet', $data);

        return redirect()->route('showPet', $data['id'])->with('success', "Pet added!");
    }



    public function searchPetById(Request $request)
    {
        return redirect()->route('showPet', $request->id);
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

    public function edit()
    {
        return view('edit');
    }

    public function update(Request $request)
    {
        $validatedData = $request->validate([
            'id' => 'required',
            'name' => 'required',
            'status' => 'required',
            'photoUrls' => 'required',
        ]);

        // Podzielanie wprowadzonego ciągu URL-i na tablicę
        $photoUrls = explode(',', $validatedData['photoUrls']);

        $photoUrls = array_filter($photoUrls);

        $response = Http::put('https://petstore.swagger.io/v2/pet/', [
            'id' => $validatedData['id'],
            'name' => $validatedData['name'],
            'status' => $validatedData['status'],
            'photoUrls' => $photoUrls,
        ]);

        if ($response->failed()) {
            return redirect()->back()->with('error', 'Failed to update pet');
        }

        return redirect()->route('showPet', $validatedData['id'])->with('success', 'Pet updated successfully');
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
