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

        $orders = Order::where('id' , $orderID)->get();

        return $this->Data($orders, 'Order Stored Successfully', 200);
    }
}
