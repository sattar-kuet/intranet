
<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }
</style>

<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
</style>
<div class=""></div>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Search payment history
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Transaction', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate'
                                )
                        );
                        ?>
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>

                            <div class="form-group">                                
                                <label class="control-label col-md-3" for="required">Select date</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'daterange', array(
                                        'id' => 'e1', /* e1 is past to current date, e2 is past to future date */
                                        'class' => 'span9 text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn btn-success', 'type' => 'submit')
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>                
            </div>

        </div>
        <!-- END PAGE CONTENT -->

        <?php if ($clicked): ?>    


            <div class="">
                <!-- BEGIN PAGE HEADER-->
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>   </li>
                        <li>   </li>
                        <li>   </li>
                    </ul>
                    <script></script>
                    <div class="page-toolbar">
                        <div class="btn-group pull-right">
                            <a class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank" onclick="printDiv('printableArea')">
                                Print <i class="fa fa-print"></i>
                            </a>
                        </div>
                    </div>
                </div>
                <!-- END PAGE HEADER-->
                <!-- BEGIN PAGE CONTENT-->

                <div class="invoice" id="printableArea">
                    <div class="row invoice-logo">
                        <div class="col-xs-12 invoice-logo-space">
                            <!--<img src="../../assets/admin/pages/media/invoice/walmart.png" class="img-responsive" alt="">-->
                            <div class="row">
                                <div class="col-xs-12" style="text-align: center; margin-bottom: 41px;">
                                    <h4 class="page-title"  style="color: #353535; font-weight: bold;"><u>Payment History</u></h4>
                                    <div>Total Cable USA</div>
                                    <div>P.O. BOX 770068,</div>
                                    <div>WOODSIDE, NY 11377</div>

                                </div>
                                <!--                                <div class="col-xs-6">
                                                                    <h3 class="page-title">
                                                                        Payment History <small></small>
                                                                    </h3>
                                                                    
                                                                    
                                                                </div>
                                                                <div class="col-xs-4">
                                                                </div>
                                                                <div class="col-xs-2 invoice-payment">
                                                                    <div style="text-align: left;">
                                                                        <div>   Total Cable USA</div>
                                                                        <div>P.O. BOX 770068,</div>
                                                                        <div>WOODSIDE,</div>
                                                                        <div>NY 11377</div>
                                                                        <div>
                                                                            <div style="left: 103.238px; top: 144.543px; font-size: 25px; font-family: sans-serif;">☎<small style="font-size: 12px;">&nbsp 1-212-444-8138</small></div>
                                
                                                                        </div>
                                                                    </div>
                                                                </div>-->
                            </div>
                        </div>
                        <div class="col-xs-6">
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-xs-6">                    
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-2 invoice-payment">
                            <div style="text-align: left;">

                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-xs-12">
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th class="hidden-480">
                                            Account no.
                                        </th>
                                        <th class="hidden-480">
                                            Name
                                        </th>
                                        <th class="hidden-480">
                                            Address
                                        </th>
                                        <th class="hidden-480">
                                            Mac
                                        </th>
                                        <th class="hidden-480">
                                            Pay Mode
                                        </th>
                                        <th class="hidden-480">
                                            Payment Details
                                        </th>
                                        <th class="hidden-480">
                                            Paid Amount
                                        </th>
                                        <th class="hidden-480">
                                            Due
                                        </th>
                                        <th class="hidden-480">
                                            Submitted By
                                        </th>
                                        <th class="hidden-480">
                                            Transaction Date
                                        </th>                                           
                                    </tr>
                                </thead>
                                <tbody>                                    
                                    <?php
                                    foreach ($transactions as $single):
                                        $info = $single['Transaction'];
                                        $customer_info = $single['PackageCustomer'];
                                        $user_info = $single['User'];
                                        ?>
                                        <tr>
                                            <td>
                                                <?php echo $customer_info['c_acc_no']; ?>
                                            </td>
                                            <td>
                                                <a href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit_customer_data', $customer_info['id'])) ?>" target="_blank"><?php echo $customer_info['middle_name']. " " . $customer_info['last_name']; ?></a> 
                                            </td>
                                            <td>
                                                <?php echo $customer_info['street']; ?>, <?php echo $customer_info['apartment']; ?>
                                            </td>
                                            <td>
                                                <?php echo $customer_info['mac']; ?>
                                            </td>

                                            <td><?php echo $info['pay_mode']; ?></td>
                                            <td>
                                            <?php
                                            if($info['pay_mode']=='card'){
                                                if($info['status']== 'success'){
                                                    echo 'Successful';
                                                }
                                                else {echo $info['error_msg'];}
                                            }
                                            if($info['pay_mode']=='check' || $info['pay_mode']=='money order' || $info['pay_mode']=='online bill'){?>
                                                <a target="_blank" href="<?php echo $this->webroot; ?>check_images/<?php echo $info['check_image'];?>">    <img src="<?php echo $this->webroot; ?>check_images/<?php echo $info['check_image'];?>" alt="logo" class="logo-default" style="height: 50px; width: 100px;"></a>

                                           <?php }
                                            
                                            ?>
                                            </td>
                                            <td><?php echo $info['paid_amount']; ?></td>
                                            <td><?php echo $info['due']; ?></td>
                                            <td><?php echo $user_info['name']; ?></td>
                                            <td><?php echo $info['created']; ?></td>
                                        </tr>
                                    <?php endforeach; ?>                           
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>


        <?php endif; ?>

    </div>

</div>
<!-- END CONTENT -->



