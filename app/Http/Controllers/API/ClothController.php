<?php

namespace App\Http\Controllers\API;

use Auth;
use Validator;
use App\Models\UserClothType;
use App\Models\UserClothe;
use App\Utilities\ApiResponse;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClothController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $userClothTypes = UserClothType::get();
        $userClothes = UserClothe::whereUserId(Auth::id())->paginate(10);

        $payload = ['userClothTypes'] = $userClothTypes;
        $payload = ['userClothes'] = $userClothes;

        return ApiResponse::sendResponse("Record created successfully",  $payload, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            $payload = [];

            $validator = Validator::make($request->all(), [
                'user_id' => 'required|exists:users,id',
                'user_cloth_type_id' => 'required|integer',
                'color' => 'required|string',
            ]);

            if($validator->fails())
            {
                return ApiResponse::sendError('Validation Error', $validator->errors(), 403);     
            }

            $filename = "";

            if($request->hasFile('filename'))
            {
                $request->filename->store('images', 'public');
                $filename = $request->filename->hashName();
            }  

            $lastRecord = UserClothe::latest()->first();
            $refNo = $lastRecord? ($lastRecord->ref_no + 1): '0001';
            $incrementedNumber = (int)$refNo;
            $refNo = str_pad($incrementedNumber, 4, '0', STR_PAD_LEFT);

            UserClothe::create(['user_id' => Auth::id(), 'ref_no' => $refNo, 'user_cloth_type_id' => $request->user_cloth_type_id, 'color' => $request->color, 'filename' => $filename]);

            return ApiResponse::sendResponse("Record created successfully",  $payload, 200);
        }catch(\Exception $e)
        {
            $payload['error'] = $e->getMessage();

            return ApiResponse::sendError('An error occured while creating a record. Please try again later', $payload, 403); 
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        try
        {
            $payload = [];

            $validator = Validator::make($request->all(), [
                'user_cloth_id' => 'required',
                'user_id' => 'required|exists:users,id',
                'user_cloth_type_id' => 'required|integer',
                'color' => 'required|string',
            ]);

            if($validator->fails())
            {
                return ApiResponse::sendError('Validation Error', $validator->errors(), 403);     
            }

            $userClothe = UserClothe::whereId($request->user_clothe_id)->first();
            if(!$userClothe)
            {
                return ApiResponse::sendError('Unkown record. Please try again later', $payload, 403);
            }

            $filename = $userClothe->filename;

            if($request->hasFile('filename'))
            {
                $request->filename->store('images', 'public');
                $filename = $request->filename->hashName();
            }  

            $userClothe->update(['user_cloth_type_id' => $request->user_cloth_type_id, 'color' => $request->color, 'filename' => $filename]);

            return ApiResponse::sendResponse("Record updated successfully",  $payload, 200);
        }catch(\Exception $e)
        {
            $payload['error'] = $e->getMessage();

            return ApiResponse::sendError('An error occured while updating a record. Please try again later', $payload, 403); 
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserClothe, $userClothe)
    {
        try
        {
            $payload = [];

            $validator = Validator::make($request->all(), [
                'user_cloth_id' => 'required',
            ]);

            if($validator->fails())
            {
                return ApiResponse::sendError('Validation Error', $validator->errors(), 403);     
            }

            $userClothe = UserClothe::whereId($request->user_clothe_id)->first();
            if(!$userClothe)
            {
                return ApiResponse::sendError('Unkown record. Please try again later', $payload, 403);
            }

            $userClothe->delete();

            return ApiResponse::sendResponse("Record deleted successfully",  $payload, 200);
        }catch(\Exception $e)
        {
            $payload['error'] = $e->getMessage();

            return ApiResponse::sendError('An error occured while deleting a record. Please try again later', $payload, 403); 
        }
    }
}
