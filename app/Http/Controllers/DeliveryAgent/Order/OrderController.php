<?php

namespace App\Http\Controllers\DeliveryAgent\Order;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAgentOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Trait\DataTrait;
use Illuminate\Support\Facades\Validator;

class OrderController extends Controller
{

    use DataTrait;

    //احضار الطلبات الجديدة لعامل التوصيل

    public function getNewOrder()
    {
        $deliveryAgentID = Auth::guard('deliveryAgent')->user()->id;

        $newOrders = DeliveryAgentOrder::with('order.user')->where('deliveryAgentID', $deliveryAgentID)->get();

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
}
