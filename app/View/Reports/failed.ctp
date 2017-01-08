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
                        <div class="alert alert-info clearfix" style="color: #000; font-size: 14px;"> 
                            <p> Total Subscription<b>: <?php echo $totalCustomer; ?></b> &nbsp; &nbsp;&nbsp;&nbsp;
                                Total Payable Amount<b>: $<?php echo $totalPayment; ?> </b></p>
                        </div> 

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
                                    <th>
                                        Payment attempt at
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $results):
                                    $customer = $results['pc'];
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo $results['t']['id']; ?>                            
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
                                        <td>
    <?php if (!empty($results['psettings']['name'])) { ?>
                                                Name:<?php echo $results['psettings']['name'] ?><br>
                                                Duration:<?php echo $results['psettings']['duration']; ?><br>
                                                Amount: <?php echo $results['psettings']['amount']; ?>
    <?php } else { ?>
                                                Name: <?php echo $results['custom_packages']['duration'] ?> Month(s) Custom Package<br>
                                                Amount: <?php echo $results['custom_packages']['charge']; ?>
    <?php } ?>
                                        </td>   

                                        <td class="hidden-480">
    <?php echo $results['t']['content']; ?>                          
                                        </td>
                                        <td>
    <?php echo $results['t']['created']; ?>                          
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
