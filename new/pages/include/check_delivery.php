<?php
session_start();
$outlet = $_SESSION['outlet'];
$branchId = $_SESSION['branch_id'];
?>

<div class="panel panel-default" id="panel_driver">
<div class="panel-heading">
    <h2 class="panel-title">Form Check Delivery</h2>
</div>
  <div class="panel-body">
    <?= $branchId ?>
    <form action="" id="form_driver">
        <div class="form-group">
            <input type="text" class="form-control" name="salesOrder" id="salesOrder" placeholder="Scan nota di sini ...">
        </div>

    </form>

  </div>
</div>


<style>
    .check_driver {
        background-color: rgba(0,0,0,.6);
        position: absolute;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        left: 0;
        top: 0;
        bottom: 0;
        z-index: 99;
    }

    #panel_driver {
        width: 40%;
        margin: 165px;
    }
</style>

<script>
    jQuery(function ($) {
        
        getData("SalesOrder/getOrderToCheckoutOutlet/"+outlet, { }, function (data) {
            if (data.readyState != 0) {
                console.log(data);
            }
        });


    })
</script>