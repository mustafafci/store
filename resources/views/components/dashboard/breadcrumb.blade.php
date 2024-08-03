<div class="app-content-header"> <!--begin::Container-->
    <div class="container-fluid"> <!--begin::Row-->
        <div class="row">
            <div class="col-sm-6">
                <h3 class="mb-0">{{ $currentPage ?? 'Dashboard' }}</h3>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-end">
                    @isset($currentPage)
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                        @isset($page)
                            <li class="breadcrumb-item"><a href="{{ route($page['route_name']) }}">{{ $page['title'] }}</a></li>
                        @endisset
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $currentPage }}
                        </li>
                    @endisset

                </ol>
            </div>
        </div> <!--end::Row-->
    </div> <!--end::Container-->
</div> <!--end::App Content Header--> <!--begin::App Content-->
