<?php

namespace App\Http\Controllers\Admin\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\User;
use App\Utils\ImageManager;
use Flasher\Laravel\Facade\Flasher;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::withCount(['posts'])->when(request()->keyword, function (Builder $query) {

            $query->where('name', 'like', '%' . request()->keyword . '%');

        })->when(request()->status, function (Builder $query) {

            $query->where('status', request()->status);

        })->orderBy(request('sort_by', 'id'), request('order_by', 'desc'))
            ->paginate(request('limit_by', 5))->withQueryString();

        return view('dashboard.pages.categories.index', compact('categories'));
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
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255', 'min:2', 'unique:categories,name'],
            'status' => ['required', 'in:active,inactive'],
        ]);

        if ($validator->fails()) {
            Flasher::addError('Failed to create category. Please check the form and try again.');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        if (!$category) {
            Flasher::addError('Category could not be created. Please try again.');
            return redirect()->back();
        }

        Flasher::addSuccess('Category created successfully.');
        return redirect()->route('admin.categories.index');
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
        $validator = Validator::make($request->all(), [
            'name' => [
                'required',
                'string',
                'max:255',
                'min:2',
                Rule::unique('categories')->ignore($id),
            ],
            'status' => ['required', 'in:active,inactive'],
        ]);

        if ($validator->fails()) {
            Flasher::addError('Failed to update category. Please check the form and try again.');
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        $category = Category::findOrFail($id);

        $updated = $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'status' => $request->status,
        ]);

        if (!$updated) {
            Flasher::addError('Failed to update category. Please try again.');
            return redirect()->back();
        }

        Flasher::addSuccess('Category updated successfully.');
        return redirect()->route('admin.categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            //delete user image and check
            $category = Category::findOrFail($id);

            $category->delete();

            return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully');

        } catch (\Exception $exception) {
            return redirect()->route('admin.categories.index')->with('error', 'Category not deleted');
        }
    }

    public function changeStatus($id)
    {
        $category = Category::findOrFail($id);


        if ($category->status == 'active') {
            $category->update([
                'status' => 'inactive',
            ]);
            return redirect()->back()->with('success', 'Category blocked successfully');
        } else {
            $category->update([
                'status' => 'active',
            ]);
            return redirect()->back()->with('success', 'Category Activated successfully');
        }

    }
}
