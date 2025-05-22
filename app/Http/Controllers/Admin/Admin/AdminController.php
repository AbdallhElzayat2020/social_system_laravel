<?php

namespace App\Http\Controllers\Admin\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AdminRequest;
use App\Models\Admin;
use App\Models\Authorization;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = auth()->guard('admin')->user()->id;

        $admins = Admin::where('id', '!=', $user)
            ->when(request()->keyword, function (Builder $query) {

                $query->where('name', 'like', '%' . request()->keyword . '%')
                    ->orWhere('email', 'like', '%' . request()->keyword . '%')
                    ->orWhere('username', 'like', '%' . request()->keyword . '%');

            })->when(request()->status, function (Builder $query) {
                $query->where('status', request()->status);

            })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('dashboard.pages.admins.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $roles = Authorization::select(['id', 'role_name'])->get();
        return view('dashboard.pages.admins.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AdminRequest $request)
    {
        $admin = Admin::create($request->only([
            'name',
            'email',
            'username',
            'password',
            'status',
            'phone',
            'role_id',
        ]));
        if (!$admin) {
            return redirect()->back()->with('error', 'try again later');
        }
        return redirect()->route('admin.admins.index')->with('success', 'created successfully');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $admin = Admin::findOrFail($id);
        $roles = Authorization::select(['id', 'role_name'])->get();

        return view('dashboard.pages.admins.edit', compact('admin', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(AdminRequest $request, string $id)
    {
        $admin = Admin::findOrFail($id);

        $admin->update($request->except(['_token', '_method', 'password_confirmation']));
        if ($request->password) {
            $admin->update([
                'password' => bcrypt($request->password),
            ]);
        }

        if (!$admin) {
            return redirect()->back()->with('error', 'try again later');
        }

        return to_route('admin.admins.index')->with('success', 'updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //delete user image and check
            $admin = Admin::findOrFail($id);

            $admin->delete();

            if (!$admin) {
                return redirect()->route('admin.admins.index')->with('error', 'try again later');
            }

            return redirect()->route('admin.admins.index')->with('success', 'deleted successfully');

        } catch (\Exception $exception) {
            return redirect()->route('admin.admins.index')->with('error', 'not deleted');
        }
    }

    public function changeStatus($id)
    {
        $admin = Admin::findOrFail($id);


        if ($admin->status == 'active') {
            $admin->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'Admin blocked successfully');
        } else {
            $admin->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'Admin Activated successfully');
        }

    }
}
