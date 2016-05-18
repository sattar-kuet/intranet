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
            Troubleshot Technicians <small></small>
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
                                        Customer Name
                                    </th>

                                    <th>
                                        Address
                                    </th>
                                    <th>
                                        Attachment
                                    </th>
                                    <th>
                                        Emergency Contact
                                    </th>
                                    <th>
                                        Equipment Needed
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
                                    //  pr($customer);
                                    //  exit;
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo $results['customers']['created']; ?>                            
                                        </td>
                                        <td>
                                            <a href="<?php
                                            echo Router::url(array('controller' => 'customers',
                                                'action' => 'edit_registration', $results['customers']['id']))
                                            ?>" 
                                               target="_blank">
                                                   <?php
                                                   echo $results['customers']['first_name'] . " " .
                                                   $results['customers']['middle_name'] . " " .
                                                   $results['customers']['last_name'];
                                                   ?>
                                            </a>

                                        </td>
                                        <td>
                                            <?php echo $customer_address; ?> 
                                        </td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 mix category_2 category_1">
                                                <div class="mix-inner">
                                                    <img class="img-responsive" src="<?php echo $this->webroot . 'attchment' . '/' . $customer['attachment']; ?>" alt="">
                                                    <div class="mix-details">
                                                        <a class="mix-preview fancybox-button" href="<?php echo $this->webroot . 'attchment' . '/' . $customer['attachment']; ?>" title="Project Name" data-rel="fancybox-button">
                                                            <i class="fa fa-eye pull-right"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="hidden-480">
                                            <?php if (!empty($customer['cell'])): ?>
                                                <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a> &nbsp;&nbsp;
                                            <?php endif; ?>
                                            <?php if (!empty($customer['home'])): ?>
                                                <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                            <?php endif; ?> 
                                        </td>
                                        <td>
                                            <?php echo $customer['shipment_equipment'] . ' ' . $customer['shipment_note']; ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if (!empty($results['customers']['comments'])): ?>
                                                    <li><?php echo $results['customers']['comments'] ?> </li>
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
