<?php

namespace App\Http\Controllers\User\Store;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trait\DataTrait;
use App\Models\Catigory;
use App\Models\Location;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Store_Catigory;
use Illuminate\Http\Request;
use Symfony\Component\Console\Input\Input;
use Validator;

class StoreController extends Controller
{
    use DataTrait;

    // public function get_resturant(Request $request)
    public function getStore(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'type' => 'required',
            'catigoryName' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $type = $request->input('type');
        $ctigoryName = $request->input('catigoryName');

        if ($ctigoryName == "All") {
            $stores = Store::with('store_catigory')->where('type', $type)->get();
        } else {
            $stores = Store::with('store_catigory')
                ->where('type', $type)
                ->whereHas('store_catigory.catigory', function ($query) use ($ctigoryName) {
                    $query->where('name', $ctigoryName);
                })
                ->get();
        }

        $additionalData = [];

        foreach ($stores as $store) {

            $id = $store->id;
            $name = $store->name;
            $type = $store->type;
            $status = $store->status;
            $phone = $store->phone;
            $openTime = $store->openTime;
            $closeTime = $store->closeTime;
            $locationID = $store->location_id;
            $location = Location::where('id', $locationID)->first();
            $locationName = $location->name;
            $locationArea = $location->area;
            $locationStreet = $location->street;
            $locationFloor = $location->floor;
            $locationNear = $location->near;
            $locationDetails = $location->another_details;
            $locationLongitude = $location->longitude;
            $locationLatitude = $location->latitude;
            $img = $store->img;

            $categories = [];

            foreach ($store->store_catigory as $storeCategory) {
                $catigoryId = $storeCategory->catigory_id;
                $catigoryName = $storeCategory->catigory->name;


                $categories[] = [
                    'catigoryId' => $catigoryId,
                    'catigoryName' => $catigoryName,
                ];
            }


            $additionalData[] = [
                'id' => $id,
                'name' => $name,
                'type' => $type,
                'status' => $status,
                'phone' => $phone,
                'img' => $img,
                'openTime' => $openTime,
                'closeTime' => $closeTime,
                'locationName' => $locationName,
                'locationArea' => $locationArea,
                'locationStreet' => $locationStreet,
                'locationFloor' => $locationFloor,
                'locationNear' => $locationNear,
                'locationDetails' => $locationDetails,
                'locationLongitude' => $locationLongitude,
                'locationLatitude' => $locationLatitude,
                'categories' => $categories,
            ];
        }

        return $this->Data($additionalData, 'Store Retrieved Successfully', 200);
    }

    public function getStoreSearch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'type' => 'required',
            'catigoryName' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $name = $request->input('name');
        $type = $request->input('type');
        $ctigoryName = $request->input('catigoryName');

        if ($ctigoryName == "All") {
            $stores = Store::with('store_catigory')->where('type', $type)->where('name', 'LIKE', $name)->get();
        } else {
            $stores = Store::with('store_catigory')
                ->where('type', $type)->where('name', 'LIKE', $name)
                ->whereHas('store_catigory.catigory', function ($query) use ($ctigoryName) {
                    $query->where('name', $ctigoryName);
                })
                ->get();
        }


        $additionalData = [];

        foreach ($stores as $store) {

            $id = $store->id;
            $name = $store->name;
            $type = $store->type;
            $status = $store->status;
            $phone = $store->phone;
            $img = $store->img;

            $categories = [];

            foreach ($store->store_catigory as $storeCategory) {
                $catigoryId = $storeCategory->catigory_id;
                $catigoryName = $storeCategory->catigory->name;


                $categories[] = [
                    'catigoryId' => $catigoryId,
                    'catigoryName' => $catigoryName,
                ];
            }

            $additionalData[] = [
                'id' => $id,
                'name' => $name,
                'type' => $type,
                'status' => $status,
                'phone' => $phone,
                'img' => $img,
                'categories' => $categories,
            ];
        }

        return $this->Data($additionalData, 'Store Retrieved Successfully', 200);
    }


    public function getStoreCatigory(Request $request)
    {
        $type = $request->input('type');
        $resturant_store = Store::where('type', $type)->pluck('id');
        $catigory_id = Store_Catigory::whereIn('store_id', $resturant_store)->pluck('catigory_id');
        $catigory = Catigory::whereIn('id', $catigory_id)->get();
        return $this->Data($catigory, 'Catigory Retrieved Successfully', 200);
    }

    public function get_store_type()
    {
        $stores = Store::with('store_catigory')->where('type', '!=', 'resturant')->get();
        $additionalData = [];

        foreach ($stores as $store) {

            $id = $store->id;
            $name = $store->name;
            $type = $store->type;
            $status = $store->status;
            $phone = $store->phone;
            $img = $store->img;
            $locationID = $store->location_id;
            $location = Location::where('id', $locationID)->first();
            $locationName = $location->name;
            $locationArea = $location->area;
            $locationStreet = $location->street;
            $locationFloor = $location->floor;
            $locationNear = $location->near;
            $locationDetails = $location->another_details;
            $locationLongitude = $location->longitude;
            $locationLatitude = $location->latitude;


            $categories = [];

            foreach ($store->store_catigory as $storeCategory) {
                $catigoryId = $storeCategory->catigory_id;
                $catigoryName = $storeCategory->catigory->name;


                $categories[] = [
                    'catigoryId' => $catigoryId,
                    'catigoryName' => $catigoryName,
                ];
            }


            $additionalData[] = [
                'id' => $id,
                'name' => $name,
                'type' => $type,
                'status' => $status,
                'phone' => $phone,
                'img' => $img,
                'locationName' => $locationName,
                'locationArea' => $locationArea,
                'locationStreet' => $locationStreet,
                'locationFloor' => $locationFloor,
                'locationNear' => $locationNear,
                'locationDetails' => $locationDetails,
                'locationLongitude' => $locationLongitude,
                'locationLatitude' => $locationLatitude,
                'categories' => $categories,
            ];
        }

        return $this->Data($additionalData, 'Store Types Retrieved Successfully', 200);
    }

    //حساب المسافة بين المطعم والزبون 

    public function CalculateDistance(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'storeLongitude' => 'required',
            'storeLatitude' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $storeLongitude = $request->input('storeLongitude');
        $storeLatitude = $request->input('storeLatitude');

        $userLocationID = $request->input('LocationIDSelected');

        $userLocation = Location::where('id', $userLocationID)->first();

        if (!$userLocation) {
            return response()->json(['error' => 'User location not found'], 404);
        }

        $userLongitude = $userLocation->longitude;
        $userLatitude = $userLocation->latitude;

        $R = 6371; // Earth radius in kilometers

        $dLat = deg2rad($storeLatitude - $userLatitude);
        $dLon = deg2rad($storeLongitude - $userLongitude);

        $a = sin($dLat / 2) * sin($dLat / 2) + cos(deg2rad($userLatitude)) * cos(deg2rad($storeLatitude)) * sin($dLon / 2) * sin($dLon / 2);
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        $distance = $R * $c / 10; // Distance in kilometers

        $distanceInt = (int) $distance ;

        return $this->Data($distanceInt, 'Distance Retrieved Successfully', 200);
    }

    //حساب اجرة التوصيل من كل مطعم

    public function CalculateDeliveryFee(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'distance' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $distance = $request->input('distance');

        $kilometerPrices = Setting::where('key' , 'priceKilomete')->first();

        $kilometerPrice = $kilometerPrices->value;

        $deliveryFee = $distance * $kilometerPrice;

        return $this->Data($deliveryFee, 'DeliveryFee Retrieved Successfully', 200);
    }
}
