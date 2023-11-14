<?php

namespace App\Http\Controllers\User\Location;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trait\DataTrait;
use App\Models\Location;
use App\Models\UserD_Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class LocationController extends Controller
{
    use DataTrait;

    //جلب جميع المواقع الخاصة بالمستخدم

    public function getUserlocations()
    {
        $locationsID = UserD_Location::where('user_id', Auth::guard('userD')->user()->id)->pluck('location_id');
        $locations = Location::whereIn('id', $locationsID)->get();
        return $this->Data($locations, 'Locations Retrieved Successfully', 200);
    }

    //جلب بيانات موقع معين بناء على ال id الخاص به

    public function getLocationByID(Request $request)
    {
        $locationID = $request->input('locationID');
        $locations = Location::where('id', $locationID)->get();
        return $this->Data($locations, 'Locations Retrieved Successfully', 200);
    }

    //تخزين موقع جديد في قاعدة البيانات 

    public function storeLocation(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'area' => 'required',
            'street' => 'required',
            'floor' => 'required',
            'near' => 'required',
            'details' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $name = $request->input('name');
        $area = $request->input('area');
        $street = $request->input('street');
        $floor = $request->input('floor');
        $near = $request->input('near');
        $details = $request->input('details');
        $longitude = $request->input('longitude');
        $latitude = $request->input('latitude');

        $location = Location::create([

            'name' => $name,
            'area' => $area,
            'street' => $street,
            'floor' => $floor,
            'near' => $near,
            'another_details' => $details,
            'longitude' => $longitude,
            'latitude' => $latitude,

        ]);

        $locationID = $location->id;

        $userLocation = UserD_Location::create([
            'user_id' => Auth::guard('userD')->user()->id,
            'location_id' => $locationID,
        ]);

        $location = Location::where('id', $locationID)->get();

        return $this->Data($location, 'Location Retrieved Successfully', 200);
    }

    //تحديث بيانات الموقع الخاص بالمستخدم

    public function updateLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'area' => 'required',
            'street' => 'required',
            'floor' => 'required',
            'near' => 'required',
            'details' => 'required',
            'locationID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $name = $request->input('name');
        $area = $request->input('area');
        $street = $request->input('street');
        $floor = $request->input('floor');
        $near = $request->input('near');
        $details = $request->input('details');
        $locationID = $request->input('locationID');
        $location = Location::findOrfail($locationID);
        $locationUpdate = $location->update([
            'name' => $name,
            'area' => $area,
            'street' => $street,
            'floor' => $floor,
            'near' => $near,
            'another_details' => $details,
        ]);

        $locationDetails = Location::where('id', $locationID)->get();
        return $this->Data($locationDetails, 'Location Updated Successfully', 200);
    }

    //حذف موقع المستخدم بواسطة ال id

    public function deleteLocation(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'locationID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $locationID = $request->input('locationID');
        $userID = Auth::guard('userD')->user()->id;
        $locationUser = UserD_Location::where('user_id', $userID)->where('location_id', $locationID)->first();
        $location = Location::findOrfail($locationID);
        $locationDetails = Location::where('id', $location->id)->get();
        $locationUser->forceDelete();
        $location->forceDelete();
        return $this->Data($locationDetails, 'Location Deleted Successfully', 200);
    }
}
