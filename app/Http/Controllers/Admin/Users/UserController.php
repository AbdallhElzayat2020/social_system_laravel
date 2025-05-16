<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $users = User::when(request()->keyword, function (Builder $query) {

            $query->where('name', 'like', '%' . request()->keyword . '%')
                ->orWhere('email', 'like', '%' . request()->keyword . '%')
                ->orWhere('phone', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {
            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 3))->withQueryString();


        return view('dashboard.pages.users.index', compact('users'));
    }

    public function changeStatus($id)
    {
        $user = User::findOrFail($id);


        if ($user->status == 'active') {
            $user->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'User blocked successfully');
        } else {
            $user->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'User Activated successfully');
        }

    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        try {
            //delete user image and check
            $user = User::findOrFail($id);

            ImageManager::deleteImageFromLocal($user->image);
            $user->delete();

            return redirect()->route('admin.users.index')->with('success', 'User deleted successfully');

        } catch (\Exception $exception) {
            return redirect()->route('admin.users.index')->with('error', 'User not deleted');
        }
    }
}
