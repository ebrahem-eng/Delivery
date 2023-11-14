<?php

namespace App\Http\Controllers\User\Store;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trait\DataTrait;
use App\Models\Catigory;
use App\Models\Store;
use App\Models\Store_Catigory;
use Illuminate\Http\Request;
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

        return $this->Data($additionalData, 'Store Types Retrieved Successfully', 200);
    }
    
}
