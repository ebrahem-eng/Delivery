<?php

namespace App\Http\Controllers\Admin\Store;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Store\StoreRequest;
use App\Http\Requests\Admin\Store\UpdateStoreRequest;
use App\Models\Catigory;
use App\Models\Location;
use App\Models\Store;
use App\Models\Store_Catigory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class StoreController extends Controller
{

    public function index()
    {
        $stores = Store::with('admin')->get();
        return view('Admin.Store.index', compact('stores'));
    }

    public function create()
    {
        $catigories = Catigory::where('type', '1')->get();
        return view('Admin.Store.create', compact('catigories'));
    }

    public function store(StoreRequest $request)
    {

        $password = $request->input('password');
        $admin_id = Auth::guard('admin')->user()->id;
        $email = $request->input('email');
        $phone = $request->input('phone');
        $image = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('StoreImage', $image, 'storeImage');

        $check_email = Store::where('email', $email)->get();
        $check_phone = Store::where('phone', $phone)->get();

        if (count($check_email) > 0) {
            return redirect()->back()->with('error_message', 'Store Email Already Exists');
        } elseif (count($check_phone) > 0) {

            return redirect()->back()->with('error_message', 'Store Phone Already Exists');
        }

        $location = Location::create([
            'name' => $request->input('locationName'),
            'area' => $request->input('area'),
            'street' => $request->input('street'),
            'floor' => $request->input('floor'),
            'near' => $request->input('near'),
            'another_details' => $request->input('details'),
            'longitude' => $request->input('longitude'),
            'latitude' => $request->input('latitude'),
        ]);

        $store = Store::create([
            'name' => $request->input('name'),
            'email' => $email,
            'password' => Hash::make($password),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'phone' => $phone,
            'openTime' => $request->input('openTime'),
            'closeTime' => $request->input('closeTime'),
            'img' => $path,
            'location_id' => $location->id,
            'created_by' => $admin_id,
        ]);

        $catigoryIDs = $request->input('catigoryID');

        foreach ($catigoryIDs as $catigoryID) {
            Store_Catigory::create([
                'store_id' => $store->id,
                'catigory_id' => $catigoryID
            ]);
        }

        return redirect()->route('admin.store.index')->with('success_message', 'Store Created Successfully');
    }

    public function edit($id)
    {
        $store = Store::findOrFail($id);
        $catigories = Catigory::where('type', '1')->get();
        $storeCatigoryIDs = Store_Catigory::where('store_id', $store->id)->pluck('catigory_id');
        return view('Admin.Store.edit', compact('store', 'catigories', 'storeCatigoryIDs'));
    }

    public function update(UpdateStoreRequest $request, $id)
    {
        $store = Store::findOrFail($id);

        if ($request->file('img') == null) {
            $store->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'type' => $request->input('type'),
                'status' => $request->input('status'),
                'openTime' => $request->input('openTime'),
                'closeTime' => $request->input('closeTime'),
                'phone' => $request->input('phone'),
            ]);

            $storeCatigory = Store_Catigory::where('store_id', $store->id)->get();
            $storeCatigory->each->delete();
            $catigoryIDs = $request->input('catigoryID');
            foreach ($catigoryIDs as $catigoryID) {
                Store_Catigory::create([
                    'store_id' => $store->id,
                    'catigory_id' => $catigoryID
                ]);
            }

            return redirect()->route('admin.store.index')->with('success_message', 'Store Updated Successfully');
        } else {
            if ($store->img != null) {
                Storage::disk('storeImage')->delete($store->img);
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('StoreImage', $image, 'storeImage');

                $store->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'type' => $request->input('type'),
                    'status' => $request->input('status'),
                    'openTime' => $request->input('openTime'),
                    'closeTime' => $request->input('closeTime'),
                    'phone' => $request->input('phone'),
                    'img' => $path,
                ]);

                $storeCatigory = Store_Catigory::where('store_id', $store->id)->get();
                $storeCatigory->each->delete();
                $catigoryIDs = $request->input('catigoryID');
                foreach ($catigoryIDs as $catigoryID) {
                    Store_Catigory::create([
                        'store_id' => $store->id,
                        'catigory_id' => $catigoryID
                    ]);
                }
                return redirect()->route('admin.store.index')->with('success_message', 'Store Updated Successfully');
            } else {

                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('StoreImage', $image, 'storeImage');

                $store->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'type' => $request->input('type'),
                    'status' => $request->input('status'),
                    'openTime' => $request->input('openTime'),
                    'closeTime' => $request->input('closeTime'),
                    'phone' => $request->input('phone'),
                    'img' => $path,
                ]);

                $storeCatigory = Store_Catigory::where('store_id', $store->id)->get();
                $storeCatigory->each->delete();
                $catigoryIDs = $request->input('catigoryID');
                foreach ($catigoryIDs as $catigoryID) {
                    Store_Catigory::create([
                        'store_id' => $store->id,
                        'catigory_id' => $catigoryID
                    ]);
                }

                return redirect()->route('admin.store.index')->with('success_message', 'Store Updated Successfully');
            }
        }
    }

    public function archive()
    {
        $stores = Store::onlyTrashed()->with('admin')->get();
        return view('Admin.Store.archive', compact('stores'));
    }


    public function editLocation($id)
    {
        $store = Store::findOrFail($id);
        return view('Admin.Store.editLocation', compact('store'));
    }

    public function updateLocation($id, Request $request)
    {
        $location = Location::findOrFail($id);
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

        return redirect()->route('admin.store.index')->with('success_message', 'Store Location Updated Successfully');
    }

    public function soft_delete($id)
    {
        $store = Store::findOrFail($id);

        $store->delete();

        return redirect()->route('admin.store.index')->with('success_message', 'Store Deleted Successfully');
    }

    public function force_delete($id)
    {
        $store = Store::withTrashed()->where('id', $id)->first();
        if ($store) {
            Storage::disk('storeImage')->delete($store->img);
            $store->forceDelete();

            return redirect()->route('admin.store.archive')->with('success_message', 'Store Deleted Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Store Not Found');
        }
    }

    public function restore($id)
    {
        Store::withTrashed()->where('id', $id)->restore();

        return redirect()->route('admin.store.archive')->with('success_message', 'Store Restored Successfully');
    }
}
