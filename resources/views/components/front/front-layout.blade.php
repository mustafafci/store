<x-front.head :title="$title"/>
<!-- Start Header Area -->
<x-front.header  />
<!-- End Header Area -->
{{ $breadcrumb ?? '' }}
{{ $slot }}

<!-- Start Footer Area -->
<x-front.footer />