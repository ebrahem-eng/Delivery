<?php

namespace App\Http\Controllers\DeliveryAgent\Order;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAgentOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Trait\DataTrait;
use App\Models\Order;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    use DataTrait;

    //احضار الطلبات الجديدة لعامل التوصيل

    public function getNewOrder()
    {
        $deliveryAgentID = Auth::guard('deliveryAgent')->user()->id;

        // $newOrders = DeliveryAgentOrder::with('order.user')->where('deliveryAgentID', $deliveryAgentID)->get();
        $newOrders = DeliveryAgentOrder::with('order.user')
        ->where('deliveryAgentID', $deliveryAgentID)
        ->whereHas('order', function ($query) {
            $query->where('order_status', 'pending delivery agent accept');
        })
        ->get();

        $additionalData = [];

        foreach ($newOrders as $newOrder) {
            $order = $newOrder->order;
            // $userOrderDetails = [

            // ];

            $additionalData[] = [
                'id' => $newOrder->id,
                'details' => $newOrder->details,
                'expectedDeliveryTime' => $newOrder->expectedDeliveryTime,
                'realDeliveryTime' => $newOrder->realDeliveryTime,
                'status' => $newOrder->status,
                'created_at' => $newOrder->created_at,
                'orderID' => $order->id,
                'orderStatus' => $order->order_status,
                'orderReasonOfRefuse' => $order->reason_of_refuse,
                'orderType' => $order->type,
                'orderStoreAcceptStatus' => $order->store_accept_status,
                'orderDeliveryAcceptStatus' => $order->delivery_accept_status,
                'orderDeliveredCode' => $order->delivered_code,
                'orderReceiptCode' => $order->receipt_code,
                'orderNote' => $order->order_note,
                'orderDeliveryFee' => $order->deliveryFee,
                'orderTypePayment' => $order->typePayment,
                'orderDeliveryTips' => $order->deliveryTips,
                'orderVoucher' => $order->voucher,
                'orderTax' => $order->tax,
                'orderTotalAmmount' => $order->totalAmmount,
                'orderCreated_at' => $order->created_at,
                'userID' => $order->user->id,
                'userName' => $order->user->name,
                'userPhone' => $order->user->phone,
                'userCity' => $order->user->city,
                // 'userOrderDetails' => $userOrderDetails,
            ];
        }

        return $this->Data($additionalData, 'New Order Retrieved Successfully', 200);
    }


      //احضار الطلبات النشطة بعد الموافقة عليها من عامل التوصيل

      public function getActiveOrder()
      {
          $deliveryAgentID = Auth::guard('deliveryAgent')->user()->id;
  
          // $newOrders = DeliveryAgentOrder::with('order.user')->where('deliveryAgentID', $deliveryAgentID)->get();
          $newOrders = DeliveryAgentOrder::with('order.user')
          ->where('deliveryAgentID', $deliveryAgentID)
          ->whereDoesntHave('order', function ($query) {
              $query->where('order_status', 'pending delivery agent accept');
          })
          ->get();
  
          $additionalData = [];
  
          foreach ($newOrders as $newOrder) {
              $order = $newOrder->order;
              // $userOrderDetails = [
  
              // ];
  
              $additionalData[] = [
                  'id' => $newOrder->id,
                  'details' => $newOrder->details,
                  'expectedDeliveryTime' => $newOrder->expectedDeliveryTime,
                  'realDeliveryTime' => $newOrder->realDeliveryTime,
                  'status' => $newOrder->status,
                  'created_at' => $newOrder->created_at,
                  'orderID' => $order->id,
                  'orderStatus' => $order->order_status,
                  'orderReasonOfRefuse' => $order->reason_of_refuse,
                  'orderType' => $order->type,
                  'orderStoreAcceptStatus' => $order->store_accept_status,
                  'orderDeliveryAcceptStatus' => $order->delivery_accept_status,
                  'orderDeliveredCode' => $order->delivered_code,
                  'orderReceiptCode' => $order->receipt_code,
                  'orderNote' => $order->order_note,
                  'orderDeliveryFee' => $order->deliveryFee,
                  'orderTypePayment' => $order->typePayment,
                  'orderDeliveryTips' => $order->deliveryTips,
                  'orderVoucher' => $order->voucher,
                  'orderTax' => $order->tax,
                  'orderTotalAmmount' => $order->totalAmmount,
                  'orderCreated_at' => $order->created_at,
                  'userID' => $order->user->id,
                  'userName' => $order->user->name,
                  'userPhone' => $order->user->phone,
                  'userCity' => $order->user->city,
                  // 'userOrderDetails' => $userOrderDetails,
              ];
          }
  
          return $this->Data($additionalData, 'Active Order Retrieved Successfully', 200);
      }

    //احضار تفاصيل الطلبات الجديدة لعامل التوصيل

    public function getNewOrderDetails(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'deliveryOrderID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $deliveryOrderID = $request->input('deliveryOrderID');

        $newOrders = DeliveryAgentOrder::with(['order.user', 'order.orderDetails'])->where('id', $deliveryOrderID)->get();

        $additionalData = [];

        foreach ($newOrders as $newOrder) {
            $order = $newOrder->order;

            // Extracting orderDetails information
            $orderDetails = $order->orderDetails->map(function ($detail) {
                return [
                    'orderDetailsID' => $detail->id,
                    'productPrice' => $detail->product_price,
                    'productNote' => $detail->product_note,
                    'quantity' => $detail->quantity,
                    'productTotalAmount' => $detail->productTotalAmount,
                    'productID' => $detail->product_id,
                    'productName' => $detail->productOrderDetails->name,
                    'orderID' => $detail->order_id,
                    'created_at' => $detail->created_at,
                ];
            });

            $additionalData[] = [
                'id' => $newOrder->id,
                'details' => $newOrder->details,
                'expectedDeliveryTime' => $newOrder->expectedDeliveryTime,
                'realDeliveryTime' => $newOrder->realDeliveryTime,
                'status' => $newOrder->status,
                'created_at' => $newOrder->created_at,
                'orderID' => $order->id,
                'orderStatus' => $order->order_status,
                'orderReasonOfRefuse' => $order->reason_of_refuse,
                'orderType' => $order->type,
                'orderStoreAcceptStatus' => $order->store_accept_status,
                'orderDeliveryAcceptStatus' => $order->delivery_accept_status,
                'orderDeliveredCode' => $order->delivered_code,
                'orderReceiptCode' => $order->receipt_code,
                'orderNote' => $order->order_note,
                'orderDeliveryFee' => $order->deliveryFee,
                'orderTypePayment' => $order->typePayment,
                'orderDeliveryTips' => $order->deliveryTips,
                'orderVoucher' => $order->voucher,
                'orderTax' => $order->tax,
                'orderTotalAmmount' => $order->totalAmmount,
                'orderCreated_at' => $order->created_at,
                'userID' => $order->user->id,
                'userName' => $order->user->name,
                'userPhone' => $order->user->phone,
                'userCity' => $order->user->city,
                'orderDetails' => $orderDetails,
            ];
        }

        return $this->Data($additionalData, 'New Order Details Retrieved Successfully', 200);
    }


    //احضار الموقع الخاص بالمطعم لكل فاتورة جديدة

    public function getNewOrderStoreLocation(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'deliveryOrderID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $deliveryOrderID = $request->input('deliveryOrderID');

        $newOrders = DeliveryAgentOrder::with(['order.user', 'order.orderDetails'])->where('id', $deliveryOrderID)->get();

        $additionalData = [];

        foreach ($newOrders as $newOrder) {
            $order = $newOrder->order;

            $additionalData[] = [
                'id' => $newOrder->id,
                'details' => $newOrder->details,
                'expectedDeliveryTime' => $newOrder->expectedDeliveryTime,
                'realDeliveryTime' => $newOrder->realDeliveryTime,
                'status' => $newOrder->status,
                'created_at' => $newOrder->created_at,
                'orderStoreID' => $order->store->id,
                'orderStoreName' => $order->store->name,
                'orderStoreArea' => $order->store->location->area,
                'orderStoreStreet' => $order->store->location->street,
                'orderStoreNear' => $order->store->location->near,
                'orderStoreAnotherDetailsLocation' => $order->store->location->another_details,
                'orderStoreLongitude' => $order->store->location->longitude,
                'orderStoreLatitude' => $order->store->location->latitude,
                'orderUserArea' => $order->userLocation->location->area,
                'orderUserStreet' => $order->userLocation->location->street,
                'orderUserNear' => $order->userLocation->location->near,
                'orderUserAnotherDetailsLocation' => $order->userLocation->location->another_details,
                'orderUserLongitude' => $order->userLocation->location->longitude,
                'orderUserLatitude' => $order->userLocation->location->latitude,
            ];
        }

        return $this->Data($additionalData, 'New Order Store Location Retrieved Successfully', 200);
    }

    //الموافقة على الطلب


    public function acceptNewOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orderID' => 'required',
            'deliveryOrderID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // $deliveryAgentID = Auth::guard('deliveryAgent')->user()->id;
        $orderID = $request->input('orderID');
        $deliveryOrderID = $request->input('deliveryOrderID');
        $orders = Order::findOrfail($orderID);

        // Generate a random number between 10000 and 99999
        $randomCode = rand(10000, 99999);
        $orders->update([
            'order_status' => 'accept delivery pending for preparation',
            'delivered_code' => $randomCode
        ]);

        $deliveryOrderAccepts = DeliveryAgentOrder::findOrfail($deliveryOrderID);

        $deliveryOrderAccepts->update([
            'status' => '1'
        ]);

        $newOrders = DeliveryAgentOrder::with(['order.user', 'order.orderDetails'])->where('id', $deliveryOrderID)->get();

        $additionalData = [];

        foreach ($newOrders as $newOrder) {
            $order = $newOrder->order;

            // Extracting orderDetails information
            $orderDetails = $order->orderDetails->map(function ($detail) {
                return [
                    'orderDetailsID' => $detail->id,
                    'productPrice' => $detail->product_price,
                    'productNote' => $detail->product_note,
                    'quantity' => $detail->quantity,
                    'productTotalAmount' => $detail->productTotalAmount,
                    'productID' => $detail->product_id,
                    'productName' => $detail->productOrderDetails->name,
                    'orderID' => $detail->order_id,
                    'created_at' => $detail->created_at,
                ];
            });

            $additionalData[] = [
                'id' => $newOrder->id,
                'details' => $newOrder->details,
                'expectedDeliveryTime' => $newOrder->expectedDeliveryTime,
                'realDeliveryTime' => $newOrder->realDeliveryTime,
                'status' => $newOrder->status,
                'created_at' => $newOrder->created_at,
                'orderID' => $order->id,
                'orderStatus' => $order->order_status,
                'orderReasonOfRefuse' => $order->reason_of_refuse,
                'orderType' => $order->type,
                'orderStoreAcceptStatus' => $order->store_accept_status,
                'orderDeliveryAcceptStatus' => $order->delivery_accept_status,
                'orderDeliveredCode' => $order->delivered_code,
                'orderReceiptCode' => $order->receipt_code,
                'orderNote' => $order->order_note,
                'orderDeliveryFee' => $order->deliveryFee,
                'orderTypePayment' => $order->typePayment,
                'orderDeliveryTips' => $order->deliveryTips,
                'orderVoucher' => $order->voucher,
                'orderTax' => $order->tax,
                'orderTotalAmmount' => $order->totalAmmount,
                'orderCreated_at' => $order->created_at,
                'userID' => $order->user->id,
                'userName' => $order->user->name,
                'userPhone' => $order->user->phone,
                'userCity' => $order->user->city,
                'orderDetails' => $orderDetails,
            ];
        }

        return $this->Data($additionalData, 'New Order Accepted Successfully', 200);
    }


    //عرض كود المطعم 

    public function showStoreCode(Request $request)
      {
        $validator = Validator::make($request->all(), [
            'deliveryOrderID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $deliveryOrderID = $request->input('deliveryOrderID');

        $newOrders = DeliveryAgentOrder::with('order.user')->where('id', $deliveryOrderID)->get();

        $additionalData = [];

        foreach ($newOrders as $newOrder) {
            $order = $newOrder->order;
  
            $additionalData[] = [
                'id' => $newOrder->id,
                'details' => $newOrder->details,
                'expectedDeliveryTime' => $newOrder->expectedDeliveryTime,
                'realDeliveryTime' => $newOrder->realDeliveryTime,
                'status' => $newOrder->status,
                'created_at' => $newOrder->created_at,
                'orderID' => $order->id,
                'orderStatus' => $order->order_status,
                'orderReasonOfRefuse' => $order->reason_of_refuse,
                'orderType' => $order->type,
                'orderStoreAcceptStatus' => $order->store_accept_status,
                'orderDeliveryAcceptStatus' => $order->delivery_accept_status,
                'orderDeliveredCode' => $order->delivered_code,
                'orderReceiptCode' => $order->receipt_code,
                'orderNote' => $order->order_note,
                'orderDeliveryFee' => $order->deliveryFee,
                'orderTypePayment' => $order->typePayment,
                'orderDeliveryTips' => $order->deliveryTips,
                'orderVoucher' => $order->voucher,
                'orderTax' => $order->tax,
                'orderTotalAmmount' => $order->totalAmmount,
                'orderCreated_at' => $order->created_at,
                'userID' => $order->user->id,
                'userName' => $order->user->name,
                'userPhone' => $order->user->phone,
                'userCity' => $order->user->city,
                // 'userOrderDetails' => $userOrderDetails,
            ];
        }

        return $this->Data($additionalData, 'New Order Retrieved Successfully', 200);

       }


       //البدء بالتوصيل

       public function startDrive(Request $request)
       {
        $validator = Validator::make($request->all(), [
            'orderID' => 'required',
            'deliveryOrderID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        // $deliveryAgentID = Auth::guard('deliveryAgent')->user()->id;
        $orderID = $request->input('orderID');
        $deliveryOrderID = $request->input('deliveryOrderID');
        $orders = Order::findOrfail($orderID);

        $orders->update([
            'order_status' => 'start delivering',
        ]);

        $newOrders = DeliveryAgentOrder::with(['order.user', 'order.orderDetails'])->where('id', $deliveryOrderID)->get();

        $additionalData = [];

        foreach ($newOrders as $newOrder) {
            $order = $newOrder->order;

            // Extracting orderDetails information
            $orderDetails = $order->orderDetails->map(function ($detail) {
                return [
                    'orderDetailsID' => $detail->id,
                    'productPrice' => $detail->product_price,
                    'productNote' => $detail->product_note,
                    'quantity' => $detail->quantity,
                    'productTotalAmount' => $detail->productTotalAmount,
                    'productID' => $detail->product_id,
                    'productName' => $detail->productOrderDetails->name,
                    'orderID' => $detail->order_id,
                    'created_at' => $detail->created_at,
                ];
            });

            $additionalData[] = [
                'id' => $newOrder->id,
                'details' => $newOrder->details,
                'expectedDeliveryTime' => $newOrder->expectedDeliveryTime,
                'realDeliveryTime' => $newOrder->realDeliveryTime,
                'status' => $newOrder->status,
                'created_at' => $newOrder->created_at,
                'orderID' => $order->id,
                'orderStatus' => $order->order_status,
                'orderReasonOfRefuse' => $order->reason_of_refuse,
                'orderType' => $order->type,
                'orderStoreAcceptStatus' => $order->store_accept_status,
                'orderDeliveryAcceptStatus' => $order->delivery_accept_status,
                'orderDeliveredCode' => $order->delivered_code,
                'orderReceiptCode' => $order->receipt_code,
                'orderNote' => $order->order_note,
                'orderDeliveryFee' => $order->deliveryFee,
                'orderTypePayment' => $order->typePayment,
                'orderDeliveryTips' => $order->deliveryTips,
                'orderVoucher' => $order->voucher,
                'orderTax' => $order->tax,
                'orderTotalAmmount' => $order->totalAmmount,
                'orderCreated_at' => $order->created_at,
                'userID' => $order->user->id,
                'userName' => $order->user->name,
                'userPhone' => $order->user->phone,
                'userCity' => $order->user->city,
                'orderDetails' => $orderDetails,
            ];
        }

        return $this->Data($additionalData, 'Start Driving Successfully', 200);

       }


       //عرض تفاصيل الطلب النهائية

       public function detailsFinish(Request $request)
       {
           $validator = Validator::make($request->all(), [
               'deliveryOrderID' => 'required',
           ]);
       
           if ($validator->fails()) {
               return response()->json($validator->errors(), 422);
           }
       
           $deliveryOrderID = $request->input('deliveryOrderID');
       
           $newOrders = DeliveryAgentOrder::with(['order.user', 'order.orderDetails'])->where('id', $deliveryOrderID)->get();
       
           $averageSpeed = 40; // Average speed in kilometers per hour
       
           $additionalData = [];
       
           foreach ($newOrders as $newOrder) {
               $order = $newOrder->order;
       
               $storeLatitude = $order->store->location->latitude;
               $storeLongitude = $order->store->location->longitude;
               $userLatitude = $order->userLocation->location->latitude;
               $userLongitude = $order->userLocation->location->longitude;
       
               // Calculate distance using Haversine formula
               $distance = $this->haversine($storeLatitude, $storeLongitude, $userLatitude, $userLongitude);
       
               // Calculate expected time in hours
               $expectedTimeHours = $distance / $averageSpeed;
       
               // Convert expected time to minutes and cast to integer
               $expectedTimeMinutes = (int) ($expectedTimeHours * 60);
       
               $findOrder = DeliveryAgentOrder::findOrFail($newOrder->id);
       
               $findOrder->update([
                   'expectedDeliveryTime' => $expectedTimeMinutes,
               ]);
       
               // Cast distance to integer
               $distance = (int) $distance;
       
               $additionalData[] = [
                   'id' => $newOrder->id,
                   'details' => $newOrder->details,
                   'expectedDeliveryTime' => $expectedTimeMinutes,
                   'realDeliveryTime' => $newOrder->realDeliveryTime,
                   'status' => $newOrder->status,
                   'created_at' => $newOrder->created_at,
                   'orderStoreID' => $order->store->id,
                   'orderStoreName' => $order->store->name,
                   'orderStoreArea' => $order->store->location->area,
                   'orderStoreStreet' => $order->store->location->street,
                   'orderStoreNear' => $order->store->location->near,
                   'orderStoreAnotherDetailsLocation' => $order->store->location->another_details,
                   'orderStoreLongitude' => $order->store->location->longitude,
                   'orderStoreLatitude' => $order->store->location->latitude,
                   'orderUserID' => $order->user->id,
                   'orderUserName' => $order->user->name,
                   'orderUserArea' => $order->userLocation->location->area,
                   'orderUserStreet' => $order->userLocation->location->street,
                   'orderUserNear' => $order->userLocation->location->near,
                   'orderUserAnotherDetailsLocation' => $order->userLocation->location->another_details,
                   'orderUserLongitude' => $order->userLocation->location->longitude,
                   'orderUserLatitude' => $order->userLocation->location->latitude,
                   'distanceBetweenStoreAndUser' => $distance,
                   'expectedTimeToCross' => $expectedTimeMinutes // in minutes
               ];
           }
       
           return $this->Data($additionalData, 'Finishing Order Details Retrieved Successfully', 200);
       }
       
       // Function to calculate distance using Haversine formula
       private function haversine($storeLat, $storeLong, $userLat, $userLong) {
           $earthRadius = 6371; // Earth's radius in kilometers
       
           $latDifference = deg2rad($userLat - $storeLat);
           $longDifference = deg2rad($userLong - $storeLong);
       
           $a = sin($latDifference/2) * sin($latDifference/2) + cos(deg2rad($storeLat)) * cos(deg2rad($userLat)) * sin($longDifference/2) * sin($longDifference/2);
           $c = 2 * atan2(sqrt($a), sqrt(1-$a));
       
           $distance = $earthRadius * $c / 10; // Distance in kilometers
       
           return $distance;
       }
  
}
