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
            Failed payment list<small></small>
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
                                        SL.
                                    </th>
                                    <th>
                                        Customer Detail
                                    </th>

                                    <th>
                                        Payment Details
                                    </th>

                                    <th>
                                        Payment Date
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($allData as $results):
                                    $customers = $results['pc'];
                                    $customer_address = $customers['house_no'] . ' ' . $customers['street'] . ' ' .
                                            $customers['apartment'] . ' ' . $customers['city'] . ' ' . $customers['state'] . ' '
                                            . $customers['zip'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo $customers['id']; ?>                            
                                        </td>
                                        <td>
                                            <a href="<?php
                                            echo Router::url(array('controller' => 'customers',
                                                'action' => 'edit_registration', $customers['id']))
                                            ?>" 
                                               target="_blank">
                                                   <?php
                                                   echo $customers['first_name'] . " " .
                                                   $customers['middle_name'] . " " .
                                                   $customers['last_name'];
                                                   ?>
                                            </a><br>
                                            <?php if (!empty($customer['cell'])): ?>
                                                <b>Cell:</b>  <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a> &nbsp;&nbsp;
                                            <?php endif; ?><br>
                                            <?php if (!empty($customer['home'])): ?>
                                                <b> Phone: </b> <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                            <?php endif; ?> <br>

                                            <b> Address: </b> <?php echo $customer_address; ?> 
                                        </td>
                                        <td><?php echo $results['ti']['content']; ?></td>
                                        <td><?php echo date('m-d-Y', strtotime($results['ti']['created'])); ?></td>
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
