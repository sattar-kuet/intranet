


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
    .txtArea { width:300px; }
      ul.pagination {
        display: flex;
        justify-content: center;
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
                            Total Customers: <?php // echo count($transactions);    ?> 
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
                                <div class="alert alert-info clearfix" style="color: #000; font-size: 14px;"> 
                                    <p> Total Subscription<b>: <?php echo $totalCustomer; ?></b> &nbsp; &nbsp;&nbsp;&nbsp;
                                        Total Paid Amount<b>: $<?php echo $totalPayment; ?> </b> </p>
                                </div> 
                                   <ul class="pagination" >
                            <?php
                            for ($i = 1; $i <= $total_page; $i++):
                                $active = '';
                                if (isset($this->params['pass'][0]) && $this->params['pass'][0] == $i) {
                                    $active = 'active';
                                }
                                ?>
                                <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                                    <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'successful', $i)) ?>"><?php echo $i; ?></a>
                                </li>
                            <?php endfor; ?>
                        </ul>
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
                                                Package
                                            </th>
                                            <th>
                                                Payment Information
                                            </th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($allData as $results):
                                            $customer = $results['package_customers'];
                                            $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                                    $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                                    . $customer['zip'];
                                            ?>
                                            <tr>
                                                <td class="hidden-480">
                                                    <?php echo $results['transactions']['id']; ?>                            
                                                </td>
                                                <td class="hidden-480">
                                                    <a href="<?php
                                                    echo Router::url(array('controller' => 'customers',
                                                        'action' => 'edit', $results['package_customers']['id']))
                                                    ?>" 
                                                       target="_blank">
                                                           <?php echo $results['package_customers']['first_name'] . ' ' . $results['package_customers']['middle_name'] . ' ' . $results['package_customers']['last_name']; ?>
                                                    </a><br>
                                                    <?php echo $customer_address; ?> 
                                                </td>                                     
                                                <td>
                                                    <?php if (!empty($results['ps']['name'])): ?>
                                                        Name:<?php echo $results['ps']['name'] ?><br>
                                                        Duration:<?php echo $results['ps']['duration']; ?><br>
                                                        Amount: <?php echo $results['ps']['amount']; ?>
                                                    <?php endif; ?>
                                                </td>                                     
                                                <td class="hidden-480">

                                        <li> <b>Paid Amount :</b> <?php echo $results['transactions']['paid_amount']; ?> </li>                           
                                        <li> <b>Transaction ID :</b> <?php echo $results['transactions']['trx_id']; ?> </li>                           

                                        <li> <b>Payment Method :</b> <?php echo $results['transactions']['pay_mode']; ?> </li>                           
                                        <li> <b>Payment Date :</b> <?php echo $results['transactions']['created']; ?>  </li>                          
                                        <li> <b>Next Payment Date :</b> <?php echo $results['package_customers']['r_form']; ?></li>                           
                                        </td>
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



