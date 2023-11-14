<?php

namespace App\Http\Controllers\Admin\DiscountCode;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\DiscountCode\CreateDiscountCodeRequest;
use App\Http\Requests\Admin\DiscountCode\UpdateDiscountCodeRequest;
use App\Models\DiscountCode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscountCodeController extends Controller
{
    
    public function index()
    {
        $discountCodes = DiscountCode::with('admin')->get();
        return view('Admin.DiscountCode.index', compact('discountCodes'));
    }

    public function create()
    {
        return view('Admin.DiscountCode.create');
    }

    public function store(CreateDiscountCodeRequest $request)
    {
        $adminID = Auth::guard('admin')->user()->id;
        $code_name = $request->input('code_name');

        $check_code_exists = DiscountCode::where('code_name',$code_name)->first();

        if($check_code_exists)
        {
            return redirect()->back()->with('error_message', 'Discount Code Already Exists');
        }

        DiscountCode::create([
            'code_name' => $code_name,
            'discount_value' => $request->input('discount_value'),
            'status' => $request->input('status'),
            'created_by' => $adminID
        ]);

        return redirect()->route('admin.discount.code.index')->with('success_message', 'Discount Code Created Successfully');
    }

    public function edit($id)
    {
        $discountCode = DiscountCode::findOrFail($id);

        return view('Admin.DiscountCode.edit', compact('discountCode'));
    }

    public function update(UpdateDiscountCodeRequest $request, $id)
    {
        $discountCode = DiscountCode::findOrFail($id);
        $discountCode->update([
            'code_name' => $request->input('code_name'),
            'discount_value' => $request->input('discount_value'),
            'status' => $request->input('status'),
        ]);

        return redirect()->route('admin.discount.code.index')->with('success_message', 'Discount Code Updated Successfully');
    }

    public function archive()
    {
        $discountCodes = DiscountCode::onlyTrashed()->get();
        return view('Admin.DiscountCode.archive', compact('discountCodes'));
    }

    public function soft_delete($id)
    {
        $discountCode = DiscountCode::findOrFail($id);

        $discountCode->delete();

        return redirect()->route('admin.discount.code.index')->with('success_message', 'Discount Code Deleted Successfully');
    }

    public function force_delete($id)
    {
        DiscountCode::withTrashed()->where('id', $id)->forceDelete();

        return redirect()->route('admin.discount.code.archive')->with('success_message', 'Discount Code Deleted Successfully');
    }

    public function restore($id)
    {
        DiscountCode::withTrashed()->where('id', $id)->restore();

        return redirect()->route('admin.discount.code.archive')->with('success_message', 'Discount Code Restored Successfully');
    }


}
