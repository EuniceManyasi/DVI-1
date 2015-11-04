<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
  <div class="row">
    <div class="col-lg-4 col-lg-offset-4">
    <?php echo validation_errors('<div class="alert alert-danger alert-dismissable"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button><b>',' </b></div>');
	$array = array();
      $x=0;
      foreach($macounty as $row ){
          //$new_arr[$v[0]] = end($v); 
          //$array[] = end($row->county_name);
      //    $array = [
      //    $row-> => $row->county_name
      //];
         $array[$row->county_name] = $row->county_name;
        // $array[$row->region_id] = $row->id;

}
	
	?>
      <h1></h1>
      <?php echo form_open('subcounty/submit',array('class'=>'form-horizontal'));?>
      <div class="form-group">
        <?php
        echo form_label('Sub County Name','subcounty_name');
        echo form_error('subcounty_name');
        echo form_input(['name' => 'subcounty_name', 'id' => 'subcounty',  'value' => $subcounty_name ,'class' => 'form-control', 'placeholder' => 'Enter Sub County Name', 'readonly'=>'true']);
        ?>
      </div>
      <div class="form-group">
        <?php
        echo form_label('County Name','county_id');
        echo form_error('county_id');
        echo form_dropdown('county_id',$array , $county_id, 'id="county_id" class="form-control"');
	   // echo form_input(['name' => 'county_id', 'id' => 'county_id',  'value' => $county_id ,'class' => 'form-control', 'placeholder' => 'Enter County Name']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Estimated Total Population','population');
        echo form_error('population');
        echo form_input(['name' => 'population','type'=>'number' ,'min'=>'1', 'id' => 'population',  'value' => $population ,'class' => 'form-control', 'placeholder' => 'Enter Population']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Estimated Population Under One','population_one');
        echo form_error('population_one');
        echo form_input(['name' => 'population_one','type'=>'number' ,'min'=>'1', 'id' => 'population_one',  'value' => $population_one ,'class' => 'form-control', 'placeholder' => 'Enter Population']);
        ?>
      </div>
       <div class="form-group">
        <?php
        echo form_label('Estimated Population of Women','population_women');
        echo form_error('population_women');
        echo form_input(['name' => 'population_women','type'=>'number' ,'min'=>'1', 'id' => 'population_women',  'value' => $population_women ,'class' => 'form-control', 'placeholder' => 'Enter Population']);
        ?>
      </div>
     <div class="form-group">
        <?php
        echo form_label('Number of Health Facilities','no_facilities');
        echo form_error('no_facilities');
        echo form_input(['name' => 'no_facilities', 'id' => 'no_facilities','type'=>'number' ,'min'=>'1',  'value' => $no_facilities ,'class' => 'form-control', 'placeholder' => 'Enter Number']);
        ?>
      </div>
	  <div class="form-group">
        <?php
        echo form_label('Sub-County EPI Logistician','subcounty_logistician');
        echo form_error('subcounty_logistician');
        echo form_input(['name' => 'subcounty_logistician', 'id' => 'subcounty_logistician', 'pattern'=>'[a-zA-Z\s]+', 'value' => $subcounty_logistician ,'class' => 'form-control', 'placeholder' => 'Enter Name of Sub-County EPI Logistician']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Mobile Phone Number of EPI Logistician','subcounty_logistician_phone');
        echo form_error('subcounty_logistician_phone');
        echo form_input(['name' => 'subcounty_logistician_phone','pattern'=>"[07]{2}[0-9]{8}", 'id' => 'subcounty_logistician_phone',  'value' => $subcounty_logistician_phone ,'class' => 'form-control', 'placeholder' => 'Start with 07....']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Email Address of EPI Logistician','subcounty_logistician_email');
        echo form_error('subcounty_logistician_email');
        echo form_input(['name' => 'subcounty_logistician_email','pattern'=>"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$", 'id' => 'subcounty_logistician_email',  'value' => $subcounty_logistician_email ,'class' => 'form-control', 'placeholder' => 'Enter Email Address of EPI Logistician']);
        ?>
      </div>
	  
	  
	  
	  <div class="form-group">
        <?php
        echo form_label('Sub-County Public Health Nurse','subcounty_nurse');
        echo form_error('subcounty_nurse');
        echo form_input(['name' => 'subcounty_nurse', 'id' => 'subcounty_nurse', 'pattern'=>'[a-zA-Z\s]+', 'value' => $subcounty_nurse ,'class' => 'form-control', 'placeholder' => 'Enter Name of Sub-County Public Health Nurse']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Mobile Phone Number of Sub-County Public Health Nurse','subcounty_nurse_phone');
        echo form_error('subcounty_nurse_phone');
        echo form_input(['name' => 'subcounty_nurse_phone','pattern'=>"[07]{2}[0-9]{8}", 'id' => 'subcounty_nurse_phone',  'value' => $subcounty_nurse_phone ,'class' => 'form-control', 'placeholder' => 'Start with 07...']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Email Address of Sub-County Public Health Nurse','subcounty_nurse_email');
        echo form_error('subcounty_nurse_email');
        echo form_input(['name' => 'subcounty_nurse_email','pattern'=>"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$", 'id' => 'subcounty_nurse_email',  'value' => $subcounty_nurse_email ,'class' => 'form-control', 'placeholder' => 'Enter Email Address of Sub-County Public Health Nurse']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Name of Medical Engineering Technician','medical_technician');
        echo form_error('medical_technician');
        echo form_input(['name' => 'medical_technician', 'id' => 'medical_technician', 'pattern'=>'[a-zA-Z\s]+', 'value' => $medical_technician ,'class' => 'form-control', 'placeholder' => 'Enter Name of Medical Engineering Technician']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Mobile Phone Number of Medical Engineering Technician','medical_technician_phone');
        echo form_error('medical_technician_phone');
        echo form_input(['name' => 'medical_technician_phone','pattern'=>"[07]{2}[0-9]{8}", 'id' => 'medical_technician_phone',  'value' => $medical_technician_phone ,'class' => 'form-control', 'placeholder' => 'Start with 07....']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Email Address of Medical Engineering Technician','medical_technician_email');
        echo form_error('medical_technician_email');
        echo form_input(['name' => 'medical_technician_email','pattern'=>"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$", 'id' => 'medical_technician_email',  'value' => $medical_technician_email ,'class' => 'form-control', 'placeholder' => 'Enter Email Address of Medical Engineering Technician']);
        ?>
      </div>
	  
	  
	  
	  <div class="form-group">
        <?php
        echo form_label('Name of Sub-County Medical Officer','subcounty_medical_officer');
        echo form_error('subcounty_medical_officer');
        echo form_input(['name' => 'subcounty_medical_officer', 'id' => 'subcounty_medical_officer', 'pattern'=>'[a-zA-Z\s]+', 'value' => $subcounty_medical_officer ,'class' => 'form-control', 'placeholder' => 'Enter Name of Sub-County Medical Officer']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Mobile Phone Number of Sub-County Medical Officer','subcounty_medical_officer_phone');
        echo form_error('subcounty_medical_officer_phone');
        echo form_input(['name' => 'subcounty_medical_officer_phone','pattern'=>"[07]{2}[0-9]{8}", 'id' => 'subcounty_medical_officer_phone',  'value' => $subcounty_medical_officer_phone ,'class' => 'form-control', 'placeholder' => 'Start with 07....']);
        ?>
      </div>
	  
	  <div class="form-group">
        <?php
        echo form_label('Email Address of Sub-County Medical Officer','subcounty_medical_officer');
        echo form_error('subcounty_medical_officer_email');
        echo form_input(['name' => 'subcounty_medical_officer_email','pattern'=>"[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$", 'id' => 'subcounty_medical_officer_email',  'value' => $subcounty_medical_officer_email ,'class' => 'form-control', 'placeholder' => 'Enter Email Address of Sub-County Medical Officer']);
        ?>
      </div>

      <div >
      <button class="btn btn-lg btn-danger btn-block" name="submit" type="submit">Submit</button>
      </div>
      <?php 
      if (isset($update_id)){
          echo form_hidden('update_id', $update_id);
      }
      echo form_close();?>
    </div>
  </div>
