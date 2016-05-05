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
                            <i class="fa fa-plus"></i>Add new Ticket
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Ticket', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
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
                                <label class="control-label col-md-3">Select Issue<span class="required">
                                        * </span>
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('issue_id', array(
                                            'type' => 'select',
                                            'options' => $issues,
                                            'empty' => 'Select Issue',
                                            'class' => 'form-control select2me required',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Select Action 
                                </label>
                                <div class="form-group">
                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('action_type', array(
                                            'type' => 'select',
                                            'options' => array(
                                                'ready ' => 'Reday to Installation',
                                                'shipment' => 'Shipment',
                                                'solved ' => "It's Solved"
                                            ),
                                            'empty' => 'Select Action',
                                            'class' => 'form-control select2me ',
                                            'id' =>'action_type'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group assign_single">
                                <label class="control-label col-md-3">Assign to (individual)
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('user_id', array(
                                            'type' => 'select',
                                            'options' => $users,
                                            'empty' => 'Select From Existing admins panel user',
                                            'class' => 'form-control select2me',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group assign_group">
                                <label class="control-label col-md-3">Assign to (Department)
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('role_id', array(
                                            'type' => 'select',
                                            'options' => $roles,
                                            'empty' => 'Select Department or Role',
                                            'class' => 'form-control select2me',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group priority">
                                <label class="control-label col-md-3">Select Priority<span class="required">
                                        * </span>
                                </label>
                                <div class="form-group">

                                    <div class="col-md-4">
                                        <?php
                                        echo $this->Form->input('priority', array(
                                            'type' => 'select',
                                            'options' => array('low' => 'Low', 'medium' => 'Medium', 'high' => 'High'),
                                            'empty' => 'Select Priority',
                                            'class' => 'form-control select2me required priority_input',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">Ticket Details 
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'content', array(
                                        'class' => 'form-control required ckeditor',
                                        'data-error-container' => '#editor2_error',
                                        'rows' => 6,
                                        'type' => 'textarea',
                                        'id' => 'desc'
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
                                            'Create', array('class' => 'btn green', 'type' => 'submit')
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
    </div>
</div>
<!-- END CONTENT -->

