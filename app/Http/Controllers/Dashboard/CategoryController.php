<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Requests\CategoryRequest;
use App\Models\Image;
use App\Models\Category;
use App\Traits\UploadImageTrait;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoryController extends Controller
{
    use UploadImageTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $query = Category::query();
        // // request()->query('search)
        // if ($search = request("search")) {
        //     $query->where("name", "like", "%{$search}%");
        // }

        // if ($status = request("status")) {
        //     $query->where("status", $status);
        // }

        // $categories = Category::leftJoin("categories as parents", "categories.parent_id", "=", "parents.id")
        //     ->select([
        //         'categories.*',
        //         'parents.name as parent_name'
        //     ])
        //     ->filter(request()->query())->paginate();

        $categories = Category::with('parent')
            ->select('categories.*')
            // ->selectRaw('(SELECT COUNT(*) FROM products WHERE category_id = categories.id) as product_count')
            ->withCount('products') // return count in new column (products_count) => name of relation  _ count
            ->filter(request()->query())->paginate();

        return view("dashboard.categories.index", compact("categories"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        return view('dashboard.categories.create', [
            'parents' => Category::active()->pluck('name', 'id'),
            'category' => new Category()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request)
    {

        try {
            DB::beginTransaction();

            $category = Category::create($request->all());


            $this->uploadImage($request, 'uploads', 'categories', 'image', 'App\Models\Category', $category->id);
            DB::commit();

            flash()->success('created successfully');
            return redirect()->route('dashboard.categories.index');
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $products_in_category = $category->products()->with('store')->latest()->paginate();
        return view('dashboard.categories.show', compact('category', 'products_in_category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parents = Category::active()->where('id', '<>', $category->id)
            ->where(function ($query) use ($category) {
                $query->where('parent_id', '<>', $category->id)
                    ->orWhereNull('parent_id');
            })
            ->get();

        return view('dashboard.categories.edit', [
            'parents' => $parents,
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, Category $category)
    {

        try {
            DB::beginTransaction();

            if ($request->hasFile('image')) {
                $image = Image::where('imageable_id', $category->id)->first();
                if ($image) {
                    $this->deleteImage('uploads', $image->url, $category->id);
                }
                $this->uploadImage($request, 'uploads', 'categories', 'image', 'App\Models\Category', $category->id);
            }

            $category->update($request->all());

            DB::commit();
            flash()->success('updated successfully');
            return redirect()->route('dashboard.categories.index');

        } catch (\Exception $e) {

            DB::rollBack();

            flash()->error($e->getMessage());
            return redirect()->back();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $image = Image::where('imageable_id', $category->id)->first();

        if ($image) {
            $this->deleteImage('uploads', $image->url, $category->id);
        }
        $category->delete();

        flash()->success('deleted successfully');

        return redirect()->back();
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->paginate();
        return view('dashboard.categories.trash', compact('categories'));
    }

    public function restore($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->restore();
        flash()->success('restored successfully');
        return redirect()->back();
    }

    public function forceDelete($id)
    {
        $category = Category::onlyTrashed()->findOrFail($id);
        $category->forceDelete();
        flash()->success('deleted successfully');
        return redirect()->back();
    }
}
