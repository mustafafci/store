<x-dashboard.dashboard-layout>
    <x-slot:title>Categories</x-slot:title>
    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb currentPage="Categories" />
    </x-slot:breadcrumb>
    <div class="container-fluid">
        <div class="card card-primary card-outline mb-4 shadow"> <!--begin::Header-->
            <div class="card-header">
                <div class="card-title float-end">
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary ">Create Category</a>
                    <a href="{{ route('dashboard.categories.trash') }}" class="btn btn-info mx-2 ">trashed Categories</a>
                </div>
            </div> <!--end::Header--> <!--begin::Form-->
            <div class="card-body">
                <form action="{{ URL::current() }}" class="d-flex justify-content-between mb-4">
                    <x-form.input type="search" class="mx-2" name="search" :value="request('search')"
                        placeholder="search ..." />
                    <select name="status" id="" class="form-select mx-2">
                        <option value="">All</option>
                        <option @selected(request('status') == 'active') value="active">Active</option>
                        <option @selected(request('status') == 'inactive') value="inactive">Not Active</option>
                    </select>
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </form>
                <table class="table table-bordered table-hover table-striped text-center mb-4">
                    <thead>
                        <tr>
                            <th class="bg-primary-subtle" style="width: 10px">#</th>
                            <th class="bg-primary-subtle">name</th>
                            <th class="bg-primary-subtle">slug</th>
                            <th class="bg-primary-subtle">parent</th>
                            <th class="bg-primary-subtle">Num of product</th>
                            <th class="bg-primary-subtle">status</th>
                            <th class="bg-primary-subtle">description</th>
                            <th class="bg-primary-subtle">created at</th>
                            <th class="bg-primary-subtle">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($categories as $category)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td><a
                                        href="{{ route('dashboard.categories.show', $category->id) }}">{{ $category->name }}</a>
                                </td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parent?->name }}</td>
                                <td>{{ $category->products_count }}</td>
                                <td><span
                                        class="badge text-bg-{{ $category->status == 'active' ? 'success' : 'dark' }}">{{ $category->status }}</span>
                                </td>
                                <td>{{ Str::limit($category->description, 30, '...') }}</td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('dashboard.categories.edit', $category->id) }}">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $category->id }}">
                                        Delete
                                    </button>

                                    <x-dashboard.delete-modal :id="$category->id" route="dashboard.categories.destroy" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8">
                                    <div class="alert alert-warning text-center">
                                        no result found
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $categories->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-dashboard.dashboard-layout>
