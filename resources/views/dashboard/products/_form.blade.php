<div class="row mb-3">
    <div class="col-md-6">
        <x-form.label for="name" label="Name" />
        <x-form.input name="name" :value="$product->name" autofocus />
    </div>
    <div class="col-md-6">
        <x-form.label for="status" label="Status" />
        <x-form.select name="status" :options="[
            'active' => 'Active',
            'draft' => 'Draft',
            'archived' => 'Archived',
        ]" :selected="$product->status" />
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <x-form.label for="category_id" label="Category" />
        <x-form.select name="category_id" :options="$categories" :selected="$product->category_id" />
    </div>
    <div class="col-md-6">
        <x-form.label for="store_id" label="Store" />
        <x-form.select name="store_id" :options="$stores" :selected="$product->store_id" />
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-6">
        <x-form.label for="price" label="Price" />
        <x-form.input type="number" name="price" :value="$product->price" />
    </div>
    <div class="col-md-6">
        <x-form.label for="compare_price" label="Compare Price" />
        <x-form.input type="number" name="compare_price" :value="$product->compare_price" />
    </div>
</div>

<div class="row mb-3">
    <div class="col">
        <x-form.label for="tags" label="tags" />
        <x-form.input name="tags" :value="$product->tags()->pluck('name')" />
    </div>

</div>

<div class="row mb-3">
    <div class="col">
        <x-form.label for="description" label="description" />
        <x-form.textarea name="description" :value="$product->description" id="description" />
    </div>
</div>

<div class="form-check mb-4">
    <input name="featured" class="form-check-input" type="checkbox" value="{{ $product->featured }}" id="featured"
        @checked(old('featured', $product->featured) == 1)>
    <x-form.label class="form-check-label" for="featured" label="Is Featured" />
</div>

<div class="mb-3">
    <button type="submit" class="btn btn-success">{{ $btn_label ?? 'Save' }}</button>
</div>


@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.css" rel="stylesheet" type="text/css" />
@endpush

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify"></script>
    <script src="https://cdn.jsdelivr.net/npm/@yaireo/tagify/dist/tagify.polyfills.min.js"></script>
    <script>
        var input = document.querySelector('input[name=tags]');
        new Tagify(input)
    </script>
@endpush
