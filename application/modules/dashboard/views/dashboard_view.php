<?php defined('BASEPATH') OR exit('No direct script access allowed');?>
<!--
<script src="<?php //echo base_url() ?>assets/plugins/morris/morris.min.js" type="text/javascript"></script> 
<script src="<?php //echo base_url() ?>assets/plugins/morris/raphael-min.js" type="text/javascript"></script>  
<script src="<?php //echo base_url() ?>assets/plugins/morris/morris-script.js"></script> 
-->


  <div class="row">
    <div class="block-web">
    <div class="col-lg-12">

<div class="col-md-6">
      <h5 class="content-header text-info">Stock Available</h5>
</br>
    
 
<div id="morris-bar-chart" ></div>
</div>
<div class="col-md-6">
  
     <h5 class="content-header text-info">Usage Trends </h5>
<td> <select name="vaccine" class="form-control vaccine" id="vaccine">
                 <option value="">--Select Antigen--</option>
                 <?php foreach ($mavaccine as $vaccine) { 
                     echo "<option value='".$vaccine['Vaccine_name']."'>".$vaccine['Vaccine_name']."</option>";
                     }?>
                </select></td>

<div id="morris-line-chart" name="morris-line-chart" ></div>
</div>

</div>
</div>
  </div>

    
<br />

<div class="row">
    <div class="block-web">
        <div class="col-lg-12">
          <div class="col-md-6">
            <h5 class="content-header text-info">Wastage</h5>
            </br>
            <div id="morris-donut-chart" ></div>
          </div>
          
          <div class="col-md-6">
            <h5 class="content-header text-info">Coverage</h5>
            </br>
            <input type="checkbox" id="activate1" checked="checked"/> BCG
            <input type="checkbox" id="activate2" checked="checked"/>  OPV
            <input type="checkbox" id="activate3" checked="checked"/> PCV1
            <input type="checkbox" id="activate4" checked="checked"/> ROTA

            <div id="line-example"></div>
          </div>

        </div>
       </div>
</div>

</br>

 <div class="row">
        <div class="col-md-12">

    <h5 class="content-header text-info">Immunization Of Children</h5>      
            <table id="table" class="display table table-bordered dataTable table-hover" cellspacing="0" width="100%">
      <thead>
        <tr>
          <th class="content-header text-info">Month</th>
          <th class="content-header text-info">Children Immunized > 2yrs</th>
          <th class="content-header text-info">Children Immunized > 1yr</th>

        </tr>
      </thead>
      <tbody>
      </tbody>

      <tfoot>
        <tr>
          <th class="content-header text-info">Month</th>
          <th class="content-header text-info">Children Immunized > 2yrs</th>
          <th class="content-header text-info">Children Immunized > 1yr</th>
          
        </tr>
      </tfoot>
    </table>
  </div><!--/porlets-content-->  
</div><!--/block-web-->  


<script type="text/javascript">
$(document).ready(function(){
 
 Morris.Bar({
        element: 'morris-bar-chart',
        data: <?php echo json_encode($chart)?>,

        xkey: ['label'],
        ykeys: ['value'],
        labels: ['Series A'],
        hideHover: 'auto',
        resize: false,
        barColors: ['#54cdb4', '#FF0000'],
    });
 
 });
</script>

<script type="text/javascript">

$.get( "<?php echo base_url();?>dashboard/get_linechart", function(json) {
console.log(json);
Morris.Line({
        element: 'morris-line-chart',
        data: $.parseJSON(json) ,

        xkey: ['label'],
        ykeys: ['value'],
        parseTime:false,
        labels: ['Series A'],
        hideHover: 'auto',
        resize: false,
        lineColors: ['#54cdb4','#1ab394'],
    });
});

$('.vaccine').change(function () {
    var vaccine = $(this).val();
    console.log(vaccine);
	$('#morris-line-chart').empty();
   load_linechart(vaccine);
});

function load_linechart(vaccine){
    
        var _url="dashboard/get_linechart";
            
        var request=$.ajax({
           url: _url,
           type: 'post',
           data: {"vaccine":vaccine},

          });
          request.done(function(data){
		  console.log(data);
				Morris.Line({
					element: 'morris-line-chart',
					data: $.parseJSON(data) ,
					
					xkey: ['label'],
					ykeys: ['value'],
					parseTime:false,
					labels: ['Series A'],
					hideHover: 'auto',
					resize: false,
					lineColors: ['#54cdb4','#1ab394'],
					});
				});                 
           
          request.fail(function(jqXHR, textStatus) {
          
        });
}
    

