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
                            <i class="fa fa-plus"></i>Call Logs
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
                                <label class="control-label col-md-3" for="required">Select Date:</label>
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

                            <div class="form-group">                                
                                <label class="control-label col-md-3" for="required">Pay mode:</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input('pay_mode', array(
                                        'type' => 'select',
                                        'options' => array('card' => 'Card', 'check' => 'Check', 'money order' => 'Money Order', 'online bill' => 'Online Bill', 'cash' => 'Cash', 'refund' => 'Refund'),
                                        'empty' => 'Select Paymode',
                                        'class' => 'form-control select2me required',
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
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="invoice"  id="printableArea">

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
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>Customer Detail</th>
                                            <th>Payment Detail</th>
                                            <th>Payment Amount</th>
                                            <th>Payment Time</th>
                                        </tr>
                                    </thead>
                                    <tbody>                                     
                                        <?php
                                        $total = 0;
                                        foreach ($transactions as $single):
//                                            pr($single['tr']['pay_mode']); exit; 
                                            $tr = $single['tr'];                                           
//                                            $total += $tr['paid_amount'];
                                            $pc = $single['pc'];
                                            $customer_address = $pc['house_no'] . ' ' . $pc['street'] . ' ' .
                                                    $pc['apartment'] . ' ' . $pc['city'] . ' ' . $pc['state'] . ' '
                                                    . $pc['zip'];
                                            ?>
                                            <tr >
                                                <td>
                                                    <ul>
                                                        <li> <strong> Name: </strong>  
                                                            <a href="<?php
                                                            echo Router::url(array('controller' => 'Transactions',
                                                                'action' => 'edit_customer_data', $pc['id']))
                                                            ?>" 
                                                               target="_blank">
                                                                   <?php
                                                                   echo $pc['first_name'] . ' ' . $pc['middle_name'] . ' ' . $pc['last_name'];
                                                                   ?>
                                                            </a><br>
                                                        </li> 
                                                        <li><strong> Cell: </strong>  <?php echo $pc['cell']; ?> </li> 
                                                    </ul>
                                                </td>
                                                <td>
                                                    <ul>
                                                        <li><strong>Mode :</strong> <?php echo $tr['pay_mode']; ?></li>
                                                        <?php if ($tr['pay_mode'] == 'card'): ?>
                                                            <li><strong>Transaction ID :</strong> <?php echo $tr['trx_id']; ?></li>
                                                        <?php endif;
                                                        ?>
                                                    </ul>
                                                </td>
                                                <td><h4> $<?php echo $single['pt']['amount']; ?> </h4></td>
                                                <td>
                                                    <?php echo $tr['created']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>         
                                    </tbody>
                                </table>
                                <!--<h2 style="text-align: center;" > Grant Total: $<?php echo $total; ?></h2>-->
                            </div>
                        </div>
                    </div>
                </div>
            </div>                             
        <?php endif; ?>
    </div>
</div>
<!-- END CONTENT -->

