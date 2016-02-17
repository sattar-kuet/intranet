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
                            <i class="fa fa-plus"></i>Add new Category
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Chapter', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'type' => 'file'
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
                                <label class="control-label col-md-3">Select Class/Level<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    //pr($cities); //exit;
                                    echo $this->Form->input('level_id', array(
                                        'type' => 'select',
                                        'options' => $levels,
                                        'empty' => 'Select class/level',
                                        'class' => 'form-control select2me required pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Subject<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    //pr($cities); //exit;
                                    echo $this->Form->input('subject_id', array(
                                        'type' => 'select',
                                        'options' => $subjects,
                                        'empty' => 'Select class/level',
                                        'class' => 'form-control select2me required cclass',
                                        'id' => 'cid'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Select Chapter<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    //pr($cities); //exit;
                                    echo $this->Form->input('id', array(
                                        'type' => 'select',
                                        'options' => $chapters,
                                        'empty' => 'Select chapter',
                                        'class' => 'form-control select2me required ccclass',
                                        'id' => 'ccid'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>


                            <div class="form-group">
                                <label class="control-label col-md-3">New Chapter Name <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
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
                                            'Add', array('class' => 'btn green', 'type' => 'submit')
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

