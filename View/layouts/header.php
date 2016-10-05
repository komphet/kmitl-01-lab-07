<!-- HEADER -->
<div id="divHeaderWrapper">
    <header class="header-standard-2">
	    <!-- MAIN NAV -->
	    <div class="navbar navbar-wp navbar-arrow mega-nav" role="navigation">
	        <div class="container">
	            <div class="navbar-header">
	                <button type="button" class="navbar-toggle navbar-toggle-aside-menu">
	                    <i class="fa fa-outdent icon-custom"></i>
	                </button>
	                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
	                    <i class="fa fa-bars icon-custom"></i>
	                </button>

	                <a class="navbar-brand" href="{{ self::url('/') }}" title="Boomerang | One template. Infinite solutions">
	                    <img src="View/frontend/images/logo-db.png" alt="Boomerang | One template. Infinite solutions">
	                </a>
	            </div>
	            <div class="navbar-collapse collapse">
	                <ul class="nav navbar-nav navbar-right">
	                    <li class="<?php echo ($_GET['action'] == '')? 'active':''; ?>"><a href="{{ self::url('/') }}">home</a></li>
	                    <!-- <li class="<?php echo ($_GET['action'] == 'register')? 'active':''; ?>"><a href="{{ self::url('register') }}">register</a></li> -->
	                    <li class="<?php echo ($_GET['action'] == 'setup')? 'active':''; ?>"><a href="{{ self::url('setup') }}">setup</a></li>
	                </ul>

	            </div><!--/.nav-collapse -->
	        </div>
	    </div>
	</header>
</div>