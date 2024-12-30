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

    public function sendRequest()
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
            $curl = curl_init();
            // Prepare the array data
            $data = array(
                "companyId" => $companyId,
                "userInfo" => array(
                    "submitDateTime" => $date->format('Y-m-d H:i:s'),
                    "sourceUniqueId" => "buy-1",
                    "firstName" => "Yesvant",
                    "lastName" => "Alaria",
                    "phone" => "+91 9653720289",
                    "email" => "yesvantalaria09@gmail.com",
                    // "customerCompany" => "BAT",
                    // "customerCompanySize" => 9999,
                    // "jobTitle" => "Team Lead",
                    // "message" => "First Test submit lead",
                    "listingId" => "mir-RD8243",
                    "allowEmailPromotion" => true,
                    "subscribe" => true,
                    "trackingItems" => array(
                        array(
                            "listingId" => "mir-RD8243",
                            "sourceUniqueId" => "buy-1",
                            "trackingDateTime" => $date->format('Y-m-d H:i:s'),
                            "spentTime" => 10
                        )
                    ),
                    "favoriteItems" => array(
                        array(
                            "listingId" => "mir-RD8243",
                            "sourceUniqueId" => "rent-3",
                            "favorite" => true,
                            "trackingDateTime" => $date->format('Y-m-d H:i:s'),
                            "spentTime" => 10
                        )
                    ),
                    "extRemark" => "{}"
                )
            );
            
            // Convert array to JSON
            $json_data = json_encode($data);
            
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
            dd($response);                              
        } 
    }
    

    public function submit(Request $request)
    {
        if(isset($request->type) && $request->type == 'dev'){
                   $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactNumber' => 'required|string|max:20',
            // 'pageName' => 'required|string|max:255',
            // 'pageId' => 'required|string|max:255',
        ]); 
        }else{
                    $request->validate([
            'fullName' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'contactNumber' => 'required|string|max:20',
            'message' => 'required|string',
            // 'pageName' => 'required|string|max:255',
            // 'pageId' => 'required|string|max:255',
        ]);            
        }
        $previousUrl = url()->previous();

        FormData::create([
            'full_name' => $request->fullName,
            'email' => $request->email,
            'contact_number' => $request->contactNumber,
            'message' => $request->message ?? "",
            'page_name' => $previousUrl ?? "",
            'page_id' => $request->pageId ?? "",
            'ip_address' => $request->ip(),
        ]);

        return redirect()->back()->with('success', 'Form submitted successfully!');
    }
}
