<?php

namespace App\Http\Controllers\Admin\Profile;

use App\Http\Controllers\Controller;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $adminID = Auth::guard('admin')->user()->id;
        $admin = Admin::where('id', $adminID)->first();
        return view('Admin.profile', compact('admin'));
    }

    public function update_personal_info(Request $request, $id)
    {
        $admin = Admin::findorfail($id);
        $admin->update([
            'name' => $request->input('name'),
            'age' => $request->input('age'),
        ]);

        return redirect()->back()->with('success_message', 'The Data Updated Successfully');
    }

    public function reset_password(Request $request, $id)
    {
        $admin = Admin::findorfail($id);

        if (Hash::check($request->current_password, $admin->password)) {

            $admin->password = Hash::make($request->new_password);
            $admin->save();


            return redirect()->back()->with('success_message', 'Password updated successfully.');
        } else {

            return redirect()->back()->with('error_message', 'Incorrect current password.');
        }
    }

    public function update_contact_info(Request $request, $id)
    {
        $admin = Admin::findorfail($id);
        $admin->update([
            'phone' => $request->input('phone'),
        ]);

        return redirect()->back()->with('success_message', 'The Data Updated Successfully');
    }
}
