
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
                                        Contact Date
                                    </th>
                                    <th>
                                        Customer detail
                                    </th>
                                    <th>
                                        Payment
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
//                                 pr($customer['total']); exit; 
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
                                            <?php if(!empty($customer['total'])): ?>
                                            <?php echo $customer['total']; ?>
                                            <?php endif ;?>
                                        </td>
                                        <td>
                                            <?php if(!empty($results['issues'][0]['name']['name'])): ?>
                                            <?php echo $results['issues'][0]['name']['name']; ?>
                                            <?php endif ;?>
                                        </td>$customer['total']
                                        <td>
                                            <?php echo get_canceled_mac($customer['mac'], $customer['cancel_mac']); ?>
                                        </td>
                                        <td>
                                            <ul>
                                                <?php if (!empty($results['customers']['unhold_date'])): ?>
                                                    <?php echo $results['customers']['unhold_date'] ?>
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
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->



<!--
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
         BEGIN PAGE HEADER
        <h3 class="page-title">
            Follow up customers List<small></small>
        </h3>

         END PAGE HEADER
         BEGIN PAGE CONTENT
        <div class="row">
            <div class="col-md-12">
                 BEGIN EXAMPLE TABLE PORTLET
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
                                        Phone
                                    </th>
                                    <th>
                                        Package
                                    </th>

                                    <th>
                                        Equipment
                                    </th>
                                    <th>
                                        Comment
                                    </th>
                                    <th>
                                        Attachment
                                    </th>                                    

                                    <th>
                                        Dead line
                                    </th>
                                    <th>
                                        Action
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($filteredData as $results):
                                    //    pr($results['comments']);
                                    //         exit;
                                    $customer = $results['customers'];

                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td class="hidden-480">
                                            <?php echo $results['customers']['created']; ?>  <br>
                                            <?php echo $results['users']['name']; ?>                            
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
                                        <td class="hidden-480">
                                            <?php if (!empty($customer['cell'])): ?>
                                                <a href="tel:<?php echo $customer['cell'] ?>"><?php echo $customer['cell']; ?></a> &nbsp;&nbsp;
                                            <?php endif; ?>
                                            <?php if (!empty($customer['home'])): ?>
                                                <a href="tel:<?php echo $customer['home'] ?>"><?php echo $customer['home']; ?></a>
                                            <?php endif; ?> 
                                        </td>
                                        <td>
                                            <?php if (!empty($results['package']['name'])): ?>
                                                Name:<?php echo $results['package']['name'] ?><br>
                                                Duration:<?php echo $results['package']['duration']; ?><br>
                                                Amount: <?php echo $results['package']['amount']; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td>
                                            <?php echo $customer['shipment_equipment'] . ' ' . $customer['shipment_note']; ?>
                                        </td>
                                        <td>
                                            <?php
                                            foreach ($results['comments'] as $comment):
                                                // pr($comment);
                                                ?>
                                                <span title="<?php echo $comment['content']['created']; ?>" class="fa fa-hand-o-right ">  <?php echo $comment['content']['content']; ?> &nbsp;&nbsp;</span> <i> <?php echo $comment['user']['name']; ?></i>
                                                <br> 
                                                <br> 

                                            <?php endforeach;
                                            ?>
                                        </td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 mix category_2 category_1">
                                                <div class="mix-inner">
                                                    <?php if (!empty($customer['attachment'])) { ?>
                                                        <img class="img-responsive" src="<?php echo $this->webroot . 'attchment' . '/' . $customer['attachment']; ?>" alt="">
                                                        <div class="mix-details">
                                                            <a class="mix-preview fancybox-button" href="<?php echo $this->webroot . 'attchment' . '/' . $customer['attachment']; ?>" title="Project Name" data-rel="fancybox-button">
                                                                <i class="fa fa-eye pull-right"></i>
                                                            </a>
                                                        </div>
                                                    <?php } else { ?>
                                                        <h4> No Attachment</h4>

                                                    <?php } ?>

                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <?php echo $results['customers']['schedule_date']; ?>
                                        </td>

                                        <td> 
                                            <div class="controls center text-center">
                                                <a 
                                                    href="doneDiv<?php echo $results['customers']['id']; ?>" title="Done" class="toggleDiv">
                                                   
                                                    <span  class="fa fa-check fa-lg "></span>
                                                </a>
                                                <a 
                                                    href="commentDiv<?php echo $results['customers']['id']; ?>" title="Comment" class="toggleDiv">
                                                   
                                                    <span  class="fa fa-comment fa-lg "></span>
                                                </a>
                                                &nbsp;
                                                <a 
                                                   href="postponeDiv<?php echo $results['customers']['id']; ?>"title="Post Pone" class="toggleDiv">
                                                    <span class="fa fa-pause fa-lg "></span>
                                                </a>
                                                &nbsp;
                                                <a 
                                                    href="rescheduleDiv<?php echo $results['customers']['id']; ?>" title="Reschedule" class="toggleDiv">
                                                    <span  class="fa fa-repeat fa-lg "></span>
                                                </a>

                                                &nbsp;
                                                <a 
                                                    href="cancelDiv<?php echo $results['customers']['id']; ?>" title="Cancel" class="toggleDiv">
                                                    <span class="fa fa-remove fa-lg "></span>
                                                </a>   
                                                
                                                <div id="doneDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
                                                    <?php
                                                    echo $this->Form->create('PackageCustomer', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'technicians', 'action' => 'dodone')
                                                            )
                                                    );
                                                    ?>


                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
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
                                                        <?php echo $this->Session->flash(); ?>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('comment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments for cancel'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Done', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                     END FORM
                                                </div>

                                                <div id="commentDiv<?php echo $results['customers']['id']; ?>" class=" hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
                                                    <?php
                                                    echo $this->Form->create('Comment', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'technicians', 'action' => 'comment')
                                                            )
                                                    );
                                                    ?>
                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
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
                                                        <?php echo $this->Session->flash(); ?>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('content', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments here'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Comment', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                     END FORM
                                                </div>
                                                
                                                <div id="postponeDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
                                                    <?php
                                                    echo $this->Form->create('PackageCustomer', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'technicians', 'action' => 'postPone')
                                                            )
                                                    );
                                                    ?>


                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
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
                                                        <?php echo $this->Session->flash(); ?>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('comment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments for post pone'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Post pone', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                     END FORM
                                                </div>

                                                <div id="rescheduleDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
                                                    <?php
                                                    echo $this->Form->create('PackageCustomer', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'technicians', 'action' => 'reschedule')
                                                            )
                                                    );
                                                    ?>

                                                                                                                

                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
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
                                                        <?php echo $this->Session->flash(); ?>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('comment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments for reschedule'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Done', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                     END FORM
                                                </div>

                                                <div id="cancelDiv<?php echo $results['customers']['id']; ?>" class="hideRest portlet-body form" style="display: none;">
                                                     BEGIN FORM
                                                    <?php
                                                    echo $this->Form->create('PackageCustomer', array(
                                                        'inputDefaults' => array(
                                                            'label' => false,
                                                            'div' => false
                                                        ),
                                                        'id' => 'form_sample_3',
                                                        'class' => 'form-horizontal',
                                                        'novalidate' => 'novalidate',
                                                        'url' => array('controller' => 'technicians', 'action' => 'cancel')
                                                            )
                                                    );
                                                    ?>


                                                    <?php
                                                    echo $this->Form->input('package_customer_id', array(
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
                                                        <?php echo $this->Session->flash(); ?>
                                                        <div class="form-group">
                                                            <div class="form-group">
                                                                <div class="col-md-12">
                                                                    <?php
                                                                    echo $this->Form->input('comment', array(
                                                                        'type' => 'textarea',
                                                                        'class' => 'form-control required txtArea',
                                                                        'placeholder' => 'Write your comments for cancel'
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-actions">
                                                        <div class="row">
                                                            <div class="col-md-offset-7 col-md-4">
                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Cancel', array('class' => 'btn green', 'type' => 'submit')
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>
                                                     END FORM
                                                </div>

                                            </div>
                                        </td>  



                                    </tr>
                                <?php endforeach; ?>  

                            </tbody>
                        </table>
                    </div>
                </div>
                 END EXAMPLE TABLE PORTLET
            </div>
        </div>
         END PAGE CONTENT 
    </div>
</div>-->
<!-- END CONTENT -->
