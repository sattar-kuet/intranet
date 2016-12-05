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
                            <i class="fa fa-plus"></i>Unhold Request
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
            <h3 class="page-title">
                Unhold Request<small></small>
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
                                            SL.
                                        </th>
                                        <th>
                                            Contact Date
                                        </th>
                                        <th>
                                            Customer detail
                                        </th>

                                        <th>
                                            Package
                                        </th>

                                        <th>
                                            Issue
                                        </th>
                                        <th>
                                            Mac will be unhold
                                        </th>

                                        <th>
                                            unhold Date
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
                                                <?php echo $results['customers']['id']; ?>                            
                                            </td>
                                            <td class="hidden-480">
                                                  <?php echo date('m-d-Y', strtotime($results['customers']['created'])); ?>  <br>
                                                <?php echo $results['users']['name']; ?>  
                                            </td>
                                            <td>
                                                <ul>
                                                    <b>  Name :</b>  <a href="<?php
                                                    echo Router::url(array('controller' => 'customers',
                                                        'action' => 'edit', $results['customers']['id']))
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
                                                <?php if (!empty($results['package']['name'])): ?>
                                                    Name: <?php echo $results['package']['name'] ?><br>
                                                    Duration: <?php echo $results['package']['duration']; ?><br>
                                                    Total: $<?php echo $customer['total']; ?>
                                                    <?php // echo $results['package']['amount'];  ?>
                                                <?php endif; ?>
                                            </td>

                                            <td>
                                                <?php echo $results['issue']; ?>
                                            </td>
                                            <td>
                                                <?php echo get_canceled_mac($customer['mac'], $customer['cancel_mac']); ?>
                                            </td>
                                            <td>
                                                <ul>
                                                    <?php if (!empty($results['customers']['unhold_date'])): ?>
                                                        <?php echo date_format(new DateTime($results['customers']['unhold_date']), 'm-d-Y'); ?>
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

                                                            <div class="form-group">                               
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'schedule_date', array(
                                                                        'type' => 'text',
                                                                        'placeholder' => 'Select date',
                                                                        'class' => "datepicker form-control",
                                                                        'title' => 'Click & select date'
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div> 
                                                            <div class="form-group">                               
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'seTime', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control',
                                                                        'placeholder' => 'Write time range',
                                                                        'title' => 'Write time range'
                                                                            )
                                                                    );
                                                                    ?> 

                                                                </div>
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
        <?php endif; ?>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->
