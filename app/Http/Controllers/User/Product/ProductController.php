<?php

namespace App\Http\Controllers\User\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trait\DataTrait;
use App\Models\Catigory;
use App\Models\Location;
use App\Models\Order_Details;
use App\Models\product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Validator;

class ProductController extends Controller
{
    use DataTrait;

    //احضار المنجات داخل المتجر

    public function getProductStore(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'storeID' => 'required',
            'catigoryName' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $storeID = $request->input('storeID');
        $ctigoryName = $request->input('catigoryName');

        if($ctigoryName == "All")
        {
            $products = product::with('product_catigory')->where('store_id' , $storeID)->get();
        }
        else{
            $products = product::with('product_catigory')
            ->where('store_id' , $storeID)
                ->whereHas('product_catigory.catigory', function ($query) use ($ctigoryName) {
                    $query->where('name', $ctigoryName);
                })
                ->get();
            
        }


        $additionalData = [];

        foreach ($products as $product) {

            $id = $product->id;
            $name = $product->name;
            $price = $product->price;
            $status = $product->status;
            $details = $product->details;
            $img = $product->img;
            $created_at = $product->created_at;


            $storeID = $product->store->id;
            $storeName = $product->store->name;
            $storePhone = $product->store->phone;
            $storeStatus = $product->store->status;
            $storeImg = $product->store->img;
            $locationID = $product->store->location_id;
            $location = Location::where('id', $locationID)->first();
            $locationLongitude = $location->longitude;
            $locationLatitude = $location->latitude;


            $categories = [];

            foreach ($product->product_catigory as $productCategory) {
                $catigoryId = $productCategory->catigory_id;
                $catigoryName = $productCategory->catigory->name;


                $categories[] = [
                    'catigoryId' => $catigoryId,
                    'catigoryName' => $catigoryName,
                ];
            }


            $additionalData[] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'status' => $status,
                'details' => $details,
                'img' => $img,
                'created_at' => $created_at,
                'storeID' => $storeID,
                'storeName' => $storeName,
                'storePhone' => $storePhone,
                'storeStatus' => $storeStatus,
                'storeImg' => $storeImg,
                'locationLongitude' => $locationLongitude,
                'locationLatitude' => $locationLatitude,
                'categories' => $categories,
            ];
        }


