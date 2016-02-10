<div class="container-fluid">
    <div class="loginContainer" style="left: 47%; width: 400px; margin-top: -250px;">
        <?php echo $this->Session->flash(); ?>
        <?php
        echo $this->Form->create('Employee', array(
            'inputDefaults' => array(
                'label' => false,
                'div' => false
            ),
            'class' => 'form-horizontal',
            'role' => 'form',
            'id' => 'loginForm',
            'url' => array('controller' => 'employees', 'action' => 'inout'),
        ));
        ?>
        <div class="form-row row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <label class="form-label span12" for="username">
                        Email:
                        <span class="icon16 icomoon-icon-user-3 right gray marginR10"></span>
                    </label>
                    <?php
                    echo $this->Form->input('email', array(
                        'class' => 'span12',
                        'id' => 'username',
                        'type' => 'text',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-row row-fluid">
            <div class="span12">
                <div class="row-fluid">
                    <label class="form-label span12" for="password">
                        Password:
                        <span class="icon16 icomoon-icon-locked right gray marginR10"></span>
                        <span class="forgot"><a href="#">Forgot your password?</a></span>
                    </label>
                    <?php
                    echo $this->Form->input('password', array(
                        'class' => 'span12',
                        'id' => 'password',
                        'type' => 'password',
                    ));
                    ?>
                </div>
            </div>
        </div>
        <div class="form-row row-fluid">                       
            <div class="span12">
                <div class="row-fluid">
                    <div class="form-actions">
                        <div class="span4 controls">
                            <!-- <input type="hidden" name="HDN_FormClicked" value="<?= $clicked ?>" /> -->
                            <?php echo $this->Form->button('yyy', array('class' => 'in_pic', 'name' => 'in_button', 'title' => 'Enter into Office')); ?>
                        </div>
                        <div class="span4 controls">
                            <?php
                            echo $this->Html->image('girl.png', array('alt' => 'CakePHP'));
                            ?>
                        </div>
                        <div class="span4 controls">
                            <?php echo $this->Form->button('yyy', array('class' => 'out_pic', 'name' => 'out_button', 'title' => 'Exit from Office', 'type' => 'submit')); ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="form-row row-fluid">                       
            <div class="span12">
                <div class="row-fluid">
                    <div class="form-actions" style="border-top: 0px;">
                        <div class="span12 controls">
                            <div class="checker" id="uniform-keepLoged"><span class=""><input type="checkbox" id="keepLoged" value="Value" class="styled" name="logged" style="opacity: 0;"></span></div> Keep me logged in
                            <!--<button type="submit" class="btn btn-info right" id="loginBtn"><span class="icon16 icomoon-icon-enter white"></span> Login</button>-->
                            <?php echo $this->Form->button('Login', array('class' => 'btn btn-info right', 'name' => 'login', 'type' => 'Login')); ?>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
        <div class="form-row row-fluid">                       
            <div class="span12">
                <div class="row-fluid">

                    <div class="col-md-12 center">
                        <h3><?php echo __('No Account?'); ?></h3>
                        <p>
                            <?php
                            echo $this->Html->link(__('Create one'), array('controller' => 'employees', 'action' => 'create'), array(
                                'class' => 'btn btn-success',
                                'role' => 'button'
                            ));
                            ?>
                        </p>
                    </div>
                </div>
            </div> 
        </div>
        <?php echo $this->Form->end(); ?>
    </div>
</div><!-- End .container-fluid -->
