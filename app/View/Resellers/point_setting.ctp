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
                <div class="portlet box purple">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Reseller point  Settings
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Point', array(
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

                            <?php
                            echo $this->Form->input('id',array(
                                'id' => 'pid',
                                'value' => 0
                            ));
                            ?>



                            <div class="form-group">
                                <div class="col-md-12">
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
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input('product_id', array(
                                        'type' => 'select',
                                        'options' => $product,
                                        'empty' => 'Select Product',
                                        'id' => 'cid',
                                        'class' => 'form-control product_id_input select2me required cclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="margin-top-10 margin-bottom-10 clearfix warning_info display-hide">
                                <table class="table table-bordered table-striped">
                                    <tr>
                                        <td>
                                            <div  class="warning_text" style="padding:5px 0px; text-align: center;">
                                                
                                            </div>
                                        </td>
                                    </tr>


                                </table>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input(
                                            'sold', array(
                                        'class' => 'form-control required',
                                        'type' => 'text',
                                        'placeholder' => 'How many point whould you set for one product sold?'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input(
                                            'fake', array(
                                        'class' => 'form-control required',
                                        'type' => 'text',
                                        'placeholder' => 'How many negative point whould you set for one product returned after delivary?'
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
                                            'Save Change', array('class' => 'btn green', 'type' => 'submit')
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
