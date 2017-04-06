<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

    .col-md-6 {
        margin-top: 10px;
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
                            <i class="fa fa-paperclip"></i>All Reports
                        </div>
                        <!--                        <div class="tools">
                                                    <a href="javascript:;" class="reload">
                                                    </a>
                                                </div>-->
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Role', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'reports', 'action' => 'all')
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

                                <div class="col-md-7" >
                                    <div class="col-md-12 display-hide hide-rest" id="only-date-range">
                                        <?php
                                        echo $this->Form->input(
                                                'daterangeonly', array(
                                            'class' => 'span9 text e1' /* e1 is past to current date, e2 is past to future date */
                                                )
                                        );
                                        ?>
                                    </div>

                                    <div class="col-md-12 row-fluid display-hide hide-rest" id="date-range-pay-mode">
                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->input(
                                                    'daterangepaymode', array(
                                                'class' => 'span9 text e1'/* e11 is past to current date, e2 is past to future date */
                                                    )
                                            );
                                            ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?php
                                            echo $this->Form->input('pay_mode', array(
                                                'type' => 'select',
                                                'options' => array('card' => 'Card', 'check' => 'Check', 'money order' => 'Money Order', 'online bill' => 'Online Bill', 'cash' => 'Cash', 'refund' => 'Refund'),
                                                'empty' => 'Select Paymode',
                                                'class' => 'form-control select2me '
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>

                                    <div class="col-md-12 row-fluid display-hide hide-rest" id="callog">
                                        <div class="row-fluid">
                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->input(
                                                        'daterangecalllog', array(
                                                    'class' => 'span9 text e1' /* e1 is past to current date, e2 is past to future date */
                                                        )
                                                );
                                                ?>
                                            </div>

                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->input('issue_id', array(
                                                    'type' => 'select',
                                                    'options' => $issues,
                                                    'empty' => 'Select Issue',
                                                    'class' => 'form-control select2me ',
                                                        )
                                                );
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row-fluid margin-top-15">
                                            <div class="col-md-6">
                                                <?php
                                                echo $this->Form->input('user_id', array(
                                                    'type' => 'select',
                                                    'options' => $users,
                                                    'empty' => 'Select From Existing admins panel user',
                                                    'class' => 'form-control select2me',
                                                        )
                                                );
                                                ?>
                                            </div>


                                            <div class="col-md-6">
                                                <?php
                                                $status = array("closed" => "Closed", "solved" => "Solved", "unresolved" => "Unresolved", "open" => "Open");
                                                echo $this->Form->input('status', array(
                                                    'class' => 'form-control  select2me',
                                                    'type' => 'select',
                                                    'options' => $status,
                                                    'empty' => 'Select status',
                                                        )
                                                );
                                                ?>
                                            </div>

                                        </div>

                                    </div>
                                </div>

                                <div class="col-md-5">
                                    <?php
                                    echo $this->Form->input('action', array(
                                        'type' => 'select',
                                        'options' => array('cancel' => 'Cancel', 'paymenthistory' => 'Payment History', 'newcustomer' => 'New Customer', 'expirecustomer' => 'Expire Customer', 'calllog' => 'Call Log', 'allautorecurring' => 'All Auto Recurring', 'successful' => 'Succeeded Auto Recurring', 'failed' => 'Faile Auto Recurring', 'summeryReport' => 'Summary', 'allinvoice' => 'All Invoice', 'openInvoice25' => 'Open Invoice', 'passedinvoice' => 'Passed Due Invoice', 'closedinvoice' => 'Closed Invoice', 'customerbylocation' => 'Customer By Location', 'allcustomers' => 'All Customers'),
                                        'empty' => 'Select Paymode',
                                        'class' => 'form-control select2me ',
                                        'id' => 'actionID'
                                            )
                                    );
                                    ?>
                                </div>


                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn green', 'type' => 'submit')
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
        <?php
        if ($action) {
//                            pr($action); exit;
            if ($action == 'newcustomer') {
                echo $this->element('newcustomer', array('data' => $data));
            }

            if ($action == 'paymenthistory') {
                echo $this->element('payment_history', array('data' => $data));
            }

            if ($action == 'cancel') {
                echo $this->element('cancel', array('data' => $data));
            }

            if ($action == 'expirecustomer') {
                echo $this->element('expcustomers', array('data' => $data));
            }

            if ($action == 'calllog') {
                echo $this->element('call_log', array('data' => $data));
            }

            if ($action == 'allautorecurring') {
                echo $this->element('allAutorecurring', array('data' => $data));
            }

            if ($action == 'successful') {
                echo $this->element('successful', array('data' => $data));
            }

            if ($action == 'failed') {
                echo $this->element('failed', array('data' => $data));
            }

            if ($action == 'summeryreport') {
                echo $this->element('summeryreport', array('data' => $data));
            }

            if ($action == 'allinvoice') {
                echo $this->element('allinvoice', array('data' => $data));
            }

            if ($action == 'openinvoice25') {
                echo $this->element('openinvoice25', array('data' => $data));
            }
            
            if ($action == 'passedinvoice') {
                echo $this->element('passedinvoice', array('data' => $data));
            }
            
            if ($action == 'closedinvoice') {
//                pr($data['']); exit;
                echo $this->element('closedinvoice', array('data' => $data));
            }
        }
        ?>
    </div>
</div>
<!-- END CONTENT -->

