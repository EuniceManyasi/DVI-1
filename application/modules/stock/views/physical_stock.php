<?php
$form_attributes = array('id' => 'physical_stock_fm');
echo form_open('',$form_attributes);?>
<div class="col-lg-12">
<div class="panel-body">
<div id="physical_stock">
<table class="table table-bordered table-hover table-striped ">
	<thead>
		<th style="width:12%;" class="small" align="center">Vaccine/Diluents</th>
		<th style="width:9%;" class="small">Batch Number</th>
		<th style="width:15%;" class="small">Expiry Date</th>
		<th style="width:16%;" class="small">Available Quantity</th>
		<th style="width:15%;" class="small">Physical Count</th>
        <th style="width:9%;" class="small">Date Of Count</th>
		<th style="width:12%;" class="small">Action</th>
							
							
	</thead>
	<tbody>
		<tr physical_row="1">
			<input type="hidden" name ="transaction_type" class="transaction_type" value="2">
            <td><select name="vaccine" class="form-control vaccine" id="vaccine" required="true">
		                 <option value="">--Select One--</option>
		                 <?php foreach ($vaccines as $vaccine) { 
		                     echo "<option value='".$vaccine['ID']."'>".$vaccine['Vaccine_name']."</option>";
		                     }?>
                </select></td>
            <td><select name="batch_no" class="form-control batch_no" id="batch_no"></td>
            <td><?php $data=array('name' => 'expiry_date','id'=> 'expiry_date','class'=>'form-control expiry_date', 'required'=>'true', 'type'=>'date'); echo form_input($data);?></td>
             		 <style type="text/css">
		                input[id="available_quantity"]{
		                 background-color: #E0F2F7 !important }</style></td>
            <td><?php $data=array('name' => 'available_quantity','id'=> 'available_quantity','class'=>'available_quantity','readonly'=>'true', 'value'=>'' ); echo form_input($data);?></td>
            <td><?php $data=array('name' => 'physical_count','id'=>'physical_count' ,'class'=>' physical_count', 'required'=>'true', 'type' =>'number',' min' => '0'); echo form_input($data);?></td>
            <td><?php $data=array('name' => 'date_count','id'=> 'date_count','class'=>'form-control date_count', 'required'=>'true', 'type'=>'date'); echo form_input($data);?></td>
            <td class="small">
		     			<a href="#" class="add btn"><span class="label label-success"><i class="fa fa-plus-square"></i> <b>ADD</b></span></a><br>
		             	<a class="remove btn" href="#"><span class="label label-danger"><i class="fa  fa-minus-square"></i> <b>REMOVE</b></span></a>
		    </td>

           </tr>     	
             	
	</tbody>
</table>
</div>
</div>
</div>
<button type="submit" name="physical_count_fm" id="physical_count_fm" class="btn btn-sm btn-danger">Submit</button>
<?php echo form_close();?>
<script type="text/javascript">
	$('#expiry_date').datepicker({dateFormat: "yy-mm-dd"}).datepicker({setDate: null});
	$("#expiry_date").datepicker("option", "minDate", 0);
	$('#date_count').datepicker({dateFormat: "yy-mm-dd"}).datepicker({setDate: null});

	// Add another row in the form on click add

           $('#physical_stock').delegate( '.add', 'click', function () {

             var thisRow =$('#physical_stock tr:last');
              var cloned_object = $( thisRow ).clone();

              var physical_row = cloned_object.attr("physical_row");
			  var next_physical_row = parseInt(physical_row) + 1;
			   cloned_object.attr("physical_row", next_physical_row);
                
                var vaccine_id = "vaccine" + next_physical_row;
			    var vaccine = cloned_object.find(".vaccine");
				vaccine.attr('id',vaccine_id);
               
               var batch_id = "batch_no" + next_physical_row;
			    var batch = cloned_object.find(".batch_no");
				batch.attr('id',batch_id);

				var expiry_id = "expiry_date" + next_physical_row;
				var expiry = cloned_object.find(".expiry_date");
				expiry.attr('id',expiry_id);

				var available_quantity_id = "available_quantity" + next_physical_row;
			    var available_quantity = cloned_object.find(".available_quantity");
				available_quantity.attr('id',available_quantity_id);

				var physical_count_id = "physical_count" + next_physical_row;
			    var physical_count = cloned_object.find(".physical_count");
				physical_count.attr('id',physical_count_id);


                cloned_object .insertAfter( thisRow ).find( 'input' ).val( '' );
             
                });
// Remove a row from the form
           $('#physical_stock').delegate('.remove', 'click', function(){
             $(this).closest('tr').remove();});


           $("#physical_stock_fm").submit(function(e)
         {
			         	e.preventDefault();//STOP default action
			         	var vaccine_count=0;
			         	$.each($(".vaccine"), function(i, v) {
			                   vaccine_count++;
			         	});

		   
		   var formURL="<?php echo base_url();?>stock/save_physical_count";

		   var vaccines = retrieveFormValues_Array('vaccine');
		   var batch_no = retrieveFormValues_Array('batch_no');
                   var date_count = retrieveFormValues_Array('date_count');
                   var available_quantity = retrieveFormValues_Array('available_quantity');
		   var physical_count = retrieveFormValues_Array('physical_count');



		   	for(var i = 0; i < vaccine_count; i++) {
		   		var get_vaccine=vaccines[i];
		   		var get_batch=batch_no[i];
                var get_date_of_count=date_count[i];
	            var get_available_quantity=available_quantity[i];
		   		var get_count=physical_count[i];
		   		

					    $.ajax(
					    {
					        url : formURL,
					        type: "POST",
					        data : {"vaccine":get_vaccine,"batch_no":get_batch,"date_of_count":get_date_of_count,"available_quantity":get_available_quantity,"physical_count":get_count},
					       /* dataType : json,*/
					     success:function(data, textStatus, jqXHR) 
					        {
                                                    
						    console.log(data);
					        	window.location.replace('<?php echo base_url().'stock/list_inventory'?>');
					            //data: return data from server
					        },
					     error: function(jqXHR, textStatus, errorThrown) 
					        {
					            //if fails      
					        }
					    });
		 }
		   // e.unbind(); //unbind. to stop multiple form submit.
           });

		
			$(document).on( 'change','.vaccine', function () {
						var stock_row=$(this);
					   var selected_vaccine=$(this).val();
					   load_batches(selected_vaccine,stock_row);
		     });

		function load_batches(selected_vaccine,stock_row){
		
					//var _url='http://localhost/DVI/stock/get_batches';
					var _url="<?php echo base_url();?>stock/get_batches";
							var request=$.ajax({
								     url: _url,
								     type: 'post',
								     data: {"selected_vaccine":selected_vaccine},

						    });

				    request.done(function(data){
					    	data=JSON.parse(data);
					    	console.log(data);
					    	stock_row.closest("tr").find(".batch_no option").remove();
					    	stock_row.closest("tr").find(".expiry_date ").val("");
					    	stock_row.closest("tr").find(".available_quantity").val("");
					    	stock_row.closest("tr").find(".batch_no ").append("<option value='0'>Select batch </option> ");
				    $.each(data,function(key,value){
				    		stock_row.closest("tr").find(".batch_no").append("<option value='"+value.batch_number+"'>"+value.batch_number+"</option> ");
			    		/*value[0].batch_number;*/
			    		
			    	});
			    });
			    request.fail(function(jqXHR, textStatus) {
				  
				});
		}
		
		
			$(document).on( 'change','.batch_no', function () {
				   var stock_row=$(this);
				   var selected_batch=$(this).val();
			     batch_details(selected_batch,stock_row);
		});

		function batch_details(selected_batch,stock_row){
					//var _url="<?php echo base_url();?>stock/get_batch_details";
                        var _url="<?php echo base_url();?>stock/get_batch_details";
								
						var request=$.ajax({
							     url: _url,
							     type: 'post',
							     data: {"selected_batch":selected_batch},

					    });
					    request.done(function(data){
								    	data=JSON.parse(data);
								    	console.log(data);
								    	stock_row.closest("tr").find(".expiry_date ").val("");
								    	stock_row.closest("tr").find(".available_quantity").val("");
								    	
					    $.each(data,function(key,value){
					    		stock_row.closest("tr").find(".expiry_date").val(value.expiry_date);
					    		stock_row.closest("tr").find(".available_quantity").val(value.stock_balance);
					    });
					                                });
					    request.fail(function(jqXHR, textStatus) {
						  
						});
		}

		 //This function loops the whole form and saves all the input, select, e.t.c. elements with their corresponding values in a javascript array for processing

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








</script>

