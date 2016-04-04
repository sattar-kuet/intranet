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
                            <i class="fa fa-plus"></i>Add new Customer
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
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
                                <label class="control-label col-md-2">First Name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Middle Name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'middle_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Last Name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'last_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Address:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'address', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Street:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'street', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Apartment:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'apartment', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">City:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'city', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">State:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'state', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Zip:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'zip', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Phone: Home:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'home', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Cell:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'cell', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">E-Mail<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'class' => 'form-control required',
                                        'type' => 'text',
                                         'placeholder'=>'Optional'       
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Fax<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'fax', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Select package:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                         <?php
                                        $arrCategory = array("1" => "1 Month", "3" => "3 Month", "6" => "6 Month", "12" => "1 Year");
                                        echo $this->Form->input(
                                                'duration', array(
                                            'class' => 'form-control input-medium',
                                            'id' => 'selctMonth',
                                            'options' => $arrCategory,
                                            'label' => false,
                                            'empty' => '--Select Month--',
                                                )
                                        );
                                        ?>
                                </div>
                                <label class="control-label col-md-2"> Custom Package<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox">Select Check box 
                                        </label>
                                        
                                    </div>
                                </div>
                                
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Referred by:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Bonus:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Phone:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Router OR Modem<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> YES</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> NO </label>
                                    </div>
                                </div>
                                <label class="control-label col-md-2">Site Top Box<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <select class="form-control input-medium">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </div>
                                <label class="control-label col-md-2">HDMI<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> YES </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2">NO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Wi-fi Adapter<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> Yes </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> No</label>
                                    </div>
                                </div>
                                <label class="control-label col-md-2">Power Adapter<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> Yes </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> No </label>
                                    </div>
                                </div>
                                <label class="control-label col-md-2">Remote Control<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> Yes </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Wire<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Current ISP and Speed<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Service Provider<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Ethernet Wire<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Security Deposit:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Monthly Bill:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Equipment:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Total:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Shipment<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                   <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox">Select Check box 
                                        </label>
                                        
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Driving lisence or Social Security<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Customer Utility:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                   <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios4" value="option1" checked> Yes </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="optionsRadios" id="optionsRadios5" value="option2"> No</label>
                                    </div>
                                </div>
                                <label class="control-label col-md-2">First name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Last name<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Card no:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">CVV Code:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Exp. Date:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                   <select class="form-control input-medium">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </div>
                                <label class="control-label col-md-2">Select month<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <select class="form-control input-medium">
                                        <option>Option 1</option>
                                        <option>Option 2</option>
                                        <option>Option 3</option>
                                        <option>Option 4</option>
                                        <option>Option 5</option>
                                    </select>
                                </div>
                                <label class="control-label col-md-2">Address on Card:<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text',
                                         'placeholder'=>'Zip',       
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Follow this Customer<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                   <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox">Select Check box 
                                        </label>
                                        
                                    </div>
                                </div>
                                <label class="control-label col-md-2">Follow up date<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control required',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Comment<span class="required">
                                        * </span>
                                </label>
                                <div class="col-md-2">
                                    <textarea class="form-control" rows="3"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Signup', array('class' => 'btn green', 'type' => 'submit')
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

