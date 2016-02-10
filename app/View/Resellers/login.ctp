<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .alert.alert-error {
        background: #A9B0B5;
        color: #EF5858;
        font-weight: normal;
    }

</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="content">

            <!-- BEGIN LOGIN FORM -->

            <?php
            echo $this->Form->create('Reseller', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false,
                    'id' => false
                ),
                'class' => 'login-form',
                'url' => array('controller' => 'resellers', 'action' => 'login')
                    )
            );
            ?>


            <?php echo $this->Session->flash(); ?>

            <h3 class="form-title">Login to your account</h3>
            <div class="alert alert-danger display-hide">
                <button class="close" data-close="alert"></button>
                <span>
                    Enter Email and password. </span>
            </div>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-user"></i>

                    <?php
                    echo $this->Form->input(
                            'email', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'text',
                        'autocomplete' => 'off',
                        'placeholder' => 'Email'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>

                    <?php
                    echo $this->Form->input(
                            'password', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'password',
                        'autocomplete' => 'off',
                        'placeholder' => 'Password'
                            )
                    );
                    ?>
                </div>
            </div>

            <div class="form-actions">
                <?php
                echo $this->Form->button(
                        'Login <i class="m-icon-swapright m-icon-white"></i>', array(
                    'class' => 'btn blue pull-right',
                    'type' => 'submit',
                    'escape' => false
                        )
                );
                ?> 

            </div>


            <div class="forget-password">
                <h4>Forgot your password ?</h4>
                <p>
                    no worries, click <a href="javascript:;" id="forget-password">
                        here </a>
                    to reset your password.
                </p>
            </div>
            <div class="create-account">
                <p>
                    Don&#39;t have an account yet ?&nbsp; <a style=" text-transform: none; font-size: 12px !important;" class="btn btn-circle blue" href="javascript:;" id="register-btn">
                        Create an account </a>
                </p>
            </div>
            <?php echo $this->Form->end(); ?>
            <!-- END LOGIN FORM -->

            <!-- BEGIN FORGOT PASSWORD FORM -->
            <?php
            echo $this->Form->create('Reseller', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false,
                    'id' => false
                ),
                'class' => 'forget-form',
                'url' => array('controller' => 'resellers', 'action' => 'passwordRecoveryRequest')
                    )
            );
            ?>
            <h3 id="pwrSection">Forget Password ?</h3>
            <p>
                Enter your e-mail address below to reset your password.
            </p>
            <div class="form-group">
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>
                    <?php
                    echo $this->Form->input(
                            'email', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'text',
                        'autocomplete' => 'off',
                        'placeholder' => 'Email'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-actions">
                <button type="button" id="back-btn" class="btn">
                    <i class="m-icon-swapleft"></i> Back </button>
                <?php
                echo $this->Form->button(
                        'Submit <i class="m-icon-swapright m-icon-white"></i>', array(
                    'class' => 'btn blue pull-right',
                    'type' => 'submit',
                    'escape' => false
                        )
                );
                ?> 
            </div>
            <?php echo $this->Form->end(); ?>
            <!-- END FORGOT PASSWORD FORM -->
            <!-- BEGIN REGISTRATION FORM -->

            <?php
            echo $this->Form->create('Reseller', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false,
                    'id' => false
                ),
                'class' => 'register-form',
                'type' => 'file',
                'url' => array('controller' => 'resellers', 'action' => 'registration')
                    )
            );
            ?>


            <h3>Sign Up</h3>
            <p>
                Enter your personal details below:
            </p>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Full Name</label>
                <div class="input-icon">
                    <i class="fa fa-font"></i>
                    <?php
                    echo $this->Form->input(
                            'name', array(
                        'class' => 'form-control placeholder-no-fix required',
                        'type' => 'text',
                        'placeholder' => 'Full Name'
                            )
                    );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Institute Name</label>
                <div class="input-icon">
                    <i class="fa fa-font"></i>
                    <?php
                    echo $this->Form->input(
                            'institute', array(
                        'class' => 'form-control placeholder-no-fix required',
                        'type' => 'text',
                        'placeholder' => 'Type your most recent institute name'
                            )
                    );
                    ?>
                </div>
            </div>

            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Phone</label>
                <div class="input-icon">
                    <i class="fa fa-phone"></i>

                    <?php
                    echo $this->Form->input(
                            'mobile', array(
                        'class' => 'form-control placeholder-no-fix required',
                        'type' => 'text',
                        'placeholder' => 'Phone Number'
                            )
                    );
                    ?>
                </div>
            </div>


            <div id="prev_image1" >
            </div>


            <div class="form-group img-upload">
                <label class="control-label  btn btn-circle purple feedbackImg" style="text-align:center; text-transform:none;">
                    Upload Your photo &nbsp;&nbsp;<i class="fa fa-user"></i>
                    <?php
                    echo $this->Form->input(
                            'img', array(
                        'class' => 'form-control required hide single_img_btn',
                        'type' => 'file',
                        'id' => 1
                            )
                    );
                    ?>
                </label>

            </div>


            <p>
                Enter your account details below:
            </p>
            <div class="form-group">
                <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
                <label class="control-label visible-ie8 visible-ie9">Email</label>
                <div class="input-icon">
                    <i class="fa fa-envelope"></i>

                    <?php
                    echo $this->Form->input(
                            'email', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'text',
                        'placeholder' => 'Email'
                            )
                    );
                    ?>
                </div>
            </div>


            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Password</label>
                <div class="input-icon">
                    <i class="fa fa-lock"></i>
                    <?php
                    echo $this->Form->input(
                            'password', array(
                        'class' => 'form-control placeholder-no-fix',
                        'type' => 'password',
                        'autocomplete' => 'off',
                        'id' => 'register_password',
                        'placeholder' => 'Password'
                            )
                    );
                    ?>
                </div>
            </div>
            <div class="form-group">
                <label class="control-label visible-ie8 visible-ie9">Re-type Your Password</label>
                <div class="controls">
                    <div class="input-icon">
                        <i class="fa fa-check"></i>
                        <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Re-type Your Password" name="rpassword"/>

                    </div>
                </div>
            </div>


            <div class="form-group">
                <label>
                    <input type="checkbox" name="tnc"/> I agree to the  <a href="#terms-pop-up" class="fancybox-fast-view">Terms of Service</a>
                    and <a href="#privacy-pop-up" class="fancybox-fast-view">Privacy Policy</a> 
                </label>
                <div id="register_tnc_error">
                </div>
            </div>
            <div class="form-actions">
                <button id="register-back-btn" type="button" class="btn">
                    <i class="m-icon-swapleft"></i> Back </button>
                <!-- <button type="submit" id="register-submit-btn" class="btn blue pull-right">
                Sign Up <i class="m-icon-swapright m-icon-white"></i>
                </button> -->
                <?php
                echo $this->Form->button(
                        'Sign Up <i class="m-icon-swapright m-icon-white"></i>', array(
                    'class' => 'btn blue pull-right',
                    'type' => 'submit',
                    'id' => 'register-submit-btn',
                    'escape' => false
                        )
                );
                ?> 
            </div>
            <?php echo $this->Form->end(); ?>
            <!-- END REGISTRATION FORM -->

        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

<!-- terms pop-up -->
<div id="terms-pop-up" style="display: none; width: 100%;">

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-pencil"></i> Terms of Services
            </div>
        </div>
        <div class="portlet-body">
            <ul style="list-style-type:square;">
                <li>Any one can promote our service & he/she will be honored for the contribution</li>
                <li>Registration is FREE & it always be</li>
                <li>You have to receive your money via Bkash number. You can receive money within 2 hours. </li>
                <li>There is a penalty point for fake order. If order is returned after delivered then it will be treated as fake order</li> 
                <li>Point setting of products can be varied time to time</li> 
            </ul>
        </div>
    </div>
</div>
<!-- END terms pop-up -->

<!-- privacy pop-up -->
<div id="privacy-pop-up" style="display: none; width: 100%;">

    <div class="portlet box blue">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-pencil"></i> Privacy Policy 
            </div>
        </div>
        <div class="portlet-body">
            <p> There is nothing to hide. You can monitor your effort like real time.Everything you can see by login into your account. We are honest & respect your honesty in the same way. If anyone try to miss use our site, we will take action against him/her.</p>
        </div>
    </div>
</div>
<!-- END privacy pop-up -->