<?php

namespace App\Http\Controllers;

use App\Constants\PetConstants;
use App\Http\Requests\PetRequest;
use App\Services\PetService;
use Illuminate\Http\Request;

class PetController extends Controller
{
    private $petService;

    public function __construct(PetService $petService)
    {
        $this->petService = $petService;
    }

    public function index()
    {
        $pets = $this->petService->getAllPets();
        return view('index', compact('pets'));
    }

    public function searchPetsByStatus(Request $request)
    {
        $status = $request->input('status');
        $pets = $this->petService->getAllPets(); // Możesz dodać dodatkowy filtr po statusie
        return view('index', compact('pets'));
    }

    public function create()
    {
        $statuses = PetConstants::STATUSES;
        return view('add', compact('statuses'));
    }

    public function store(PetRequest $request)
    {
        $pet = $this->petService->createPet($request->validated());

        if (!$pet) {
            return redirect()->back()->with('error', 'Nie udało się dodać zwierzaka.');
        }

        return redirect()->route('showPet', ['id' => $pet['id']])->with('success', 'Zwierzaka dodano pomyślnie! 🐾');
    }

    public function show($id)
    {
        $pet = $this->petService->getPetById($id);

        if (!$pet) {
            return redirect()->back()->with('error', 'Zwierzaka nie znaleziono.');
        }

        return view('show', compact('pet'));
    }

    public function edit($id)
    {
        $pet = $this->petService->getPetById($id);
        $statuses = PetConstants::STATUSES;

        if (!$pet) {
            return redirect()->route('index')->with('error', 'Nie znaleziono zwierzaka.');
        }

        return view('edit', compact('pet', 'statuses'));
    }

    public function update(PetRequest $request)
    {
        $success = $this->petService->updatePet($request->validated());

        if (!$success) {
            return redirect()->back()->with('error', 'Nie udało się zaktualizować zwierzaka.');
        }

        return redirect()->route('showPet', ['id' => $request->validated()])->with('success', 'Zwierzaka zaktualizowano pomyślnie!');
    }

    public function destroy($id)
    {
        $success = $this->petService->deletePet($id);

        if (!$success) {
            return redirect()->back()->with('error', 'Nie udało się usunąć zwierzaka.');
        }

        return redirect()->route('index')->with('success', 'Zwierzaka usunięto pomyślnie.');
    }
}
