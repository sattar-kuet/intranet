<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            No contact Order List <small>Contact with customer to confirm</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-phone"></i>No Contact Order
                        </div>
                        <?php echo $this->Session->flash(); ?>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">



                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th>Category</th>
                                    <th>Product Name</th>
                                    <th>Total Import</th>
                                    <th>Cost</th>
                                    <th>Due</th>
                                    <th>Stock</th>
                                    <th>Sold</th>
                                    <th>Profit</th>
                                    <th>Service charge</th>
                                    <th>SPPP</th>
                                    <th>BPPP</th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($filteredArray as $single):
                                    $stock = $single['imports']['amount'] - $single[0]['total_sell'];
                                    $discount = $single['psettings']['sppp'] * $single['psettings']['discount'] / 100;
                                    $total = $single['psettings']['sppp'] - $discount + $sc;
                                    $outcome = ceil($total) * $single[0]['total_sell'];
                                    $profit = $outcome - $single['imports']['cost'];
                                    ?>
                                    <tr>
                                        <td><?php echo $single['categories']['name']; ?></td>
                                        <td><?php echo $single['Product']['name']; ?></td>
                                        <td><?php echo $single['imports']['amount']; ?></td>
                                        <td><?php echo $single['imports']['cost']; ?></td>
                                        <td><?php echo $single['imports']['cost'] - $single['imports']['paid']; ?></td>
                                        <td><?php echo $stock . '(' . $stock * $total . 'TK)'; ?></td>
                                        <td><?php echo $single[0]['total_sell'] . '(' . $outcome . 'TK)'; ?></td>

                                        <td><?php echo $profit; ?></td>
                                        <td><?php echo $sc; ?></td>
                                        <td><?php echo $single['psettings']['sppp']; ?></td>
                                        <td><?php echo $single['psettings']['bppp']; ?></td>
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

