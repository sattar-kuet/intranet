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
                        echo $this->Form->create('Psetting', array(
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
                                <div class="col-md-9">
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
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input('product_id', array(
                                        'type' => 'select',
                                        'options' => $product,
                                        'empty' => 'Select product',
                                        'id' => 'cid',
                                        'class' => 'form-control select2me required cclass Loadingpsetting',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class=" col-md-offset-3 col-md-9" id="prev_image1">


                            </div>
                            <div class="form-group img-upload">
                                <label class="control-label col-md-offset-3 col-md-3 btn green" style="text-align:center;">Add Thumbnail Image
                                    <?php
                                    echo $this->Form->input(
                                            'thum_img', array(
                                        'class' => 'form-control hide single_img_btn',
                                        'type' => 'file',
                                        'id' => 1
                                            )
                                    );
                                    ?>
                                </label>

                            </div>

                            <div class=" col-md-offset-3 col-md-9" id="prev_image2">


                            </div>
                            <div class="form-group img-upload">
                                <label class="control-label col-md-offset-3 col-md-3 btn green" style="text-align:center;">Add Small Image
                                    <?php
                                    echo $this->Form->input(
                                            'small_img', array(
                                        'class' => 'form-control hide single_img_btn',
                                        'type' => 'file',
                                        'id' => 2
                                            )
                                    );
                                    ?>
                                </label>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Buying price per piece<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'bppp', array(
                                        'class' => 'form-control required',
                                        'type' => 'text',
                                        'id' => 'bppp'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3">Selling price per piece<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'sppp', array(
                                        'class' => 'form-control required',
                                        'type' => 'text',
                                        'id' => 'sppp'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            
                            <div class="form-group">
                                <label class="control-label col-md-3">Discount(%)<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'discount', array(
                                        'class' => 'form-control required',
                                        'type' => 'text',
                                        'id' => 'discount'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group last">
                                <label class="control-label col-md-3">Description <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'desc', array(
                                        'class' => 'form-control required ckeditor',
                                        'data-error-container' => '#editor2_error',
                                        'rows' => 6,
                                        'type' => 'textarea',
                                        'id' => 'desc'
                                            )
                                    );
                                    ?>

                                    <div id="editor2_error">
                                    </div>
                                </div>
                            </div>
                            
                              <div class="form-group last">
                                <label class="control-label col-md-3">Index<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'index', array(
                                        'class' => 'form-control required ckeditor',
                                        'data-error-container' => '#editor3_error',
                                        'rows' => 6,
                                        'type' => 'textarea',
                                        'id' => 'index'
                                            )
                                    );
                                    ?>

                                    <div id="editor3_error">
                                    </div>
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
