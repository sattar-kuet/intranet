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
            All Successful Auto Recurring<small></small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>
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
                                <li> <b>Error Message :</b> <?php echo $results['transactions']['error_msg']; ?> </li>                           
                                <li> <b>Payment Date :</b> <?php echo $results['transactions']['created']; ?>  </li> 
                                <li> <b>Next Payment Date :</b> <?php echo $results['package_customers']['r_form']; ?></li> 
                                </td>
                                </tr>
                            <?php endforeach; ?>  
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
