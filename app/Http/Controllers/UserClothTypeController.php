<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UserClothType;
use Illuminate\Http\Request;

class UserClothTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('portal.cloth-types.index', ['userClothTypes' => userClothType::whereUserId(Auth::id())->paginate(10)]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try
        {
            foreach($request->names as $name)
            {
                $lastRecord = UserClothType::latest()->first();
                $refNo = $lastRecord? ($lastRecord->ref_no + 1): '0001';
                $incrementedNumber = (int)$refNo;
                $refNo = str_pad($incrementedNumber, 4, '0', STR_PAD_LEFT);
            
                UserClothType::updateOrCreate(['user_id' => Auth::id(), 'name' => $name], ['user_id' => Auth::id(), 'ref_no' => $refNo, 'name' => $name]);
            }

            return response()->json(['status' => 'ok', 'reason' => 'Record created successfully']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'bad', 'reason' => 'An error occured while creating a record. Please try again later']);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserClothType $userClothType)
    {
        try
        {
            $userClothType = UserClothType::whereId($request->cloth_type_id)->first();
            if(!$userClothType)
            {
                return response()->json(['status' => 'bad', 'reason' => 'Unkown record. Please try again later']);
            }

            $userClothType->update(['name' => $request->name]);

            return response()->json(['status' => 'ok', 'reason' => 'Record updated successfully']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'bad', 'reason' => 'An error occured while updated a record. Please try again later']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserClothType $userClothType)
    {
        try
        {
            $userClothType->delete();

            return response()->json(['status' => 'ok', 'reason' => 'Record deleted successfully']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'bad', 'reason' => 'An error occured while deleting a record. Please try again later']);
        }
    }
}
