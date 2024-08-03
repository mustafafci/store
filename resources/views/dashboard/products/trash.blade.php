<x-dashboard.dashboard-layout>
    <x-slot:title>Trashed Categories</x-slot:title>
    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb currentPage="Trashed Categories" :page="[
            'route_name' => 'dashboard.categories.index',
            'title' => 'Categories',
        ]" />
    </x-slot:breadcrumb>
    <div class="container-fluid">
        <div class="card card-primary card-outline mb-4 shadow"> <!--begin::Header-->
            <div class="card-header">
                <div class=" d-flex justify-content-between">
                    <a href="{{ route('dashboard.categories.index') }}" class="btn btn-dark ">Back</a>
                    <a href="{{ route('dashboard.categories.create') }}" class="btn btn-primary ">Create Category</a>
                </div>
            </div> <!--end::Header--> <!--begin::Form-->
            <div class="card-body">

                <table class="table table-bordered table-hover table-striped mb-4">
                    <thead>
                        <tr>
                            <th class="bg-primary-subtle" style="width: 10px">#</th>
                            <th class="bg-primary-subtle">name</th>
                            <th class="bg-primary-subtle">slug</th>
                            <th class="bg-primary-subtle">parent</th>
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
                                <td>{{ $category->name }}</td>
                                <td>{{ $category->slug }}</td>
                                <td>{{ $category->parent_name ?? '-' }}</td>
                                <td><span
                                        class="badge text-bg-{{ $category->status == 'active' ? 'success' : 'dark' }}">{{ $category->status }}</span>
                                </td>
                                <td>{{ Str::limit($category->description, 30, '...') }}</td>
                                <td>{{ $category->created_at->format('Y-m-d') }}</td>
                                <td class="d-flex justify-content-around">
                                    <a class="btn btn-sm btn-info"
                                        href="{{ route('dashboard.categories.edit', $category->id) }}">Edit</a>
                                    <form action="{{ route('dashboard.categories.restore', $category->id) }}"
                                        method="POST">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-primary btn-sm">
                                            Restore
                                        </button>
                                    </form>
                                    <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#delete{{ $category->id }}">
                                        Delete
                                    </button>

                                    <x-dashboard.delete-modal :id="$category->id"
                                        route="dashboard.categories.force-delete" />
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
