<style>
    .nav-tabs>li.active>a, .nav-tabs>li.active>a:hover, .nav-tabs>li.active>a:focus {
        color: #555;
        cursor: default;
        background-color: #fff;
        border: 1px solid #ddd !important;

        //border-bottom-color: transparent !important;
        z-index: 55 !important;
        line-height: 35px;
    }

    .tabbable-custom {
        margin-bottom: 0px !important;
        padding: 0px;
        overflow: hidden;
    }
    .tabbable-custom > .tab-content {
        background-color: #fff;
        border: 1px solid #ddd !important;
        padding: 10px;}
    .tabbable-custom > .nav-tabs > li.active > a {
        border-top: none !important;
        font-weight: 400;}
    .nav-tabs>li>a {
        margin-right: 2px;
        line-height: 1.42857143;
        border: 1px solid transparent;
        line-height: 35px;
    }
    .tabbable-custom > .nav-tabs {
        margin-bottom: -1px;
    }
    .tabbable-custom > .tab-content {
        background-color: #fff;
        border: 1px solid #ddd !important;
        padding: 10px;
    }
    .tab-content {
        border: 1px solid #ddd !important;
        padding: 0px !important;
    }

</style>

<!-- style="background-color: #D8E3F2;" -->
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
        <div class="main">

            <div class="container">
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
                    <div class="row margin-bottom-40" style="background-color: #fff; padding: 10px; box-shadow: 0px 0px 20px 3px #888888">
                        <!-- BEGIN SIDEBAR -->

                        <!-- END SIDEBAR -->

                        <!-- BEGIN CONTENT -->





                        <!--                <div class="row">
                                            <div class="text-center">
                                                <div class="radio-list" style="margin-left: 20px;">
                                                    <label class="radio-inline"><input type="radio" value="NEW INSTALLATION" name="data[PackageCustomer][service_type]">NEW INSTALLATION</label>
                                                    <label class="radio-inline"><input type="radio" value="SERVICE REPAIR" name="data[PackageCustomer][service_type]">SERVICE REPAIR</label>
                                                </div>
                                            </div>
                                        </div>-->
                        <div id="info-container"><?php echo $this->Session->flash(); ?></div>

                        <!-- BEGIN SAMPLE FORM PORTLET-->


                           <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ul"></i>Customer Information


                                </div>

                                <div class="tools">
                                    <a  class="reload toggle">
                                    </a>
                                </div>
                            </div>
                               <div class="portlet-body">
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
                                                'class' => ''
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
                                                'class' => ''
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
                                                'class' => '',
                                                'placeholder' => 'Optional'
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
                                                'class' => '',
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
                            <div class="col-md-12">

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



                        </div>
                        &nbsp;

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
                                                'class' => '',
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
                                                'class' => '',
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
                                                'class' => '',
                                                    )
                                            );
                                            ?> 
                                        </div>                            
                                    </div>
                                </div>                        
                            </div>
                        </div>
                               </div> 
                               <!-- portletbody end-->
                           </div> 
                           <!-- end  portlet box blue-->


                       

                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ul"></i>Package Information
                                </div>

                                <div class="tools">
                                    <a  class="reload toggle" >
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
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
                        </div>
                            </div> 
                            <!--end portlet body-->
                        </div>
