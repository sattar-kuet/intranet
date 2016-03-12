
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

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>New Customers
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

            <div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
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
                                <a class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank" onclick="window.print();">
                                    Print <i class="fa fa-print"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->

                    <div class="invoice">
                        <div class="row invoice-logo">
                            <div class="col-xs-12 invoice-logo-space">
                                <!--<img src="../../assets/admin/pages/media/invoice/walmart.png" class="img-responsive" alt="">-->
                                <div class="row">
                                    <div class="col-xs-12" style="text-align: center; margin-bottom: 41px;">

                                    <h4 class="page-title"  style="color: #353535; font-weight: bold;"><u>New Customers</u></h4>
                                    <div>Total Cable USA</div>
                                    <div>P.O. BOX 770068,</div>
                                    <div>WOODSIDE, NY 11377</div>
                                        
                                </div>
<!--                                    <div class="col-xs-6" style="text-align: right;  ">
                                        <h3 class="page-title"  style="color: #353535; font-weight: bold;"><u>New Customers</u> 
                                        </h3>
                                        <div style="text-align: center;">
                                        
                                           </div>
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
                                                Registration Date
                                            </th> 
<!--                                            <th>
                                                Pay Mode
                                            </th>
                                            <th>
                                                Error Msg
                                            </th>
                                            <th class="hidden-480">
                                                Paid Amount
                                            </th>
                                            <th class="hidden-480">
                                                Due
                                            </th>-->
                                            <th class="hidden-480">
                                                Exp Date
                                            </th>
                                            <th class="hidden-480">
                                                CVV Code
                                            </th>
                                            <th>
                                                Zip Code
                                            </th>
                                            <th class="hidden-480">
                                                Address
                                            </th>
<!--                                            <th class="hidden-480">
                                                Check Info
                                            </th>
                                            <th class="hidden-480">
                                                Cash By
                                            </th>-->
                                                                                      
                                        </tr>
                                    </thead>
                                    <tbody>                                    
                                        <?php
                                        foreach ($transactions as $single):
                                            $info = $single['Transaction'];
                                            ?>
                                            <tr>
                                                <td><?php echo $info['created']; ?></td>
<!--                                                <td><?php echo $info['pay_mode']; ?></td>
                                                <td><?php echo $info['error_msg']; ?></td>
                                                <td><?php echo $info['paid_amount']; ?></td>
                                                <td><?php echo $info['due']; ?></td>-->
                                                <td><?php echo $info['exp_date']; ?></td>
                                                <td><?php echo $info['cvv_code']; ?></td>
                                                <td><?php echo $info['zip_code']; ?></td>
                                                <td><?php echo $info['address']; ?></td>
                                                <td><?php // echo $info['check_info']; ?></td>
                                                <!--<td><?php echo $info['cash_by']; ?></td>-->                                                
                                            </tr>
                                        <?php endforeach; ?>                           
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>                               

        <?php endif; ?>
    </div>



</div>
<!-- END CONTENT -->



