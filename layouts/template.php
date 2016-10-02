<!DOCTYPE html>
<html>
<?php require('layouts/head.php'); ?>
<body>
<!-- MODALS -->

<!-- MAIN WRAPPER -->
<div class="body-wrap">
	<?php require('layouts/header.php'); ?>
    <!-- MAIN CONTENT -->
    <section class="slice slice-lg bg-image" style="background-image:url(frontend/images/backgrounds/full-bg-1.jpg);">
    	@yield('content')
    </section>
    <?php require('layouts/footer.php'); ?>
</div>


</body>
</html>