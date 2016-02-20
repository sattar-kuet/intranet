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
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">

                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Payment processed
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
<!--                        <div class="row">
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
                        </div>-->
                        <div class="row">
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
                                                            <label><input class="pmode" type="radio" value="card" name="pmode">CARD (DEBIT/CREDIT)</label>
                                                        </div>
                                                        <div class="">
                                                            <label><input class="pmode" type="radio" value="check" name="pmode">CHECK</label>
                                                        </div>
                                                        <div class="">
                                                            <label><input class="pmode" type="radio" value="check" name="pmode">MONEY ORDER</label>
                                                        </div>
                                                        <div class="">
                                                            <label><input class="pmode" type="radio" value="check" name="pmode">ONLINE BILL</label>
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
                                                            'url' => array('controller' => 'payments', 'action' => 'individual_transaction')
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
                                                            <div class="col-md-9">
                                                                <div>
                                                                    <?php
                                                                    echo $this->Form->input(
                                                                            'exp_date', array(
                                                                        'type' => 'date',
                                                                    ));
                                                                    ?>
                                                                </div>
                                                                <!--   exp_date     -->
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
                                                                    'class' => 'form-control input-sm',
                                                                    'placeholder' => 'zip code'
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
                                                                    'placeholder' => 'detail (optional)'
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
                                                                    'type' => 'number',
                                                                    'value' => '',
                                                                    'class' => 'form-control input-sm required'
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
                                                                    'class' => 'btn btn-primary submitbtn',
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
                                                            'url' => array('controller' => 'payments', 'action' => 'individual_transaction')
                                                                )
                                                        );
                                                        ?>
                                                        <div class="row">
                                                            <div class="col-md-3 signupfont">
                                                                Copy of check: 
                                                            </div>
                                                            <div class="col-md-9">
                                                                <?php
                                                                echo $this->Form->input(
                                                                        'id_card', array(
                                                                    'type' => 'file',
                                                                    'id' => ''
                                                                        )
                                                                );
                                                                ?>
                                                            </div>
                                                        </div>
                                                        &nbsp;
                                                        <div class="row">
                                                            <div class="col-md-3 signupfont">
                                                                Customer info: 
                                                            </div>
                                                            <div class="col-md-9">
                                                                <?php
                                                                echo $this->Form->input(
                                                                        'charge_amount', array(
                                                                    'type' => 'text',
                                                                    'class' => 'form-control input-sm required',
                                                                    'placeholder' => 'Bank name, Check number'
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
                                                                        'charge_amount', array(
                                                                    'type' => 'number',
                                                                    'class' => 'form-control input-sm required',
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
                                                                        'charge_amount', array(
                                                                    'type' => 'number',
                                                                    'class' => 'form-control input-sm required',
                                                                ));
                                                                ?>
                                                            </div>
                                                        </div>
                                                        &nbsp;
                                                        <?php echo $this->Form->end(); ?>
                                                        <div class="row">
                                                            <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

                                                                <?php
                                                                echo $this->Form->button(
                                                                        'Submit Payment', array(
                                                                    'class' => 'btn btn-primary submitbtn',
                                                                    'type' => 'submit',
                                                                    'id' => ''
                                                                ));
                                                                ?>

                                                            </div>
                                                        </div>
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
                                                            'url' => array('controller' => 'payments', 'action' => 'individual_transaction')
                                                                )
                                                        );
                                                        ?>

                                                        <div class="row">
                                                            <div class="col-md-3 signupfont">
                                                                Charged Amount: 
                                                            </div>
                                                            <div class="col-md-9">
                                                                <?php
                                                                echo $this->Form->input(
                                                                        'charge_amount', array(
                                                                    'type' => 'number',
                                                                    'class' => 'form-control input-sm required',
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
                                                                        'charge_amount', array(
                                                                    'type' => 'text',
                                                                    'class' => 'form-control input-sm required',
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
                                                                    'class' => 'btn btn-primary submitbtn',
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
                <!-- END EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>List of transactions to be processed
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
                        <div class="row">
                            <div class="col-md-12 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box"  style=" text-align: center; background-color: black;">
                                    <div class="portlet-title">
                                        <div class="caption" id="blackcaption" >
                                            Customer Information
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
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
                                <div class="col-md-10">
                                    <div class="input-list style-4 clearfix">
                                        <div>
                                            <?php
                                            echo $this->Form->input(
                                                    'address', array(
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
                                                'class' => 'required'
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
                            <div class="col-md-12 ">

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
                                <div class="col-md-4">
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
                                    Phone: 
                                </div>
                                <div class="col-md-5">
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


                        <div class="row">
                            <div class="col-md-12 ">
                                <!-- BEGIN SAMPLE FORM PORTLET-->
                                <div class="portlet box"  style=" text-align: center; background-color: black;">
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
                        </div>

                        <div class="row">
                            <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 

                                <?php
                                echo $this->Form->button(
                                        'Done', array(
                                    'class' => 'btn btn-primary submitbtn',
                                    'type' => 'submit',
                                    'id' => ''
                                ));
                                ?>

                            </div>
                        </div>



                        <?php echo $this->Form->end(); ?>  

                    </div>
                </div>

            </div>
        </div>

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
