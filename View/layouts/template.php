<!DOCTYPE html>
<html>
@include('layouts.head')
<body>
<!-- MODALS -->

<!-- MAIN WRAPPER -->
<div class="body-wrap">
	@include('layouts.header')
    <!-- MAIN CONTENT -->
    <div class="body-content">
    	@yield('content')
    </div>
    @include('layouts.footer')
</div>
<script>
	jQuery(document).ready(function($event) {
		function contentH(){
			var headerH = $('header').height();//80
			var footerH = $('footer').height();//253
			var contentH = $('.body-content').height();
			if(headerH+footerH+contentH < $(window).height()){
				$('.body-content').height($(window).height()-headerH-footerH-35);
			}
		}
		$(window).resize(function(event) {
			contentH();
		});
		contentH();

	});
	var d = new Date();
	var n = d.getFullYear();
	$('#date').datepicker({
		dateFormat: 'yy-mm-dd',
		prevText: '<i class="fa fa-chevron-left"></i>',
		nextText: '<i class="fa fa-chevron-right"></i>',
		changeYear: true,
		changeMonth: true,
		yearRange: (n-100)+':'+n
	});

</script>
</body>
</html>