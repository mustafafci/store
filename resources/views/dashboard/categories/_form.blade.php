<div class="mb-3">
    <x-form.label for="category-name" label="Category Name" />
    <x-form.input name="name" :value="$category->name" />
</div>

<div class="mb-3">
    <x-form.label for="parent_id" label="Parent Category" />
    <x-form.select name="parent_id" :options="$parents" :selected="$category->parent_id" />
    
</div>

<div class="mb-3">
    <x-form.label for="description" label="description" />
    <x-form.textarea name="description" :value="$category->description" id="description" />
</div>

<div class="mb-3">
    <x-form.label for="status" label="Status" />
    <x-form.select name="status" :options="['active' => 'Active' , 'inactive' => 'Not Active']" :selected="$category->status" />
</div>

<div class="mb-3">
    <x-form.label label="Image" />
    <div class="input-group mb-2">
        <x-form.input type="file" name="image" id="inputGroupFile02" />
        <x-form.label class="input-group-text" for="inputGroupFile02" label="Upload" />
    </div>
    @if ($category->image)
        <img src="{{ asset('uploads/' . $category->image->url) }}" alt="{{ $category->name }}" width="100px">
    @endif
</div>

<div class="mb-3">
    <button type="submit" class="btn btn-success">{{ $btn_label ?? 'Save' }}</button>
</div>
