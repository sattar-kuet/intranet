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

                                <div class="row" >
                                    <div class="col-md-12 ">
                                        <!--For custom package input box starts -->
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

                                        <!--For custom package input box Ends -->

                                        <div id="regularpackage">
                                            <div class="col-md-2 signupfont">
                                                Select package:
                                            </div>
                                            <div class="col-md-3">
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

                                        <div class="col-md-3">
                                            <label>
                                                <div class="" style="display: inline-block;"><span class=""><input id="customcheckbox" type="checkbox"></span></div> Custom Package </label>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="input-list style-4 clearfix">

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
                                &nbsp;
                            </div> 
                            <!-- portletbody end-->
                        </div> 
                        <!-- end  portlet box blue-->

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
                                            <table class="table table-striped table-hover table-bordered table-responsive">
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
                                                            <span class="signupfont">Router OR Modem</span> 
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="text-center" style="margin-left: 0px;">
                                                                        <div class="radio-list">
                                                                            <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="YES" name="data[PackageCustomer][equipment_router]">YES</label>
                                                                            <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="NO" name="data[PackageCustomer][equipment_router]">NO</label>                                                       
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <span class="signupfont">Site Top Box</span>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="text-center" style="margin-left: 0px;">
                                                                        <div class="radio-list">
                                                                            <label style="padding-top: 0px;" class="radio-inline"><input id="box1" type="radio" value="1 BOX" name="data[PackageCustomer][equipment_top_box]">1 BOX</label>
                                                                            <label style="padding-top: 0px;" class="radio-inline"><input id="box2" type="radio" value="2 BOX" name="data[PackageCustomer][equipment_top_box]">2 BOX</label>
                                                                            <label style="padding-top: 0px;" class="radio-inline"><input id="box3" type="radio" value="3 BOX" name="data[PackageCustomer][equipment_top_box]">3 BOX</label>
                                                                            <label style="padding-top: 0px;" class="radio-inline"><input id="box3" type="radio" value="4 BOX" name="data[PackageCustomer][equipment_top_box]">4 BOX</label>
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

                                                    <tr>
                                                        <td>
                                                            <span class="signupfont">Wi-fi Adapter</span>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="text-center" style="margin-left: 0px;">
                                                                        <div class="radio-list">
                                                                            <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="YES" name="data[PackageCustomer][equipment_wi_fi]">YES</label>
                                                                            <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="NO" name="data[PackageCustomer][equipment_wi_fi]">NO</label>                                                       
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <span class="signupfont">Power Adapter</span>
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
                                                    </tr>

                                                    <tr>
                                                        <td>
                                                            <span class="signupfont">Remote Control</span>
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
                                                            <span class="signupfont">Wire</span>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="text-center" style="margin-left: 0px;">
                                                                        <div class="radio-list">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'wire', array(
                                                                                'name' => 'data[PackageCustomer][wire]',
                                                                                'class' => '',
                                                                                'placeholder' => 'like 10 fit ',
                                                                                    )
                                                                            );
                                                                            ?>    
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="signupfont">Current ISP and Speed</span>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="text-center" style="margin-left: 0px;">
                                                                        <div class="radio-list">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'current_isp_speed', array(
                                                                                'name' => 'data[PackageCustomer][current_isp_speed]',
                                                                                'class' => '',
                                                                                    )
                                                                            );
                                                                            ?>    
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="signupfont">Service Provider</span>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="text-center" style="margin-left: 0px;">
                                                                        <div class="radio-list">                                                                             
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'current_service_provider', array(
                                                                                'name' => 'data[PackageCustomer][current_service_provider]',
                                                                                'class' => '',
                                                                                    )
                                                                            );
                                                                            ?>  
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="signupfont">Ethernet Wire</span>
                                                        </td>
                                                        <td>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="text-center" style="margin-left: 0px;">
                                                                        <div class="radio-list"> 
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'ethernet_wire', array(
                                                                                'name' => 'data[PackageCustomer][ethernet_wire]',
                                                                                'class' => '',
                                                                                    )
                                                                            );
                                                                            ?> 
                                                                        </div>
                                                                    </div>     
                                                                </div>
                                                            </div>

                                                        </td>
                                                    </tr>

                                                </tbody>

                                            </table>

                                        </div>

                                    </div>

                                </div>

                            </div> 
                            <!--                           end portlet body-->
                        </div>
                        <!-- end portlet box blue-->
                        &nbsp;

                        <!-- BEGIN SAMPLE FORM PORTLET-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ul"></i> Installation
                                </div>
                                <div class="tools">
                                    <a  class="reload toggle">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
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
                                            <span class="signupfont">Equipment: </span>
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
                                </div>

                                <!--    start installation method off                         
                                                                <div class="row">
                                                                    <div class="col-md-12">
                                                                        <div class="col-md-2">
                                                                            <span class="signupfont">Installation Method: </span>
                                                                        </div>
                                                                        <div class="col-md-3">
                                                                            <div class="text-center" style="margin-left: 0px;">
                                                                                <div class="radio-list">
                                                                                    <label style="padding-top: 0px;" class="radio-inline"><input id="email" type="radio" value="email" name="data[PackageCustomer][install_method]">by Email</label>
                                                                                    <label style="padding-top: 0px;" class="radio-inline"><input id="tech" type="radio" value="technician" name="data[PackageCustomer][install_method]">by Technician</label>                                                       
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div id="technician" style="display: none;">
                                                                            <div class="col-md-3">
                                <?php
                                echo $this->Form->input(
                                        'technician_name', array(
                                    'class' => 'form-control',
                                    'id' => 'technician_id',
                                    'options' => $technician_list,
                                    'label' => false,
                                    'empty' => '--Select Technician--',
                                        )
                                );
                                ?>
                                                                        </div>
                                                                        </div>
                                                                        
                                                                    </div>
                                                                </div>           End instalation method off -->
                            </div> 
                            <!-- portletbody end-->
                        </div> 
                        <!-- end  portlet box blue-->

                        &nbsp;

                        <!-- BEGIN SAMPLE FORM PORTLET   Shipment-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ul"></i> Shipment
                                </div>
                                <div class="tools">
                                    <a  class="reload toggle">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12 ">

                                        <div class="col-md-3">
                                            <label>
                                                <div class="" style="display: inline-block;"><span class=""><input id="shipment" type="checkbox"></span></div>Shipment</label>
                                        </div> 
                                    </div>

                                    <div class="col-md-12" id="shipmentshow_hide" style="display: none">
                                        <?php
                                        echo $this->Form->create('PackageCustomer', array(
                                            'inputDefaults' => array(
                                                'label' => false,
                                                'div' => false
                                            ),
                                            'class' => 'form-horizontal',
                                            'novalidate' => 'novalidate',
                                                )
                                        );
                                        ?>

                                        <div class="row">
                                            <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                Driving lisence or Social Security
                                            </div>
                                            <div class="col-md-9">
                                                <?php
                                                echo $this->Form->input(
                                                        'driving_socialsecurity', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control input-sm required',
                                                    'id' => 'cardnumber'
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                        &nbsp; 
                                        <div class="row">
                                            <div class="col-md-3 signupfont">
                                                Customer Utility:
                                            </div>
                                            <div class="col-md-9">
                                                <div class="text-center" style="margin-left: 0px;">
                                                    <div class="radio-list">
                                                        <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="YES" name="data[PackageCustomer][customer_utility]">YES</label>
                                                        <label style="padding-top: 0px;" class="radio-inline"><input type="radio" value="NO" name="data[PackageCustomer][customer_utility]">NO</label>                                                       
                                                    </div>
                                                </div>     
                                            </div>
                                        </div>   

                                        &nbsp;      
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
                                                        'card_check_no', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control input-sm required',
                                                    'id' => 'cardnumber'
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
                                                    'class' => 'span12 uniform nostyle select1  required',
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
                                                    'class' => 'span12 uniform nostyle   select1 required',
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
                                                    'class' => 'form-control input-sm required',
                                                    'id' => 'cvvcode'
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
                                                        'zip', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control input-sm required',
                                                    'placeholder' => 'zip code',
                                                ));
                                                ?>
                                            </div>

                                            <div class="col-md-5">
                                                <?php
                                                echo $this->Form->input(
                                                        'address_on_card', array(
                                                    'type' => 'text',
                                                    'class' => 'form-control input-sm',
                                                    'placeholder' => 'detail (optional)',
                                                ));
                                                ?>
                                            </div>
                                        </div>
                                        <?php echo $this->form->end(); ?>
                                    </div>
                                </div>
                            </div> 
                            <!-- portletbody end-->
                        </div> 
                        <!-- end  portlet box blue Shipment -->

                        &nbsp;
                        <!-- BEGIN SAMPLE FORM PORTLET   Additional info-->
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ul"></i> Additional Info 
                                </div>
                                <div class="tools">
                                    <a  class="reload toggle">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-12 ">
                                        <div class="col-md-3">
                                            <label>
                                                <div class="" style="display: inline-block;"><span class=""><input id="additioninfo " type="checkbox"></span></div>Follow this Customer </label>
                                        </div> 
                                    </div>
                                    <div id="Additional_info">
                                        <div class="form-group">
                                            <label class="control-label col-md-3">Opening Date<span class="required">
                                                    * </span>
                                            </label>
                                            <div class="col-md-3">
                                                <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'openDate', array(
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


                                        <div class="col-md-1">
                                            Total: 
                                        </div>
                                        <div class="col-md-3">
                                            <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                            </div>
                                            <?php
                                            echo $this->Form->input(
                                                    'follow_up_date', array(
                                                'class' => 'form-control',
                                                'readonly' => true
                                                    )
                                            );
                                            ?>
                                        </div>  


                                    </div>
                                </div>
                            </div>
                            <!-- end portlat-body-->
                        </div>
                        <!-- end portlet box Additional info-->
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
