<?php
// app/Services/SubServicesService.php

namespace App\Services;

use App\Models\Subservice;
use App\Models\Service;
use App\Helpers\UploadHelper;

class SubServicesService
{
    /**
     * Store a new subservice
     *
     * @param  \Illuminate\Http\Request $requestData
     * @param  string $serviceSlug
     * @return \App\Models\Subservice
     */
    public function storeSubservice($requestData, $serviceSlug)
    {
        $name = $requestData->name;

        // Handle profile picture upload
        if ($requestData->hasFile('profile_picture')) {
            $profilePicture = $requestData->file('profile_picture');
            $path = 'images/subservices/'; // Desired upload path

            try {
                $profilePicturePath = UploadHelper::uploadProfilePicture($profilePicture, $path, $name);
            } catch (\Exception $e) {
                return redirect()->back()->withErrors(['profile_picture' => $e->getMessage()]);
            }
        } else {
            $profilePicturePath = null; // Default to null if no file uploaded
        }

        // Create the Subservice record
        $subService = new Subservice();
        $subService->service_id = $serviceSlug;
        $subService->name = $name;
        $subService->slug = strtolower(str_replace(" ", "_", $name));
        $subService->icon = $profilePicturePath;
        $subService->subservice_type = $requestData->subservice_type;
        $subService->price = $requestData->price;

        // Generate unique subservice ID
        do {
            $subservIdNumber = mt_rand(0, 999);
            $subService->subserv_id = 'subserv' . $subservIdNumber;
        } while (Subservice::where('subserv_id', $subService->subserv_id)->exists());

        $subService->save();

        return $subService;
    }

    /**
     * Find a service by its ID
     *
     * @param  int $serviceId
     * @return \App\Models\Service|null
     */
    public function findService($serviceId)
    {
        return Service::where('service_id', $serviceId)->first();
    }

    /**
     * Find a subservice by service ID
     *
     * @param  int $serviceId
     * @return \App\Models\Subservice|null
     */
    public function findSubService($serviceId)
    {
        return Subservice::where('service_id', $serviceId)->first();
    }
}
