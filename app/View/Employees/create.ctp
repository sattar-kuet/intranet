<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading center">

            <h3>Employee Creation</h3>                    

            

            

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
        
       
        

        <div class="row-fluid">
            
            <div class="span2">
                
            </div>

            <div class="span8">

                <div class="box">

                    <div class="title">

                        <h4>
                            <span>Personal Information</span>
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
                        echo $this->Form->create('Employee', array(
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

                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="required">Full Name</label>

                                    <?php
                                    echo $this->Form->input(
                                            'full_name', array(
                                        'class' => 'span8 text required',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="required">Email</label>
                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'class' => 'span8 text required'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div> 
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="password">Password</label>
                                    <?php
                                    echo $this->Form->input(
                                            'password', array(
                                        'class' => 'span8 password required',
                                        'type' => 'password',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="required">Contact No</label>
                                    <?php
                                    echo $this->Form->input(
                                            'cell', array(
                                        'class' => 'span8 text required'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="required">National Id</label>
                                    <?php
                                    echo $this->Form->input(
                                            'nid', array(
                                        'class' => 'span8 text required'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div> 
                        
                        &nbsp;
                        &nbsp;
                        <div class="title">

                            <h4> 
                                <span>Office Information</span>
                            </h4>
                                    
                        </div>
                        
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="normal">Department</label>
                                    <?php
                                    echo $this->Form->input('department_id', array(
                                        'type' => 'select',
                                        'options' => $departments,
                                        'class' => 'span6 uniform',
                                        'div' => array('class' => 'span8')
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="required">Designation</label>
                                    <?php
                                    echo $this->Form->input(
                                            'designation', array(
                                        'class' => 'span8 text required'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        &nbsp;
                        
                        <div class="title">

                            <h4> 
                                <span>Bank Information</span>
                            </h4>
                                    
                        </div>
                        
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="required">Bank</label>
                                    <?php
                                    echo $this->Form->input(
                                            'bank_name', array(
                                        'class' => 'span8 text required'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        
                        &nbsp;
                        <div class="title">

                            <h4> 
                                <span>Attachment</span>
                            </h4>
                                    
                        </div>
                        
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="textarea">Picture</label>
                                    <?php
                                    echo $this->Form->input(
                                            'doc1', array(
                                        'type' => 'file',
                                        'id' => 'required',
                                        'class' => 'span8 text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>  
                        </div>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span4" for="textarea">Signature</label>
                                    <?php
                                    echo $this->Form->input(
                                            'doc2', array(
                                        'type' => 'file',
                                        'id' => 'required',
                                        'class' => 'span8 text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>  
                        </div>
                       <!--  <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="textarea">Picture</label>
                                    <?php
                                    echo $this->Form->input(
                                            'doc3', array(
                                        'type' => 'file',
                                        'id' => 'required',
                                        'class' => 'span8 text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>  
                        </div> -->

                       

                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="form-actions">
                                        <div class="span3"></div>
                                        <div class="span9 controls">
                                            <?php
                                            echo $this->Form->button(
                                                    'Create', array('class' => 'btn btn-info', 'type' => 'submit')
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