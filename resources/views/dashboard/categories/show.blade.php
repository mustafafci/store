<x-dashboard.dashboard-layout>
    <x-slot:title>Products in category</x-slot:title>
    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb :currentPage="$category->name" :page="[
            'route_name' => 'dashboard.categories.index',
            'title' => 'Catgories'
        ]" />
    </x-slot:breadcrumb>
    <div class="container-fluid">
        <div class="card card-primary card-outline mb-4 shadow"> <!--begin::Header-->
            <div class="card-header">
                <div class="card-title float-end">
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-dark ">back</a>
                </div>
            </div> <!--end::Header--> <!--begin::Form-->
            <div class="card-body">
               
                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th class="bg-primary-subtle" style="width: 10px">#</th>
                            <th class="bg-primary-subtle">name</th>
                            <th class="bg-primary-subtle">slug</th>
                            <th class="bg-primary-subtle">store</th>
                            <th class="bg-primary-subtle">price</th>
                            <th class="bg-primary-subtle">rating</th>
                            <th class="bg-primary-subtle">status</th>
                            <th class="bg-primary-subtle">created at</th>
                            <th class="bg-primary-subtle">actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($products_in_category as $product)
                            <tr class="align-middle">
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{{ $product->slug }}</td>
                                <td>{{ $product->store?->name }}</td>
                                <td>{{ $product->price }}</td>
                                <td>{{ $product->rating ?? '-' }}</td>
                                <td><span
                                        class="badge text-bg-{{ $product->status == 'active' ? 'success' : 'dark' }}">{{ $product->status }}</span>
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
                {{ $products_in_category->links() }}
            </div>
        </div>
    </div>
</x-dashboard.dashboard-layout>
