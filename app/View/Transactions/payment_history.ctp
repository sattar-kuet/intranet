
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
                                        'id' => 'e2',                                       
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

            <div class="row-fluid">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" style="border: green solid 3px;">
                    <thead>
                        <tr style="background-color:green; color:white; ">  
                            <th>Pay Mode</th>
                            <th>Error Msg</th>
                            <th>Paid Amount</th>
                            <th>Due</th>
                            
                            <th>Exp Date</th>
                            <th>CVV Code</th>
                            <th>Zip Code</th>
                            <th>Address</th>
                            <th>Check Info</th>
                            <th>Cash By</th>
                            <th>Trans Action Time</th>
                            <!--<th>Action</th>-->
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($transactions as $single):
                            $info = $single['Transaction'];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $info['pay_mode']; ?></td>
                                <td><?php echo $info['error_msg']; ?></td>
                                <td><?php echo $info['paid_amount']; ?></td>
                                <td><?php echo $info['due']; ?></td>
                                <td><?php echo $info['exp_date']; ?></td>
                                <td><?php echo $info['cvv_code']; ?></td>
                                <td><?php echo $info['zip_code']; ?></td>
                                <td><?php echo $info['address']; ?></td>
                                <td><?php echo $info['check_info']; ?></td>
                                <td><?php echo $info['cash_by']; ?></td>
                                <td><?php echo $info['created']; ?></td>
<!--                                <td>   
                                            <div class="controls center">                                               
                                        <a onclick="if (confirm(&quot;Are you sure to complete this transaction?&quot)) { return true; } return false;" href="<?php echo Router::url(array('controller'=>'payments','action'=>'individual_transaction', $info['id'])
                                                )?>" class="tip"><span class="icon16 icomoon-icon-coins" title="Make transaction for this customer"></span></a>
                                                
                                            </div>
                                            
                                        </td>-->
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>

                </table>
            </div>

        <?php endif; ?>
    </div>
   
</div>
<!-- END CONTENT -->



