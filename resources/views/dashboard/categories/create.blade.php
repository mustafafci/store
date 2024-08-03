<x-dashboard.dashboard-layout>
    <x-slot:title>Create Category </x-slot:title>

    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb currentPage="Create Category" :page="['route_name' => 'dashboard.categories.index', 'title' => 'Categories']" />
    </x-slot:breadcrumb>

    <div class="container-fluid">
        <div class="row m-auto">
            <div class="card p-4">
                <form method="POST" action="{{ route('dashboard.categories.store') }}" enctype="multipart/form-data">
                    <!--begin::Body-->
                    @csrf
                    @include('dashboard.categories._form')
                </form> <!--end::Form-->
            </div>
        </div>
</x-dashboard.dashboard-layout>
