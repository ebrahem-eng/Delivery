<?php

namespace App\Http\Controllers\User\Order;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Trait\DataTrait;
use App\Models\Order;
use App\Models\Order_Details;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class OrderController extends Controller
{
    use DataTrait;

    //مجموع طلبات المستخدم 

    public function get_count_order()
    {
        $countOrder = Order::where('user_id', Auth::guard('userD')->user()->id)->count();
        return $this->Data($countOrder, 'Count Order Retrieved Successfully', 200);
    }

    //ارسال الطلب الى المتجر

    public function storeOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'deliveryFee' => 'required',
            'typePayment' => 'required',
            'deliveryTips' => 'required',
            'voucher' => 'required',
            'tax' => 'required',
            'totalAmmount' => 'required',
            'userLocationId' => 'required',
            // 'storeId' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $orderStatus = 'pending store accept';
        $type = 'Internal';
        $deliveryFee = $request->input('deliveryFee');
        $typePayment = $request->input('typePayment');
        $deliveryTips = $request->input('deliveryTips');
        $voucher = $request->input('voucher');
        $tax = $request->input('tax');
        $totalAmmount = $request->input('totalAmmount');
        $userLocationId = $request->input('userLocationId');
        $storeId = $request->input('storeId');
        $userId = Auth::guard('userD')->user()->id;

        $order = Order::create([
            'order_status' => $orderStatus,
            'type' => $type,
            'deliveryFee' => $deliveryFee,
            'typePayment' => $typePayment,
            'deliveryTips' => $deliveryTips,
            'voucher' => $voucher,
            'tax' => $tax,
            'totalAmmount' => $totalAmmount,
            'user_location_id' => $userLocationId,
            'store_id' => $storeId,
            'user_id' => $userId,
        ]);

        $orderID = $order->id;


        // Iterate over the arrays and insert each element into the database
        foreach ($request->input('productId') as $key => $productId) {
            Order_Details::create([
                'product_price' => $request->input('productPrice')[$key],
                'product_note' => $request->input('productNote')[$key],
                'quantity' => $request->input('quantity')[$key],
                'productTotalAmount' => $request->input('productTotalAmount')[$key],
                'product_id' => $productId,
                'order_id' => $orderID,
            ]);
        }

        $orders = Order::where('id', $orderID)->get();

        return $this->Data($orders, 'Order Stored Successfully', 200);
    }


    //احضار الطلبات النشطة

    public function getActiveOrder()
    {
        $userID = Auth::guard('userD')->user()->id;

        $orders = Order::where('user_id', $userID)->get();

        $additionalData = [];

        foreach ($orders as $order) {
            $orderDetailsData = [];
            foreach ($order->orderDetails as $orderDetails) {
                $orderDetailsData[] = [
                    'productPrice' => $orderDetails->product_price,
                    'productNote' => $orderDetails->product_note,
                    'quantity' => $orderDetails->quantity,
                    'productTotalAmount' => $orderDetails->productTotalAmount,
                ];
            }

            $additionalData[] = [
                'id' => $order->id,
                'orderStatus' => $order->order_status,
                'orderType' => $order->type,
                'orderStoreName' => $order->store->name,
                'receiptCode' => $order->receipt_code,
                'orderCreatedAt' => $order->created_at,
                'orderDetails' => $orderDetailsData,
            ];
        }

        return $this->Data($additionalData, 'Active Order Retrieved Successfully', 200);
    }


    //احضار تفاصيل الطلبات النشطة

    public function getActiveOrderDetails(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'orderID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        //    $userID = Auth::guard('userD')->user()->id;
        $orderID = $request->input('orderID');

        $orders = Order::where('id', $orderID)->get();

        $additionalData = [];

        foreach ($orders as $order) {
            $orderDetailsData = [];
            foreach ($order->orderDetails as $orderDetails) {
                $orderDetailsData[] = [
                    'orderDetailsID' => $orderDetails->id,
                    'productName' => $orderDetails->productOrderDetails->name,
                    'productPrice' => $orderDetails->product_price,
                    'productNote' => $orderDetails->product_note,
                    'quantity' => $orderDetails->quantity,
                    'productTotalAmount' => $orderDetails->productTotalAmount,
                ];
            }

            $additionalData[] = [
                'id' => $order->id,
                'orderStatus' => $order->order_status,
                'orderType' => $order->type,
                'orderReasonOfRefuse' => $order->reason_of_refuse,
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
                'orderStoreName' => $order->store->name,
                'orderCreatedAt' => $order->created_at,
                'orderLocationName' => $order->userLocation->location->name,
                'orderLocationArea' => $order->userLocation->location->area,
                'orderLocationStreet' => $order->userLocation->location->street,
                'orderLocationFloor' => $order->userLocation->location->floor,
                'orderLocationNear' => $order->userLocation->location->near,
                'orderLocationDetails' => $order->userLocation->location->another_details,
                'orderDetails' => $orderDetailsData,

            ];
        }

        return $this->Data($additionalData, 'Active Order Details Retrieved Successfully', 200);
    }

    //احضار بيانات الطلب عند التتبع 

    public function trackActiveOrder(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'orderID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $orderID = $request->input('orderID');
        $randomCode = rand(10000, 99999);

        $orderUpdate = Order::findOrfail($orderID);

        $orderUpdate->update([
            'receipt_code' => $randomCode
        ]);

        $orders = Order::where('id', $orderID)->get();

        $additionalData = [];

        foreach ($orders as $order) {
            $orderDetailsData = [];
            foreach ($order->orderDetails as $orderDetails) {
                $orderDetailsData[] = [
                    'orderDetailsID' => $orderDetails->id,
                    'productName' => $orderDetails->productOrderDetails->name,
                    'productPrice' => $orderDetails->product_price,
                    'productNote' => $orderDetails->product_note,
                    'quantity' => $orderDetails->quantity,
                    'productTotalAmount' => $orderDetails->productTotalAmount,
                ];
            }

            $deliveryDetailsData = [];
            foreach ($order->deliveryAgentOrder as $orderDeliveryDetails) {
                if ($orderDeliveryDetails->status == 1) {
                    $deliveryDetailsData[] = [
                        'deliveryDetailsID' => $orderDeliveryDetails->id,
                        'details' => $orderDeliveryDetails->details,
                        'status' => $orderDeliveryDetails->status,
                        'expectedDeliveryTime' => $orderDeliveryDetails->expectedDeliveryTime,
                        'realDeliveryTime' => $orderDeliveryDetails->realDeliveryTime,
                        'deliveryID' => $orderDeliveryDetails->deliveryAgent->id,
                        'deliveryName' => $orderDeliveryDetails->deliveryAgent->name,
                        'deliveryPhone' => $orderDeliveryDetails->deliveryAgent->phone,
                    ];
                }
            }

            $additionalData[] = [
                'id' => $order->id,
                'orderStatus' => $order->order_status,
                'orderType' => $order->type,
                'orderReasonOfRefuse' => $order->reason_of_refuse,
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
                'orderStoreName' => $order->store->name,
                'orderCreatedAt' => $order->created_at,
                'orderLocationName' => $order->userLocation->location->name,
                'orderLocationArea' => $order->userLocation->location->area,
                'orderLocationStreet' => $order->userLocation->location->street,
                'orderLocationFloor' => $order->userLocation->location->floor,
                'orderLocationNear' => $order->userLocation->location->near,
                'orderLocationDetails' => $order->userLocation->location->another_details,
                'orderDetails' => $orderDetailsData,
                'deliveryDetails' => $deliveryDetailsData,
            ];
        }

        return $this->Data($additionalData, 'Track Order Details Retrieved Successfully', 200);
    }


    //احضار الكود لاعطاءه لعامل التوصيل

    public function getCodeOrder(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'orderID' => 'required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        $orderID = $request->input('orderID');


        $orders = Order::where('id', $orderID)->get();

        $additionalData = [];

        foreach ($orders as $order) {
            $orderDetailsData = [];
            foreach ($order->orderDetails as $orderDetails) {
                $orderDetailsData[] = [
                    'productPrice' => $orderDetails->product_price,
                    'productNote' => $orderDetails->product_note,
                    'quantity' => $orderDetails->quantity,
                    'productTotalAmount' => $orderDetails->productTotalAmount,
                ];
            }

            $additionalData[] = [
                'id' => $order->id,
                'orderStatus' => $order->order_status,
                'orderType' => $order->type,
                'orderStoreName' => $order->store->name,
                'receiptCode' => $order->receipt_code,
                'orderCreatedAt' => $order->created_at,
                'orderDetails' => $orderDetailsData,
            ];
        }

        return $this->Data($additionalData, 'Active Order Retrieved Successfully', 200);
    }
}
