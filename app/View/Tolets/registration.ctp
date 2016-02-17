<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

    .login .content .register-form {
       display: block !important;
    }

</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="content" >
   <!-- BEGIN REGISTRATION FORM -->

            <?php
            echo $this->Form->create('ToletCustomer', array(
                'inputDefaults' => array(
                    'label' => false,
                    'div' => false,
                    'id' => false
                ),
                'class' => 'register-form',
                'url' => array('controller' => 'tolets', 'action' => 'registration')
                    )
            );
            ?>


            <h3>Sign Up</h3>
               <?php echo $this->Session->flash();  ?>
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
                    
                </label>
                <div id="register_tnc_error">
                </div>
            </div>
            <div class="form-actions">

        
            <i class="m-icon-swapleft"></i><a href="<?php echo Router::url(array('controller' => 'tolets', 'action' => 'login')) ?>" > Login</a>         <!-- <button type="submit" id="register-submit-btn" class="btn blue pull-right">
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