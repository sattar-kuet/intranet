<div class="col-md-8">
                <!-- BEGIN VALIDATION STATES-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-gift"></i> Tolet Form
                        </div>

                    </div>
                    <div class="portlet-body form">
                        <?php echo $this->Session->flash(); ?>
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Tolet', array(
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
                            <?php echo get_emergency_help(); ?>
                            <div class="form-group">
                                <label class="control-label col-md-5">Title (শিরনাম) <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-7">
                                    <div class="input-icon right">
                                        <i class="fa"></i>

                                        <?php
                                        echo $this->Form->input(
                                                'title', array(
                                            'class' => 'form-control required'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-5">Type Selection(ধরন নির্বাচন) <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-7">
                                    <?php
                                    echo $this->Form->input('tolet_type_id', array(
                                        'type' => 'select',
                                        'options' => $types,
                                        'empty' => 'Select Type',
                                        'class' => 'form-control select2me required',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-5">Select Condition ( শর্ত নির্বাচন ) <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-7">
                                    <?php
                                    echo $this->Form->input('tolet_condition_id', array(
                                        'type' => 'select',
                                        'options' => $conditions,
                                        'empty' => 'Select Condition',
                                        'class' => 'form-control select2me required',
                                            )
                                    );
                                    ?>

                                </div>
                            </div>

                            <div class="form-group">
                                    <label class="control-label col-md-5">City
                                    </label>
                                    <div class="col-md-7">
                                        <?php
//pr($cities); //exit;
                                        echo $this->Form->input('city_id', array(
                                            'type' => 'select',
                                            'options' => $cities,
                                            'empty' => 'Select City',
                                            'class' => 'form-control select2me required pclass',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-5">Locations
                                    </label>
                                    <div class="col-md-7">
                                        <?php
                                        echo $this->Form->input('location_id', array(
                                            'type' => 'select',
                                            'options' => $locations,
                                            'id' => 'cid',
                                            'empty' => 'Select Location',
                                            'class' => 'form-control select2me required cclass',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>


                            <div class="form-group">
                                <label class="control-label col-md-5">Number of Room  <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-7">
                                    <div class="input-icon right">
                                        <i class="fa"></i>

                                        <?php
                                        echo $this->Form->input(
                                                'room_no', array(
                                            'class' => 'form-control required',
                                            'min' => 1,
                                            
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-5">Number of Bath Room  <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-7">
                                    <div class="input-icon right">
                                        <i class="fa"></i>

                                        <?php
                                        echo $this->Form->input(
                                                'bath_no', array(
                                            'class' => 'form-control required',
                                            'min' => 1
                                            
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-5">Area (in square feet) <span class="optional">
                                        (Optional) </span>
                                </label>
                                <div class="col-md-7">
                                    <div class="input-icon right">
                                        <i class="fa"></i>

                                        <?php
                                        echo $this->Form->input(
                                                'area', array(
                                            'class' => 'form-control',
                                            'min' => 100,
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                             <div class="form-group">
                                <label class="control-label col-md-5">Description  <span class="optional">
                                        (Optional) </span>
                                </label>
                                <div class="col-md-7">
                                    <div class="input-icon right">
                                        <i class="fa"></i>

                                        <?php
                                        echo $this->Form->input(
                                                'desc', array(
                                            'class' => 'form-control',
                                            
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            
                             <div class="form-group">
                                <label class="control-label col-md-5">Rent(প্রতি মাসে ভাড়া) <span class="optional">
                                        (Optional) </span>
                                </label>
                                <div class="col-md-7">
                                    <div class="input-icon right">
                                        <i class="fa"></i>

                                        <?php
                                        echo $this->Form->input(
                                                'rent', array(
                                            'class' => 'form-control',
                                            
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label class="control-label col-md-5">Utility Bill <span class="optional">
                                        (Optional) </span>
                                </label>
                                <div class="col-md-7">
                                    <div class="input-icon right">
                                        <i class="fa"></i>

                                        <?php
                                        echo $this->Form->input(
                                                'utility', array(
                                            'class' => 'form-control',
                                            
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            

                         

                            <div class="form-group">
                                <label class="control-label col-md-5"> Your Phone Number <span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-7">
                                    <div class="input-icon right">
                                        <i class="fa"></i>

                                        <?php
                                        echo $this->Form->input(
                                                'cell', array(
                                            'class' => 'form-control required'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>

                           <div class="form-group" style="margin-bottom: 0px;">
                           <label class="control-label col-md-5">Tolet Will be available from <span class="required">
                                        * </span>
                                </label>
                                                                    <div class="col-md-7">
                                                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'available_from', array(
                                                                                'class' => 'form-control required',
                                                                                'type' => 'text',
                                                                                'readonly' => true
                                                                                    )
                                                                            );
                                                                            ?>
                                                                            <span class="input-group-btn">
                                                                                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                            <div class=" col-md-offset-5 col-md-7" id="prev_image">
                        
                                   
                                </div>
                            <div class="form-group img-upload">
                                <label class="control-label col-md-offset-7 col-md-3 btn green" style="text-align:center;">Add Image
                                          <?php
                                        echo $this->Form->input(
                                                'images.', array(
                                            'class' => 'form-control hide img-btn',
                                            'type' => 'file',
                                            'id' => 1
                                                )
                                        );
                                        ?>
                                </label>
                                
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-9 col-md-3" style="margin-top:10px;">

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
                </div>
                <!-- END VALIDATION STATES-->
            </div>
        </div>
    </div>
</div>
<!-- END CONTENT -->
<!-- BEGIN QUICK SIDEBAR -->


<!-- END QUICK SIDEBAR -->
</div>


</div>
