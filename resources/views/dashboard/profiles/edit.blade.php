<x-dashboard.dashboard-layout>
    <x-slot:title>Edit Profile </x-slot:title>

    <x-slot:breadcrumb>
        <x-dashboard.breadcrumb currentPage="Edit Profile" />
    </x-slot:breadcrumb>

    <div class="container-fluid">
        <div class="row m-auto">
            <div class="card p-4">
                <form method="POST" action="{{ route('dashboard.profile.update') }}" enctype="multipart/form-data"> <!--begin::Body-->
                    @csrf
                    @method('PATCH')
                    @include('dashboard.profiles._form')
                </form> <!--end::Form-->
            </div>
        </div>
</x-dashboard.dashboard-layout>