<!--                           end portlet box-->
<!--                                 start paymentprocess-->
<!--                        <div class="portlet box blue">
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
                                                                <br>
                                                                <div class="">
                                                                    <label><input class="pmode" type="radio" value="check" name="pmode">CHECK</label>
                                                                </div>
                                                                <br>
                                                                <div class="">
                                                                    <label><input class="pmode" type="radio" value="money order" name="pmode">MONEY ORDER</label>
                                                                </div>
                                                                <br>
                                                                <div class="">
                                                                    <label><input class="pmode" type="radio" value="online bill" name="pmode">ONLINE BILL</label>
                                                                </div>
                                                                <br>
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
                                                                <br>
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
                                                                    <div class="col-md-4">
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
                                                                            'class' => 'form-control input-sm',
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
                                                                            'class' => 'btn btn-primary submitbtn blue',
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
                                                                <br>
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
                                                                <br>
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
                                                                <br>
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
                                                                <br>
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
                        </div>-->
                                      <!--End payment process-->
                        <!--
                                        <div class="row">
                                            <div class="col-md-12 ">
                                                 BEGIN SAMPLE FORM PORTLET
                                                <div class="portlet box"  style=" text-align: center; background-color: black;">
                                                    <div class="portlet-title">
                                                        <div class="caption" id="blackcaption" >
                                                            Payment
                                                        </div>
                        
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                        
                                        <div class="row">
                                            <div class="col-md-12 ">
                        
                                                <div class="col-md-2">
                                                    <span class="signupfont"> Security Deposit: </span>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="input-list style-4 clearfix">
                                                        <div>
                        <?php
                        echo $this->Form->input(
                                'deposit', array(
                            'class' => 'required partial',
                            'type' => 'number'
                                )
                        );
                        ?> 
                                                        </div>                            
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <span class="signupfont">Monthly Bill: </span>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="input-list style-4 clearfix">
                                                        <div>
                        <?php
                        echo $this->Form->input(
                                'monthly_bill', array(
                            'class' => 'required partial',
                            'type' => 'number'
                                )
                        );
                        ?> 
                                                        </div>                            
                                                    </div>
                                                </div>
                                                <div class="col-md-1">
                                                    <span class="signupfont">Others: </span>
                                                </div>
                                                <div class="col-md-1">
                                                    <div class="input-list style-4 clearfix">
                                                        <div>
                        <?php
                        echo $this->Form->input(
                                'others', array(
                            'class' => 'partial',
                            'type' => 'number'
                                )
                        );
                        ?> 
                                                        </div>                            
                                                    </div>
                                                </div>
                                                <div class="col-md-1 signupfont">
                                                    Total: 
                                                </div>
                                                <div class="col-md-2">
                        <?php
                        echo $this->Form->input(
                                'total', array(
                            'class' => 'form-control input-sm total',
                            'type' => 'text',
                            'readonly' => 'readonly'
                                )
                        );
                        ?>
                                                </div>                                                                          
                                            </div>
                                        </div>-->
                        &nbsp;



                        <!--   *********payment             <div class="row">
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
                                                                            <label><input id="sig1" type="radio" value="CARD (DEBIT/CREDIT)" name="data[PackageCustomer][payment_type]">CARD (DEBIT/CREDIT)</label>
                                                                        </div>
                                                                        <div class="">
                                                                            <label><input id="sig1" type="radio" value="PERSONAL CHECK" name="data[PackageCustomer][payment_type]">PERSONAL CHECK</label>
                                                                        </div>
                                                                        <div class="">
                                                                            <label><input id="sig1" type="radio" value="CERTIFIED CHECK" name="data[PackageCustomer][payment_type]">CERTIFIED CHECK</label>
                                                                        </div>
                                                                        <div class="">
                                                                            <label><input id="sig2" type="radio" value="MONEY ORDER" name="data[PackageCustomer][payment_type]">MONEY ORDER</label>
                                                                        </div>
                        
                                                                    </div>
                                                                    <div class="sss" style="display: none;">
                                                                        <div class="col-md-9">
                                                        <label  class="signupfont" for="exampleInputFile1">Money order copy:</label>&nbsp;
                        
                                                                        <input type="file" name="data[PackageCustomer][ch_signature]" id="required">  
                        <?php
                        echo $this->Form->input(
                                'money_order', array(
                            'type' => 'file',
                            'id' => 'moneyorder'
                                )
                        );
                        ?>
                                                    </div>
                                                                    </div>
                        
                                                                </td>
                                                                <td>
                        
                                                                </td>
                                                                <td>
                                                                    <div class="row">
                                                                        <div class="col-md-8 col-md-offset-3">
                                                                            <div class="form-group" style="margin-left: 0px;">
                        
                                                                                <div class="radio-list">
                                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="VISA" name="data[PackageCustomer][card_type]">VISA</label>
                                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="MASTER Card" name="data[PackageCustomer][card_type]">MASTER Card </label>
                                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="MASTER Card" name="data[PackageCustomer][card_type]">BANK </label>
                                                                                </div>
                                                                            </div>     
                        
                                                                        </div>
                        
                                                                    </div>
                        
                        
                        
                                                                    <div class="row">
                                                                        <div class="col-md-3 signupfont">
                                                                            Name: 
                                                                        </div>
                                                                        <div class="col-md-9">
                        <?php
                        echo $this->Form->input(
                                'card_username', array(
                            'type' => 'text',
                            'class' => 'form-control input-sm required'
                        ));
                        ?>
                                                                        </div>
                        
                                                                    </div>
                        
                                                                    &nbsp;
                        
                                                                    <div class="row">
                                                                        <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                                            Card/Check No: 
                                                                        </div>
                                                                        <div class="col-md-9">
                        <?php
                        echo $this->Form->input(
                                'card_check_no', array(
                            'type' => 'text',
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
                                                                        <div class="col-md-9">
                                                                            <div>
                        <?php
                        echo $this->Form->input(
                                'exp_date', array(
                            'type' => 'date',
                        ));
                        ?>
                                                                            </div>
                                                                               exp_date     
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
                            'class' => 'form-control input-sm required'
                        ));
                        ?>
                                                                        </div>
                                                                        <div class="col-md-3 signupfont">
                                                                            Charged Amount: 
                                                                        </div>
                                                                        <div class="col-md-3">
                        <?php
                        echo $this->Form->input(
                                'charge_amount', array(
                            'class' => 'form-control input-sm total',
                            'type' => 'text',
                                )
                        );
                        ?>
                                                                        </div>
                                                                    </div>
                                                                    &nbsp;
                                                                    <div class="row">
                                                                        <div class="col-md-3 signupfont">
                                                                            Address on Card: 
                                                                        </div>
                                                                        <div class="col-md-9">
                        <?php
                        echo $this->Form->input(
                                'address_on_card', array(
                            'type' => 'text',
                            'class' => 'form-control input-sm'
                        ));
                        ?>
                                                                        </div>
                                                                    </div>
                                                                    &nbsp;
                                                                    <div class="row">
                                                                        <div class="col-md-10 col-md-offset-3">
                                                                            <input type="checkbox" name="data[PackageCustomer][same_address]" value="YES" id="PostPublished" /> <span class="signupfont">SAME AS BILLING ADDRESS </span>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>-->

                       <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ul"></i>EQUIPMENT
                                </div>

                                <div class="tools">
                                    <a  class="reload toggle" >
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                    <table class="table table-striped table-hover table-bordered">
                                        <thead>
                                            <tr>
                                                <th class="tablehead">
                                                    EQUIPMENT
                                                </th>

                                                <th class="tablehead">
                                                    DESCRIPTION
                                                </th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <span class="signupfont">SITE TOP BOX</span>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="text-center" style="margin-left: 0px;">
                                                                <div class="radio-list">
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input id="box1" type="radio" value="1 BOX" name="data[PackageCustomer][equipment_top_box]">1 BOX</label>
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input id="box2" type="radio" value="2 BOX" name="data[PackageCustomer][equipment_top_box]">2 BOX</label>
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input id="box3" type="radio" value="3 BOX" name="data[PackageCustomer][equipment_top_box]">3 BOX</label>
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>

                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="signupfont">HDMI</span> 
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="text-center" style="margin-left: 0px;">
                                                                <div class="radio-list">
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="YES" name="data[PackageCustomer][equipment_hdmi]">YES</label>
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="NO" name="data[PackageCustomer][equipment_hdmi]">NO</label>                                                       
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
        <!--                                    <tr>
                                                <td>
                                                    <span class="signupfont">AV CABLE</span> 
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="text-center" style="margin-left: 0px;">
                                                                <div class="radio-list">
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="YES" name="data[PackageCustomer][equipment_av_cable]">YES</label>
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="NO" name="data[PackageCustomer][equipment_av_cable]">NO</label>                                                       
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>-->
                                            <tr>
                                                <td>
                                                    <span class="signupfont">Wi-fi Adapter</span>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="text-center" style="margin-left: 0px;">
                                                                <div class="radio-list">
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="YES" name="data[PackageCustomer][equipment_ethernet]">YES</label>
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="NO" name="data[PackageCustomer][equipment_ethernet]">NO</label>                                                       
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
        <!--                                    <tr>
                                                <td>
                                                    <span class="signupfont">REMOTE</span>
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="text-center" style="margin-left: 0px;">
                                                                <div class="radio-list">
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="YES" name="data[PackageCustomer][equipment_remote]">YES</label>
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="NO" name="data[PackageCustomer][equipment_remote]">NO</label>                                                       
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <span class="signupfont">POWER ADAPTER</span> 
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="text-center" style="margin-left: 0px;">
                                                                <div class="radio-list">
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="YES" name="data[PackageCustomer][equipment_adapter]">YES</label>
                                                                    <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="NO" name="data[PackageCustomer][equipment_adapter]">NO</label>                                                       
                                                                </div>
                                                            </div>     
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>-->

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                            </div> 
<!--                           end portlet body-->
                       </div>