</script>


<script type="text/javascript">

$(document).ready(function(){
  Morris.Donut({
  element: 'morris-donut-chart',
  data: <?php echo json_encode($chart)?>,
  colors:['#54cdb4','#0BA462','#95D7BB'],
  labelColor: '#333300'
    });
});
</script>

<script type="text/javascript">
$(document).ready(function(){
// function data(BCG,OPV,PCV1,ROTA) {
//   var ret = [
//               {"label":"July 2015","BCG":1575,"OPV":1097,"PCV1":1613,"ROTA":8339},
//               {"label":"August 2015","BCG":1491,"OPV":1146,"PCV1":1435,"ROTA":1156},
//               {"label":"September 2015","BCG":1700,"OPV":1110,"PCV1":1814,"ROTA":1316}
//             ];
   
//     if(BCG==false)
//     {
        
//     for(var i = 0; i < ret.length; i++)
//       delete ret[i].BCG;        
//     }
//     if(OPV==false)
//     {
       
//     for(var i = 0; i < ret.length; i++)
//       delete ret[i].OPV;        
//     }
//     if(PCV1==false)
//     {
       
//     for(var i = 0; i < ret.length; i++)
//       delete ret[i].PCV1;        
//     }
//     if(ROTA==false)
//     {
       
//     for(var i = 0; i < ret.length; i++)
//       delete ret[i].ROTA;        
//     }        
//      return ret;
// };

var morris = Morris.Line({
  element: 'line-example',
  data: <?php echo json_encode($coverage)?>,
  xkey: ['label'],
  parseTime:false,
  ykeys: ['BCG','OPV','PCV1','ROTA'],
  labels: ['Series A', 'Series B','Series C','Series D'],
  colors: ['red',"blue","green","yellow"]
});


    $('#activate1').on('change', function() {
      var isChecked1 = $('#activate1').is(':checked');
      var isChecked2 = $('#activate2').is(':checked');
      var isChecked3 = $('#activate3').is(':checked'); 
      var isChecked4 = $('#activate4').is(':checked');  
      var isChecked5 = $('#activate5').is(':checked');  
 
      morris.setData(data(isChecked1,isChecked2,isChecked3,isChecked4));
      
    });
    $('#activate2').on('change', function() {
      var isChecked1 = $('#activate1').is(':checked');
      var isChecked2 = $('#activate2').is(':checked');
      var isChecked3 = $('#activate3').is(':checked');  
      var isChecked4 = $('#activate4').is(':checked');  
      var isChecked5 = $('#activate5').is(':checked'); 

      morris.setData(data(isChecked1,isChecked2,isChecked3,isChecked4));
    });
    $('#activate3').on('change', function() {
      var isChecked1 = $('#activate1').is(':checked');
      var isChecked2 = $('#activate2').is(':checked');
      var isChecked3 = $('#activate3').is(':checked');
      var isChecked4 = $('#activate4').is(':checked');  
      var isChecked5 = $('#activate5').is(':checked');

      morris.setData(data(isChecked1,isChecked2,isChecked3,isChecked4));
    });
     $('#activate4').on('change', function() {
      var isChecked1 = $('#activate1').is(':checked');
      var isChecked2 = $('#activate2').is(':checked');
      var isChecked3 = $('#activate3').is(':checked');  
      var isChecked4 = $('#activate4').is(':checked');  
      var isChecked5 = $('#activate5').is(':checked'); 

      morris.setData(data(isChecked1,isChecked2,isChecked3,isChecked4));
      
    });
 });    
</script>

<script type="text/javascript">
 
    var table;
    $(document).ready(function() {
      table = $('#table').DataTable({ 
        
        "processing": true, //Feature control the processing indicator.
        "serverSide": true, //Feature control DataTables' server-side processing mode.
        
        // Load data for the table's content from an Ajax source
        "ajax": {
            "url": "<?php echo site_url('dashboard/get_data/')?>",
            "type": "POST"
        },

        //Set column definition initialisation properties.
        "columnDefs": [
        { 
          "targets": [ -1 ], //last column
          "orderable": true, //set not orderable
        },
        ],

      });
    });

</script>