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
           Cancel Request <small></small>
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
                                    <th>
                                        Contact Date
                                    </th>
                                    <th>
                                        Customer detail
                                    </th>

                                    <th>
                                        Issue
                                    </th>
                                    <th>
                                        Mac will be canceled
                                    </th>

                                    <th>
                                        Canceled Date
                                    </th>

                                    <th>
                                        Expected pick up date
                                    </th>

                                    <th>
                                        Comment
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($filteredData as $results):
                                    $customer = $results['customers'];
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo $results['customers']['created']; ?>   <br>
                                            <?php echo $results['users']['name']; ?>  
                                        </td>
                                        <td>
                                            <ul>
                                                <b>  Name :</b>  <a href="<?php
                                                echo Router::url(array('controller' => 'customers',
                                                    'action' => 'edit_registration', $results['customers']['id']))
                                                ?>" 
                                                                    target="_blank">
                                                                        <?php
                                                                        echo $results['customers']['first_name'] . " " .
                                                                        $results['customers']['middle_name'] . " " .
                                                                        $results['customers']['last_name'];
                                                                        ?>
                                                </a><br>
                                                <b>  Address :  </b> <?php echo $customer_address; ?> <br>

                                                <?php if (!empty($customer['cell'])): ?>
                                                    <b> Cell :</b> <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a><br>
                                                <?php endif; ?>
                                                <?php if (!empty($customer['home'])): ?>
                                                    <b>  Home :</b>  <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                                <?php endif; ?> 
                                            </ul>

                                        </td>

                                        <td>
                                            <?php echo $results['issue']; ?>
                                        </td>
                                        <td>
                                            <?php echo get_canceled_mac($customer['mac'], $customer['cancel_mac']); ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if (!empty($results['customers']['cancelled_date'])): ?>
                                                    <?php echo $results['customers']['cancelled_date'] ?>
                                                <?php endif ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if (!empty($results['customers']['pickup_date'])): ?>
                                                    <?php echo $results['customers']['pickup_date'] ?>
                                                <?php endif ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if (!empty($results['customers']['comments'])): ?>
                                                    <?php echo $results['customers']['comments'] ?> 
                                                <?php endif ?>
                                            </ul>
                                        </td>
                                        <td>
                                            <div class="controls center text-center">

                                                <div class="portlet-body form">
                                                    <!-- BEGIN FORM-->
                                                    <?php
                                                    echo $this->Form->create('PackageCustomer', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'customers', 'action' => 'shedule_assian')
                                                            )
                                                    );
                                                    ?>

                                                    <?php
                                                    echo $this->Form->input('id', array(
                                                        'type' => 'hidden',
                                                        'value' => $results['customers']['id'],
                                                            )
                                                    );
                                                    ?>
                                                    <div class="form-body">
                                                        <div class="alert alert-danger display-hide">
                                                            <button class="close" data-close="alert"></button>
                                                            You have some form errors. Please check below.
                                                        </div>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('technician_id', array(
                                                                        'type' => 'select',
                                                                        'options' => $technician,
                                                                        'empty' => 'Select Technician',
                                                                        'class' => 'form-control select2me required',
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>                                               
                                                    </div>
                                                    <div class="form-group">                               
                                                        <div class="col-md-4">
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'daterange', array(
                                                                'class' => 'span9 text required e3'
                                                            ));
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Submit', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                    <!-- END FORM-->
                                                </div>
                                            </div>
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
