 <div class="row">
    <div class="col-lg-12">
<?php
$form_attributes = array('id' => 'stock_received_fm','method' =>'post','class'=>'form-inline','role'=>'form');
echo form_open('',$form_attributes);?>

<div class="well well-sm"><b>Transaction Details</b></div>

<div class="row">
    <div class="col-lg-3">
        <section class="">
            <div class="panel-body">
                <b>Received From</b><br>
                <?php $data=array('name' => 'received_from','id'=> 'received_from','required'=>'true', 'class'=>'form-control'); echo form_input($data);?> 
            </div>
        </section>
    </div>
    <div class="col-lg-3">
        <section class="">
            <div class="panel-body">
               <b>S11 #</b><br>
                <?php $data=array('name' => 's11','id'=> 's11','class'=>'form-control'); echo form_input($data);?> 
            </div>
        </section>
    </div>
    <div class="col-lg-3">
        <section class="">
            <div class="panel-body">
                <b>Date Received</b><br>
                <?php $data=array('name' => 'date_received','id'=>'date_received','required'=>'true','class'=>'form-control'); echo form_input($data);?>
            </div>
        </section>
    </div>
    <div class="col-lg-3">
        <section class="">
            <div class="panel-body">
            <b>Order </b><br>
              <select name="order" class="form-control" id="order">
                         <option value="">--Select Order No--</option>
                         <?php foreach ($orders as $order) { 
                             echo "<option value='".$order->order_id."'>".$order->order_id."</option>";
                             }?>
                        </select></div>
        </section>
    </div>
</div>
<input type="hidden" name ="transaction_type" class="transaction_type" value="1">

<div class="table-responsive">
<div class="well well-sm"><b>Vaccine Details</b></div>

<div id="stock_receive_tbl">
	 
	<table class="table table-bordered table-hover table-striped">
		<thead>

			              <th align="center">Vaccine/Diluents</th>
							<th >Batch No.</th>
							<th >Expiry&nbsp;Date</th>
							<th >Quantity(doses)</th>
							<th >VVM Status</th>
							<th >Action</th>
		</thead>
		<tbody>

			<tr align="center" receive_row="1"> 
              
              <td> <select name="vaccine" class="vaccine form-control" id="vaccine" required="true">
                 <option value="">--Select One--</option>
                 <?php foreach ($vaccines as $vaccine) { 
                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
                     }?>
                </select></td>

				
             		<td><?php $data=array('name' => 'batch_no','required'=>'true','id'=>'batch_no','class'=>'batch_no form-control'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'expiry_date','id'=> 'expiry_date','required'=>'true','class'=>'form-control expiry_date', 'type'=>'date'); echo form_input($data);?></td>
             		<td><?php $data=array('name' => 'quantity_received','id'=> 'quantity_received','required'=>'true','class'=>'quantity_received form-control', 'type' =>'number',' min' => '0'); echo form_input($data);?></td>
             		
                <td>
                <select name="vvm_status" class=" form-control vvm_status " id="vvm_status" name="vvm_status" required="true">
                <option value=""> --Select One-- </option>
                    <option value="1">Stage 1</option>
                    <option value="2">Stage 2</option>
                    <option value="3">Stage 3</option>
                     <option value="3">Stage 4</option>
                </select></td>
             		<td ><a href="#" class="add"><span class="label label-success"><i class="fa  fa-plus-square"></i> <b>ADD</b></span></a><span class="divider">  </span><a href="#" class="remove"><span class="label label-danger"><i class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a></td>
			</tr>

		</tbody>
	</table>


</div>

<button type="submit" name="stock_receivedstock_received" id="stock_received" class="btn btn-sm btn-danger">Submit</button>

<?php
   echo form_close();?>
