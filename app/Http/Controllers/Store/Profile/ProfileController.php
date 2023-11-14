<?php

namespace App\Http\Controllers\Store\Profile;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $storeID = Auth::guard('store')->user()->id;
        $store = Store::where('id', $storeID)->first();
        return view('Store.profile', compact('store'));
    }

    public function update_personal_info(Request $request, $id)
    {
        $store = Store::findorfail($id);
        $store->update([
            'name' => $request->input('name'),
            'openTime' => $request->input('openTime'),
            'closeTime' => $request->input('closeTime'),
            'type' => $request->input('type'),
        ]);

        return redirect()->back()->with('success_message', 'The Data Updated Successfully');
    }

    public function reset_password(Request $request, $id)
    {
        $store = Store::findorfail($id);

        if (Hash::check($request->current_password, $store->password)) {

            $store->password = Hash::make($request->new_password);
            $store->save();


            return redirect()->back()->with('success_message', 'Password updated successfully.');
        } else {

            return redirect()->back()->with('error_message', 'Incorrect current password.');
        }
    }

    public function update_contact_info(Request $request, $id)
    {
        $store = Store::findorfail($id);
        $store->update([
            'phone' => $request->input('phone'),
        ]);

        return redirect()->back()->with('success_message', 'The Data Updated Successfully');
    }

    public function update_address_info($id, Request $request)
    {
        $store = Store::findOrFail($id);
        $location = Location::findOrFail($store->location_id);
        $location->update([
            'name' => $request->input('locationName'),
            'area' => $request->input('area'),
            'street' => $request->input('street'),
            'floor' => $request->input('floor'),
            'near' => $request->input('near'),
            'another_details' => $request->input('details'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
        ]);

        return redirect()->back()->with('success_message', 'Location Updated Successfully');
    }
}
