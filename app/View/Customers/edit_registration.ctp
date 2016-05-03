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
                        <?php
                        echo $this->Form->input('id');
                        ?>
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>

                            <div class="form-group">
                                <label class="control-label col-md-2">First Name<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'first_name', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Middle Name<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'middle_name', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Last Name<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'last_name', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Address:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'address', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Street:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'street', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Apartment:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'apartment', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">City:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'city', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">State:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'state', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Zip:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'zip', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Phone: Home:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'home', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Cell:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'cell', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">E-Mail<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'class' => 'form-control ',
                                        'type' => 'text',
                                        'placeholder' => 'Optional'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Fax<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'fax', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <div id="regularpackage">
                                    <label class="control-label col-md-2">Select package:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('psetting_id', array(
                                            'type' => 'select',
                                            'class' => 'form-control',
                                            'options' => $packageList,
                                            'empty' => '--Select Package Type--',
                                            'id' => 'psettingId',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div id="custompackage" style="display: none;">
                                    <div class="col-md-2">
                                        <?php
                                        $arrCategory = array("1" => "1 Month", "3" => "3 Month", "6" => "6 Month", "12" => "1 Year");
                                        echo $this->Form->input(
                                                'duration', array(
                                            'class' => 'form-control',
                                            'id' => 'selctMonth',
                                            'options' => $arrCategory,
                                            'label' => false,
                                            'empty' => '--Select Month--',
                                                )
                                        );
                                        ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'charge', array(
                                            'class' => 'form-control',
                                            'id' => 'inputAmount',
                                            'type' => 'number',
                                            'placeholder' => 'Amount'
                                                )
                                        );
                                        ?> 
                                    </div>
                                </div>

                                <label class="control-label col-md-2"> Custom Package<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="checkbox-list">
                                        <label>
                                            <input type="checkbox"id="customcheckbox" > 
                                        </label>

                                    </div>
                                </div>

                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Referred by:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'referred_name', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Bonus:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'bonus', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Phone:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'referred_phone', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Router OR Modem<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_router]" id="optionsRadios4" value="YES" > YES</label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_router]" id="optionsRadios5" value="NO"> NO </label>
                                    </div>
                                </div>
                                <label class="control-label col-md-2">Site Top Box<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    $arrCategory = array("1" => "1 box", "2" => "2 box", "3" => "3 box", "4" => "4 box");
                                    echo $this->Form->input(
                                            'equipment_top_box', array(
                                        'class' => 'form-control',
                                        'id' => 'selctMonth',
                                        'options' => $arrCategory,
                                        'label' => false,
                                        'empty' => '--Select Box Number--',
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">HDMI<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_hdmi]" id="optionsRadios4" value="YES" > YES </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_hdmi]" id="optionsRadios5" value="NO">NO</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Wi-fi Adapter<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_wi_fi]" id="optionsRadios4" value="YES" > Yes </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_wi_fi]" id="optionsRadios5" value="NO"> No</label>
                                    </div>
                                </div>
                                <label class="control-label col-md-2">Power Adapter<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_adapter]" id="optionsRadios4" value="YES" > Yes </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_adapter]" id="optionsRadios5" value="NO"> No </label>
                                    </div>
                                </div>
                                <label class="control-label col-md-2">Remote Control<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="radio-list">
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_remote]" id="optionsRadios4" value="YES" > Yes </label>
                                        <label class="radio-inline">
                                            <input type="radio" name="data[PackageCustomer][equipment_remote]" id="optionsRadios5" value="NO"> No</label>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Ethernet Wire<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'ethernet_wire', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Current ISP and Speed<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'current_isp_speed', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-2">Service Provider<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'current_service_provider', array(
                                        'class' => 'form-control ',
                                        'type' => 'text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">   
                                <label class="control-label col-md-2"> Installation Date<span class="required">
                                    </span>
                                </label>                                 
                                <div class="col-md-3">
                                    <?php
                                    echo $this->Form->input(
                                            'created', array(
                                        'class' => ''
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <hr/>
                            <div class="form-group">
                                <label class="control-label col-md-1">SD:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'deposit', array(
                                        'class' => 'form-control  partial',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-1">MB:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'monthly_bill', array(
                                        'class' => 'form-control  partial ',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>


                                <label class="control-label col-md-1">Equipment:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'others', array(
                                        'class' => 'form-control  partial',
                                        'type' => 'number'
                                            )
                                    );
                                    ?>
                                </div>
                                <label class="control-label col-md-1">Total:<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <?php
                                    echo $this->Form->input(
                                            'total', array(
                                        'class' => 'form-control input-sm total',
                                        'type' => 'number',
                                        'readonly' => 'readonly'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 blink_me" style="color: red">Shipment <span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="checkbox-list">
                                        <label>
                                            <?php
                                            echo $this->Form->input(
                                                    'shipment', array(
                                                'type' => 'checkbox',
                                                'value' => '1',
                                                'id' => 'shipment',
                                                    )
                                            );
                                            ?>
                                        </label>

                                    </div>
                                </div>

                            </div>
                            <div id="shipmentshow_hide" style="display: none">
                                <div class="form-group">
                                    <label class="control-label col-md-2">Driving lisence or Social Security<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'driving_socialsecurity', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>

                                    <label class="control-label col-md-2">First name<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'cfirst_name', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                    <label class="control-label col-md-2">Last name<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'clast_name', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-2">Customer Utility:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <div class="radio-list">
                                            <label class="radio-inline">
                                                <input type="radio" name="data[PackageCustomer][customer_utility]" id="optionsRadios4" value="YES"> Yes </label>
                                            <label class="radio-inline">
                                                <input type="radio" name="data[PackageCustomer][customer_utility]" id="optionsRadios5" value="NO"> No</label>
                                        </div>
                                    </div>
                                    <label class="control-label col-md-2">Card no:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'card_check_no', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                    <label class="control-label col-md-2">CVV Code:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'cvv_code', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2">Exp. Date:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('exp_date.year', array(
                                            'type' => 'select',
                                            'options' => $ym['year'],
                                            'empty' => 'Select Year',
                                            'class' => ' form-control input-medium',
                                            'div' => array('class' => 'span12 ')
                                                )
                                        );
                                        ?>
                                    </div>
                                    <label class="control-label col-md-2">Select month<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('exp_date.month', array(
                                            'type' => 'select',
                                            'options' => $ym['month'],
                                            'empty' => 'Select Month',
                                            'class' => 'form-control input-medium',
                                            'div' => array('class' => 'span12 ')
                                                )
                                        );
                                        ?> 
                                    </div>
                                    <label class="control-label col-md-2">Address on Card:<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'czip', array(
                                            'class' => 'form-control ',
                                            'type' => 'text',
                                            'placeholder' => 'Zip & detail (optional)',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2 blink_me" style="color: red">Follow this Customer<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-2">
                                    <div class="checkbox-list">
                                        <label>
                                            <?php
                                            echo $this->Form->input(
                                                    'follow_up', array(
                                                'type' => 'checkbox',
                                                'value' => '1 ',
                                                'id' => 'additioninfo',
                                                    )
                                            );
                                            ?>

                                        </label>

                                    </div>
                                </div>
                                <div id="Additional_info" style="display: none" >

                                    <label class="control-label col-md-2">Follow up date<span class="required">
                                        </span>
                                    </label>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'follow_date', array(
                                            'type' => 'text',
                                            'class' => 'datepicker form-control '
                                                )
                                        );
                                        ?>

                                    </div>

                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-2">Comment<span class="required">
                                    </span>
                                </label>
                                <div class="col-md-9">
                                    <?php
                                    echo $this->Form->input(
                                            'comments', array(
                                        'class' => 'form-control',
                                        'type' => 'textarea',
                                        'value' => $lastComment['content'],
                                        'rows' => '3',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                            <?php
                            echo $this->Form->input(
                                    'comment_id', array(
                                'type' => 'hidden',
                                'value' => $lastComment['id']
                                    )
                            );
                            ?>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-6 col-md-4">
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
