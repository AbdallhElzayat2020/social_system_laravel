<?php

namespace App\Http\Controllers\Admin\Authorization;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\AuthorizationRequest;
use App\Models\Admin;
use App\Models\Authorization;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class AuthorizationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Authorization::paginate(5);

        return view('dashboard.pages.authorizations.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.pages.authorizations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AuthorizationRequest $request)
    {
        $authorization = Authorization::create([
            'role_name' => $request->role_name,
            'status' => $request->status,
            'permissions' => json_encode($request->permissions),
        ]);

        if (!$authorization) {
            return redirect()->back()->with('error', 'Failed to create.');
        }
        return to_route('admin.authorizations.index')->with('success', 'created successfully.');


    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $authorization = Authorization::findOrFail($id);
        return view('dashboard.pages.authorizations.edit', compact('authorization'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $authorization = Authorization::findOrFail($id);
        $authorization->update([
            'role_name' => $request->role_name,
            'status' => $request->status,
            'permissions' => json_encode($request->permissions),
        ]);


        if (!$authorization) {
            return redirect()->back()->with('error', 'Failed to update authorization.');
        }
        return to_route('admin.authorizations.index')->with('success', 'updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $role = Authorization::findOrFail($id);

            if ($role->admins->count() > 0) {
                return redirect()->back()->with('error', 'Failed to delete. This role is assigned to one or more admins.');
            }

            $role->delete();

            if (!$role) {
                return redirect()->back()->with('error', 'Failed to delete. Please try again.');
            }

        } catch (\Exception $exception) {
            return redirect()->back()->with('error', 'Failed to delete. Please try again.');
        }
        return to_route('admin.authorizations.index')->with('success', 'deleted successfully.');

    }

}
