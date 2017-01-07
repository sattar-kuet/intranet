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
            All auto Recurring<small></small>
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
                                        Auto Recurring Date
                                    </th>
                                    <th>
                                        Package
                                    </th>
<<<<<<< HEAD
                                   
                                    <th>
                                        Auto Recurring Date
                                    </th>
                                  
=======

>>>>>>> 42715c59b6716ed5791c3ca8465d6c72ca23203d
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allData as $results):
//                                       pr($results);
//                                            exit;
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
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->
