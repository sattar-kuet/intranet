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
                            <i class="fa fa-plus"></i>All auto Recurring 
                            <?php // if ($clicked): ?>                              
                            Total Customers: <?php // echo count($transactions);  ?> 
                            <?php // endif; ?>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('PackageCustomer', array(
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
                    <div class="invoice" id="printableArea">

                        <hr>
                        <div class="row">
                            <div class="col-xs-12">
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th class="sorting_desc">
                                                ID
                                            </th>

                                            <th>
                                                Customer Detail
                                            </th>
                                            <th>
                                                Auto Recurring Date
                                            </th>
                                            <th>
                                                Package
                                            </th>


                                            <th>
                                                Auto Recurring Date
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($allData as $results):
                                            $customer = $results['pc'];
                                            $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                    $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                                    . $customer['zip'];
                                            ?>
                                            <tr>
                                                <td class="hidden-480">
                                                    <?php echo $results['pc']['id']; ?>                            
                                                </td>
                                                <td class="hidden-480">
                                                    <a href="<?php
                                                    echo Router::url(array('controller' => 'customers',
                                                        'action' => 'edit', $results['pc']['id']))
                                                    ?>" 
                                                       target="_blank">
                                                           <?php echo $results['pc']['first_name'] . ' ' . $results['pc']['middle_name'] . ' ' . $results['pc']['last_name']; ?>
                                                    </a><br>
                                                    <?php echo $customer_address; ?> 
                                                </td>  
                                                <td class="hidden-480">
                                                    <?php echo $results['pc']['r_form']; ?>                            
                                                </td>

                                                <td>
                                                    <?php if (!empty($results['ps']['name'])): ?>
                                                        Name:<?php echo $results['ps']['name'] ?><br>
                                                        Duration:<?php echo $results['ps']['duration']; ?><br>
                                                        Amount: <?php echo $results['ps']['amount']; ?>
                                                    <?php endif; ?>
                                                </td>  
                                                <td><?php echo $results['pc']['r_form']; ?></td>
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

