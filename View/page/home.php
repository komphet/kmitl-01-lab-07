@extends('layouts.template')

@section("title")
	Home
@endsection

@section("content")
<style>
	.middle {
	    display: table-cell;
	    vertical-align: middle;
	}
</style>
<section class="slice slice-lg bg-image body-content" style="background-image:url(View/frontend/images/backgrounds/full-bg-1.jpg);">
	<div class="wp-section">
    	<div class="container ">
    		<?php
    			if(!is_null($_SESSION['errors'])){
                    echo '<div class="alert alert-danger">';
                    foreach ($_SESSION['errors'] as $key => $value) {
                        echo '<i class="fa fa-close"></i> ';
                        echo $value.'<br>';
                    }
                    echo '</div>';
                }
    		?>
    		<div class="row">

    				<?php
    					if(count($members) > 0){
	    					foreach ($members as $key => $member) {
	    						$gender = ($member['Gender'] == 'M')? 'ชาย' : 'หญิง';
	    						$tz  = new DateTimeZone('Asia/Bangkok');
		    					$age = DateTime::createFromFormat('Y-m-d', $member['Date of Birth'], $tz)
									     ->diff(new DateTime('now', $tz))
									     ->y;
								$name = explode(' ', $member['Name']);
	    						echo '<div class="col-sm-6">';
				    				echo '<div class="wp-block hero white" style="padding: 10px;">';
				    						echo '<a onclick="return confirm(\'คุณต้องการลบ Member นี้หรือไม่?\')" href="'.\Vender\Helper::url('/register/destroy/'.$member['ID']).'" class="badge-corner">';
											    echo '<span class="fa fa-remove"></span>';
											echo '</a>';
				    					echo '<div class="row" id="edit-id-'.$member['ID'].'" style="display:none;">';
				    						echo '<div class="col-sm-12">';
				    							echo '<form action="'.self::url('/register/edit/'.$member['ID']).'" method="POST" id="frmRegister" class="sky-form">';
				                                    echo '<fieldset class="no-padding">';
				                                        echo '<section id="personTable" class="no-margin">';
				                                            echo '<div class="row">';
				                                                echo '<section class="col-xs-6">';
				                                                    echo '<label class="input">';
				                                                        echo '<i class="icon-append fa fa-user"></i>';
				                                                        echo '<input required type="text" name="id" placeholder="ID" value="'.$member['ID'].'">';
				                                                    echo '</label>';
				                                                echo '</section>';
				                                                echo '<section class="col-xs-6">';
				                                                    echo '<label class="input">';
				                                                        echo '<i class="icon-append fa fa-calendar"></i>';
				                                                        echo '<input required id="date" type="text" name="dateofbirth" value="'.$member['Date of Birth'].'" placeholder="Date of Birth">';
				                                                    echo '</label>';
				                                                echo '</section>';
				                                                echo '<section class="col-xs-6">';
				                                                    echo '<label class="input">';
				                                                        echo '<i class="icon-append fa fa-user"></i>';
				                                                        echo '<input required type="text" name="fname" placeholder="First Name" value="'.$name[0].'">';
				                                                    echo '</label>';
				                                                echo '</section>';
				                                                echo '<section class="col-xs-6">';
				                                                    echo '<label class="input">';
				                                                        echo '<i class="icon-append fa fa-user"></i>';
				                                                        echo '<input required type="text" name="lname" placeholder="Last Name" value="'.$name[1].'">';
				                                                    echo '</label>';
				                                                echo '</section>';
				                                                echo '<section class="col-xs-6">';
				                                                    echo '<label class="input">';
				                                                        echo '<i class="icon-append fa fa-sort-numeric-asc"></i>';
				                                                        echo '<input required type="text" name="weight" placeholder="Weight" value="'.$member['Weight'].'">';
				                                                    echo '</label>';
				                                                echo '</section>';
				                                                echo '<section class="col-xs-6">';
				                                                    echo '<label class="select">';
				                                                        echo '<i class="icon-append fa fa-user"></i>';
				                                                        echo '<select required name="gender" placeholder="Gender">';
				                                                        	echo '<option ';
				                                                        		if($gender == 'ชาย') echo "selected ";
				                                                        	echo 'value="M">Male</option>';
				                                                        	echo '<option ';
				                                                        		if($gender == 'หญิง') echo "selected ";
				                                                        	echo 'value="F">Female</option>';
				                                                        echo '</select>';
				                                                    echo '</label>';
				                                                echo '</section>';
				                                            echo '</div>';
				                                        echo '</section>';
				                                    echo '</fieldset>';

				                                    echo '<fieldset>';
				                                        echo '<section>';
				                                            echo '<div class="row">';
				                                                echo '<div class="col-md-8">';
				                                                	echo '<button onclick="$(\'#profile-id-'.$member['ID'].'\').show();$(\'#edit-id-'.$member['ID'].'\').hide();$(\'#insert-new\').show();" class="btn btn-gray btn-icon btn-icon-left fa-chevron-left pull-left" type="button">';
				                                                        echo '<span>Back</span>';
				                                                    echo '</button>';
				                                                echo '</div>';
				                                                echo '<div class="col-md-4">';
				                                                    echo '<button class="btn btn-alt btn-icon btn-icon-right btn-icon-go pull-right" type="submit">';
				                                                        echo '<span>Edit</span>';
				                                                    echo '</button>';
				                                                echo '</div>';
				                                        echo '</section>';
				                                    echo '</fieldset>';
				                                echo '</form>';
				    						echo '</div>';
				    					echo '</div>';
				    					echo '<div class="row" id="profile-id-'.$member['ID'].'">';
				    						echo '<div class="col-sm-2">';
				    							echo '<div class="thmb-img">';
				                                	echo '<i class="fa fa-user"></i>';
				                                echo '</div>';
				    						echo '</div>';
				    						echo '<div class="col-sm-9">';
				    							echo '<div class="pull-right"><h4 class="title-large">'.$member['ID'].'</h4></div>';
				    							echo '<h4 class="title-large"><a href="#" onclick="$(\'#profile-id-'.$member['ID'].'\').hide();$(\'#edit-id-'.$member['ID'].'\').show();$(\'#insert-new\').hide();"><i class="fa fa-edit"></i></a> '.$member['Name'].' </h4>';
				    							echo '<div class="row">';
				    								echo '<div class="col-sm-6">';
				    									echo '<b>เพศ:</b> '.$gender.'<br>';
				                                		echo '<b>น้ำหนัก:</b> '.$member['Weight'].' KG<br>';
				                                		echo '<b>อายุ:</b> '.$age.' ปี <br>';
				    								echo '</div>';
				    								echo '<div class="col-sm-6">';
				    									echo '<b>วันเกิด:</b> '.$member['Date of Birth'].'<br>';
				    									echo '<b>Created At:</b> '.date_format(date_create(date("Y-m-d H:i:s")),"Y/m/d H:i").'<br>';
				                                		echo '<b>Update At:</b> '.date_format(date_create(date("Y-m-d H:i:s")),"Y/m/d H:i");
				    								echo '</div>';
				    							echo '</div>';
				    						echo '</div>';
				    					echo '</div>';
				    				echo '</div>';
				    			echo '</div>';
	    					}
	    				}
    				?>
    				<div class="col-sm-6" id="insert-new">
	    				<div class="wp-block hero white" style="padding: 10px;">
	    					<div class="row">
	    						<div class="col-sm-12">
	    							<form action="{{ self::url('/register/store') }}" method="POST" id="frmRegister" class="sky-form">
	                                    <fieldset class="no-padding">
	                                        <section id="personTable" class="no-margin">
	                                            <div class="row">
	                                                <section class="col-xs-6">
	                                                    <label class="input">
	                                                        <i class="icon-append fa fa-user"></i>
	                                                        <input required type="text" name="id" placeholder="ID">
	                                                    </label>
	                                                </section>
	                                                <section class="col-xs-6">
	                                                    <label class="input">
	                                                        <i class="icon-append fa fa-calendar"></i>
	                                                        <input required id="date" type="text" name="dateofbirth" placeholder="Date of Birth">
	                                                    </label>
	                                                </section>
	                                                <section class="col-xs-6">
	                                                    <label class="input">
	                                                        <i class="icon-append fa fa-user"></i>
	                                                        <input required type="text" name="fname" placeholder="First Name">
	                                                    </label>
	                                                </section>
	                                                <section class="col-xs-6">
	                                                    <label class="input">
	                                                        <i class="icon-append fa fa-user"></i>
	                                                        <input required type="text" name="lname" placeholder="Last Name">
	                                                    </label>
	                                                </section>
	                                                <section class="col-xs-6">
	                                                    <label class="input">
	                                                        <i class="icon-append fa fa-sort-numeric-asc"></i>
	                                                        <input required type="text" name="weight" placeholder="Weight">
	                                                    </label>
	                                                </section>
	                                                <section class="col-xs-6">
	                                                    <label class="select">
	                                                        <i class="icon-append fa fa-user"></i>
	                                                        <!-- <input type="text" name="gender" placeholder="Gender"> -->
	                                                        <select required name="gender" placeholder="Gender">
	                                                        	<option value="M">Male</option>
	                                                        	<option value="F">Female</option>
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
	                                                        <span>Register</span>
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
    </div>
</section>
@endsection