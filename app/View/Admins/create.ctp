<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading center">

            <h3>Create Admin</h3>                    

            

            

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">
            
            <div class="span2">
                
            </div>

            <div class="span8">
                

                <div class="box">

                    <div class="title">

                        <h4>
                            <span>Create new Admin</span>
                        </h4>

                        <?php echo $this->Session->flash(); ?>
                        <?php
                        if (isset($errors)):
                            echo $errors;
                        endif;
                        ?>   
                    </div>
                    <div class="content">
                        <?php
                        echo $this->Form->create('Admin', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate'
                                )
                        );
                        ?>

                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="required">Name</label>

                                    <?php
                                    echo $this->Form->input(
                                            'name', array(
                                        'class' => 'span9 text required'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="required">Email</label>
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                    
                                        'class' => 'span9 text required'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div> 



                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="password">Password</label>
                                    <?php
                                    echo $this->Form->input(
                                            'password', array(
                                        'class' => 'span9 password required',
                                        'type' => 'password'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                
                   
                       
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="required">Role</label>
                                    <div class="span9 controls sel">
                                        <?php
                                        echo $this->Form->input('role_id', array(
                                            'type' => 'select',
                                            'id' => 'select1',
                                            'options' => $roles,
                                            'empty' => 'Select Role',
                                            
                                            'class' => 'span12 uniform required nostyle',
                                            'div' => array('class' => 'span12 required')
                                                )
                                        );
                                        ?>
                                    </div> 
                                </div>
                            </div> 
                        </div>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="form-actions">
                                        <div class="span3"></div>
                                        <div class="span9 controls">
                                            <?php
                                            echo $this->Form->button(
                                                    'Create', array('class' => 'btn marginR10', 'type' => 'submit')
                                            );
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <?php echo $this->Form->end(); ?>

                    </div>

                </div><!-- End .box -->

            </div><!-- End .span12 -->
            
           <div class="span2">
                
            </div> 

        </div><!-- End .row-fluid -->  
    </div>
</div>