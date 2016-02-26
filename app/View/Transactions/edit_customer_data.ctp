<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .txtArea { width:300px; }
</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <div  class="col-md-12 col-sm-12">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Complete the transactions <small>(individually)</small>
            </h3>
            <?php echo $this->Session->flash(); ?>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->           
                    <!-- END EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Customer Information
                            </div>

                            <div class="tools">
                                <a href="javascript:;" class="reload">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <?php echo $this->Session->flash() ?>
                            <?php
                            echo $this->Form->create('PackageCustomer', array(
                                'inputDefaults' => array(
                                    'label' => false,
                                    'div' => false
                                ),
                                'id' => 'form-validate',
                                'class' => 'form-horizontal',
                                'novalidate' => 'novalidate',
                                'enctype' => 'multipart/form-data'
                                    )
                            );
                            ?>
                            <!--                        <div class="row">
                                                        <div class="col-md-12 ">
                                                             BEGIN SAMPLE FORM PORTLET
                                                            <div class="portlet box"  style=" text-align: center; background-color: black;">
                                                                <div class="portlet-title">
                                                                    <div class="caption" id="blackcaption" >
                                                                        Customer Information
                                                                    </div>
                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>-->
                            <div class="row">
                                <div class="col-md-12 ">

                                    <div class="col-md-2 signupfont">
                                        Name: First:
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'first_name', array(
                                                    'class' => 'required',
                                                    'id' => 'first'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="col-md-1 signupfont">
                                        Middle:

                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'middle_name', array(
                                                    'class' => 'required'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="col-md-1 signupfont">
                                        Last: 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'last_name', array(
                                                    'class' => 'required',
                                                    'id' => 'last'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-12 ">

                                    <div class="col-md-2 signupfont">
                                        Address:
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'address', array(
                                                    'class' => 'required',
                                                    'id' => 'address',
                                                    "class" => ''
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="col-md-1 signupfont">
                                        Street:

                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'street', array(
                                                    'class' => 'required',
                                                    'id' => 'street'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="col-md-1 signupfont">
                                        Apartment: 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'apartment', array(
                                                    'class' => 'required',
                                                    'id' => 'apartment'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                </div>
                            </div>

                            &nbsp;
                            <div class="row">
                                <div class="col-md-12 ">

                                    <div class="col-md-2 signupfont">
                                        City:
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'city', array(
                                                    'class' => 'required',
                                                    'id' => 'city'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="col-md-1 signupfont">
                                        State:

                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'state', array(
                                                    'class' => 'required',
                                                    'id' => 'state'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="col-md-1 signupfont">
                                        Zip: 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'zip', array(
                                                    'class' => 'required',
                                                    'id' => 'zip'
                                                        )
                                                );
                                                ?>  
                                            </div>                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-12 ">

                                    <div class="col-md-2 signupfont">
                                        Phone: Home:  
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'home', array(
                                                    'class' => 'required',
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="col-md-1 signupfont">
                                        Cell:

                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'cell', array(
                                                    'class' => 'required'
                                                        )
                                                );
                                                ?>
                                            </div>                            
                                        </div>
                                    </div>                        
                                </div>
                            </div>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="col-md-2 signupfont">
                                        E-Mail

                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'email', array(
                                                    'class' => 'required',
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-1 signupfont">
                                        Fax: 
                                    </div>
                                    <div class="col-md-5">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'fax', array(
                                                    'class' => 'required',
                                                    'placeholder' => 'Optional'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>


                                </div>
                            </div>
                            &nbsp;
                            <div class="row">
                                <div class="col-md-6 ">

                                    <div class="col-md-2 signupfont">
                                        Mac no:
                                    </div>
                                    <div class="col-md-10">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'mac', array(
                                                    'class' => 'required',
                                                    'placeholder' => 'Use comma (,) to seperate multiple mac'
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div> 
                                </div>


                                <div class="col-md-5">
                                    <?php
                                    echo $this->Form->input('psetting_id', array(
                                        'type' => 'select',
                                        'options' => $packageList,
                                        //'default' => $selected['package'],
                                        'empty' => 'Select Package Type',
                                        'class' => 'span12 uniform nostyle select1 pclass required',
                                        'div' => array('class' => 'span12 required')
                                            )
                                    );
                                    ?>
                                </div> 
                               
                            </div>


                            <div class="row">
                                <div class="col-md-12 ">
                                    <div class="col-md-2 signupfont">
                                        Referred by:

                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'referred_name', array(
                                                    'class' => 'required',
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-1 signupfont">
                                        Bonus:

                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'bonus', array(
                                                    'class' => 'required',
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-1 signupfont">
                                        Phone: 
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'referred_phone', array(
                                                    'class' => 'required',
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                    </div>                        
                                </div>
                            </div>
                            &nbsp;




                            <!--                        <div class="row">
                                                        <div class="col-md-12 ">
                                                             BEGIN SAMPLE FORM PORTLET
                                                            <div class="portlet box green"">
                                                                <div class="portlet-title">
                                                                    <div class="caption" id="blackcaption" >
                                                                        Package Information
                                                                    </div>
                            
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="panel-group accordion" id="accordion1">
                                                                <div class="panel panel-default">
                                                                    <div class="panel-heading">
                                                                        <h4 class="panel-title">
                                                                            <a class="accordion-toggle collapsed" data-toggle="collapse" data-parent="#accordion1" href="#collapse_1" aria-expanded="false">
                                                                                <span style="font-weight: 700;">Select a package </span><span class="text-danger">(required)</span> </a>
                                                                        </h4>
                                                                    </div>
                                                                    <div id="collapse_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                                                                        <div class="panel-body">
                            
                                                                            <div class="" style="">
                                                                                <div class="tabbable tabbable-custom">
                                                                                    <ul class="nav nav-tabs">
                            <?php
                            foreach ($filteredPackage as $n => $single):
                                $tab = $single['packages'];
                                ?>
                                                                                                                                    <li <?php
                                if (!$n) {
                                    echo 'class="active"';
                                }
                                ?>><a data-toggle="tab" href="#<?php echo $tab['id']; ?>"><?php echo $tab['name']; ?></a>
                                                                    
                            <?php endforeach; ?>
                                                                                        <li><a data-toggle="tab" href="#custom">Custom</a></li>
                                                                                    </ul>
                                                                                </div>
                            
                                                                                <div class="tab-content">
                            
                            <?php
                            foreach ($filteredPackage as $n => $single):
                                $tab = $single['packages'];
                                $content = $single['psettings'];
                                ?>
                                                                                                                                <div class="tab-pane <?php
                                if (!$n) {
                                    echo 'active';
                                }
                                ?>" id="<?php echo $tab['id']; ?>" >
                                                                    
                                                                    
                                                                                                                                    <div class="panel-body">
                                <?php foreach ($content as $package): ?>
                                                                                                                                                                                    <div class="col-md-3">
                                                                                                                                                                                        <div class="pricing hover-effect" data-id="<?php echo $package['id'] ?>">
                                                                                                                                                                                            <div id="fariff" class="pricing-head">
                                                                                                                                                                                                <h3><?php
                                    echo ($package['duration'] == 12) ? '1 Year' : $package['duration'] . ' Month';
                                    ?>  <span> Billing Package </span></h3>
                                                                                                                                                                                                <h4><?php
                                    if (strtolower($tab['name']) == 'uk') {
                                        echo '£';
                                    } else if (strtolower($tab['name']) == 'canada') {
                                        echo 'c$';
                                    } else {
                                        echo '$';
                                    }
                                    ?>
                                    <?php echo $package['amount']; ?> <span> For 1st Box </span>
                                                                                                                                                                                                </h4>
                                                                                                                                                                                            </div>
                                                                                                                                                                                            <ul class="pricing-content list-unstyled">
                                    <?php echo $package['offer']; ?>
                                                                                                                                                                                            </ul>
                                                                                                            
                                                                                                                                                                                        </div>
                                                                                                            
                                                                                                                                                                                    </div>
                                                                                                            
                                <?php endforeach;
                                ?>
                                                                                                                                    </div>
                                                                    
                                                                                                                                </div>
                                                                    
                                <?php
                            endforeach;
                            ?>
                            
                            
                                                                                    <div class="tab-pane" id="custom">
                                                                                        <div class="panel-body">
                                                                                            <div class="col-md-6 col-md-offset-3">
                                                                                                <div class="pricing hover-effect" data-id="0">
                                                                                                    <div class="pricing-head">
                                                                                                        <h3>Custom<span> Billing Package </span></h3>
                            
                                                                                                    </div>
                                                                                                    <div style="padding: 10px;">
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-4 control-label">Duration</label>
                                                                                                            <div class="col-md-8">
                            <?php
                            $arrCategory = array("1 Month" => "1 Month", "3 Month" => "3 Month", "6 Month" => "6 Month", "1 Year" => "1 Year");
                            echo $this->Form->input(
                                    'duration', array(
                                'class' => 'form-control',
                                'options' => $arrCategory,
                                'label' => false,
                                'empty' => '--Select one--',
                                    )
                            );
                            ?>
                                                                                                            </div>
                            
                                                                                                        </div>
                            
                                                                                                        <div class="form-group">
                                                                                                            <label class="col-md-4 control-label">Charged Amount</label>
                                                                                                            <div class="col-md-8">
                            <?php
                            echo $this->Form->input(
                                    'charge', array(
                                'class' => 'form-control',
                                'type' => 'number'
                                    )
                            );
                            ?>
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                            
                                                                                                </div>
                                                                                            </div>
                            
                                                                                        </div>
                            
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                            
                            
                                                                        </div>
                                                                    </div>
                            
                                                                </div>
                                                            </div>
                            
                                                        </div> 
                                                    </div>-->


                            <div class="row">
                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                    <?php
                                    echo $this->Form->button(
                                            'Update Customer Information', array(
                                        'class' => 'btn btn-primary submitbtn green',
                                        'type' => 'submit',
                                        'id' => ''
                                    ));
                                    ?>
                                </div>
                            </div>
                            <?php echo $this->Form->end(); ?>  
                        </div>
                    </div>

                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Payment process
                            </div>

                            <div class="tools">
                                <a  class="reload toggle" data-id="paymentprocess">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row display-hide" id="paymentprocess">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-striped table-hover table-bordered">
                                            <thead>
                                                <tr>
                                                    <th class="tablehead">
                                                        PAYMENT METHOD
                                                    </th>
                                                    <th>
                                                    </th>
                                                    <th class="tablehead">
                                                        CARD/CHECK INFORMATION
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                    <td class="signupfont" style="min-width: 200px;">
                                                        <div class="form-group" style="margin-left: 0px;">
                                                            <div class="">
                                                                <label><input class="pmode" checked="checked" type="radio" value="card" name="pmode">CARD (DEBIT/CREDIT)</label>
                                                            </div>
                                                            <div class="">
                                                                <label><input class="pmode" type="radio" value="check" name="pmode">CHECK</label>
                                                            </div>
                                                            <div class="">
                                                                <label><input class="pmode" type="radio" value="money order" name="pmode">MONEY ORDER</label>
                                                            </div>
                                                            <div class="">
                                                                <label><input class="pmode" type="radio" value="online bill" name="pmode">ONLINE BILL</label>
                                                            </div>
                                                            <div class="">
                                                                <label><input class="pmode" type="radio" value="cash" name="pmode">CASH</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <td>

                                                    </td>
                                                    <td>
                                                        <div id="option_card">
                                                            <?php
                                                            echo $this->Form->create('Transaction', array(
                                                                'inputDefaults' => array(
                                                                    'label' => false,
                                                                    'div' => false
                                                                ),
                                                                'id' => 'form-validate',
                                                                'class' => 'form-horizontal',
                                                                'novalidate' => 'novalidate',
                                                                'enctype' => 'multipart/form-data',
                                                                'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_card')
                                                                    )
                                                            );
                                                            ?>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'cid', array(
                                                                'type' => 'hidden',
                                                                'value' => $this->params['pass'][0]
                                                            ));
                                                            ?>
                                                            <div class="row">

                                                                <div class="col-md-3 signupfont">
                                                                    Name: 
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'fname', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'placeholder' => 'first name',
                                                                        'id' => 'firstname'
                                                                    ));
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'lname', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',                                                                                
                                                                        'placeholder' => 'last name',
                                                                        'id' => 'lastname',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;

                                                            <div class="row">
                                                                <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                                    Card no: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'card_no', array(
                                                                        'type' => 'text',
                                                                        'value' => '',
                                                                        'class' => 'form-control input-sm required'
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            &nbsp;                                                        

                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Exp. Date:
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <?php
                                                                    echo $this->Form->input('exp_date.year', array(
                                                                        'type' => 'select',
                                                                        'options' => $ym['year'],
                                                                        'empty' => 'Select Year',
                                                                        'class' => 'span12 uniform nostyle select1 pclass required',
                                                                        'div' => array('class' => 'span12 ')
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                                <div class="col-md-5">
                                                                    <?php
                                                                    echo $this->Form->input('exp_date.month', array(
                                                                        'type' => 'select',
                                                                        'options' => $ym['month'],
                                                                        'empty' => 'Select Month',
                                                                        'class' => 'span12 uniform nostyle  cclass select1 required',
                                                                        'id' => 'cid',
                                                                        'div' => array('class' => 'span12 ')
                                                                            )
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    CVV Code: 
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'cvv_code', array(
                                                                        'type' => 'text',
                                                                        'value' => '',
                                                                        'class' => 'form-control input-sm required'
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Address on Card: 
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'zip_code', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'placeholder' => 'zip code',
                                                                        'id' => 'zip_code'
                                                                    ));
                                                                    ?>
                                                                </div>

                                                                <div class="col-md-5">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'address', array(
                                                                        'type' => 'text',
                                                                        'value' => '',
                                                                        'class' => 'form-control input-sm required',
                                                                        'placeholder' => 'detail (optional)',
                                                                        'id' => 'addressdetail'
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-10 col-md-offset-3">
                                                                    <input type="checkbox" id="autofillAddrCheck"  /> <span class="signupfont">SAME AS BILLING ADDRESS </span>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Charged Amount: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'paid_amount', array(
                                                                        'type' => 'text',
                                                                        'value' => '',
                                                                        'class' => 'form-control input-sm required'
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'cid', array(
                                                                'type' => 'hidden',
                                                                'value' => $this->params['pass'][0]
                                                            ));
                                                            ?>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

                                                                    <?php
                                                                    echo $this->Form->button(
                                                                            'Submit Payment', array(
                                                                        'class' => 'btn btn-primary submitbtn green',
                                                                        'type' => 'submit',
                                                                        'id' => ''
                                                                    ));
                                                                    ?>

                                                                </div>
                                                            </div>
                                                            <?php echo $this->Form->end(); ?>
                                                        </div>
                                                        &nbsp;
                                                        <div id="option_check" class="display-none">
                                                            <?php
                                                            echo $this->Form->create('Transaction', array(
                                                                'inputDefaults' => array(
                                                                    'label' => false,
                                                                    'div' => false
                                                                ),
                                                                'id' => 'form-validate',
                                                                'class' => 'form-horizontal',
                                                                'novalidate' => 'novalidate',
                                                                'enctype' => 'multipart/form-data',
                                                                'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_check')
                                                                    )
                                                            );
                                                            ?>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'cid', array(
                                                                'type' => 'hidden',
                                                                'value' => $this->params['pass'][0]
                                                            ));
                                                            ?>

                                                            <?php
                                                            echo $this->Form->input(
                                                                    'pay_mode', array(
                                                                'type' => 'hidden',
                                                                'value' => 'check'
                                                            ));
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Attachment: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'check_image', array(
                                                                        'type' => 'file',
                                                                        'class' => 'form-control input-sm required',
                                                                        'value' => ''
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Charged Amount: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'paid_amount', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'value' => '',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Check Info: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'check_info', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'placeholder' => 'Check No, Bank Name',
                                                                        'value' => '',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

                                                                    <?php
                                                                    echo $this->Form->button(
                                                                            'Submit Payment', array(
                                                                        'class' => 'btn btn-primary submitbtn green',
                                                                        'type' => 'submit',
                                                                        'id' => ''
                                                                    ));
                                                                    ?>

                                                                </div>
                                                            </div>

                                                            <?php echo $this->Form->end(); ?>
                                                        </div>
                                                        &nbsp;
                                                        <div id="option_moneyorder" class="display-none">
                                                            <?php
                                                            echo $this->Form->create('Transaction', array(
                                                                'inputDefaults' => array(
                                                                    'label' => false,
                                                                    'div' => false
                                                                ),
                                                                'id' => 'form-validate',
                                                                'class' => 'form-horizontal',
                                                                'novalidate' => 'novalidate',
                                                                'enctype' => 'multipart/form-data',
                                                                'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_morder')
                                                                    )
                                                            );
                                                            ?>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'cid', array(
                                                                'type' => 'hidden',
                                                                'value' => $this->params['pass'][0]
                                                            ));
                                                            ?>

                                                            <?php
                                                            echo $this->Form->input(
                                                                    'pay_mode', array(
                                                                'type' => 'hidden',
                                                                'value' => 'money order'
                                                            ));
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Attachment: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'check_image', array(
                                                                        'type' => 'file',
                                                                        'class' => 'form-control input-sm required',
                                                                        'value' => ''
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;

                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Charged Amount: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'paid_amount', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'value' => '',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;

                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Check Info: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'check_info', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'placeholder' => 'Check No, Bank Name',
                                                                        'value' => '',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

                                                                    <?php
                                                                    echo $this->Form->button(
                                                                            'Submit Payment', array(
                                                                        'class' => 'btn btn-primary submitbtn green',
                                                                        'type' => 'submit',
                                                                        'id' => ''
                                                                    ));
                                                                    ?>

                                                                </div>
                                                            </div>
                                                            <?php echo $this->Form->end(); ?>
                                                        </div>
                                                        &nbsp;
                                                        <div id="option_onlinebill" class="display-none">
                                                            <?php
                                                            echo $this->Form->create('Transaction', array(
                                                                'inputDefaults' => array(
                                                                    'label' => false,
                                                                    'div' => false
                                                                ),
                                                                'id' => 'form-validate',
                                                                'class' => 'form-horizontal',
                                                                'novalidate' => 'novalidate',
                                                                'enctype' => 'multipart/form-data',
                                                                'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_online_bil')
                                                                    )
                                                            );
                                                            ?>

                                                            <?php
                                                            echo $this->Form->input(
                                                                    'cid', array(
                                                                'type' => 'hidden',
                                                                'value' => $this->params['pass'][0]
                                                            ));
                                                            ?>

                                                            <?php
                                                            echo $this->Form->input(
                                                                    'pay_mode', array(
                                                                'type' => 'hidden',
                                                                'value' => 'online bill'
                                                            ));
                                                            ?>
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Attachment: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'check_image', array(
                                                                        'type' => 'file',
                                                                        'class' => 'form-control input-sm required',
                                                                        'value' => ''
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Charged Amount: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'paid_amount', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'value' => '',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Check Info: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'check_info', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'placeholder' => 'Check No, Bank Name',
                                                                        'value' => '',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>

                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                                                    <?php
                                                                    echo $this->Form->button(
                                                                            'Submit Payment', array(
                                                                        'class' => 'btn btn-primary submitbtn green',
                                                                        'type' => 'submit',
                                                                        'id' => ''
                                                                    ));
                                                                    ?>

                                                                </div>
                                                            </div>

                                                            <?php echo $this->Form->end(); ?>
                                                        </div>
                                                        &nbsp;
                                                        <div id="option_cash" class="display-none">
                                                            <?php
                                                            echo $this->Form->create('Transaction', array(
                                                                'inputDefaults' => array(
                                                                    'label' => false,
                                                                    'div' => false
                                                                ),
                                                                'id' => 'form-validate',
                                                                'class' => 'form-horizontal',
                                                                'novalidate' => 'novalidate',
                                                                'enctype' => 'multipart/form-data',
                                                                'url' => array('controller' => 'payments', 'action' => 'individual_transaction_by_cash')
                                                                    )
                                                            );
                                                            ?>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'cid', array(
                                                                'type' => 'hidden',
                                                                'value' => $this->params['pass'][0]
                                                            ));
                                                            ?>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'pay_mode', array(
                                                                'type' => 'hidden',
                                                                'value' => 'cash'
                                                            ));
                                                            ?>

                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Charged Amount: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'paid_amount', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'value' => ''
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-md-3 signupfont">
                                                                    Received by: 
                                                                </div>
                                                                <div class="col-md-9">
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'cash_by', array(
                                                                        'type' => 'text',
                                                                        'class' => 'form-control input-sm required',
                                                                        'value' => '',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                            </div>
                                                            &nbsp;
                                                            <div class="row">
                                                                <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                                                    <?php
                                                                    echo $this->Form->button(
                                                                            'Submit Payment', array(
                                                                        'class' => 'btn btn-primary submitbtn green',
                                                                        'type' => 'submit',
                                                                        'id' => ''
                                                                    ));
                                                                    ?>

                                                                </div>
                                                            </div>
                                                            <?php echo $this->Form->end(); ?>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div> 
                        </div>
                    </div>
                    <!-- end -->
                </div>
            </div>
        </div>
        <!-------------payment history start----------------->
        <div  class="col-md-12 col-sm-12">
            <div class="portlet box green">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>Payment History
                    </div>
                    <div class="tools">
                        <a  class="reload toggle" data-id="paymenthistory">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row display-hide" id="paymenthistory">

                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                            <thead>
                                <tr >  
                                    <th>Pay Mode</th>
                                    <th>Error Msg</th>
                                    <th>Paid Amount</th>
                                    <th>Due</th>
                                    <th>Exp Date</th>
                                    <th>CVV Code</th>
                                    <th>Zip Code</th>
                                    <th>Address</th>
                                    <th>Check Info</th>
                                    <th>Cash By</th>
                                    <th>Trans Action Time</th>
                                    <!--<th>Action</th>-->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transactions as $single):
                                    $info = $single['Transaction'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $info['pay_mode']; ?></td>
                                        <td><?php echo $info['error_msg']; ?></td>
                                        <td><?php echo $info['paid_amount']; ?></td>
                                        <td><?php echo $info['due']; ?></td>
                                        <td><?php echo $info['exp_date']; ?></td>
                                        <td><?php echo $info['cvv_code']; ?></td>
                                        <td><?php echo $info['zip_code']; ?></td>
                                        <td><?php echo $info['address']; ?></td>
                                        <td><?php echo $info['check_info']; ?></td>
                                        <td><?php echo $info['cash_by']; ?></td>
                                        <td><?php echo $info['created']; ?></td>
        <!--                                <td>   
                                                    <div class="controls center">                                               
                                                <a onclick="if (confirm(&quot;Are you sure to complete this transaction?&quot)) { return true; } return false;" href="<?php
                                        echo Router::url(array('controller' => 'payments', 'action' => 'individual_transaction', $info['id'])
                                        )
                                        ?>" class="tip"><span class="icon16 icomoon-icon-coins" title="Make transaction for this customer"></span></a>
                                                        
                                                    </div>
                                                    
                                                </td>-->
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
            <div>
                <!-------------payment history end----------------->

                <!-------------ticket history start----------------->

                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Ticket History
                        </div>
                        <div class="tools">
                            <a  class="reload toggle" data-id="tickethistory">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row display-hide" id="tickethistory">
                            <div  class="col-md-12 col-sm-12">
                                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                                    <thead>
                                        <tr>
                                            <th>Subject</th>
                                            <th>Customer Info</th>
                                            <th>Open Time</th>
                                            <th>Detail</th>
                                            <th>History</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($data as $single):
                                            $issue = end($single['history']);
                                            $customer = end($single['history']);
                                            $customer = $customer['pc'];
                                            $ticket = $single['ticket'];
                                            ?>
                                            <tr >
                                                <td><?php echo $issue['i']['name']; ?></td>
                                                <td>
                                                    <ul>
                                                        <li> Name: <?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?> </li> 
                                                        <li> Cell: <?php echo $customer['cell']; ?> </li> 
                                                    </ul>
                                                </td>
                                                <td><?php echo $ticket['created']; ?></td>
                                                <td><?php echo $ticket['content']; ?></td>
                                                <td>
                                                    <ol>
                                                        <?php
                                                        
                                                        $lasthistory = $single['history'][0]['tr'];
                                                        foreach ($single['history'] as $history):
                                                            ?>
                                                            <li>
                                                                <?php if ($history['tr']['status'] != 'open') { ?>
                                                                    <strong><?php echo ucfirst($history['tr']['status']); ?> By:</strong>
                                                                <?php } else {
                                                                    ?>
                                                                    <strong>Forwarded By:</strong>
                                                                    <?php
                                                                }
                                                                ?>
                                                                <?php echo $history['fb']['name']; ?>
                                                                <p><strong>Forwarded To:</strong><ul><li><?php echo $history['fi']['name']; ?> </li><li><?php echo $history['fd']['name']; ?> </li></ul>
                                                                <strong>Time:</strong> <?php echo $history['tr']['created']; ?>

                                                                &nbsp;&nbsp;<strong>Status:</strong> <?php echo $history['tr']['status']; ?><br>
                                                                <?php
                                                                if (!empty($history['tr']['comment'])):
                                                                    echo '<strong>';
                                                                    echo 'Comment : ';
                                                                    echo '</strong>';
                                                                    echo $history['tr']['comment'];
                                                                endif;
                                                                ?> 
                                                            </li>
                                                            <br>
                                                        <?php endforeach; ?>
                                                    </ol>
                                                </td>
                                                <td>   
                                                    <div class="controls center text-center">
                                                        <?php if ($lasthistory['status'] == 'open') { ?>
                                                            <a 
                                                                href="#" title="Solved">
                                                                <span id="<?php echo $ticket['id']; ?>" class="fa fa-check fa-lg solve_ticket"></span>
                                                            </a>
                                                            &nbsp;
                                                            <a 
                                                                href="#" title="Unresolved">
                                                                <span id="<?php echo $ticket['id']; ?>" class="fa fa-times fa-lg unsolve_ticket"></span>
                                                            </a>
                                                            &nbsp;
                                                            <a 
                                                                href="#" title="Forward">
                                                                <span id="<?php echo $ticket['id']; ?>" class="fa fa-mail-forward fa-lg forward_ticket"></span>
                                                            </a>
                                                            <div id="forward_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">
                                                                <!-- BEGIN FORM-->
                                                                <?php
                                                                echo $this->Form->create('Track', array(
                                                                    'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false
                                                                    ),
                                                                    'id' => 'form_sample_3',
                                                                    'class' => 'form-horizontal',
                                                                    'novalidate' => 'novalidate',
                                                                    'url' => array('controller' => 'tickets', 'action' => 'forward')
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('ticket_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $ticket['id'],
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
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
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
                                                                    <div class="form-group">

                                                                        <div class="form-group">

                                                                            <div class="col-md-12">
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
                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <?php
                                                                                echo $this->Form->input('priority', array(
                                                                                    'type' => 'select',
                                                                                    'options' => array('low' => 'Low', 'medium' => 'Medium', 'high' => 'High'),
                                                                                    'empty' => 'Select Priority',
                                                                                    'class' => 'form-control select2me required pclass',
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <?php
                                                                                echo $this->Form->input('comment', array(
                                                                                    'type' => 'textarea',
                                                                                    'class' => 'form-control required',
                                                                                    'placeholder' => 'Write your comments'
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-7 col-md-4">
                                                                            <?php
                                                                            echo $this->Form->button(
                                                                                    'Forward', array('class' => 'btn green', 'type' => 'submit')
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php echo $this->Form->end(); ?>
                                                                <!-- END FORM-->
                                                            </div>

                                                            <div id="solve_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

                                                                <!-- BEGIN FORM-->
                                                                <?php
                                                                echo $this->Form->create('Track', array(
                                                                    'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false
                                                                    ),
                                                                    'id' => 'form_sample_3',
                                                                    'class' => 'form-horizontal',
                                                                    'novalidate' => 'novalidate',
                                                                    'url' => array('controller' => 'tickets', 'action' => 'solve')
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('ticket_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $ticket['id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('user_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['user_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('role_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['role_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('issue_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['issue_id'],
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
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <?php
                                                                                echo $this->Form->input('comment', array(
                                                                                    'type' => 'textarea',
                                                                                    'class' => 'form-control required txtArea',
                                                                                    'placeholder' => 'Write your comments'
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-7 col-md-4">
                                                                            <?php
                                                                            echo $this->Form->button(
                                                                                    'Done', array('class' => 'btn green', 'type' => 'submit')
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php echo $this->Form->end(); ?>
                                                                <!-- END FORM-->
                                                            </div> 

                                                            <div id="unsolve_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

                                                                <!-- BEGIN FORM-->
                                                                <?php
                                                                echo $this->Form->create('Track', array(
                                                                    'inputDefaults' => array(
                                                                        'label' => false,
                                                                        'div' => false
                                                                    ),
                                                                    'id' => 'form_sample_3',
                                                                    'class' => 'form-horizontal',
                                                                    'novalidate' => 'novalidate',
                                                                    'url' => array('controller' => 'tickets', 'action' => 'unsolve')
                                                                        )
                                                                );
                                                                ?>

                                                                <?php
                                                                echo $this->Form->input('ticket_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $ticket['id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('user_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['user_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('role_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['role_id'],
                                                                        )
                                                                );
                                                                ?>
                                                                <?php
                                                                echo $this->Form->input('issue_id', array(
                                                                    'type' => 'hidden',
                                                                    'value' => $lasthistory['issue_id'],
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
                                                                        <div class="form-group">
                                                                            <div class="col-md-12">
                                                                                <?php
                                                                                echo $this->Form->input('comment', array(
                                                                                    'type' => 'textarea',
                                                                                    'class' => 'form-control required txtArea',
                                                                                    'placeholder' => 'Write your comments'
                                                                                        )
                                                                                );
                                                                                ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-actions">
                                                                    <div class="row">
                                                                        <div class="col-md-offset-7 col-md-4">
                                                                            <?php
                                                                            echo $this->Form->button(
                                                                                    'Done', array('class' => 'btn green', 'type' => 'submit')
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <?php echo $this->Form->end(); ?>
                                                                <!-- END FORM-->
                                                            </div> 
                                                            <?php
                                                        } else {
                                                            echo 'Nothing to do';
                                                        }
                                                        ?>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php
                                        endforeach;
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="col-md-2"><a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'create', $this->request->params['pass'][0])) ?>" style="font-weight: bold; color: #E02222;">Generate Ticket</a></div>
                        </div>
                    </div>
                </div>

                <!-------------ticket history end----------------->

                <!-- CUSTOMER DATA STARTED-->
                <div class="row">
                    <div class="main">
                        <div class="container">
                            <?php echo $this->Session->flash() ?>
                            <div class="col-md-12 col-sm-12" id="block-quicktabs-3">
                                <?php
                                echo $this->Form->create('PackageCustomer', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false
                                    ),
                                    'id' => 'form-validate',
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate',
                                    'enctype' => 'multipart/form-data'
                                        )
                                );
                                ?>
                                <ul class="">
                                </ul>
                                <!-- BEGIN SIDEBAR & CONTENT -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END PAGE CONTENT -->
            </div>
        </div>
        <!-- END CONTENT -->        
