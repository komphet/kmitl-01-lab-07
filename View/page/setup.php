@extends('layouts.template')

@section("title")
	Setup Website
@endsection

@section("content")
<div class="pg-opt">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <h2>Setup</h2>
                </div>
                <div class="col-md-6">
                    <ol class="breadcrumb">
                        <li><a href="{{ self::url('/') }}">Home</a></li>
                        <li><a href="#">Pages</a></li>
                        <li class="active">Setup</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="slice slice-lg bg-image" style="background-image:url(View/frontend/images/backgrounds/full-bg-1.jpg)">
        <div class="wp-section">
            <div class="container">
                <div class="row">
                    <div class="col-md-8 col-md-offset-2 col-sm-6 col-sm-offset-3">
                        <div class="wp-block default user-form user-form-alpha no-margin">
                            <div class="form-header">
                                <h2>Setup Website</h2>
                            </div>
                            <div class="form-body">
                                <form action="{{ self::url('/setup') }}" method="POST" id="frmRegister" class="sky-form">
                                    <fieldset class="no-padding">
                                        <section class="">
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <label class="input">
                                                            <i class="icon-append fa fa-database"></i>
                                                            <input required type="text" name="databese" placeholder="Databese" value="{{ $config['DB_DATABASE'] }}">
                                                            <b class="tooltip tooltip-bottom-right">ชื่อฐานข้อมูล</b>
                                                        </label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="input">
                                                            <i class="icon-append fa fa-link"></i>
                                                            <input required type="text" name="baseurl" placeholder="Base Url" value="http://{{ preg_replace('/\/index.*/', '', $_SERVER['SERVER_NAME'].$_SERVER['PHP_SELF']) }}">
                                                            <b class="tooltip tooltip-bottom-right">URL เริ่มต้นของเว็บไซต์</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-xs-6">
                                                    <div class="form-group">
                                                        <div class="form-group">
                                                            <label class="input">
                                                                <i class="icon-append fa fa-user"></i>
                                                                <input required type="text" name="username" placeholder="Username" value="{{ $config['DB_USERNAME'] }}">
                                                                <b class="tooltip tooltip-bottom-right">ชื่อผู้ใช้ฐานข้อมูล</b>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="input">
                                                            <i class="icon-append fa fa-lock"></i>
                                                            <input required type="text" name="password" placeholder="Password" value="{{ $config['DB_PASSWORD'] }}">
                                                            <b class="tooltip tooltip-bottom-right">รหัสผ่านฐานข้อมูล</b>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                        </section>
                                        <section class="no-margin">
											<table class="table">
												<caption><h4 class="title-large">Table Name: person</h4></caption>
												<thead>
													<tr>
														<th>Attribute Name</th>
														<th>Data Type</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td>ID</td>
														<td>Varchar(10)</td>
													</tr>
													<tr>
														<td>Name</td>
														<td>Varchar(25)</td>
													</tr>
													<tr>
														<td>Date of Birth</td>
														<td>Date</td>
													</tr>
													<tr>
														<td>Weight</td>
														<td>Integer</td>
													</tr>
													<tr>
														<td>Gender</td>
														<td>Character(1) มีค่า M หรือ F เท่านั้น</td>
													</tr>
												</tbody>
											</table>
                                        </section>
                                        <section class="no-margin">
                                            <div class="row">
                                                <section class="col-xs-4">
                                                    <label class="input">
                                                        <i class="icon-append fa fa-user"></i>
                                                        <input required type="text" name="id" placeholder="ID">
                                                    </label>
                                                </section>
                                                <section class="col-xs-4">
                                                    <label class="input">
                                                        <i class="icon-append fa fa-user"></i>
                                                        <input required type="text" name="fname" placeholder="First Name">
                                                    </label>
                                                </section>
                                                <section class="col-xs-4">
                                                    <label class="input">
                                                        <i class="icon-append fa fa-user"></i>
                                                        <input required type="text" name="lname" placeholder="Last Name">
                                                    </label>
                                                </section>
                                            </div> 
                                            <div class="row">
                                                <section class="col-xs-4">
                                                    <label class="input">
                                                        <i class="icon-append fa fa-calendar"></i>
                                                        <input required id="date" type="text" name="dateofbirth" placeholder="Date of Birth">
                                                    </label>
                                                </section>
                                                <section class="col-xs-4">
                                                    <label class="input">
                                                        <i class="icon-append fa fa-sort-numeric-asc"></i>
                                                        <input required type="text" name="weight" placeholder="Weight">
                                                    </label>
                                                </section>
                                                <section class="col-xs-4">
                                                    <label class="select">
                                                        <i class="icon-append fa fa-user"></i>
                                                        <!-- <input type="text" name="gender" placeholder="Gender"> -->
                                                        <select required name="gender" placeholder="Gender">
                                                        	<option value="M">Male</option>
                                                        	<option value="M">Female</option>
                                                        </select>
                                                    </label>
                                                </section>
                                            </div>
                                        </section>
                                    </fieldset>

                                    <fieldset>
                                        <section>
                                            <div class="row">
                                                <div class="col-md-8">
                                                </div>
                                                <div class="col-md-4">
                                                    <button class="btn btn-alt btn-icon btn-icon-right btn-icon-go pull-right" type="submit">
                                                        <span>Setup Website</span>
                                                    </button>
                                                </div>
                                        </section>
                                    </fieldset>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
<script type="text/javascript">
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
@endsection