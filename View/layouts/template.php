<!DOCTYPE html>
<html>
@include('layouts/head')
<body>
<!-- MODALS -->

<!-- MAIN WRAPPER -->
<div class="body-wrap">
	@include('layouts/header')
    <!-- MAIN CONTENT -->
    <section class="slice slice-lg bg-image" style="background-image:url(frontend/images/backgrounds/full-bg-1.jpg);">
    	@yield('content')
    </section>
    @include('layouts/footer')
</div>
@yield('asrgs')

</body>
</html>