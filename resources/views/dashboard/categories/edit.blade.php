<x-dashboard.dashboard-layout>
    <x-slot:title>Create Category </x-slot:title>

    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb currentPage="Create Category" :page="['route_name' => 'dashboard.categories.index', 'title' => 'Categories']" />
    </x-slot:breadcrumb>

    <div class="container-fluid">
        <div class="row m-auto">
            <div class="card p-4">
                <form method="POST" action="{{ route('dashboard.categories.update', $category->id) }}"
                    enctype="multipart/form-data"> <!--begin::Body-->
                    @csrf
                    @method('PUT')
                    @include('dashboard.categories._form', [
                        'btn_label' => 'Update',
                    ])
                </form> <!--end::Form-->
            </div>
        </div>
</x-dashboard.dashboard-layout>
