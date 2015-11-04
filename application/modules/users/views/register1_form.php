<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
   <div class="row">
       <div class="col-lg-4 col-lg-offset-4">
      <?php echo $this->session->flashdata('msg');  ?>
      
      <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');?>
 <?php echo form_open('users/register');?>
   
<?php  
$group = array();
  foreach($magroups as $row ){
    $group[$row->id] = $row->name;
    
  }
$level = array();
  foreach($malevels as $row ){
    $level[$row->id] = $row->name;
  }
 
$region = array();
  foreach($maregion as $row ){
    $region[$row->id] = $row->region_name; 
  }

$county = array();
  foreach($macounties as $row ){
    $county[$row->id] = $row->county_name; 
  }


  $subcounty = array();
  foreach($masubcounty as $row ){
    $subcounty[$row->id] = $row->subcounty_name; 
  }

  $facility = array();
  foreach($mafacilities as $row ){
    $facility[$row->id] = $row->facility_name;
  }

  $nation = array('Kenya');
  $national = "";
  $regional = "";
  $countyuser = "";
  $subcountyuser = "";
  $facilityuser = "";
?>   
     <script type="text/javascript">
// jQuery(document).ready(function ($) {
// $('#access_level').on('change',function(){
// console.log("Detected change..." + this.value);
//   if ( this.value == 'National')
//     $("#base1").show();     
//   else if ( this.value == 'Region')
//     $("#base2").show();
//   else if ( this.value == 'County')
//     $("#base3").show();
//   else if ( this.value == 'Sub County')
//     $("#base4").show();
//   else if ( this.value == 'Facility')
//     $("#base5").show();
//   else
//   $("#base1").hide();
//   $("#base2").hide();
//   $("#base3").hide();
//   $("#base4").hide();
//   $("#base5").hide();
// }).trigger("change"); //
// });
      
// $(document).ready(function() { 
// $("#access_level").change(function () {
//     if($("#access_level").val()=='1'){
//       $("#base1").show();
//   $("#base2").show();
//   $("#base3").show();
//   $("#base4").show();
//   $("#base5").show(); 
//     } else {
  
  
//     $("#base1").hide();
//   $("#base2").hide();
//   $("#base3").hide();
//   $("#base4").hide();
//   $("#base5").hide();
//     }
//   });
// })/;

// $(document).ready(function(){
//   $("select.access_level").change(function(){
//     var selectedlevel = $(".access_level option:selected").val();
//       console.log("Detected change..." +selectedlevel );
//   });
// });


        // $('#access_level').on('change',function(){
        //   var selection = $(this).val();
        //    console.log("Detected change..." + $(this).val());
//           switch(selection){
// case "National":

// $("#base1").show()
// break;
// case "Region":
// $("#base2").show()
// break;
// case "County":
// $("#base3").show()
// break;
// case "Sub County":
// $("#base4").show()
// break;
// case "Facility":
// $("#base5").show()
// break;
// default:
//  $("#base1").hide();
// $("#base2").hide();
// $("#base3").hide();
// $("#base4").hide();
// $("#base5").hide();

          // }
        // });
        </script>   
