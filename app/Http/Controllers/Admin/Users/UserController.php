<?php

namespace App\Http\Controllers\Admin\Users;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\UserRequest;
use App\Models\User;
use App\Utils\ImageManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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
        return view('dashboard.pages.users.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UserRequest $request)
    {
        $request->validated();
        try {
            DB::beginTransaction();
            $request->merge([
                'email_verified_at' => $request->email_verified_at == 1 ? now() : null,
            ]);
            $user = User::create($request->except(['_token', 'image', 'password_confirmation']));
            // upload image
            ImageManager::uploadImages($request, null, $user);

            DB::commit();
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()->back()->with('error', $exception->getMessage());
        }

        return to_route('admin.users.index')->with('success', 'User created successfully');
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
        $user = User::findorFail($id);
        return view('dashboard.pages.users.show', compact('user'));
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
