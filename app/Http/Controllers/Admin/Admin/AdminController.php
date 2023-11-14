<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Admin\CreateAdminRequest;
use App\Http\Requests\Admin\Admin\UpdateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{

    public function index()
    {
        $admins = Admin::all();
        return view('Admin.Admin.index', compact('admins'));
    }

    public function create()
    {
        return view('Admin.Admin.create');
    }

    public function store(CreateAdminRequest $request)
    {
        $password = $request->input('password');
        $email = $request->input('email');
        $phone = $request->input('phone');
        $image = $request->file('img')->getClientOriginalName();
        $path = $request->file('img')->storeAs('AdminImage', $image, 'adminImage');

        $check_email = Admin::where('email', $email)->get();
        $check_phone = Admin::where('phone', $phone)->get();

        if (count($check_email) > 0) {
            return redirect()->back()->with('error_message', 'Admin Email Already Exists');
        } elseif (count($check_phone) > 0) {

            return redirect()->back()->with('error_message', 'Admin Phone Already Exists');
        }

        Admin::create([
            'name' => $request->input('name'),
            'email' => $email,
            'password' => Hash::make($password),
            'type' => $request->input('type'),
            'status' => $request->input('status'),
            'phone' => $phone,
            'gender' => $request->input('gender'),
            'age' => $request->input('age'),
            'img' => $path,
        ]);

        return redirect()->route('admin.admin.index')->with('success_message', 'Admin Created Successfully');
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        return view('Admin.Admin.edit', compact('admin'));
    }

    public function update(UpdateAdminRequest $request, $id)
    {
        $admin = Admin::findOrFail($id);


        if ($request->file('img') == null) {
            $admin->update([
                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'type' => $request->input('type'),
                'status' => $request->input('status'),
                'phone' => $request->input('phone'),
                'gender' => $request->input('gender'),
                'age' => $request->input('age'),
            ]);

            return redirect()->route('admin.admin.index')->with('success_message', 'Admin Updated Successfully');
        } else {
            if ($admin->img != null) {
                Storage::disk('adminImage')->delete($admin->img);
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('AdminImage', $image, 'adminImage');

                $admin->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'type' => $request->input('type'),
                    'status' => $request->input('status'),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'age' => $request->input('age'),
                    'img' => $path,
                ]);

                return redirect()->route('admin.admin.index')->with('success_message', 'Admin Updated Successfully');
            } else {
                $image = $request->file('img')->getClientOriginalName();
                $path = $request->file('img')->storeAs('AdminImage', $image, 'adminImage');

                $admin->update([
                    'name' => $request->input('name'),
                    'email' => $request->input('email'),
                    'type' => $request->input('type'),
                    'status' => $request->input('status'),
                    'phone' => $request->input('phone'),
                    'gender' => $request->input('gender'),
                    'age' => $request->input('age'),
                    'img' => $path,
                ]);

                return redirect()->route('admin.admin.index')->with('success_message', 'Admin Updated Successfully');
            }
        }
    }

    public function archive()
    {
        $admins = Admin::onlyTrashed()->get();
        return view('Admin.Admin.archive', compact('admins'));
    }

    public function soft_delete($id)
    {
        $admin = Admin::findOrFail($id);
        $adminLoginID = Auth::guard('admin')->user()->id;

        if ($adminLoginID == $admin->id) {
            return redirect()->back()->with('error_message', 'You Cant Delete This Account Because You Are Logged In With Him');
        }

        $admin->delete();

        return redirect()->route('admin.admin.index')->with('success_message', 'Admin Deleted Successfully');
    }

    public function force_delete($id)
    {

        $admin = Admin::withTrashed()->where('id', $id)->first();
        if ($admin) {
            Storage::disk('adminImage')->delete($admin->img);
            $admin->forceDelete();
            return redirect()->route('admin.admin.archive')->with('success_message', 'Admin Deleted Successfully');
        } else {
            return redirect()->back()->with('error_message', 'Admin Not Found');
        }
    }

    public function restore($id)
    {
        Admin::withTrashed()->where('id', $id)->restore();

        return redirect()->route('admin.admin.archive')->with('success_message', 'Admin Restored Successfully');
    }
}
