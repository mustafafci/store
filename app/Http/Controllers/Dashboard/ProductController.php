<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Store;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    protected $rules = [
        'name' => ['required', 'string', 'min:3', 'max:255'],
        'status' => ['required', 'in:active,draft,archived'],
        'category_id' => ['required', 'integer', 'exists:categories,id'],
        'store_id' => ['required', 'integer', 'exists:stores,id'],
        'price' => ['required', 'numeric', 'lte:compare_price'],
        'compare_price' => ['required', 'numeric']
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'store'])->latest()->paginate();
        return view("dashboard.products.index", compact("products"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::active()->pluck('name', 'id');
        $stores = Store::active()->pluck('name', 'id');
        $product = new Product();
        return view('dashboard.products.create', compact('categories', 'stores', 'product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate($this->rules);

        // $request->merge([
        //     'slug' => Str::slug($request->name)
        // ]);

        $product = Product::create($request->except('tags'));

        $tags = json_decode($request->tags);
        $tags = collect($tags)->pluck('value')->toArray();

        $saved_tags = Tag::all();
        $tag_ids = [];

        if ($tags) {
            foreach ($tags as $tag_name) {
                $tag = $saved_tags->where('name', $tag_name)->first();
                if (!$tag) {
                    $tag = Tag::create([
                        'name' => $tag_name,
                        'slug' => Str::slug($tag_name)
                    ]);
                }

                $tag_ids[] = $tag->id;
            }
        }

        $product->tags()->sync($tag_ids);

        flash()->success('created successfully');

        return redirect()->route('dashboard.products.index');

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
    public function edit(Product $product)
    {
        $categories = Category::active()->pluck('name', 'id');
        $stores = Store::active()->pluck('name', 'id');

        return view('dashboard.products.edit', compact('product', 'categories', 'stores'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate($this->rules);

        if ($request->featured) {
            $request->merge([
                'featured' => true
            ]);
        }

        $product->update($request->except('tags'));

        $tags = json_decode($request->tags);
        $tags = collect($tags)->pluck('value')->toArray();

        $saved_tags = Tag::all();
        $tag_ids = [];
        if ($tags) {
            foreach ($tags as $tag_name) {

                $tag = $saved_tags->where('name', $tag_name)->first();
                //   echo $tag;
                if (is_null($tag)) {
                    $tag = Tag::create([
                        'name' => $tag_name,
                        'slug' => Str::slug($tag_name)
                    ]);

                }
                $tag_ids[] = $tag->id;
            }
        }
        //dd($tag_ids);
        $product->tags()->sync($tag_ids);

        flash()->success('updated_successfully');
        return redirect()->route('dashboard.products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


}
