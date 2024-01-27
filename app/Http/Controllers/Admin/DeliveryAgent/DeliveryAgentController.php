<?php

namespace App\Http\Controllers\Admin\DeliveryAgent;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DeliveryAgent\CreateDeliveryAgentRequest;
use App\Http\Requests\Admin\DeliveryAgent\UpdateDeliveryAgentRequest;
use App\Models\DeliveryAgent;
use App\Models\DeliveryAgentLocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class DeliveryAgentController extends Controller
{
    public function index()
    {
        $deliveryAgents = DeliveryAgent::with('admin')->get();
        return view('Admin.DeliveryAgent.index', compact('deliveryAgents'));
    }

    public function create()
    {
        return view('Admin.DeliveryAgent.create');
    }

    public function store(CreateDeliveryAgentRequest $request)
    {
        $password = $request->input('password');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $adminID = Auth::guard('admin')->user()->id;
        $image = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('DeliveryAgentImage', $image, 'deliveryAgentImage');
        $locationName = $request->input('locationName');
        $latitudeStart = $request->input('latitudeStart');
        $latitudeEnd = $request->input('latitudeEnd');
        $longitudeStart = $request->input('longitudeStart');
        $longitudeEnd = $request->input('longitudeEnd');

        $locationDelivery = DeliveryAgentLocation::create([
        'name' => $locationName,
        'longitudeStart' => $longitudeStart,
        'longitudeEnd' => $longitudeEnd,
        'latitudeStart' => $latitudeStart,
        'latitudeEnd' => $latitudeEnd,
        ]);

        $locationDeliveryID = $locationDelivery->id;
        

        $check_email = DeliveryAgent::where('email', $email)->get();
        $check_phone = DeliveryAgent::where('phone', $phone)->get();

        if (count($check_email) > 0) {
            return redirect()->back()->with('error_message', 'Delivery Agent Email Already Exists');
        } elseif (count($check_phone) > 0) {

            return redirect()->back()->with('error_message', 'Delivery Agent Phone Already Exists');
        }

        DeliveryAgent::create([
            'name' => $request->input('name'),
            'email' => $email,
            'password' => Hash::make($password),
            'status_accept_order' => $request->input('status_accept_order'),
            'status' => $request->input('status'),
            'phone' => $phone,
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'img' => $path,
            'deliveryAgentLocationID' => $locationDeliveryID,
            'created_by' => $adminID,
        ]);

        return redirect()->route('admin.delivery.agent.index')->with('success_message', 'Delivery Agent Created Successfully');
    }

    public function edit($id)
    {
        $deliveryAgent = DeliveryAgent::findOrFail($id);

        return view('Admin.DeliveryAgent.edit', compact('deliveryAgent'));
    }

    public function update(UpdateDeliveryAgentRequest $request, $id)
    {
        $deliveryAgent = DeliveryAgent::findOrFail($id);

        if ($request->file('img') == null) {
            $deliveryAgent->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'status_accept_order' => $request->input('status_accept_order'),
                'status' => $request->input('status'),
                'phone' => $request->input('phone'),
                'gender' => $request->input('gender'),
                'age' => $request->input('age'),
            ]);
            return redirect()->route('admin.delivery.agent.index')->with('success_message', 'Delivery Agent Updated Successfully');
        } else {
            if ($deliveryAgent->img != null) {
                Storage::disk('deliveryAgentImage')->delete($deliveryAgent->img);
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('DeliveryAgentImage', $image, 'deliveryAgentImage');

                $deliveryAgent->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'status_accept_order' => $request->input('status_accept_order'),
                    'status' => $request->input('status'),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'age' => $request->input('age'),
                    'img' => $path,
                ]);
                return redirect()->route('admin.delivery.agent.index')->with('success_message', 'Delivery Agent Updated Successfully');
            } else {
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('DeliveryAgentImage', $image, 'deliveryAgentImage');

                $deliveryAgent->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'status_accept_order' => $request->input('status_accept_order'),
                    'status' => $request->input('status'),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'age' => $request->input('age'),
                    'img' => $path,
                ]);
                return redirect()->route('admin.delivery.agent.index')->with('success_message', 'Delivery Agent Updated Successfully');
            }
        }
    }

    public function archive()
    {
        $deliveryAgents = DeliveryAgent::onlyTrashed()->with('admin')->get();
        return view('Admin.DeliveryAgent.archive', compact('deliveryAgents'));
    }

    public function soft_delete($id)
    {
        $deliveryAgent = DeliveryAgent::findOrFail($id);

        $deliveryAgent->delete();

        return redirect()->route('admin.delivery.agent.index')->with('success_message', 'Delivery Agent Deleted Successfully');
    }

    public function force_delete($id)
    {
        $deliveryAgent = DeliveryAgent::withTrashed()->where('id', $id)->first();
        if ($deliveryAgent) {
            Storage::disk('deliveryAgentImage')->delete($deliveryAgent->img);

            $deliveryAgent->forceDelete();

            return redirect()->route('admin.delivery.agent.archive')->with('success_message', 'Delivery Agent Deleted Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Delivery Agent  Not Found');
        }
    }

    public function restore($id)
    {
        DeliveryAgent::withTrashed()->where('id', $id)->restore();

        return redirect()->route('admin.delivery.agent.archive')->with('success_message', 'Delivery Agent Restored Successfully');
    }
}