</div></div>
<div class="row">
<div class="col-md-12">
          <div class="block-web">
            
            <div class="porlets-content">
              <div class="basic-wizard" id="progressWizard">
                <ul class="nav nav-pills nav-justified">
                  <li class="active"><a data-toggle="tab" href="#ptab1"><span>Step 1:</span> Personal Details</a></li>
                  <li><a data-toggle="tab" href="#ptab2"><span>Step 2:</span> Login Information</a></li>
                  <li><a data-toggle="tab" href="#ptab3"><span>Step 3:</span> Access Level Information</a></li>
                </ul>
                <div class="tab-content">
                 <!--  <div class="progress progress-striped">
                    <div aria-valuemax="100" aria-valuemin="0" aria-valuenow="45" role="progressbar" class="progress-bar" style="width: 33.3333%;"></div>
                  </div> -->
                  <div id="ptab1" class="tab-pane active">
                       <div class="form-group">
        <?php
        echo form_label('Enter First Name','f_name');
        echo form_error('f_name');
        echo form_input(['name' => 'f_name', 'id' => 'f_name',  'value' => $f_name ,'class' => 'form-control', 'placeholder' => 'Enter First Name']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter Last Name','l_name');
        echo form_error('l_name');
        echo form_input(['name' => 'l_name', 'id' => 'l_name',  'value' => $l_name ,'class' => 'form-control', 'placeholder' => 'Enter Last Name']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter Phone Number','phone');
        echo form_error('phone');
        echo form_input(['name' => 'phone', 'id' => 'phone',  'value' => $phone ,'class' => 'form-control', 'placeholder' => 'Enter Phone Number']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Enter Email Address','email');
        echo form_error('email');
        echo form_input(['name' => 'email', 'id' => 'email',  'value' => $email ,'class' => 'form-control', 'placeholder' => 'Enter Email']);
        ?>
      </div>
                  </div>
                  <div id="ptab2" class="tab-pane">
                    <div class="form-group">
        <?php
        echo form_label('Enter User Name','username');
        echo form_error('username');
        echo form_input(['name' => 'username', 'id' => 'username',  'value' => $username ,'class' => 'form-control', 'placeholder' => 'Enter Username Name']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('Enter Password','password');
        echo form_error('modulename_name');
        echo form_password(['name' => 'password', 'id' => 'password' ,'class' => 'form-control', 'placeholder' => 'Enter Password']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('RE-Enter Password','password');
        echo form_error('modulename_name');
        echo form_password(['name' => 'passwordc', 'id' => 'passwordc', 'class' => 'form-control', 'placeholder' => 'RE-Enter Password']);
        ?>
      </div>
      
                  </div>
                  <div id="ptab3" class="tab-pane">
                   <div class="form-group">
        <?php
        echo form_label('Enter User Group','user_group');
        echo form_error('user_group');
        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
       echo form_dropdown('user_group', $group, $user_group, 'id="user_group" class="form-control"'); 
        ?>
      </div>
        <div class="form-group" id="user_level">
        <?php
        echo form_label('Enter Access Level','user_level');
        echo form_error('user_level');
        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
       echo form_dropdown('user_level', $level, $user_level, 'id="user_level" class="form-control"'); 
        ?>
      </div>
      <div class="form-group" id="base1">
        <?php
        echo form_label('Enter National Base','national');
        echo form_error('national');
        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
       echo form_dropdown('national', $nation, $national, 'id="national" class="form-control"'); 
        ?>
      </div>
      <div class="form-group" id="base2">
        <?php
        echo form_label('Enter Regional Base ','regional');
        echo form_error('regional');
        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
       echo form_dropdown('regional', $region, $regional,'id="regional" class="form-control"'); 
        ?>
      </div>
      <div class="form-group" id="base3">
        <?php
        echo form_label('Enter County Base ','countyuser');
        echo form_error('countyuser');
        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
       echo form_dropdown('countyuser', $county, $countyuser, 'id="countyuser" class="form-control"'); 
        ?>
      </div>
      <div class="form-group" id="base4">
        <?php
        echo form_label('Enter Sub County Base ','subcountyuser');
        echo form_error('subcountyuser');
        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
       echo form_dropdown('subcountyuser', $subcounty, $subcountyuser, 'id="subcountyuser" class="form-control"'); 
        ?>
      </div>
      <div class="form-group" id="base5">
        <?php
        echo form_label('Enter Facility Base ','facilityuser');
        echo form_error('facilityuser');
        //echo form_input(['name' => 'user_group', 'id' => 'user_group',  'value' => $user_group ,'class' => 'form-control', 'placeholder' => 'Enter User Group ID']);
       echo form_dropdown('facilityuser', $facility, $facilityuser, 'id="facilityuser" class="form-control"'); 
        ?>
      </div>
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">ADD USER</button>
    <?php echo form_close();?>
                  </div>
                </div><!-- /tab-content -->
                
                <!-- <ul class="pager wizard">
                  <li class="previous disabled"><a href="javascript:void(0)">Previous</a></li>
                  <li class="next"><a href="javascript:void(0)">Next</a></li>
                </ul> -->
              </div><!--/progressWizard-->
            </div><!--/porlets-content--> 
          </div><!--/block-web--> 
        </div><!--/col-md-6--> </div>
       