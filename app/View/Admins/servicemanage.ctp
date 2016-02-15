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
            <div class="col-md-6">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i>Search customer information by cell no
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('PaidCustomer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                                //'url' => array('controler' => 'Admins', 'action' => 'changeservice')
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
                                <label class="control-label col-md-3">
                                </label>
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->input('cell', array(
                                        'type' => 'select',
                                        'options' => $cells,
                                        'empty' => 'Select Cell No',
                                        'class' => 'form-control select2me required pclass',
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
                                            'Search', array('class' => 'btn green', 'type' => 'submit')
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

            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet">
                    <div class="portlet-title line">
                        <div class="caption">
                            <i class="fa fa-envelope-o fa-lg"></i>Message from Admin
                        </div>
                        <div class="tools">
                            
                            <a href="" class="reload" data-original-title="" title="">
                            </a>
                            
                        </div>
                    </div>
                    <div class="portlet-body" id="chats">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;"><div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                                <ul class="chats">
                                    <li class="in">
                                        <img class="avatar" alt="" src="<?php echo $this->webroot; ?>/assets/admin/layout/img/avatar1.jpg">
                                        <div class="message">
                                            <span class="arrow">
                                            </span>
                                            <a href="#" class="name">
                                                Mr. Admin </a>
                                            <span class="datetime">
                                                at 20:09 </span>
                                            <span class="body">
                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                        </div>
                                    </li>
                                    <li class="in">
                                        <img class="avatar" alt="" src="<?php echo $this->webroot; ?>/assets/admin/layout/img/avatar1.jpg">
                                        <div class="message">
                                            <span class="arrow">
                                            </span>
                                            <a href="#" class="name">
                                                Mr. Manager </a>
                                            <span class="datetime">
                                                at 20:09 </span>
                                            <span class="body">
                                                Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt ut laoreet dolore magna aliquam erat volutpat. </span>
                                        </div>
                                    </li>

                                </ul>
                            </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 185.485px; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>

                    </div>
                </div>
                <!-- END PORTLET-->
            </div>

        </div>
        <!-- END PAGE CONTENT -->        

        <?php if ($clicked): ?>

            <div class="row-fluid">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                        <tr>                                           
                            <th>Name</th>
                            <th>Cell</th>
                            <th>Package</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $info = $customer_info['PaidCustomer'];
                        ?>
                        <tr class="odd gradeX">

                            <td><?php echo $info['lname']; ?></td>
                            <td><?php echo $info['cell']; ?></td>
                            <td><?php echo $info['psetting_id']; ?></td>
                            <td><?php echo $info['status']; ?></td>
                            <td>

                                <?php
                                echo $this->Form->create('PaidCustomer', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false
                                    ),
                                    'id' => 'form_sample_3',
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate',
                                    'url' => array('controller' => 'admins', 'action' => 'changeservice')
                                        )
                                );
                                ?>

                                <?php
                                echo $this->Form->input('id', array(
                                    'type' => 'hidden',
                                    'value' => $info['id']
                                        )
                                );
                                ?>
                                <?php
                                echo $this->Form->input('status', array(
                                    'type' => 'select',
                                    'options' => Array('ticket' => 'Generate Ticket', 'canceled' => 'Cancel', 'continue' => 'Continue', 'hold' => 'Hold', 'reconnect' => 'Reconnect'),
                                    'empty' => 'Select Action',
                                    'class' => 'form-control form-filter input-sm',
                                        )
                                );
                                ?>

                                <br>

                                <?php
                                echo $this->Form->button(
                                        'Go', array('class' => 'btn blue', 'title' => 'Do this selected action', 'type' => 'submit')
                                );
                                ?>
                                <?php echo $this->Form->end(); ?>


                            </td>



                        </tr>
                        <?php
                        ?>
                    </tbody>

                </table>
            </div>

            <?php
        endif;
        ?>

    </div>

</div>
<!-- END CONTENT -->

