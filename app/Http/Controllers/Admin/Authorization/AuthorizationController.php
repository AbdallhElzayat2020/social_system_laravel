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
        $roles = Authorization::when(request()->keyword, function (Builder $query) {

            $query->where('role_name', 'like', '%' . request()->keyword . '%')
                ->orWhere('permissions', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {
            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

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
            return redirect()->back()->with('error', 'Failed to create authorization.');
        }
        return redirect()->route('admin.authorizations.index')->with('success', 'Authorization created successfully.');


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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
