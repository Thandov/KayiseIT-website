<?php

// app/Services/SubServicesService.php

namespace App\Services;

use App\Models\Subservice;
use App\Models\Service;
use App\Helpers\UploadHelper;


class SubServicesService
{
    public function storeSubservice($requestData, $serviceId)
    {
        $name = $requestData->name;
        if ($requestData->hasFile('profile_picture') && !empty($requestData->hasFile('profile_picture'))) {
            $profilePicture = $requestData->file('profile_picture');
            $path = 'images/subservices/'; // Set the desired path dynamically here

            try {
                $profilePicturePath = UploadHelper::uploadProfilePicture($profilePicture, $path, $name);
            } catch (\Exception $e) {
                // Handle the exception here
                dd("error");
                return redirect()->back()->withErrors(['profile_picture' => $e->getMessage()]);
            }

            // Do something with the $profilePicturePath, like saving it to the database, etc.
        } else {
            $profilePicturePath = "null";
        }

        $subService = new Subservice();
        $subService->service_id = $serviceId;
        $subService->name = $requestData->name;
        $subService->icon = $profilePicturePath;
        $subService->subservice_type = $requestData->subservice_type;
        $subService->price = $requestData->price;
        // Generate a random 8-digit number and prepend it with "subserv_id"
        do {
            $subservIdNumber = mt_rand(0, 999);
            $subService->subserv_id = 'subserv' . $subservIdNumber;
        } while (Subservice::where('subserv_id', $subService->subserv_id)->exists());

        $subService->save();

        return $subService;
    }
    public function findService($serviceId)
    {
        return Service::where('service_id', $serviceId)->first();
    }
}