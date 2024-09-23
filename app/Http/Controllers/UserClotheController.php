<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\UserClothType;
use App\Models\UserClothe;
use Illuminate\Http\Request;

class UserClotheController extends Controller
{
    //DISPLAY CLOTHES ALREADY CREATED-------------
    public function index()
    {
        $userClothTypes = UserClothType::get();

        return view('portal.clothes.index', ['userClothTypes' => $userClothTypes, 'userClothes' => UserClothe::whereUserId(Auth::id())->paginate(10)]);
    }

    //CREATE CLOTH RECORD---------------
    public function store(Request $request)
    {
        try
        {
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

            return response()->json(['status' => 'ok', 'reason' => 'Record created successfully']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'bad', 'reason' => 'An error occured while creating a record. Please try again later']);
        }
    }

    //UPDATE EXISITING CLOTH RECORD
    public function update(Request $request, UserClothe $userClothe)
    {
        try
        {
            $userClothe = UserClothe::whereId($request->user_clothe_id)->first();
            if(!$userClothe)
            {
                return response()->json(['status' => 'bad', 'reason' => 'Unkown record. Please try again later']);
            }

            $filename = $userClothe->filename;

            if($request->hasFile('filename'))
            {
                $request->filename->store('images', 'public');
                $filename = $request->filename->hashName();
            }  

            $userClothe->update(['user_cloth_type_id' => $request->user_cloth_type_id, 'color' => $request->color, 'filename' => $filename]);

            return response()->json(['status' => 'ok', 'reason' => 'Record updated successfully']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'bad', 'reason' => 'An error occured while updating a record. Please try again later']);
        }
    }

    //DELETE CLOTH FROM THE SYSTEM--------------
    public function destroy(UserClothe $userClothe)
    {
        try
        {
            $userClothe->delete();

            return response()->json(['status' => 'ok', 'reason' => 'Record deleted successfully']);
        }catch(\Exception $e)
        {
            return response()->json(['status' => 'bad', 'reason' => 'An error occured while deleting a record. Please try again later']);
        }
    }
}
