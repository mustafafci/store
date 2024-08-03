<x-dashboard.head :title="$title" />
<x-dashboard.nav />
<x-dashboard.sidebar />

<main class="app-main"> <!--begin::App Content Header-->
   {{ $breadcrumb }}
    <div class="app-content"> <!--begin::Container-->
       {{ $slot }}
    </div> <!--end::App Content-->
</main> <!--end::App Main--> <!--begin::Footer-->

<x-dashboard.footer />
