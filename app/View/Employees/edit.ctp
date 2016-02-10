<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Update Your Information </h3>                    

           

            

            

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span12">

                <div class="box">

                    <div class="title">

                        <h4>
                            <span>Update the followings</span>
                        </h4>
                            
                        <?php echo $this->Session->flash(); ?>
                            
                    </div>
                    <div class="content">
                           <?php echo $this->Form->create('Employee', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div'   => false                                  
                                ),
                            'id'=> 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate'=>'novalidate'
                            )
                            ); ?>

                            <div class="form-row row-fluid">
                                <div class="span12">
                                    <div class="row-fluid">
                                        <label class="form-label span3" for="required">Full Name</label>

                                        <?php echo $this->Form->input(
                                            'full_name',
                                            array(
                                                'id'=>'required',
                                                'class' => 'span9 required text'
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
                                            <?php echo $this->Form->input(
                                                'email',
                                                array(
                                                    'id'=>'required',
                                                    'class' => 'span9 text'
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
                                                <?php echo $this->Form->input(
                                                    'password',
                                                    array(
                                                        'id'=>'required',
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
                                                    <label class="form-label span3" for="normal">Mobile No</label>
                                                    <?php echo $this->Form->input(
                                                        'cell',
                                                        array(
                                                            'id'=>'required',
                                                            'class' => 'span9 text'
                                                            )

                                                        ); 
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-row row-fluid">
                                                <div class="span12">
                                                    <div class="row-fluid">
                                                        <label class="form-label span3" for="normal">National Id</label>
                                                        <?php echo $this->Form->input(
                                                            'nid',
                                                            array(
                                                                'id'=>'required',
                                                                'class' => 'span9 text'
                                                                )

                                                            ); 
                                                            ?>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-row row-fluid">
                                                    <div class="span12">
                                                        <div class="row-fluid">
                                                            <label class="form-label span3" for="required">Designation</label>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'designation', array(
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
                                                            <label class="form-label span3" for="required">Bank</label>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'bank_name', array(
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
                                                            <label class="form-label span3" for="textarea">Picture</label>
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'doc1', array(
                                                                'type' => 'file',
                                                                'id' => 'required',
                                                                'class' => 'span9 text'
                                                                    )
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>  
                                                </div>
                                                 <div class="form-row row-fluid">
                                                    <div class="span9" style="float: right;">
                                                        
                                                    <?php
                                                     $i=0;

                                                           foreach ($employee as $single):
                                                          //  $newses = $single['News'];
                                                          //  $newses = $single['News'];
                                                           // echo $single['image_url'];
                                                        ?>
                                                        <img src="<?php echo $this->webroot . 'eImages' . '/' . $single['doc1']; ?>"  width="150px" height="150px" />
                                                        <?php
                                                        $i++;
                                                        if($i==1) break;
                                                            endforeach;
                                                            ?> 
                                                            
                                                    </div> 
                                                    
                                                </div>
                                                    <?php echo $this->Form->input('id'); ?>
                                                    <div class="form-row row-fluid">
                                                        <div class="span12">
                                                            <div class="row-fluid">
                                                                <div class="form-actions">
                                                                    <div class="span3"></div>
                                                                    <div class="span9 controls">
                                                                     <?php 
                                                                     echo $this->Form->button(
                                                                        'Update', 
                                                                        array('class' => 'btn marginR10', 'type' => 'submit')
                                                                        ); ?>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div> 
                                                    </div>
                                                    <?php echo $this->Form->end(); ?>

                                                </div>

                                            </div><!-- End .box -->

                                        </div><!-- End .span12 -->



                                    </div><!-- End .row-fluid -->  