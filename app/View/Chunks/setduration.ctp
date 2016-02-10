<style>
    .ui-datepicker .ui-datepicker-buttonpane button.ui-datepicker-current {
        float: left;
        display: none;
    }
</style>

<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->
        <div class="heading">
            <h3>Set duration to a program</h3>                    
            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>

            <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                    <a href="#" class="tip" oldtitle="back to dashboard" title="" data-hasqtip="true">
                        <span class="icon16 icomoon-icon-screen-2"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 icomoon-icon-arrow-right-2"></span>
                    </span>
                </li>
                <li class="active">Fill up </li>
            </ul>
        </div><!-- End .heading-->
        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->
        <div class="row-fluid">
            <div class="span12">
                <div class="box">
                    <div class="title">

                        <h4>
                            <span>Set duration to a program</span>
                        </h4>

                        <?php
                        echo $this->Session->flash();
                        echo $this->Session->flash('auth');
                        ?>
                        <?php
                        if (isset($errors)):
                            echo $errors;
                        endif;
                        ?>   
                    </div>
                    <div class="content">
                        <?php
                        echo $this->Form->create('Chunk', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
//                            'url' => array(
//                                'controller' => 'chunks',
//                                'action' => 'setduration'
//                               )
                                )
                        );
                        ?>

                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="checkboxes">Select Program Name</label>
                                    <div class="span9 controls sel">
                                        <?php
                                        echo $this->Form->input('id', array(
                                            'type' => 'select',
                                            'id' => 'select1',
                                            'options' => $chunks,
                                            'empty' => 'select program',
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
                                    <label class="form-label span3" for="required">Duration</label>

                                    <?php
                                    echo $this->Form->input(
                                            'duration', array(
                                        'id' => 'required',
                                        'class' => 'span9 text combined-picker'
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
                                                    'Set Duration', array('class' => 'btn marginR10', 'type' => 'submit')
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

