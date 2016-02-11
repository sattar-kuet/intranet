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
                                <div class="col-md-4">
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
                                <div class="col-md-offset-6 col-md-4">
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
                                    'options' => Array('canceled' => 'Cancel', 'continue' => 'Continue', 'hold' => 'Hold', 'reconnect' => 'Reconnect'),
                                    'empty' => 'Select Action',
                                    'class' => 'form-control form-filter input-sm',
                                        )
                                );
                                ?>
                                <?php
                                echo $this->Form->button(
                                        'DO', array('class' => 'btn whitesmoke', 'title' => 'Do this selected action', 'type' => 'submit')
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

