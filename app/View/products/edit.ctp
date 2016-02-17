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
                            <i class="fa fa-plus"></i>Edit Product
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Product', array(
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
                                <label class="control-label col-md-3">Category
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input('category_id', array(
                                        'type' => 'select',
                                        'options' => $categories,
                                        'empty' => 'Select Category',
                                        'class' => 'form-control select2me required pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">Product
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input('id', array(
                                        'type' => 'select',
                                        'options' => $products,
                                        'empty' => 'Select product',
                                        'id' => 'cid',
                                        'class' => 'form-control select2me required cclass startLoading',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">New product Name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'name', array(
                                        'class' => 'form-control required',
                                        'id' => 'pname',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3">New Writer Name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'writer', array(
                                        'class' => 'form-control required',
                                        'id' => 'writerName',
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
                                            'Update', array('class' => 'btn green', 'type' => 'submit')
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

