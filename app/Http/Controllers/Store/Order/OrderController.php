<?php

namespace App\Http\Controllers\Store\Order;

use App\Http\Controllers\Controller;
use App\Models\DeliveryAgent;
use App\Models\DeliveryAgentLocation;
use App\Models\DeliveryAgentOrder;
use App\Models\Location;
use App\Models\Order;
use App\Models\Order_Details;
use App\Models\UserD_Location;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function new_order()
    {
        $store_id = Auth::guard('store')->user()->id;
        $orders = Order::with('orderDetails', 'user', 'userLocation')->where('store_id', $store_id)->Where('order_status', "pending store accept")->orwhere('order_status', 'pending delivery agent accept')->get();
        $orderLocationDetails = [];

        foreach ($orders as $order) {
            $user_location_id = $order->user_location_id;

            $location_details = UserD_Location::where('id', $user_location_id)->pluck('location_id');
            $location_details = Location::whereIn('id', $location_details)->get();

            $orderLocationDetails[$order->id] = $location_details;
        }

        // dd($orders);
        return view('Store.Order.newOrder', compact('orders', 'orderLocationDetails'));
    }


    // public function accept_new_order($id)
    // {

    //     $order = Order::findOrfail($id);
    //     if ($order) {
    //         $order->update([
    //             'order_status' => "pending delivery agent accept"
    //         ]);

    //         return redirect()->back()->with('success_message', 'Order Accepted Successfully');
    //     } else {
    //         return redirect()->back()->with('error_message', 'Order Not Found');
    //     }
    // }


    public function accept_new_order($id)
    {
        // Step 1: Find the order
        $order = Order::findOrFail($id);

        // Step 2: Check if the order exists
        if (!$order) {
            return redirect()->back()->with('error_message', 'Order Not Found');
        }

        // Step 3: Select Available Delivery Agents
        $availableAgents = DeliveryAgent::where('status_accept_order', 1)->get();

        // Step 4: Check if there are available agents
        if ($availableAgents->isEmpty()) {
            return redirect()->back()->with('error_message', 'No available delivery agents.');
        }

        // Step 5: Calculate Distance
        $storeLocation = [
            'latitude' => $order->store->location->latitude,
            'longitude' => $order->store->location->longitude,
        ];

        $agentDistances = [];

        foreach ($availableAgents as $agent) {
            $earthRadius = 6371; // Earth's radius in kilometers

            // Check if delivery agent location is available
            if ($agent->deliveryAgentLocation) {
                $lat1 = deg2rad(($agent->deliveryAgentLocation->latitudeStart + $agent->deliveryAgentLocation->latitudeEnd) / 2);
                $lon1 = deg2rad(($agent->deliveryAgentLocation->longitudeStart + $agent->deliveryAgentLocation->longitudeEnd) / 2);
                $lat2 = deg2rad($storeLocation['latitude']);
                $lon2 = deg2rad($storeLocation['longitude']);

                $deltaLat = $lat2 - $lat1;
                $deltaLon = $lon2 - $lon1;

                $a = sin($deltaLat / 2) ** 2 + cos($lat1) * cos($lat2) * sin($deltaLon / 2) ** 2;
                $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

                $distance = $earthRadius * $c;

                $agentDistances[$agent->id] = $distance;
            } else {
                // If delivery agent location is not available, assign a large distance
                $agentDistances[$agent->id] = PHP_FLOAT_MAX;
            }
        }

        // Step 6: Sort Agents by Distance
        $sortedAgents = $availableAgents->sortBy(function ($agent) use ($agentDistances) {
            return $agentDistances[$agent->id];
        });

        // Step 7: Load Balancing
        $optimalAgent = $sortedAgents->first();

        // Step 8: Check if an optimal agent was found
        if (!$optimalAgent) {
            return redirect()->back()->with('error_message', 'No suitable delivery agent found.');
        }

        // Step 9: Assign Order to Selected Delivery Agent
        DeliveryAgentOrder::create([
            'details' => "no det",
            'status' => 0, // Set appropriate status value
            'expectedDeliveryTime' => 0,
            'realDeliveryTime' => 0, // Initial value
            'orderID' => $order->id,
            'deliveryAgentID' => $optimalAgent->id,
        ]);


        // Step 10: Update Delivery Agent Status
        $optimalAgent->update(['status' => 1]); // Set appropriate status value

        // Step 11: Update Order Status
        $order->update(['order_status' => 'pending delivery agent accept']);

        // Step 12: Return Response
        return redirect()->back()->with('success_message', 'Order Assigned Successfully');
    }







    public function refusal_new_order(Request $request, $id)
    {

        $order = Order::findOrfail($id);
        if ($order) {
            $order->update([
                'reason_of_refuse' => $request->input('refusal_reason'),
                'order_status' => 'refusal by store ',
            ]);

            return redirect()->back()->with('success_message', 'Order Refusal Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Order Not Found');
        }
    }

    public function refusal_order()
    {

        $store_id = Auth::guard('store')->user()->id;
        $orders = Order::with('orderDetails', 'user', 'userLocation')->where('store_id', $store_id)->Where('order_status', "refusal by store ")->get();
        $orderLocationDetails = [];

        foreach ($orders as $order) {
            $user_location_id = $order->user_location_id;

            $location_details = UserD_Location::where('id', $user_location_id)->pluck('location_id');
            $location_details = Location::whereIn('id', $location_details)->get();

            $orderLocationDetails[$order->id] = $location_details;
        }

        return view('Store.Order.refusalOrder', compact('orders', 'orderLocationDetails'));
    }

    public function active_order()
    {

        $store_id = Auth::guard('store')->user()->id;
        $orders = Order::with('orderDetails', 'user', 'userLocation')->where('store_id', $store_id)->Where('order_status', "accept delivery pending for preparation")->orwhere('order_status', 'preparing')->orwhere('order_status', 'finish preparation')->get();
        $orderLocationDetails = [];

        foreach ($orders as $order) {
            $user_location_id = $order->user_location_id;

            $location_details = UserD_Location::where('id', $user_location_id)->pluck('location_id');
            $location_details = Location::whereIn('id', $location_details)->get();

            $orderLocationDetails[$order->id] = $location_details;
        }

        return view('Store.Order.activeOrder', compact('orders', 'orderLocationDetails'));
    }

    public function start_preparation_active_order($id)
    {

        $order = Order::findOrfail($id);
        if ($order) {
            $order->update([
                'order_status' => 'preparing',
            ]);

            return redirect()->back()->with('success_message', 'Order Start Preparation  Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Order Not Found');
        }
    }

    public function finish_preparation_active_order($id)
    {

        $order = Order::findOrfail($id);
        if ($order) {
            $order->update([
                'order_status' => 'finish preparation',
            ]);

            return redirect()->back()->with('success_message', 'Order Finish Preparation  Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Order Not Found');
        }
    }

    public function approval_delivery_active_order(Request $request, $id)
    {

        $order = Order::findOrFail($id);
        $delivery_code = $request->input('delivered_code');
        $check_delivery_code = Order::where('id', $id)->where('delivered_code', $delivery_code)->count();

        if ($check_delivery_code > 0) {
            $order->update([
                'order_status' => 'finish store delivery in progress',
            ]);

            return redirect()->back()->with('success_message', 'The Order Was Successfully Delivered To The Delivery Agent');
        } else {
            return redirect()->back()->with('error_message', 'Delivery Code Not True');
        }
    }

    public function finish_order()
    {
        $store_id = Auth::guard('store')->user()->id;
        $orders = Order::with('orderDetails', 'user', 'userLocation')->where('store_id', $store_id)->Where('order_status', "finish store delivery in progress")->orwhere('order_status', 'delivered')->get();
        $orderLocationDetails = [];

        foreach ($orders as $order) {
            $user_location_id = $order->user_location_id;

            $location_details = UserD_Location::where('id', $user_location_id)->pluck('location_id');
            $location_details = Location::whereIn('id', $location_details)->get();

            $orderLocationDetails[$order->id] = $location_details;
        }

        return view('Store.Order.finishOrder', compact('orders', 'orderLocationDetails'));
    }

    // public function new_order_accept_delivery($id)
    // {
    //     $order = Order::findOrfail($id);
    //     if ($order) {
    //         $order->update([
    //             'order_status' => 'accept delivery pending for preparation',
    //         ]);

    //         return redirect()->back()->with('success_message', 'Order Accepted By Delivery Agent Successfully');
    //     } else {
    //         return redirect()->back()->with('error_message', 'Order Not Found');
    //     }
    // }
}