</div></div></div>
   <script type="text/javascript">
 
              $("#expiry_date").datepicker("option", "minDate", 0);


              $('#stock_receive_tbl').delegate( '.add', 'click', function () {
            
                       var thisRow =$('#stock_receive_tbl tr:last');
                       var cloned_object = $( thisRow ).clone();

                       var receive_row = cloned_object.attr("receive_row");
                       var next_receive_row = parseInt(receive_row) + 1;
                       cloned_object.attr("receive_row", next_receive_row);

                       var vaccine_id = "vaccine" + next_receive_row;
                       var vaccine = cloned_object.find(".vaccine");
                       vaccine.attr('id',vaccine_id);

                      var batch_id = "batch_no" + next_receive_row;
                      var batch = cloned_object.find(".batchno_");
                      batch.attr('id',batch_id);

                      var expiry_id = "expiry_date" + next_receive_row;
                      var expiry = cloned_object.find(".expiry_date");
                      expiry.attr('id',expiry_id);

                      var quantity_received_id = "quantity_received" + next_receive_row;
                      var quantity_received = cloned_object.find(".quantity_received");
                      quantity_received.attr('id',quantity_received_id);

                      var vvm_status_id = "vvm_status" + next_receive_row;
                      var vvm_status = cloned_object.find(".vvm_status");
                      vvm_status.attr('id',vvm_status_id);

                cloned_object .insertAfter( thisRow ).find( 'input' ).val( '' );
             
                });
		// Remove a row from the form
       $('#stock_receive_tbl').delegate('.remove', 'click', function(){
             $(this).closest('tr').remove();});

  
 

   $("#stock_received_fm").submit(function(e)
         {
          e.preventDefault();//STOP default action
          var vaccine_count=0;
          $.each($(".vaccine"), function(i, v) {
                   vaccine_count++;
          });

       
       var formURL="<?php echo base_url();?>stock/save_received_stock";

       var vaccines = retrieveFormValues_Array('vaccine');
       var batch_no = retrieveFormValues_Array('batch_no');
       var expiry_date = retrieveFormValues_Array('expiry_date');
       var quantity_received = retrieveFormValues_Array('quantity_received');
       var vvm_status = retrieveFormValues_Array('vvm_status');
       var date_received = retrieveFormValues('date_received');
       var received_from= retrieveFormValues('received_from');
       var transaction_type= retrieveFormValues('transaction_type');
	   var s11=retrieveFormValues('s11');

        for(var i = 0; i < vaccine_count; i++) {
          var get_vaccine=vaccines[i];
          var get_batch=batch_no[i];
          var get_expiry=expiry_date[i];
          var get_quantity_received=quantity_received[i];
          var get_vvm_status=vvm_status[i];
          var get_date_received=date_received;
          var get_received_from=received_from;
          var get_transaction_type=transaction_type;
		  var get_s11=s11;

          $.ajax(
          {
              url : formURL,
              type: "POST",
              data : {"transaction_type":get_transaction_type,"s11":get_s11, "date_received":get_date_received,"received_from":get_received_from,"vaccine":get_vaccine,"batch_no":get_batch,"expiry_date":get_expiry,"quantity_received":get_quantity_received,"vvm_status":get_vvm_status},
             /* dataType : json,*/
            // url : "<?php echo site_url("stock/list_inventory"); ?>";
              success:function(data, textStatus, jqXHR) 
              {
                  //data: return data from server
                  
                  window.location.replace('<?php echo base_url().'stock/list_inventory'?>');



              },
              error: function(jqXHR, textStatus, errorThrown) 
              {
                  //if fails      
              }
          });
     }
       // e.unbind(); //unbind. to stop multiple form submit.
           });

 

           function retrieveFormValues_Array(name) {
                      var dump = new Array();
                      var counter = 0;
                        $.each($("input[name=" + name + "], select[name=" + name + "]"), function(i, v) {
                            var theTag = v.tagName;
                            var theElement = $(v);
                            var theValue = theElement.val();
                            /*dump[counter] = theElement.attr("value");*/
                            dump[counter] = theValue;

                            counter++;
                        });
                      return dump;
            }

            function retrieveFormValues(name) {
                      var dump;
                        $.each($("input[name=" + name + "], select[name=" + name + "]"), function(i, v) {
                            var theTag = v.tagName;
                            var theElement = $(v);
                            var theValue = theElement.val();
                            dump = theValue;
                        });
                      return dump;
            }

        $('#expiry_date').datepicker({dateFormat: "yy-mm-dd"}).datepicker('setDate', NULL);
        $('#date_received').datepicker({dateFormat: "yy-mm-dd"}).datepicker('setDate', NULL);
        </script>