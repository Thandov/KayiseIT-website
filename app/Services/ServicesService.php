<?php

// app/Services/ServicesService.php
namespace App\Services;

use App\Models\Service;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class ServicesService
{
    // Create a new service
    public function createService(array $data): Service
    {
        // Create a new service record
        return Service::create([
            'service_id' => $data['service_id'],
            'icon' => $data['icon'] ?? null,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'service_type' => $data['service_type'],
            'price' => $data['price'],
        ]);
    }

    // Get all services
    public function getAllServices(): Collection
    {
        // Return only the 'id', 'service_id', 'name', and 'slug' columns
        return Service::select('id', 'service_id', 'name', 'slug')->get();
    }

    
    // Get a service by its ID
    public function getServiceById(int $id): ?Service
    {
        // Find a service by ID
        return Service::find($id);
    }

    // Get a service by its slug
    public function getServiceBySlug(string $slug): ?Service
    {
        // Find a service by its slug
        return Service::where('slug', $slug)->first();
    }

    // Update a service
    public function updateService(int $id, array $data): bool
    {
        $service = $this->getServiceById($id);

        if (!$service) {
            return false;
        }

        // Update the service with the new data
        return $service->update([
            'service_id' => $data['service_id'],
            'icon' => $data['icon'] ?? null,
            'name' => $data['name'],
            'slug' => $data['slug'],
            'description' => $data['description'],
            'service_type' => $data['service_type'],
            'price' => $data['price'],
        ]);
    }

    // Delete a service
    public function deleteService(int $id): bool
    {
        $service = $this->getServiceById($id);

        if (!$service) {
            return false;
        }

        // Delete the service
        return $service->delete();
    }
}