<!--                        end portlet box blue-->



                        <!-- BEGIN BUTTONS PORTLET-->



                        &nbsp; &nbsp; &nbsp;
                        <!--                <div class="row">
                                            <div class="col-md-12 col-sm-12" style="text-align: justify;">  
                        
                                                <div class="checkbox-list">
                                                    <label class="checkbox-inline" >
                                                        I understand that it will be billed $______for______month for cable TV voice online service. This bill payable by the 7th day of the every month. Total cable has the right to discontinue my cable service and asses additional @5/10/15 service charge for reconnecting service due to late or non-payment of bills. Total Cable has the right to discontinue service or change/remove contents offered as required by law or otherwise without prior notice. 
                                                    </label>
                        
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <label  class="signupfont" for="exampleInputFile1">Card Holder's Signature:</label>&nbsp;
                        
                                                                        <input type="file" name="data[PackageCustomer][ch_signature]" id="required">  
                        <?php
                        echo $this->Form->input(
                                'ch_signature', array(
                            'type' => 'file',
                            'id' => 'cardsig'
                                )
                        );
                        ?>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label  class="signupfont" for="exampleInputFile1">Card Holder's ID Card:</label>&nbsp;
                        
                                                                        <input type="file" name="data[PackageCustomer][ch_signature]" id="required">  
                        <?php
                        echo $this->Form->input(
                                'id_card', array(
                            'type' => 'file',
                            'id' => 'cardsig'
                                )
                        );
                        ?>
                                                    </div>
                                                </div>
                        
                                                <div class="checkbox-list">
                                                    <label class="checkbox-inline require" >
                        
                        <?php
                        echo $this->Form->input(
                                'agreement', array(
                            'type' => 'checkbox',
                            'id' => 'agree'
                        ));
                        ?> 
                        
                                                        By signing below I agree to the<a href="<?php echo Router::url(array('action' => 'terms_and_conditions')) ?>"><span class="text-primary"> terms and conditions </span></a> on other side of the page.
                        
                                                    </label>
                        
                                                </div>
                        
                                            </div>
                                        </div>-->

                        &nbsp;


                        <?php
                        echo $this->Form->input(
                                'psetting_id', array(
                            'id' => 'packageid',
                            'class' => 'required',
                            'type' => 'hidden',
                                )
                        );
                        ?>
                        &nbsp;

                        &nbsp;

                        <div class="row">
                            <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

                                <?php
                                echo $this->Form->button(
                                        'Sign up', array(
                                    'class' => 'btn btn-primary submitbtn',
                                    'type' => 'submit',
                                    'id' => 'signup'
                                ));
                                ?>

                            </div>
                        </div> 
                    </div>

                    <?php echo $this->Form->end(); ?>

                </div>
            </div>
        </div>
    </div>
</div>
