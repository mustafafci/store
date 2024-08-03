<x-dashboard.dashboard-layout>
    <x-slot:title>Edit Product </x-slot:title>

    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb :currentPage="$product->name" :page="['route_name' => 'dashboard.products.index', 'title' => 'Products']" />
    </x-slot:breadcrumb>

    <div class="container-fluid">
        <div class="row m-auto">
            <div class="card p-4">
                <form method="POST" action="{{ route('dashboard.products.update', $product->id) }}"
                    enctype="multipart/form-data"> <!--begin::Body-->
                    @csrf
                    @method('PUT')
                    @include('dashboard.products._form', [
                        'btn_label' => 'Update',
                    ])
                </form> <!--end::Form-->
            </div>
        </div>
</x-dashboard.dashboard-layout>
