
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
                            <i class="fa fa-plus"></i>Expired Customers
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
                                <label class="control-label col-md-3" for="required">Select date</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'daterange', array(
                                        'id' => 'e2', /* e1 is past to current date, e2 is past to future date */
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

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user">Total tickets: <?php echo count($customers); ?></i>
                            </div>

                            <div class="tools">
                                <a href="javascript:;" class="reload">
                                </a>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <?php echo $this->Session->flash(); ?> 


                            <div class="row">
                                <div class="col-xs-12">
                                    <table class="table table-striped table-hover">
                                        <thead>
                                            <tr> 
                                                <th class="hidden-480">
                                                    Account no.
                                                </th>
                                                <th class="hidden-480">
                                                    Name
                                                </th>
                                                <th class="hidden-480">
                                                    Address
                                                </th>
                                                <th class="hidden-480">
                                                    Mac
                                                </th>
                                                <th class="hidden-480">
                                                    Cell
                                                </th>
                                                <th>
                                                    Package
                                                </th>
                                                <th class="hidden-480">
                                                    Due
                                                </th>
                                                <th class="hidden-480">
                                                    Exp Date
                                                </th>


                                            </tr>
                                        </thead>
                                        <tbody>                                    
                                            <?php
                                            foreach ($customers as $info):
                                                $customer_address = $info['PackageCustomer']['house_no'] . ' ' . $info['PackageCustomer']['street'] . ' ' .
                                                        $info['PackageCustomer']['apartment'] . ' ' . $info['PackageCustomer']['city'] . ' ' . $info['PackageCustomer']['state'] . ' '
                                                        . $info['PackageCustomer']['zip'];
                                                // pr($info); exit;
                                                ?>
                                                <tr>
                                                    <td><?php echo $info['PackageCustomer']['c_acc_no']; ?></td>
                                                    <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['PackageCustomer']['id'])) ?>" target="_blank"><?php echo $info['PackageCustomer']['middle_name'] . " " . $info['PackageCustomer']['last_name']; ?></a> </td>
                                                    <td><?php echo $customer_address; ?></td>
                                                    <td><?php echo $info['PackageCustomer']['mac']; ?></td>
                                                    <td><?php echo $info['PackageCustomer']['cell']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($info['PackageCustomer']['custom_package_id'] == null) {
                                                            if (count($info['Psetting']) == 0) {
                                                                echo 'No package was selected with this customer';
                                                            } else {
                                                                echo $info['Psetting']['name'];
                                                            }
                                                        } else {
                                                            echo $info['CustomPackage']['duration'] . ' Months, Custom package ' . $info['CustomPackage']['charge'] . '$';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>$<?php echo $info['PackageCustomer']['payable_amount']; ?></td>                                               
                                                    <td><?php echo date('m-d-Y', strtotime($info['PackageCustomer']['exp_date'])); ?></td>
                                                </tr>
                                            <?php endforeach; ?>                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- END EXAMPLE TABLE PORTLET-->
                    </div>

                    <!--                    <ul class="pagination" >
                    <?php
                    for ($i = 1; $i <= $total_page; $i++):
                        $active = '';
                        if (isset($this->params['pass'][0]) && $this->params['pass'][0] == $i) {
                            $active = 'active';
                        }
                        ?>
                                                    <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                                                        <a href="<?php echo Router::url(array('controller' => 'otherspayments', 'action' => 'manage', $i, $start, $end)) ?>"><?php echo $i; ?></a>
                                                    </li>
                    <?php endfor; ?>
                                        </ul>-->
                </div>
            <?php endif; ?>
        </div>
    </div>
    <!-- END CONTENT -->



