<x-dashboard.dashboard-layout>
    <x-slot:title>Products</x-slot:title>
    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb currentPage="Products" />
    </x-slot:breadcrumb>
    <div class="container-fluid">
        <div class="card card-primary card-outline mb-4 shadow"> <!--begin::Header-->
            <div class="card-header">
                <div class="card-title float-end">
                    <a href="{{ route('dashboard.products.create') }}" class="btn btn-primary ">Create Product</a>
                    {{-- <a href="{{ route('dashboard.products.trash') }}" class="btn btn-info mx-2 ">Trashed Products</a> --}}
                </div>
            </div> <!--end::Header--> <!--begin::Form-->
            <div class="card-body">
                {{-- <form action="{{ URL::current() }}" class="d-flex justify-content-between mb-4">
                    <x-form.input type="search" class="mx-2" name="search" :value="request('search')"
                        placeholder="search ..." />
                    <select name="status" id="" class="form-select mx-2">
                        <option value="">All</option>
                        <option @selected(request('status') == 'active') value="active">Active</option>
                        <option @selected(request('status') == 'inactive') value="inactive">Not Active</option>
                    </select>
                    <button type="submit" class="btn btn-secondary">Filter</button>
                </form> --}}
                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th class="bg-primary-subtle" style="width: 10px">#</th>
                            <th class="bg-primary-subtle">name</th>
                            <th class="bg-primary-subtle">slug</th>
                            <th class="bg-primary-subtle">category</th>
                            <th class="bg-primary-subtle">store</th>
                            <th class="bg-primary-subtle">price</th>
                            <th class="bg-primary-subtle">rating</th>
                            <th class="bg-primary-subtle">status</th>
                            <th class="bg-primary-subtle">created at</th>
                            <th class="bg-primary-subtle">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products as $product)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>{{ $product->category?->name }}</td>
                                <td>{{ $product->store?->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->rating ?? '-' }}</td>
                                <td><span
                                        class="badge text-bg-{{ $product->statusClass }}">{{ $product->status }}</span>
                                </td>
                                <td>{{ $product->created_at->format('Y-m-d') }}</td>
                                <td>
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('dashboard.products.edit', $product->id) }}">Edit</a>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $product->id }}">
                                        Delete
                                    </button>

                                    <x-dashboard.delete-modal :id="$product->id" route="dashboard.products.destroy" />
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="10">
                                    <div class="alert alert-warning text-center">
                                        no result found
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $products->withQueryString()->links() }}
            </div>
        </div>
    </div>
</x-dashboard.dashboard-layout>
