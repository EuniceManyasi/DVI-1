<form id="list_orders_fm">
   <a href='<?php echo site_url('order/create_order');?>' class='btn btn-info state_change' id="create_order" value="Create Order">Create Order</a>
   <hr></hr> <hr></hr>

<!--Listing Placed Orders-->
      <div><h5 class="bg-info">Placed Orders</h5></div>
      <hr></hr>

    <table class="table" id="list_orders_tbl">
        <thead>
                <tr><td>Order No</td><td>Order By </td><td>Date Created</td><td>Status</td><td>Action</td></tr>
        </thead>

        <tbody>

        <?php foreach ($orders as $order) { 
          $ledger_url = base_url().'order/view_orders/'.$order['order_id'];?>

              <tr>
              <td><?php echo $order['order_id']?></td>
              <td><?php echo $order['order_by']?></td>
              <td><?php echo $order['date_created']?></td>
              <td style="color:red">Pending</td>
              <td><a href="<?php echo $ledger_url ?>">View</a><span class="divider"> | </span><a href="#">Download</a></td>
        <?php }?>
              </tr>

        </tbody>
        </table>

<!--Listing Rejected Orders-->
      <hr></hr>
      <div><h5 class="bg-info">Rejected Orders</h5></div>
      <hr></hr>

  <table class="table" id="list_rejected_orders_tbl">
        <thead>
          <tr><td>Order No</td><td>Order By </td><td>Date Rejected</td><td>Reasons</td><td>Action</td></tr>
        </thead>
        <tbody>
                <tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td><a href="#">Edit/Modify</a></td>
                </tr>
        </tbody>
  </table>
</form>