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
        <div class="portlet box  " style="background-color: green; border: green solid 2px;">
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
                <div class="row " id="paymentprocess">
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
                                                //   pr($latestcardInfo);
                                                //   exit;

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
                                                <?php
                                                echo $this->Form->input(
                                                        'pay_mode', array(
                                                    'type' => 'hidden',
                                                    'value' => 'card'
                                                ));
                                                ?>
                                                <br>

                                                <div class="row">
                                                    <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                        Card Number: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'card_no', array(
                                                            'type' => 'text',
                                                            'value' => '',
                                                            'class' => 'form-control input-sm ',
                                                            'id' => 'card_number',
                                                            'value' => $latestcardInfo['card_no']
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>

                                                &nbsp;                                                        

                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Expiration Date:
                                                    </div>
                                                    <div class="col-md-4">
                                                        <?php
                                                        echo $this->Form->input('exp_date.year', array(
                                                            'type' => 'select',
                                                            'options' => $ym['year'],
                                                            'empty' => 'Select Year',
                                                            'class' => 'span12 uniform nostyle select1 ',
                                                            'div' => array('class' => 'span12 '),
                                                            'id' => 'showyear',
                                                            'default' => $latestcardInfo['exp_date']['year']
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
                                                            'class' => 'span12 uniform nostyle select1 ',
                                                            'div' => array('class' => 'span12 '),
                                                            'id' => 'showmonth',
                                                            'default' => $latestcardInfo['exp_date']['month']
                                                                )
                                                        );
                                                        ?>
                                                    </div>
                                                </div>
                                                &nbsp;
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Amount: 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'paid_amount', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm '
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <hr style="background-color:black;">
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Invoice#
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'invoice', array(
                                                            'type' => 'text',
                                                            'value' => '',
                                                            'class' => 'form-control input-sm',
                                                            'class' => 'form-control input-sm '
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                <br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Description
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'description', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['description']
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>


                                                <hr style="color: #333;">



                                                <div class="row">
                                                    <div class="col-md-3 signupfont">
                                                        Customer ID 
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'package_customer_id', array(
                                                            'type' => 'text',
                                                            'value' => $this->params['pass'][0],
                                                            'class' => 'form-control input-sm '
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
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
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'first name',
                                                            'id' => 'firstname',
                                                            'value' => $latestcardInfo['fname']
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'lname', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'placeholder' => 'last name',
                                                            'id' => 'lastname',
                                                            'value' => $latestcardInfo['lname']
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>

                                                </br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                        Company 
                                                    </div>
                                                    <div class="col-md-9">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'company', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'id' => 'card_number',
                                                            'value' => $latestcardInfo['company']
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                        Address
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'address', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['address']
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-1 signupfont" style="padding-right: 0px;">
                                                        City
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'city', array(
                                                            'type' => 'text',
                                                            'id' => 'cityname',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['city']
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                                </br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                        State/Province
                                                    </div>
                                                    <div class="col-md-5">

                                                        <?php
                                                        echo $this->Form->input(
                                                                'state', array(
                                                            'type' => 'text',
                                                            'id' => 'statename',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['state']
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-2 signupfont" style="padding-right: 0px;">
                                                        Zipe Code
                                                    </div>
                                                    <div class="col-md-2">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'zip_code', array(
                                                            'type' => 'text',
                                                            'id' => 'zip_code',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['zip_code']
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>

                                                </br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                        Country
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'country', array(
                                                            'type' => 'text',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['country']
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-1 signupfont" style="padding-right: 0px;">
                                                        Phone
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'phone', array(
                                                            'type' => 'text',
                                                            'id' => 'phoneno',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['phone']
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>

                                                </br>
                                                <div class="row">
                                                    <div class="col-md-3 signupfont" style="padding-right: 0px;">
                                                        Email
                                                    </div>
                                                    <div class="col-md-5">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'email', array(
                                                            'type' => 'text',
                                                            'id' => 'emailadd',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['email']
                                                        ));
                                                        ?>
                                                    </div>
                                                    <div class="col-md-1 signupfont" style="padding-right: 0px;">
                                                        Fax
                                                    </div>
                                                    <div class="col-md-3">
                                                        <?php
                                                        echo $this->Form->input(
                                                                'fax', array(
                                                            'type' => 'text',
                                                            'id' => 'faxno',
                                                            'class' => 'form-control input-sm ',
                                                            'value' => $latestcardInfo['fax']
                                                        ));
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
                                                            'class' => 'form-control input-sm ',
                                                            'id' => 'cvv_code',
                                                            'value' => $latestcardInfo['cvv_code'],
                                                        ));
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>  

                                            &nbsp;
                                            <div class="row">
                                                <div class="col-md-10 col-md-offset-3">
                                                    <input type="checkbox" id="autofillAddrCheck"  /> <span class="signupfont">SAME AS BILLING ADDRESS </span>
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
                                                <div class="col-lg-6  padding-left-0 padding-top-20 pull-left"> 

                                                    <?php
                                                    echo $this->Form->button(
                                                            'Update Card', array(
                                                        'class' => 'btn btn-primary submitbtn blue',
                                                        'type' => 'submit',
                                                        'name' => 'updateCard',
                                                        'confirm' => 'Are you sure to update the card info?'
                                                    ));
                                                    ?>

                                                </div>

                                                <div class="col-lg-6  padding-left-0 padding-top-20 pull-right"> 

                                                    <?php
                                                    echo $this->Form->button(
                                                            'Submit Payment', array(
                                                        'class' => 'btn btn-primary submitbtn blue-dark',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
                                                            'class' => 'form-control input-sm ',
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
    </div>
</div>
<!-- END CONTENT -->

