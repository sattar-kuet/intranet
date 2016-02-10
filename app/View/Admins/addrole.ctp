<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Admin Creation</h3>                    
            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>

        </div><!-- End .heading-->
        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="title">

                        <h4>
                            <span>Create new Admin role</span>
                        </h4>

                        <?php
                        echo $this->Session->flash();
                        echo $this->Session->flash('auth');
                        ?>
                        
                    </div>
                    <div class="content">
                        <?php
                        echo $this->Form->create('Role', array(
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
                                    <label class="form-label span3" for="required">Role Name</label>

                                    <?php
                                    echo $this->Form->input(
                                            'name', array(
                                        'id' => 'required',
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
                                    <div class="form-actions">
                                        <div class="span3"></div>
                                        <div class="span9 controls">
                                            <?php
                                            echo $this->Form->button(
                                                    'Add', array('class' => 'btn marginR10', 'type' => 'submit')
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

        </div><!-- End .row-fluid -->
