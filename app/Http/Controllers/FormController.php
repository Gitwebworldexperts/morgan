<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FormData;
use DateTime;
use DateTimeZone;

use App\Services\ApiRequestService;

class FormController extends Controller
{

    protected $apiRequestService;

    public function __construct(ApiRequestService $apiRequestService)
    {
        $this->apiRequestService = $apiRequestService;
    }

    public function sendRequest($data = [])
    {
        $APIusername = getOption('APIusername', 'eu20.prod.api.102@pr.com');
        $APIpassword = getOption('APIpassword', 'D55cZZtD');
        $loginUrl = 'https://eu20.propertyraptor.com/hornet/client/login';
        $loginData = [
            "username" => $APIusername,
            "password" => $APIpassword
        ];
    
        // Login and get the token
        $authResponse = $this->apiRequestService->sendPostRequest($loginUrl, $loginData);
    
        if (isset($authResponse['code']) && $authResponse['code'] === 200) {
            $date = new DateTime("now", new DateTimeZone("Asia/Singapore"));
            $token = $authResponse['data']['token'];
            $companyId = getOption('companyId', 'eu20_001');
    
            // Add mandatory fields
            $data['companyId'] = $companyId;
            $data['userInfo']['submitDateTime'] = $date->format('Y-m-d H:i:s');
    
            $json_data = json_encode($data);
    
            $curl = curl_init();
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'https://eu20.propertyraptor.com/hornet/portal/createLead',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $json_data,
                CURLOPT_HTTPHEADER => array(
                    'token: ' . $token,
                    'Content-Type: application/json'
                ),
            ));
            $response = curl_exec($curl);
            curl_close($curl);
    
            // Handle the response as needed
            return $response;
        }
    
        // Handle login failure
        throw new Exception('Failed to authenticate and retrieve token.');
    }
    
    public function submit(Request $request)
    {
        $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactNumber' => 'required|string|max:20',
            // 'message' => 'required|string',
        ]);
        $previousUrl = url()->previous();

        $formData = FormData::create([
            'full_name' => $request->fullName,
            'email' => $request->email,
            'contact_number' => $request->contactNumber,
            'message' => $request->message ?? "",
            'page_name' => $previousUrl ?? "",
            'page_id' => $request->pageId ?? "",
            'ip_address' => $request->ip(),
            'is_api' => false, 
        ]);
    
        $nameParts = explode(' ', trim($request->fullName));
        $firstName = $nameParts[0];
        $lastName = isset($nameParts[1]) ? implode(' ', array_slice($nameParts, 1)) : 'NA';
    
        // Prepare mandatory fields for `sendRequest`
        $requestData = [
            "userInfo" => [
                "submitDateTime" => now()->setTimezone("Asia/Singapore")->format('Y-m-d H:i:s'),
                "sourceUniqueId" => "form-" . $formData->id,
                "firstName" => $firstName,
                "lastName" => $lastName,
                "phone" => $formData->contact_number,
                "email" => $formData->email,
                "listingId" => $request->listingId ?? "default-listing-id", // Replace with actual data or fallback
                "allowEmailPromotion" => $request->allowEmailPromotion ?? true,
                "subscribe" => $request->subscribe ?? true,
                // "extRemark" => ['form_id' => $formData->id],
            ]
        ];
        // $formData->update(['is_api' => true]);
        try {
            $response = $this->sendRequest($requestData);
            // Decode the JSON response
            $responseDecoded = json_decode($response, true);
            if (isset($responseDecoded['result']) && $responseDecoded['result'] === true) {
                $formData->update(['is_api' => true]);
            }
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Failed to submit form: ' . $e->getMessage());
        }
    
        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
    
}
