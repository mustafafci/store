<x-dashboard.dashboard-layout>
    <x-slot:title>Create Product </x-slot:title>

    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb currentPage="Create Product" :page="['route_name' => 'dashboard.products.index', 'title' => 'Products']" />
    </x-slot:breadcrumb>

    <div class="container-fluid">
        <div class="row m-auto">
            <div class="card p-4">
                <form method="POST" action="{{ route('dashboard.products.store') }}" enctype="multipart/form-data">
                    <!--begin::Body-->
                    @csrf
                    @include('dashboard.products._form')
                </form> <!--end::Form-->
            </div>
        </div>
</x-dashboard.dashboard-layout>
