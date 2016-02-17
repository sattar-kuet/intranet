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
                            <i class="fa fa-plus"></i>Add your valuable Feedback
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Feedback', array(
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

                         <?php
                                echo $this->Form->input('id', array('id'=>'feedbackId','value'=>0));
                        ?>
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>
                           
                            <div class="form-group">                      
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'class' => 'form-control required feedbackEmail',
                                        
                                        'placeholder' => 'Type your Email here..'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            
                            
                            <div class="form-group">                      
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input(
                                            'mobile', array(
                                        'class' => 'form-control required',
                                        
                                        'placeholder' => "Type your Mobile Number here. Don't worry about your privacy. Your mobile number will be hidden"
                                            )
                                    );
                                    ?>
                                </div>
                            </div>


                            <div class="form-group">
                                
                                
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input(
                                            'name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text',
                                        'placeholder' => 'Type your Name here..'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            
                            
                            <div class=" col-md-offset-4 col-md-8" id="prev_image1">


                            </div>
                            <div class="form-group img-upload">
                                <label class="control-label col-md-offset-4 col-md-4 btn green feedbackImg" style="text-align:center;">
                                    <span>Add Your Image</span>
                                    <?php
                                    echo $this->Form->input(
                                            'img', array(
                                        'class' => 'form-control required_toggle required hide single_img_btn',
                                        'type' => 'file',
                                        'id' => 1
                                            )
                                    );
                                    ?>
                                </label>

                            </div>

                            <div class="form-group">
                                 <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input(
                                            'comment', array(
                                        'class' => 'form-control required',
                                        'type' => 'textarea',
                                        'row' => 8,
                                        'maxlength' =>350,
                                        'placeholder' => 'Type your valuable comment within 350 character'
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
                                            'Post', array('class' => 'btn green', 'type' => 'submit')
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
