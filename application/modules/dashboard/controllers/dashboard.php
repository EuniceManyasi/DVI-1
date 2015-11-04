<?php
class Dashboard extends MX_Controller 
{

function __construct() {
parent::__construct();
Modules::run('secure_tings/is_logged_in');

}



function home() {
  Modules::run('secure_tings/is_logged_in');
  //echo "welcome to Dashboard";
  $data['chart'] = $this->get_chart();
  $data['mavaccine'] = $this->vaccines();
  $data['coverage'] = $this->get_coverage();
  $data['months'] = $this->get_months();
  $data['section'] = "DVI Kenya";
  $data['subtitle'] = "Dashboard";
  $data['page_title'] = "Baringo County";
  $data['module'] = "dashboard";
  $data['view_file'] = "dashboard_view";
  $user_group = ($this->session->userdata['logged_in']['user_group']);
  if ($user_group=='1') {
  echo Modules::run('template/admin', $data);
  }else if ($user_group=='2') {
    echo Modules::run('template/member', $data);  
  }else if ($user_group=='3') {
      echo Modules::run('template/epi', $data);
  }else if ($user_group=='4') {
      echo Modules::run('template/hrio', $data);
  }else if ($user_group=='5') {
      echo Modules::run('template/moh', $data);
  }else {
      echo Modules::run('template/phn', $data);
  }

}


function get_chart() {
    $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->getChart();
    $json_array=array(); 
    foreach ($query->result() as $row) {
       $data['value'] = (int)$row->Stock_balance;
       $data['label'] = $row->Vaccine;

       array_push($json_array,$data);

    }
        
    return $json_array;
  }

  function get_coverage() {
    $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->getCoverage();
        
    foreach ($query->result() as $row) {
      $json_array[]= array(
       "label"=>$row->Months,
       "BCG"=>(int)$row->BCG,
       "OPV"=>(int)$row->OPV,
       "PCV1"=>(int)$row->PCV1,
       "ROTA"=>(int)$row->ROTA,
       "Measles"=>(int)$row->Measles
       );    
    }
    //echo json_encode($json_array);
    return $json_array;
  }

  function get_months() {
    $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->getMonths();
    
    $json_array=array(); 
    foreach ($query->result() as $row) {
      
       $data['label'] = $row->months;

       array_push($json_array,$data);

    }
        
    return $json_array;
  }



  function get_linechart() {
    $vaccine = $this->input->post("vaccine");
    if (!empty($vaccine)){
      echo json_encode ($this->getLineChart($vaccine));
    } else{
      echo json_encode ($this->get_chart());
    }
    
  }

function getLineChart($vaccine){
    $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->getLineChart($vaccine);
    $json_array=array(); 
    foreach ($query as $row) {
       $data['value'] = (int)$row->Stock_balance;
       $data['label'] = $row->Vaccine;

       $json_array[] = $data;

    }
    return $json_array;
    //echo json_encode($json_array);
}
// function get_data() {
//     $this->load->model('mdl_dashboard');
//     $query = $this->mdl_dashboard->getData();
//     $datatables=array(); 
//     foreach ($query->result() as $row) {
//        $data['quantity_in'] = (int)$row->quantity_in;
//        $data['quantity_out'] = (int)$row->quantity_out;
//       $data['VVM_status'] = $row->VVM_status;

//         array_push($datatables,$data);
//     }
        
//   echo json_encode($datatables) ;
 
//  }

function get_data() {
    $query = $this->getData();
    //var_dump($query);
    $datatable = array();
    $no = $_POST['start'];
    foreach ($query as $data) {
      $no++;
      $row = array();
      $row[] = $data->Months;
      $row[] = (int)$data->Above2yrs;
      $row[] = $data->Above1yr;
     
      $datatable[] = $row;
    }
    
    $output = array(
              "draw" => $_POST['draw'],
              "recordsTotal" => $this->count_all(),
              "recordsFiltered" => $this->count_filtered(),
              "data" => $datatable,
            );
    //output to json format
    echo json_encode($output);
  }

/*function m_of_stock(){

  $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->mofstock();
    foreach ($query->result() as $row) {
      $json_array[]= array(
       "value"=>(int)$row->totalbcg,"label"="BCG",
       "value"=>(int)$row->totalopv1,"label"=>"OPV",
       "value"=>(int)$row->totalpneumococal1,"label"=>"PCV1",
       "value"=>(int)$row->totalrotavirus1,"label"=>"ROTA" );    
    }

        
    return $json_array;
}
*/

//   function m_of_stock(){

//   $this->load->model('mdl_dashboard');
//     $query = $this->mdl_dashboard->mofstock();
//     foreach ($query as $row) {
//       for($i=0; $i<count($query); $i++){

//       }
//     }
        
//     return count($query);


// }

function vaccines(){
    $query = $this->mdl_dashboard->get_vaccine_details();
    $vaccines=array(); 
    foreach ($query->result() as $row) {
       $data['ID'] = (int)$row->ID;
       $data['Vaccine_name'] = $row->Vaccine_name;

       array_push($vaccines,$data);

    }
        
    return $vaccines;
        }


function getData() {
    $this->load->model('mdl_dashboard');
    $query = $this->mdl_dashboard->getDatatable();
    return $query;
    //var_dump($query);
  }

function get($order_by){
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->get($order_by);
return $query;
}

function get_with_limit($limit, $offset, $order_by) {
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->get_with_limit($limit, $offset, $order_by);
return $query;
}

function get_where($id){
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->get_where($id);
return $query;
}

function get_where_custom($col, $value) {
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->get_where_custom($col, $value);
return $query;
}

function _insert($data){
$this->load->model('mdl_dashboard');
$this->mdl_dashboard->_insert($data);
}

function _update($id, $data){
$this->load->model('mdl_dashboard');
$this->mdl_dashboard->_update($id, $data);
}

function _delete($id){
$this->load->model('mdl_dashboard');
$this->mdl_dashboard->_delete($id);
}

function count_where($column, $value) {
$this->load->model('mdl_dashboard');
$count = $this->mdl_dashboard->count_where($column, $value);
return $count;
}

function get_max() {
$this->load->model('mdl_dashboard');
$max_id = $this->mdl_dashboard->get_max();
return $max_id;
}

function _custom_query($mysql_query) {
$this->load->model('mdl_dashboard');
$query = $this->mdl_dashboard->_custom_query($mysql_query);
return $query;
}

function count_all() {
            $this->load->model('mdl_dashboard');
            $query = $this->mdl_dashboard->count_all();
            return $query;
      }

      function count_filtered() {
            $this->load->model('mdl_dashboard');
            $query = $this->mdl_dashboard->count_filtered();
            return $query;
      }
}
