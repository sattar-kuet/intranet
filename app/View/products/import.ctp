<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Import Product </h3>                    

            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>

            <div class="search">

                <form id="searchform" action="search.html">
                    <input type="text" id="tipue_search_input" class="top-search text" placeholder="Search here ...">
                    <input type="submit" id="tipue_search_button" class="search-btn nostyle" value="">
                </form>
                
            </div><!-- End search -->

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
                            <span>Import product</span>
                        </h4>
                            
                        <?php echo $this->Session->flash(); ?>
                         <?php
                          if(isset($errors)):
                            echo $errors; 
                            endif;
                          ?>   
                    </div>
                    <div class="content">
                           <?php echo $this->Form->create('Import', array(
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
                                    <label class="form-label span4" for="checkboxes">Category</label>
                                    <div class="span8 controls sel">
                                        <?php
                                        echo $this->Form->input('category_id', array(
                                            'type' => 'select',
                                            'options' => $categories,
                                            'empty' => '',
                                            'class' => 'span12 uniform nostyle select1 pclass required',
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
                                    <label class="form-label span4" for="checkboxes">Product</label>
                                    <div class="span8 controls sel">
                                        <?php
                                        echo $this->Form->input('product_id', array(
                                            'type' => 'select',
                                            'options' => $product,
                                            'empty' => '',
                                            'class' => 'span12 uniform nostyle  cclass select1 required',
                                            'id' => 'cid',
                                            'style' => 'width:100%;',
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
                                        <label class="form-label span4" for="required">How many</label>

                                        <?php echo $this->Form->input(
                                            'amount',
                                            array(
                                                'id'=>'required',
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
                                        <label class="form-label span4" for="required">Cost</label>

                                        <?php echo $this->Form->input(
                                            'cost',
                                            array(
                                                'id'=>'required',
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
                                        <label class="form-label span4" for="required">Paid</label>

                                        <?php echo $this->Form->input(
                                            'paid',
                                            array(
                                                'id'=>'required',
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
                                        <label class="form-label span4" for="required">Comment</label>

                                        <?php echo $this->Form->input(
                                            'comment',
                                            array(
                                                
                                                'class' => 'span8 text',
                                                'type' => 'textarea'
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
                                                                    <div class="span4"></div>
                                                                    <div class="span8 controls">
                                                                     <?php 
                                                                     echo $this->Form->button(
                                                                        'Add', 
                                                                        array('class' => 'btn btn-primary btn-large pull-right', 'type' => 'submit')
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