        return $this->Data($additionalData, 'Product Retrieved Successfully', 200);

    }

    public function getProductSearch(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'storeID' => 'required',
            'catigoryName' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $productName =$request->input('name');
        $storeID = $request->input('storeID');
        $ctigoryName = $request->input('catigoryName');

        if($ctigoryName == "All")
        {
            $products = product::with('product_catigory')->where('store_id' , $storeID)->where('name' , 'LIKE' , $productName )->get();
        }
        else{
            $products = product::with('product_catigory')
            ->where('store_id' , $storeID)
            ->where('name' , 'LIKE' , $productName )
                ->whereHas('product_catigory.catigory', function ($query) use ($ctigoryName) {
                    $query->where('name', $ctigoryName);
                })
                ->get();
            
        }


        $additionalData = [];

        foreach ($products as $product) {

            $id = $product->id;
            $name = $product->name;
            $price = $product->price;
            $status = $product->status;
            $details = $product->details;
            $img = $product->img;
            $created_at = $product->created_at;


            $storeID = $product->store->id;
            $storeName = $product->store->name;
            $storePhone = $product->store->phone;
            $storeStatus = $product->store->status;
            $storeImg = $product->store->img;
            $locationID = $product->store->location_id;
            $location = Location::where('id', $locationID)->first();
            $locationLongitude = $location->longitude;
            $locationLatitude = $location->latitude;
            


            $categories = [];

            foreach ($product->product_catigory as $productCategory) {
                $catigoryId = $productCategory->catigory_id;
                $catigoryName = $productCategory->catigory->name;


                $categories[] = [
                    'catigoryId' => $catigoryId,
                    'catigoryName' => $catigoryName,
                ];
            }


            $additionalData[] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'status' => $status,
                'details' => $details,
                'img' => $img,
                'created_at' => $created_at,
                'storeID' => $storeID,
                'storeName' => $storeName,
                'storePhone' => $storePhone,
                'storeStatus' => $storeStatus,
                'storeImg' => $storeImg,
                'locationLongitude' => $locationLongitude,
                'locationLatitude' => $locationLatitude,
                'categories' => $categories,
            ];
        }


        return $this->Data($additionalData, 'Product Retrieved Successfully', 200);

    }

    //احضار تصنيفات منتجات المطعم

    public function getProductCatigory(Request $request)
    {
        $storeType = $request->input('storeType');
        $products = Product::with('store')
            ->whereHas('store', function ($query) use ($storeType) {
                $query->where('type', $storeType);
            })
            ->get();

        foreach ($products as $product) {
            foreach ($product->product_catigory as $productCategory) {
                $catigoryId[] = $productCategory->catigory->id;
                $catigoryName = $productCategory->catigory->name;
            }
        }

        $catigory = Catigory::whereIn('id', $catigoryId)->get();
        return $this->Data($catigory, 'Product Catigory Retrieved Successfully', 200);
    }

    //احضار المنتجات الاكثر طلبا

    public function get_trending_product()
    {
        $trendingProducts = DB::table('order__details')
            ->select('product_id', DB::raw('COUNT(*) as order_count'))
            ->groupBy('product_id')
            ->orderByDesc('order_count')
            ->limit(3)
            ->get();

        $productIDs = $trendingProducts->pluck('product_id')->toArray();
        $products = product::with('store', 'product_catigory')->whereIn('id', $productIDs)->get();


        $additionalData = [];

        foreach ($products as $product) {

            $id = $product->id;
            $name = $product->name;
            $price = $product->price;
            $status = $product->status;
            $details = $product->details;
            $img = $product->img;
            $created_at = $product->created_at;


            $storeID = $product->store->id;
            $storeName = $product->store->name;
            $storePhone = $product->store->phone;
            $storeStatus = $product->store->status;
            $storeImg = $product->store->img;
            $locationID = $product->store->location_id;
            $location = Location::where('id', $locationID)->first();
            $locationLongitude = $location->longitude;
            $locationLatitude = $location->latitude;


            $categories = [];

            foreach ($product->product_catigory as $productCategory) {
                $catigoryId = $productCategory->catigory_id;
                $catigoryName = $productCategory->catigory->name;


                $categories[] = [
                    'catigoryId' => $catigoryId,
                    'catigoryName' => $catigoryName,
                ];
            }


            $additionalData[] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'status' => $status,
                'details' => $details,
                'img' => $img,
                'created_at' => $created_at,
                'storeID' => $storeID,
                'storeName' => $storeName,
                'storePhone' => $storePhone,
                'storeStatus' => $storeStatus,
                'storeImg' => $storeImg,
                'locationLongitude' => $locationLongitude,
                'locationLatitude' => $locationLatitude,
                'categories' => $categories,
            ];
        }


        return $this->Data($additionalData, 'Product Retrieved Successfully', 200);
    }

    //احضار المنتجات الجديدة

    public function get_new_product()
    {
        $oneWeekAgo = Carbon::now()->subWeek();

        $products = Product::with('store', 'product_catigory')->whereDate('created_at', '>', $oneWeekAgo)->get();

        $additionalData = [];

        foreach ($products as $product) {

            $id = $product->id;
            $name = $product->name;
            $price = $product->price;
            $status = $product->status;
            $details = $product->details;
            $img = $product->img;
            $created_at = $product->created_at;


            $storeID = $product->store->id;
            $storeName = $product->store->name;
            $storePhone = $product->store->phone;
            $storeStatus = $product->store->status;
            $storeImg = $product->store->img;
            $locationID = $product->store->location_id;
            $location = Location::where('id', $locationID)->first();
            $locationLongitude = $location->longitude;
            $locationLatitude = $location->latitude;


            $categories = [];

            foreach ($product->product_catigory as $productCategory) {
                $catigoryId = $productCategory->catigory_id;
                $catigoryName = $productCategory->catigory->name;


                $categories[] = [
                    'catigoryId' => $catigoryId,
                    'catigoryName' => $catigoryName,
                ];
            }


            $additionalData[] = [
                'id' => $id,
                'name' => $name,
                'price' => $price,
                'status' => $status,
                'details' => $details,
                'img' => $img,
                'created_at' => $created_at,
                'storeID' => $storeID,
                'storeName' => $storeName,
                'storePhone' => $storePhone,
                'storeStatus' => $storeStatus,
                'storeImg' => $storeImg,
                'locationLongitude' => $locationLongitude,
                'locationLatitude' => $locationLatitude,
                'categories' => $categories,
            ];
        }


        return $this->Data($additionalData, 'Product Retrieved Successfully', 200);
    }
}
