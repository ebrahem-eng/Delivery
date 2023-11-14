<?php

namespace App\Http\Controllers\Store\Catigory;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Catigory\CreateCatigoryRequest;
use App\Models\Catigory;
use Illuminate\Http\Request;

class CatigoryController extends Controller
{
    public function index()
    {
        $catigories = Catigory::where('type', '0')->get();
        return view('Store.Catigory.index' , compact('catigories'));
    }

    public function create()
    {
        return view('Store.Catigory.create');
    }

    public function store(CreateCatigoryRequest $request)
    {
        $catigoryName = $request->input('name');
        $checkName = Catigory::where('name', $catigoryName)->get();
        if (count($checkName) > 0) {
            return redirect()->back()->with('error_message', 'Catigory Already Exists');
        }

        Catigory::create([
            'name' => $catigoryName,
            'type' => '0',
        ]);

        return redirect()->route('store.catigory.index')->with('success_message', 'Catigory Created Successfully');
    }

    public function edit($id)
    {
        $catigory = Catigory::findOrfail($id);
        return view('Store.Catigory.edit' , compact('catigory'));
    }

    public function update(CreateCatigoryRequest $request ,$id)
    {
        $catigory = Catigory::findOrfail($id);
        $catigory->update([
            'name' => $request->input('name'),
        ]);  

        return redirect()->route('store.catigory.index')->with('success_message', 'Catigory Updated Successfully');
    }

    public function archive()
    {
        $catigories = Catigory::onlyTrashed()->get();
        return view('Store.Catigory.archive', compact('catigories'));
    }

    public function soft_delete($id)
    {
        $catigory = Catigory::findOrFail($id);

        $catigory->delete();

        return redirect()->route('store.catigory.index')->with('success_message', 'Catigory Deleted Successfully');
    }

    public function force_delete($id)
    {
        $catigory = Catigory::withTrashed()->where('id', $id)->first();
        if ($catigory) {
    
            $catigory->forceDelete();
            
            return redirect()->route('store.catigory.archive')->with('success_message', 'Catigory Deleted Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Catigory Not Found');
        }
    }

    public function restore($id)
    {
        Catigory::withTrashed()->where('id', $id)->restore();

        return redirect()->route('store.catigory.archive')->with('success_message', 'Catigory Restored Successfully');
    }
}
