<!DOCTYPE html>
<html>
@include('layouts.head')
<body>
<!-- MODALS -->

<!-- MAIN WRAPPER -->
<div class="body-wrap">
	@include('layouts.header')
    <!-- MAIN CONTENT -->
    	@yield('content')
    @include('layouts.footer')
</div>

</body>
</html>