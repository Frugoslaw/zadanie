<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use App\Constants\PetConstants;

class PetService
{
    private $apiUrl;

    public function __construct()
    {
        $this->apiUrl = PetConstants::API_URL;
    }

    public function getAllPets()
    {
        $pets = [];

        foreach (array_keys(PetConstants::STATUSES) as $status) {
            $response = Http::get("{$this->apiUrl}/findByStatus", ['status' => $status]);

            if ($response->successful()) {
                $pets = array_merge($pets, $response->json());
            }
        }

        return $pets;
    }

    public function getPetById($id)
    {
        $response = Http::get("{$this->apiUrl}/{$id}");

        return $response->successful() ? $response->json() : null;
    }

    public function createPet($data)
    {
        $formattedData = $this->formatPetData($data);
        $response = Http::post($this->apiUrl, $formattedData);

        return $response->successful() ? $response->json() : null;
    }

    public function updatePet($data)
    {
        $formattedData = $this->formatPetData($data);
        $response = Http::put($this->apiUrl, $formattedData);

        return $response->successful();
    }

    public function deletePet($id)
    {
        $response = Http::delete("{$this->apiUrl}/{$id}");

        return $response->successful();
    }

    private function formatPetData($data)
    {
        return [
            'id' => $data['id'] ?? null,
            'name' => $data['name'],
            'status' => $data['status'],
            'photoUrls' => explode(',', $data['photoUrls']),
            'category' => [
                'id' => 0,
                'name' => $data['category_name'] ?? 'Unknown',
            ],
            'tags' => !empty($data['tags']) ? array_map(fn($tag) => ['id' => 0, 'name' => trim($tag)], explode(',', $data['tags'])) : [],
        ];
    }
}
