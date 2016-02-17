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
            Requested withdraw List <small> Take necessary action</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-phone"></i>Requested withdraw
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php echo $this->Session->flash(); ?>

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone</th>
                                    <th>Image</th>
                                    <th>Withdraw Amount</th>      
                                    <th>Status</th>  
                                    <th> Time Passed </th>         
                                   
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($alldata as $k => $single):

                                    $reseller = $single['resellers'];
                                    $withdrawinfo = $single['reseller_accounts'];
                                    $transactions = $single['transactions'];

                                    ?>
                                    <tr>
                                        <td><?php echo $reseller['name']; ?></td>
                                        <td><?php echo $reseller['email']; ?></td>
                                        <td><?php echo $reseller['mobile']; ?></td>

                                        <td><img height="50" width="50" style="border-radius:50px !important;" src="<?php echo $this->webroot . 'reseller/' . $reseller['img'] ?>"/></td>

                                        <td><?php echo $withdrawinfo['withdraw']; ?> TK</td>
                                        <td>
                                            <ul> 
                                               <li>Total Earned : <?php echo $transactions['earned']; ?></li>
                                               <li>Total Spent : <?php echo $transactions['spent']; ?></li>
                                               <li>Balance after this transaction: <?php echo $transactions['balance']; ?> </li>
                                            </ul> 
                                        </td>
                                        <td><?php echo passedTime($withdrawinfo['modified']); ?> </td>
                                        
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

