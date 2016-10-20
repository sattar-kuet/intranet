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
                    <!-- -------------Begin exp date update--------------------------->                   
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Next Payment
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
                                'enctype' => 'multipart/form-data',
                                'url' => array('controller' => 'customers', 'action' => 'update_payment')
                                    )
                            );
                            ?>
                            <br>
                            <div class="row">                                     
                                <?php
                                echo $this->Form->input(
                                        'id', array(
                                    'type' => 'hidden',
                                    'value' => $this->params['pass'][0],
                                ));
                                ?>

                                <br>
                                <div class="col-md-2 signupfont">
                                    Next Payment Date:
                                </div>
                                <div class="col-md-4">
                                    <div class="input-list style-4 clearfix">
                                        <?php
                                        echo $this->Form->input(
                                                'package_exp_date', array(
                                            'class' => 'datepicker form-control ',
                                            'type' => 'text',
                                                )
                                        );
                                        ?>
                                    </div>
                                </div>
                                <div class="col-md-2 signupfont">
                                    Payment amount:
                                </div>
                                <div class="col-md-4">
                                    <div class="input-list style-4 clearfix">
                                        <?php
                                        echo $this->Form->input(
                                                'payable_amount', array(
                                            'type' => 'text',
                                            'class' => 'form-control',
                                        ));
                                        ?>
                                    </div>
                                </div>

                                &nbsp;
                                &nbsp;
                                <div class="row margin-top-20">
                                    <div class="col-lg-8 col-md-offset-4 padding-left-0 padding-top-20"> 
                                        <button class="btn btn-primary submitbtn green" type="submit" id="">Update Customer Information</button>                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                    </div>
                    <!-------------------------------------END exp date UPDATE---------------------->
                    <!--Invoice start-->
                    <!--                    <div class="portlet box lightseagreen" style=" background-color: #000; border: #000 solid 2px;">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <i class="fa fa-list-ul"></i>Open Invoice 
                                                </div>
                    
                                                <div class="tools">
                                                    <a  class="reload toggle"data-id="updatepayinfo">
                                                    </a>
                                                </div>
                                            </div>
                                            
                                            
                                            <div class="portlet-body">
                                                <div class="row " id="updatepayinfo"> 
                                                    <div class="col-md-12">
                    <?php
                    echo $this->Form->create('Transaction', array(
                        'inputDefaults' => array(
                            'label' => false,
                            'div' => false
                        ),
                        'class' => 'form-horizontal',
                        'novalidate' => 'novalidate',
                        'url' => array('controller' => 'transactions', 'action' => 'extrainvoice')
                            )
                    );
                    ?>
                    
                    <?php
                    // pr($this->params['pass'][0]); exit;
                    echo $this->Form->input('package_customer_id', array(
                        'type' => 'hidden',
                        'value' => $this->params['pass'][0],
                            )
                    );
                    ?>
                    <?php
                    // pr($this->params['pass'][0]); exit;
                    echo $this->Form->input('status', array(
                        'type' => 'hidden',
                        'value' => 'unpaid',
                            )
                    );
                    ?>
                    <?php
                    echo $this->Form->input('type', array(
                        'type' => 'hidden',
                        'value' => 'extra',
                            )
                    );
                    ?>
                    
                                                        <div class="form-body">
                                                            <div class="col-md-12">
                    
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-1">Description:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'description_tran1', array(
                        'type' => 'text',
                        'class' => 'form-control ',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Product: <span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'product_type', array(
                        'type' => 'text',
                        'class' => 'form-control',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Quantity:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'quantity', array(
                        'type' => 'text',
                        'class' => 'form-control',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Rate:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'rate', array(
                        'type' => 'text',
                        'class' => 'form-control',
                    ));
                    ?>
                                                                    </div>
                    
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-1">Price:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'price', array(
                        'type' => 'text',
                        'class' => 'form-control ',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Discount:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'discount', array(
                        'type' => 'text',
                        'class' => 'form-control',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Promotion:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'promotion', array(
                        'type' => 'text',
                        'class' => 'form-control',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Credit:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'credit', array(
                        'type' => 'text',
                        'class' => 'form-control',
                    ));
                    ?>
                                                                    </div>
                    
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-1">Adjustment: <span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'adjustment', array(
                        'type' => 'text',
                        'class' => 'form-control ',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Note:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'note', array(
                        'type' => 'text',
                        'class' => 'form-control',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Payment date: <span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
                    echo $this->Form->input(
                            'next_payment', array(
                        'type' => 'text',
                        'class' => 'datepicker form-control ',
                    ));
                    ?>
                                                                    </div>
                                                                    <label class="control-label col-md-1">Payment amount:<span class="">
                                                                        </span>
                                                                    </label>
                                                                    <div class="col-md-2">
                    <?php
//                                                    echo $this->Form->input(
//                                                            'payable_amount', array(
//                                                        'type' => 'text',
//                                                        'class' => 'form-control',
//                                                    ));
//                                                    
                    ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                    
                                                            <div class="form-actions">
                                                                <div class="row">
                                                                    <div class="col-md-offset-6 col-md-4">
                    <?php
                    echo $this->Form->button(
                            'Submit', array('class' => 'btn red-sunglo', 'type' => 'submit', 'style' => "background-color: #daae2b;",)
                    );
                    ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                    <?php echo $this->Form->end(); ?>
                                                        </div>
                    
                                                    </div>
                                                </div>
                                            </div>
                                            
                                            
                                            
                                        </div>-->

                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box green" style=" background-color: #000; border: #000 solid 2px;">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-user"></i>Open Invoice 
                                    </div>

                                    <!--                        <div class="tools">
                                                                <a href="javascript:;" class="reload">
                                                                </a>
                                                            </div>-->
                                </div>
                                <div class="portlet-body">

                                    <?php echo $this->Session->flash(); ?> 

                                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">

                                        <thead>
                                            <tr> 
                                                <th class="hidden-480">
                                                    Name
                                                </th>
                                                <th class="hidden-480">
                                                    Address
                                                </th>
                                                <th class="hidden-480">
                                                    Mac
                                                </th>
                                                <th class="hidden-480">
                                                    Cell
                                                </th>
                                                <th>
                                                    Package
                                                </th>
                                                <th class="hidden-480">
                                                    Due
                                                </th>
                                                <th class="hidden-480">
                                                    Exp Date
                                                </th>
                                                <th class="hidden-480">
                                                    Action
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($customers as $info):
//                                            pr($info);
                                                $customer_address = $info['package_customers']['house_no'] . ' ' . $info['package_customers']['street'] . ' ' .
                                                        $info['package_customers']['apartment'] . ' ' . $info['package_customers']['city'] . ' ' . $info['package_customers']['state'] . ' '
                                                        . $info['package_customers']['zip'];
                                                ?>
                                                <tr>
                                                    <td> <a href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit_customer_data', $info['package_customers']['id'])) ?>" target="_blank"><?php echo $info['package_customers']['middle_name'] . " " . $info['package_customers']['last_name']; ?></a> </td>
                                                    <td><?php echo $customer_address; ?></td>
                                                    <td><?php echo $info['package_customers']['mac']; ?></td>
                                                    <td><?php echo $info['package_customers']['cell']; ?></td>
                                                    <td>
                                                        <?php
                                                        if ($info['package_customers']['custom_package_id'] == null) {
                                                            if (count($info['Psetting']) == 0) {
                                                                echo 'No package was selected with this customer';
                                                            } else {
                                                                echo $info['Psetting']['name'];
                                                            }
                                                        } else {
                                                            echo $info['custom_packages']['duration'] . ' Months, Custom package ' . $info['custom_packages']['charge'] . '$';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>$<?php echo $info['transactions']['payable_amount']; ?></td>
                                                    <td><?php echo date_format(new DateTime($info['transactions']['next_payment']), 'm-d-Y'); ?></td>
                                                    <td>   
                                                        <a  target="_blank" title="Edit" href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $info['transactions']['id'])) ?>" >
                                                            <span class="fa fa-pencil"></span>
                                                        </a>
                                                        &nbsp;&nbsp;

                                                        <a  target="_blank" title="Take Payment" href="<?php echo Router::url(array('controller' => 'payments', 'action' => 'process', $info['transactions']['id'], $info['transactions']['id'])) ?>" >
                                                            <span class="fa fa-dollar"></span>
                                                        </a>

                                                    </td>

                                                </tr>

                                                <?php
                                            endforeach;
                                            ?>

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <!-- END EXAMPLE TABLE PORTLET-->
                        </div>
                    </div>
                    <!-- END PAGE CONTENT -->


                    <!-- END CONTENT -->
                    <!--Invoice end-->

                    <!-- END EXAMPLE TABLE PORTLET-->
                    <div class="portlet box green">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Customer Information
                                <strong style="color: #191818;;">ACCT NO. <?php echo $c_acc_no; ?></strong>
                                <?php
                                $created = date("Y-m-d", strtotime($customer_info['PackageCustomer']['created']));
                                $curr_date = date('Y-m-d');
//pr($created);exit;

                                $diff = abs(strtotime($curr_date) - strtotime($created));
                                $years = floor($diff / (365 * 60 * 60 * 24));
//pr($years);exit;
                                $status = '';
                                $color = '';
                                if ($years > 1 && $years < 3) {
                                    $status = "Gold Customer";
                                    $color = 'gold;';
                                } else if ($years >= 3) {
                                    $status = "Platinum Customer";
                                    $color = '#E5E4E2;';
                                }
                                ?>
                                <strong style="color: <?php $color; ?>">
                                    <?php echo $status; ?>
                                </strong>

                            </div>

                            <div class="tools">
                                <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'servicemanage')) ?>" class="btnPrev"  style="color:  #E02222;">Back
                                </a>
                            </div>
                            <div class="tools">
                                <?php $created = date("Y-m-d", strtotime($customer_info['PackageCustomer']['created'])); ?>
                                <strong style="color: #191818;">Since. <?php echo $created; ?></strong>
                                <?php ?>
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

                            <br>
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
                                                    'class' => '',
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
                                                    'class' => '',
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
                                        House Number
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'house_no', array(
                                                    'class' => 'form-control ',
                                                    'type' => 'text'
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
                                                    'class' => '',
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
                                                    'class' => '',
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
                                                    'class' => '',
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
                                                    'class' => '',
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
                                                    'class' => '',
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
                                                    'class' => '',
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
                                                    'id' => 'email'
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
                                                    'id' => 'fax',
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
                                    <div id="custompackage"  style="<?php
                                    if ($checkMark == FALSE) {
                                        echo 'display: none;';
                                    } else {
                                        echo '';
                                    }
                                    ?>">
                                        <div class="col-md-2">
                                            <?php
                                            $arrCategory = array("1" => "1 Month", "3" => "3 Month", "6" => "6 Month", "12" => "1 Year");
                                            echo $this->Form->input(
                                                    'duration', array(
                                                'class' => 'form-control',
                                                'id' => 'selctMonth',
                                                'default' => $custom_package_duration,
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
                                                'value' => $custom_package_charge,
                                                'placeholder' => 'Amount'
                                                    )
                                            );
                                            ?> 
                                        </div>
                                    </div>

                                    <!--For custom package input box Ends -->

                                    <div id="regularpackage" style="<?php
                                    $class = '';
                                    if ($checkMark == TRUE) {
                                        echo 'display: none;';
                                    } else {
                                        echo '';
                                        $class = '';
                                    }
                                    ?>">
                                        <div class="col-md-2 signupfont">
                                            Select package:
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            echo $this->Form->input('psetting_id', array(
                                                'type' => 'select',
                                                'options' => $packageList,
                                                //'default' => $selected['package'],
                                                'empty' => 'Select Package Type',
                                                'id' => 'psettingId',
                                                'class' => 'span12 uniform nostyle select1' . $class,
                                                'div' => array('class' => 'span12')
                                                    )
                                            );
                                            ?>
                                        </div>  
                                    </div>

                                    <div class="col-md-2">
                                        <label>
                                            <div class="" style="display: inline-block;"><span class=""><input id="customcheckbox" type="checkbox" <?php
                                                    if ($checkMark == TRUE) {
                                                        echo 'checked';
                                                    } else {
                                                        echo '';
                                                    }
                                                    ?>></span></div> Custom Package </label>
                                    </div>
                                    <div class="col-md-2 signupfont">
                                        Add New STBs:
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input('stbs', array(
                                                    'type' => 'select',
                                                    'options' => array('1' => 1, '2' => 2, '3' => 3, '4' => 4, '5' => 5, '6' => 6, '7' => 7, '8' => 8, '9' => 9, '10' => 10, '11' => 11, '12' => 12),
                                                    //'default' => $selected['package'],
                                                    'empty' => 'Select Stbs',
                                                    'class' => 'span12 uniform nostyle select1',
                                                    'name' => 'stb'
                                                        //'id'=>'stbn',
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
                                <?php
                                if (is_array($macstb['mac'])):


                                    foreach ($macstb['mac'] as $index => $mac):
                                        $system = $macstb['system'][$index];
                                        ?>
                                        <div class="col-md-12">
                                            <div class="col-md-2 signupfont ">Mac no:</div>
                                            <div class="col-md-4">
                                                <div class="input-list style-4 clearfix">
                                                    <div>

                                                        <?php
                                                        echo $this->Form->input(
                                                                'mac.', array(
                                                            'class' => '',
                                                            'placeholder' => 'Optional',
                                                            'value' => $mac
                                                                )
                                                        );
                                                        ?> 

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2 signupfont">System:</div>
                                            <div class="col-md-4">
                                                <div class="input-list style-4 clearfix">
                                                    <div>
                                                        <?php
                                                        echo $this->Form->input('system.', array(
                                                            'type' => 'select',
                                                            'options' => array('CMS1' => 'CMS1', 'CMS2' => 'CMS2', 'CMS3' => 'CMS3', 'PORTAL' => 'PORTAL', 'PORTAL1' => 'PORTAL1'),
                                                            'default' => trim($system),
                                                            'empty' => 'Select System',
                                                            'class' => 'span12 uniform nostyle select1'

                                                                //'id'=>'stbn',
                                                                )
                                                        );
                                                        ?>

                                                    </div>
                                                </div>
                                            </div>  
                                        </div>


                                        <?php
                                    endforeach;
                                endif;
                                ?>
                            </div>
                            &nbsp;
                            <div class="" id="addmac">

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
                                                    'id' => 'phone'
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
                                        Account No.

                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'c_acc_no', array(
                                                    'class' => '',
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-2 signupfont status-date">
                                        <!--                                       Active Date:-->
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'date', array(
                                                    'type' => 'text',
                                                    'class' => 'datepicker form-control '
                                                        )
                                                );
                                                ?> 
                                            </div>                            
                                        </div>
                                        <div id="status-history" class="alert alert-success display-hide" style="text-align: inherit;">
                                            <?php
                                            foreach ($statusHistories as $history):
                                                ?>
                                                <span class="fa fa-hand-o-right pull-left"> <?php echo $history['StatusHistory']['status']; ?></span> &nbsp;
                                                <span class="fa fa-clock-o pull-right"> <?php echo $history['StatusHistory']['date']; ?> </span> <br>
                                            <?php endforeach; ?>
                                        </div>

                                        <span  id="#status-history" title="Status History of Customer" class="toggleDiv">
                                            <i class="fa fa-eye pull-right"> </i>
                                        </span>


                                    </div>                                

                                </div>
                                &nbsp;

                                <div class="col-md-12 margin-bottom-25" >
                                    <div class="col-md-1 signupfont">
                                        Comment
                                    </div>
                                    <div class="col-md-3">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'comments', array(
                                                    'class' => 'form-control',
                                                    'type' => 'textarea',
                                                    'rows' => '5',
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-2 signupfont">
                                        Status Update
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input('status', array(
                                                    'type' => 'select',
                                                    'options' => array(
                                                        'active' => 'Active',
                                                        'canceled' => 'Canceled',
                                                        'requested' => 'Requested',
                                                        'done' => 'Done',
                                                        'ready' => 'Ready to install',
                                                        'old_ready' => 'Troubleshot',
                                                        'scheduled' => 'Scheduled',
                                                        'Request to cancel' => 'Request to cancel',
                                                        'Request to hold' => 'Request to hold',
                                                        'Request to unhold' => 'Request to unhold',
                                                        'hold' => 'Hold',
                                                        'unhold' => 'Unhold',
                                                        'Request to reconnection' => 'Request to reconnection',
                                                        'post pone' => 'Post pone',
                                                        'done' => 'Done',
                                                        'rescheduled' => 'Reschedu'
                                                    ),
                                                    //'default' => $selected['package'],
                                                    'empty' => 'Select Status',
                                                    'class' => 'span12 uniform nostyle select1 ',
                                                    'name' => 'status',
                                                    'id' => 'status'
                                                        //'id'=>'stbn',
                                                        )
                                                );
                                                ?>
                                            </div>                            
                                        </div>
                                    </div>

                                </div>
                                &nbsp;

                                <div class="col-md-12 margin-bottom-25" >
                                    <div class="col-md-1 signupfont">
                                        Recurring
                                    </div>
                                    <div class="col-md-1">
                                        <div class="input-list style-2 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input('auto_r', array(
                                                    'type' => 'select',
                                                    'options' => array(
                                                        'empty' => 'Select Option',
                                                        'yes' => 'Yes',
                                                        'no' => 'No',
                                                    ),
                                                    'class' => 'recurringChange')
                                                );
                                                ?>
                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-2 signupfont">
                                        &nbsp;  Repeat at Every
                                    </div>

                                    <div class="col-md-1">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'r_duration', array(
                                                    'class' => 'form-control',
                                                    'type' => 'text'
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>
                                    <div class="col-md-2 signupfont">
                                        Charge Amount
                                    </div>
                                    <div class="col-md-1">
                                        <div class="input-list style-4 clearfix">
                                            <div>
                                                <?php
                                                echo $this->Form->input(
                                                        'charge_amount', array(
                                                    'class' => 'form-control',
                                                    'type' => 'text'
                                                        )
                                                );
                                                ?>

                                            </div>                            
                                        </div>
                                    </div>

                                    <div class="col-md-2 signupfont">
                                        Recurring From
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-list style-4 clearfix">
                                            <?php
                                            echo $this->Form->input(
                                                    'r_form', array(
                                                'class' => 'datepicker form-control ',
                                                'type' => 'text',
                                                    )
                                            );
                                            ?>
                                        </div>
                                    </div>
                                </div>
                                &nbsp;


                                <div class="col-md-12 margin-bottom-25 display-hide" id="recurring" >
                                    <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                        Card Number: 
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'card_check_no', array(
                                            'type' => 'text',
                                            'value' => '',
                                            'class' => 'form-control input-sm ',
                                            'id' => 'card_number',
                                            'value' => $cardInfo['card_no']
                                        ));
                                        ?>
                                    </div>

                                    <div class="col-md-2 signupfont">
                                        Expiration Date:
                                    </div>
                                    <div class="col-md-1">
                                        <?php
                                        echo $this->Form->input('exp_date.year', array(
                                            'type' => 'select',
                                            'options' => $ym['year'],
                                            'empty' => 'Select Year',
                                            'class' => 'span12 uniform nostyle select1 ',
                                            'div' => array('class' => 'span12 '),
                                            'id' => 'showyear',
                                            'default' => $cardInfo['exp_date']['year']
                                                )
                                        );
                                        ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('exp_date.month', array(
                                            'type' => 'select',
                                            'options' => $ym['month'],
                                            'empty' => 'Select Month',
                                            'class' => 'span12 uniform nostyle select1 ',
                                            'div' => array('class' => 'span12 '),
                                            'id' => 'showmonth',
                                            'default' => $cardInfo['exp_date']['month']
                                                )
                                        );
                                        ?>
                                    </div>

                                    <div class="col-md-1 signupfont">
                                        Amount: 
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input(
                                                'charge_amount', array(
                                            'type' => 'text',
                                            'class' => 'form-control input-sm '
                                        ));
                                        ?>
                                    </div>
                                    <br>
                                    &nbsp;
                                    <div class="row">

                                        <div class="col-md-2">
                                            Name: 
                                        </div>
                                        <div class="col-md-3">
                                            <?php
                                            echo $this->Form->input(
                                                    'cfirst_name', array(
                                                'type' => 'text',
                                                'class' => 'form-control input-sm ',
                                                'placeholder' => 'first name',
                                                'id' => 'firstname',
                                                'value' => $cardInfo['fname']
                                            ));
                                            ?>
                                        </div>
                                        <div class="col-md-3">
                                            <?php
                                            echo $this->Form->input(
                                                    'clast_name', array(
                                                'type' => 'text',
                                                'class' => 'form-control input-sm ',
                                                'placeholder' => 'last name',
                                                'id' => 'lastname',
                                                'value' => $cardInfo['lname']
                                            ));
                                            ?>
                                        </div>


                                        <div class="col-md-2 ">
                                            CVV Code: 
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            echo $this->Form->input(
                                                    'cvv_code', array(
                                                'type' => 'text',
                                                'value' => '',
                                                'class' => 'form-control input-sm ',
                                                'id' => 'cvv_code',
                                                'value' => $cardInfo['cvv_code'],
                                            ));
                                            ?>
                                        </div>
                                    </div>
                                    <br>
                                    <div class="row">
                                        <div class="col-md-2 ">
                                            Zip Code on Card: 
                                        </div>
                                        <div class="col-md-2">
                                            <?php
                                            echo $this->Form->input(
                                                    'czip', array(
                                                'type' => 'text',
                                                'value' => '',
                                                'class' => 'form-control input-sm ',
                                                'id' => 'cvv_code',
                                                'value' => $cardInfo['zip_code'],
                                            ));
                                            ?>
                                        </div>
                                    </div>


                                </div>
                                &nbsp;

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
                    </div>

                    <!--     Begin Additional Invoice    -->

                    <div class="portlet box lightseagreen" style="background-color:#daae2b; border: #daae2b solid 2px;">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-list-ul"></i>Additional Invoice 
                            </div>

                            <div class="tools">
                                <a  class="reload toggle"data-id="updatepayinfo">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row display-hide" id="updatepayinfo"> 
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->create('Transaction', array(
                                        'inputDefaults' => array(
                                            'label' => false,
                                            'div' => false
                                        ),
                                        'class' => 'form-horizontal',
                                        'novalidate' => 'novalidate',
                                        'url' => array('controller' => 'transactions', 'action' => 'extrainvoice')
                                            )
                                    );
                                    ?>

                                    <?php
                                    // pr($this->params['pass'][0]); exit;
                                    echo $this->Form->input('package_customer_id', array(
                                        'type' => 'hidden',
                                        'value' => $this->params['pass'][0],
                                            )
                                    );
                                    ?>
                                    <?php
                                    // pr($this->params['pass'][0]); exit;
                                    echo $this->Form->input('status', array(
                                        'type' => 'hidden',
                                        'value' => 'unpaid',
                                            )
                                    );
                                    ?>
                                    <?php
                                    echo $this->Form->input('type', array(
                                        'type' => 'hidden',
                                        'value' => 'extra',
                                            )
                                    );
                                    ?>

                                    <div class="form-body">
                                        <div class="col-md-12">

                                            <div class="form-group">
                                                <label class="control-label col-md-1">Description:<span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'description_tran1', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                    ));
                                                    ?>
                                                </div>
                                                <label class="control-label col-md-1">Product: <span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'product_type', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                    ));
                                                    ?>
                                                </div>
                                                <label class="control-label col-md-1">Quantity:<span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'quantity', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                    ));
                                                    ?>
                                                </div>
                                                <label class="control-label col-md-1">Rate:<span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'rate', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                    ));
                                                    ?>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-1">Price:<span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'price', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                    ));
                                                    ?>
                                                </div>
                                                <label class="control-label col-md-1">Discount:<span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'discount', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                    ));
                                                    ?>
                                                </div>
                                                <label class="control-label col-md-1">Promotion:<span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'promotion', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                    ));
                                                    ?>
                                                </div>
                                                <label class="control-label col-md-1">Credit:<span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'credit', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                    ));
                                                    ?>
                                                </div>

                                            </div>
                                            <div class="form-group">
                                                <label class="control-label col-md-1">Adjustment: <span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'adjustment', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control ',
                                                    ));
                                                    ?>
                                                </div>
                                                <label class="control-label col-md-1">Note:<span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'note', array(
                                                        'type' => 'text',
                                                        'class' => 'form-control',
                                                    ));
                                                    ?>
                                                </div>
                                                <label class="control-label col-md-1">Payment date: <span class="">
                                                    </span>
                                                </label>
                                                <div class="col-md-2">
                                                    <?php
                                                    echo $this->Form->input(
                                                            'next_payment', array(
                                                        'type' => 'text',
                                                        'class' => 'datepicker form-control ',
                                                    ));
                                                    ?>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <div class="row">
                                                <div class="col-md-offset-6 col-md-4">
                                                    <?php
                                                    echo $this->Form->button(
                                                            'Submit', array('class' => 'btn red-sunglo', 'type' => 'submit', 'style' => "background-color: #daae2b;",)
                                                    );
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

                    <!--End Additional Invoice -->
                </div>
            </div>
        </div>



        <!-------------------------------------START REFUND---------------------->
        <div  class="col-md-12 col-sm-12">
            <div class="portlet box red-sunglo">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-list-ul"></i>Refund
                    </div>
                    <div class="tools">
                        <a  class="reload toggle" data-id="refund">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row display-hide" id="refund"> 

                        <?php
                        echo $this->Form->create('Transaction', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'payments', 'action' => 'refundTransaction')
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input(
                                'pay_mode', array(
                            'type' => 'hidden',
                            'value' => 'refund'
                        ));
                        ?>
                        <div class="form-body">
                            <?php
                            echo $this->Form->input(
                                    'cid', array(
                                'type' => 'hidden',
                                'value' => $this->params['pass'][0]
                            ));
                            ?>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="control-label col-md-3">Transaction Number<span class="">
                                        </span>
                                    </label>
                                    <div class="col-md-3">
                                        <?php
                                        echo $this->Form->input(
                                                'trx_no', array(
                                            'class' => 'form-control ',
                                            'type' => 'text',
                                            'value' => $latestcardInfo['trx_id']
                                                )
                                        );
                                        ?>
                                    </div>
                                    <label class="control-label col-md-3">Card Number(Last 4 digit)<span class="">
                                        </span>
                                    </label>
                                    <div class="col-md-3">
                                        <?php
                                        echo $this->Form->input(
                                                'card_no', array(
                                            'class' => 'form-control ',
                                            'type' => 'text',
                                            'value' => $latestcardInfo['card_no']
                                                )
                                        );
                                        ?>
                                    </div>

                                </div>
                                <div class="form-group">

                                    <label class="control-label col-md-2">Card Exp Date</label>

                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('exp_date.year', array(
                                            'type' => 'select',
                                            'options' => $ym['year'],
                                            'empty' => 'Select Year',
                                            'class' => 'span12 form-control uniform nostyle select1 ',
                                            'id' => 'year',
                                            'value' => $latestcardInfo['exp_date']['year']
                                                )
                                        );
                                        ?>
                                    </div>
                                    <div class="col-md-2">
                                        <?php
                                        echo $this->Form->input('exp_date.month', array(
                                            'type' => 'select',
                                            'options' => $ym['month'],
                                            'empty' => 'Select Month',
                                            'class' => 'span12 form-control uniform nostyle select1 ',
                                            'id' => 'month',
                                            'value' => $latestcardInfo['exp_date']['month']
                                                )
                                        );
                                        ?>
                                    </div>

                                    <label class="control-label col-md-3">Refund Amount<span class="">
                                        </span>
                                    </label>
                                    <div class="col-md-3">
                                        <?php
                                        echo $this->Form->input(
                                                'refund_amount', array(
                                            'class' => 'form-control ',
                                            'type' => 'text'
                                                )
                                        );
                                        ?>
                                    </div>

                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row">
                                    <div class="col-md-offset-6 col-md-4">
                                        <?php
                                        echo $this->Form->button(
                                                'Confirm', array('class' => 'btn red-sunglo', 'type' => 'submit')
                                        );
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
        <!-------------------------------------END REFUND---------------------->
        <!-------------payment history start----------------->
        <div  class="col-md-12 col-sm-12">
            <div class="portlet box " style="background-color: mediumpurple; border: mediumpurple solid 2px;">
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
                                    <th>Payment Detail</th>
                                    <th>Paid Amount</th>
                                    <th>Transaction Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($transactions as $single):

                                    $info = $single['Transaction'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td>
                                            <?php if ($info['pay_mode'] == 'card'): ?>
                                                <ul>
                                                    <li>Pay Mode : <?php echo $info['pay_mode']; ?></li> 
                                                    <li>Status : <?php echo $info['status']; ?></li>
                                                    <?php if ($info['status'] == 'error'): ?>
                                                        <ul>
                                                            <li>Error Message : <?php echo $info['error_msg']; ?></li> 
                                                        </ul>
                                                    <?php endif;
                                                    ?>
                                                    <li>Card No : <?php echo substr($info['card_no'], -4); ?></li>  
                                                    <li>Zip Code : <?php echo $info['zip_code']; ?></li>  
                                                    <li>CVV Code : <?php echo $info['cvv_code']; ?></li> 
                                                    <li>Expire Date : <?php echo $info['exp_date']; ?></li>
                                                    <li> Transaction ID : <?php echo $info['trx_id']; ?></li> 
                                                </ul>
                                            <?php elseif ($info['pay_mode'] == 'cash'): ?>
                                    <li>Pay Mode : <?php echo $info['pay_mode']; ?></li> 
                                    Cash By : <?php echo $info['cash_by']; ?>

                                <?php elseif ($info['pay_mode'] == 'refund'): ?>
                                    <ul><li>Pay Mode : <?php echo $info['pay_mode']; ?></li>
                                        <ul> <li>Amount : <?php echo $info['paid_amount']; ?></li>
                                            <li>Refund Date : <?php echo $info['created']; ?></li>
                                        </ul>
                                    </ul>

                                <?php else: ?>
                                    <li>Pay Mode : <?php echo $info['pay_mode']; ?></li> 
                                    <img src="<?php echo $this->webroot . 'check_images' . '/' . $info['check_image']; ?>"  width="50px" height="50px" />

                                <?php endif; ?> 
                                <td><?php echo $info['paid_amount']; ?></td>
                                <td><?php echo $info['created']; ?></td>

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
                <div class="portlet box " style="background-color: tomato; border: tomato solid 2px;">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-list-ul"></i>Statement
                        </div>
                        <div class="tools">
                            <a  class="reload toggle" data-id="transaction">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php if (count($transactions_all)) { ?>
                            <div class="row display-hide" id="transaction">

                                <div  class="col-md-12 col-sm-12">
                                    <div  class="col-md-9 col-sm-9">
                                    </div>  
                                    <div  class="col-md-3 col-sm-3">

                                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >

                                            <thead>
                                            <div style="text-align: right; font: bold ; font-size: 19px; margin-right: 2px;">Statement</div>
                                            <tr >  
                                                <th>Date</th>
                                                <th>Statement #</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX">
                                                    <td> <?php echo date('Y-m-d'); ?></td>  
                                                    <?php $transactions_alls = $transactions_all; ?>
                                                    <td><?php echo getInvoiceNumbe($transactions_alls[0]['tr']['package_customer_id']); ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div  class="col-md-12 col-sm-12">
                                    <div  class="col-md-3 col-sm-3">
                                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                                            <thead>
                                                <tr >  
                                                    <th>To</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $single = $transactions_all;
                                                $customer_address = $single[0]['pc']['house_no'] . ' ' . $single[0]['pc']['street'] . ' ' .
                                                        $single[0]['pc']['apartment'] . ' ' . $single[0]['pc']['city'] . ' ' . $single[0]['pc']['state'] . ' '
                                                        . $single[0]['pc']['zip'];
                                                ?>
                                                <tr class="odd gradeX">
                                                    <td>                                            
                                                        <?php
                                                        echo $single[0]['pc']['first_name'] . " " .
                                                        $single[0]['pc']['middle_name'] . " " .
                                                        $single[0]['pc']['last_name'];
                                                        ?>
                                                        <br>
                                                        <?php if (!empty($single[0]['pc']['cell'])): ?>
                                                            <b>Cell:</b>  <a href="tel:<?php echo $single[0]['pc']['cell'] ?>"><?php echo $single[0]['pc']['cell']; ?></a> &nbsp;&nbsp;
                                                        <?php endif; ?><br>
                                                        <?php if (!empty($single[0]['pc']['home'])): ?>
                                                            <b> Phone: </b> <a href="tel:<?php echo $single[0]['pc']['home'] ?>"><?php echo $single[0]['pc']['home']; ?></a>
                                                        <?php endif; ?> <br>
                                                        <b> Address: </b> <?php echo $customer_address; ?> 
                                                    </td>
                                                </tr>                                           
                                            </tbody>
                                        </table>
                                    </div>
                                    <div  class="col-md-9 col-sm-9">                                   
                                    </div>
                                </div>

                                <div  class="col-md-12 col-sm-12">
                                    <div  class="col-md-9 col-sm-9">
                                    </div>  
                                    <div  class="col-md-3 col-sm-3">
                                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                                            <thead>
                                                <tr >  
                                                    <th>Amount Due</th>
                                                    <th>Enclosed</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="odd gradeX">
                                                    <td class="due-amount"></td>                                                
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                                    <thead>
                                        <tr >  
                                            <th>Invoice Information</th>
                                            <th>Payment info</th>
                                            <th>Amount</th>
                                            <th>Balance</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $balance = array();

                                        foreach ($transactions_all as $i => $single):
//                                            pr($single); exit;
                                            if ($single['tr']['payable_amount']) {
                                                $amount = -1 * $single['tr']['payable_amount'];
                                            } else {
                                                $amount = $single['tr']['paid_amount'];
                                            }
                                            if ($i > 0) {
                                                $balance[$i] = $balance[$i - 1] + $amount;
                                            } else {
                                                $balance[$i] = $amount;
                                            }
                                            ?>
                                            <tr class="odd gradeX">
                                                <td>                                                    
                                                    Invoice No:  <?php echo $single['tr']['invoice']; ?><br>
                                                    STB Quantity:  <?php echo $single['pc']['stbs']; ?><br>
                                                    Price:  <?php echo $single['tr']['price']; ?>  
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($single['tr']['payable_amount']) {
                                                        echo $single['tr']['description_tran'];
                                                    } else {
                                                        ?>
                                                        <?php if ($single['tr']['pay_mode'] == 'card'): ?>
                                                            <ul>
                                                                <li>Pay Mode : <?php echo $single['tr']['pay_mode']; ?></li> 
                                                                <li>Status : <?php echo $single['tr']['status']; ?></li>
                                                                <?php if ($single['tr']['status'] == 'error'): ?>
                                                                    <ul>
                                                                        <li>Error Message : <?php echo $single['tr']['error_msg']; ?></li> 
                                                                    </ul>
                                                                <?php endif;
                                                                ?>
                                                                <li>Transaction No : <?php echo $single['tr']['trx_id']; ?></li> 
                                                                <li>Card No : <?php echo substr($single['tr']['card_no'], 0, 4); ?></li>  
                                                                <li>Zip Code : <?php echo $single['tr']['zip_code']; ?></li>  
                                                                <li>CVV Code : <?php echo $single['tr']['cvv_code']; ?></li> 
                                                                <li>Expire Date : <?php echo $single['tr']['exp_date']; ?></li>

                                                            </ul>
                                                        <?php elseif ($single['tr']['pay_mode'] == 'cash'): ?>
                                                <li>Pay Mode : <?php echo $single['tr']['pay_mode']; ?></li> 
                                                Cash By : <?php echo $single['tr']['cash_by']; ?>

                                            <?php elseif ($single['tr']['pay_mode'] == 'refund'): ?>
                                                <ul><li>Pay Mode : <?php echo $single['tr']['pay_mode']; ?></li>
                                                    <ul> <li>Amount : <?php echo $single['tr']['paid_amount']; ?></li>
                                                        <li>Refund Date : <?php echo $single['tr']['created']; ?></li>
                                                    </ul>
                                                </ul>

                                            <?php else: ?>
                                                <li>Pay Mode : <?php echo $single['tr']['pay_mode']; ?></li> 
                                                <?php if (!empty($single['tr']['check_image'])): ?>
                                                    <img src="<?php echo $this->webroot . 'check_images' . '/' . $single['tr']['check_image']; ?>"  width="50px" height="50px" />
                                                <?php endif; ?>
                                            <?php endif; ?> 
                                        <?php } ?>
                                        Payment Date: <?php echo $single['tr']['created']; ?>
                                        </td>
                                        <td><?php echo $amount; ?></td>



                                        <td><?php echo $balance[$i]; ?></td>


                                        </tr>
                                        <?php
                                    endforeach;
                                    $due = end($balance);
                                    echo '<span class="due-amount-2 hide">' . $due . '</span>';
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php
                        }
                        else {
                            ?>
                            <h2> No transaction found for this customer!</h2>
                        <?php }
                        ?>

                    </div>
                </div>
                <div>
                    <!-------------payment history end----------------->


                    <!-------------ticket history start----------------->

                    <div class="portlet box" style="background-color:  steelblue; border: steelblue solid 2px;">
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
                                                                &nbsp;
                                                                <a 
                                                                    href="#" title="Comment">
                                                                    <span id="<?php echo $ticket['id']; ?>" class="fa fa-comment fa-lg comment_ticket"></span>
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
                                                                    <?php
                                                                    echo $this->Form->input('package_customer_id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $lasthistory['package_customer_id'],
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
                                                                                        'class' => 'form-control select2me  pclass',
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
                                                                                        'class' => 'form-control ',
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
                                                                    echo $this->Form->input('id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $single['history'][0]['tr']['id'],
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
                                                                    <?php
                                                                    echo $this->Form->input('package_customer_id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $lasthistory['package_customer_id'],
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
                                                                                        'class' => 'form-control  txtArea',
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
                                                                    <?php
                                                                    echo $this->Form->input('package_customer_id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $lasthistory['package_customer_id'],
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
                                                                                        'class' => 'form-control  txtArea',
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


                                                                <div id="comment_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">

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
                                                                        'url' => array('controller' => 'tickets', 'action' => 'ticket_comment')
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
                                                                    <?php
                                                                    echo $this->Form->input('package_customer_id', array(
                                                                        'type' => 'hidden',
                                                                        'value' => $lasthistory['package_customer_id'],
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
                                                                                        'class' => 'form-control  txtArea',
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
                                                                                        'Comments', array('class' => 'btn green ', 'type' => 'submit')
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
                    <!--                    <div class="row">
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
                        'enctype' => 'multipart/form-data                                                                                                                                                                                              '
                            )
                    );
                    ?>
                                                        <ul class="">
                                                        </ul>
                                                         BEGIN SIDEBAR & CONTENT 
                                                    </div>
                                                </div>
                                            </div>
                                        </div>-->
                    <!-- END PAGE CONTENT -->
                </div>
            </div>
            <!-- END CONTENT -->        
        </div>
        <div class="col-md-offset-6 col-md-4">
            <?php
            echo $this->Form->create('PackageCustomer', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false
                ),
                'id' => 'form_sample_3',
                'class' => 'form-horizontal',
                'novalidate' => 'novalidate',
                'url' => array('controller' => 'customers', 'action' => 'delete')
                    )
            );
            ?>
            <button class="btn red-sunglo" onclick="if (confirm('Are you sure to Delete this Customer?')) {
                        return true;
                    }
                    return false;" type="submit" style="background-color: red;">Delete customer</button>     
            <?php echo $this->Form->end(); ?>
        </div>
    </div>