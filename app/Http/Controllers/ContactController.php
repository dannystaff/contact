<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactRequest;
use App\Models\Lead;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Log;

class ContactController extends Controller
{
    /**
     * Get contacts for list view
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function get(String $search = null) : JsonResponse
    {
        try {
            if($search){
                $results = Lead::where('first_name', 'LIKE', '%'.$search.'%')
                    ->orWhere('last_name', 'LIKE', '%'.$search.'%')
                    ->paginate(20);
            } else {
                $results = Lead::paginate(20);
            }
            
            return response()->json([
                'success' => true,
                'results' => $results
            ], Response::HTTP_OK);
        } catch (\Throwable $th) {
            Log::channel('contact')->error('Error occurred on contact submit: '.$th);
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Unable to retrieve data : ' . $th
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }

    /**
     * Create a new lead from form request
     *
     * @param ContactRequest $request
     * @return JsonResponse
     */
    public function create(ContactRequest $request) : JsonResponse
    {  
        try {
            Lead::create($request->all());

            return response()->json([
                'success' => true,
                'message' => 'Enquiry sent successfully'
            ], Response::HTTP_CREATED);
        } catch (\Throwable $th) {
            Log::channel('contact')->error('Error occurred on contact submit: '.$th);
            return response()->json(
                [
                    'success' => false,
                    'message' => 'Unable to submit contact enquiry : ' . $th
                ],
                Response::HTTP_BAD_REQUEST
            );
        }
    }
}
