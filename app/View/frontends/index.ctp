 <style type="text/css">
     .btn-primary{
         float: right;
     }
     .box .content {
      padding: 0px;
      border-top: 1px solid #c4c4c4;

  }
  span.label.label-warning {
      width: 84px;
  }
  .book-info-wrapper {
  padding: 8px 3px 0 3px !important;
  min-height:240px; 
}
img.img-polaroid.marginR5 {
  height: 240px;
  width: 175px;
}
</style>
<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">
        <?php   //  pr($products);
        //     exit();
?>
            <h3>UI elements</h3>                    

            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>

            <div class="search">

                <form id="searchform" action="search.html">
                    <input type="text" id="tipue_search_input" class="top-search" placeholder="Search here ..." />
                    <input type="submit" id="tipue_search_button" class="search-btn" value=""/>
                </form>
                
            </div><!-- End search -->

            <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                    <a href="#" class="tip" title="back to dashboard">
                        <span class="icon16 icomoon-icon-screen-2"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 icomoon-icon-arrow-right-2"></span>
                    </span>
                </li>
                <li class="active">UI elements</li>
            </ul>

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->



        <div class="row-fluid"> 
            <div class="span12">
                <div class="page-header">
                    <h4>Images style</h4> 
                      <?php echo $this->Session->flash(); ?>
                                          
                </div>
                <div style="margin-bottom: 27px;">                          
                 <?php  foreach($products as $count=>$product): 
                     $count++;
                     if(($count%2)!=0):
                        ?>
                    <div class="row-fluid"> 
            <div class="span12">
                     <?php 
                     endif;
                 ?>
                   
                     <div class="span6">
                    <div class="box">

                        <div class="content" style="display: block;">
                            <div class="row-fluid">
                                <div class="span6">
                                  <div class="temp-img" id="temp-p-img<?php echo $product['Product']['id']; ?>"></div>
                                    <a href="#myModal"  data-toggle="modal"> <img id="p-img<?php echo $product['Product']['id'];?>" src="<?php echo $this->webroot.'productImages/'.$product['Psetting']['img']?>" alt="<?php echo $product['Product']['name'].' By '.$product['Product']['writer'];?>" class="img-polaroid marginR5" ></a><br/>
                                     <button class="btn btn-info" href="#myModal" data-toggle="modal"><span class="icon16 icomoon-icon-eye-3"></span>Vew Details</button>

                                </div>
                                <div class="span6">  
                                    <div class="alert alert-success book-info-wrapper">
                                    <div class="book-info">
                                    <span class="book-name"><?php echo $product['Product']['name'];?> </span> <br/>
                                         -By <span class="writer-name"><?php echo $product['Product']['writer'];?> </span>
                                    </div>
                                     <p><span class="label label-warning">Price</span><span class="label label-inverse"><?php echo $product['Psetting']['sppp'];?>TK</span><p/>
                                    <p><span class="label label-warning">Discount</span> <span class="label label-inverse"><?php echo $product['Psetting']['discount'];?>%</span><p/>
                                   <p> <span class="label label-warning">Service Charge</span> <span class="label label-inverse"><?php echo $product['Psetting']['service_charge'];?> TK</span><p/>
                                    <p><span class="label label-warning">Total</span><span class="label label-inverse"><?php 
                                    $discount=$product['Psetting']['sppp']*$product['Psetting']['discount']/100;  
                                    $total=$product['Psetting']['sppp']-$discount+$product['Psetting']['service_charge'];
                                    echo  ceil($total);?> TK</span>
                                    </p>
                                    </div>
                                     <button class="btn btn-primary add-to-busket" id="img<?php echo $product['Product']['id'];?>"><span class="icon16  icomoon-icon-basket white"></span>Add to Bag</button>  
                                  
                                </div>
                            </div>

                            <div class="title">
 
                              <span>
                                <button class="btn btn-info" href="#myModal" data-toggle="modal"><span class="icon16 icomoon-icon-info-2 white"></span>Details</button>
                                <button class="btn btn-primary" href="#myModal" data-toggle="modal"  name='id' data-id="<?php echo $product['Product']['id']; ?>"
                                          class="tip"><span class="icon16 icomoon-icon-basket white"></span>Buy</button>  
                            </span> 
                        </div>
                    </div><!-- End .box -->
                </div> <!-- End .box -->
            </div><!-- End .span4 -->

            <?php       if(($count%2)==0):
                        ?>
                 </div><!-- End .span12-->
</div> <!-- End .row-fluid-->
                     <?php 
                     endif;
                 ?>
               
              <?php endforeach;?>
    </div>


<div id="myModal" class="modal hide fade" style="display: none; ">
    <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal"><span class="icon12 minia-icon-close"></span></button>
      <h3>Order Form</h3>
  </div>
  <div class="modal-body">
    <div class="paddingT15 paddingB15">    
     <div class="row-fluid">

        <div class="span12">

            <div class="box">

                <div class="title">

                    <h4>
                        <span>Fill up the following information and Hit Order button</span>
                    </h4>

                  
                    
                </div>
                <div class="content">
                 <?php echo $this->Form->create('Order', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div'   => false                                  
                                ),
                            'id'=> 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate'=>'novalidate'
                            )
                            ); ?>

                
                        <?php echo $this->Form->input('product_id', array('type'=>'text','id'=>'ID'));  ?>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="required">Name</label>

                                    <?php echo $this->Form->input(
                                        'name',
                                        array(
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
                                        <?php echo $this->Form->input(
                                            'email',
                                            array(
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
                                            <label class="form-label span3" for="mobile">Mobile</label>
                                            <?php

                                            echo $this->Form->input(
                                                'mobile',
                                                array(
                                                   'class' =>'span9 text required',
                                                  
                                                   )

                                                ); 
                                                ?>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-row row-fluid">
                                        <div class="span12">
                                            <div class="row-fluid">
                                                <label class="form-label span3" for="alt_mobile">Alternative Mobile</label>
                                                <?php


                                                echo $this->Form->input(
                                                    'alt_mobile',
                                                    array(

                                                        'class' => 'span9',
                                                        'type' => 'text'
                                                        )

                                                    ); 
                                                    ?>
                                                </div>
                                            </div>
                                        </div>
                            <div class="form-row row-fluid">
                                    <div class="span12">
                                        <div class="row-fluid">
                                            <label class="form-label span3" for="checkboxes">City</label>
                                            <div class="span9 controls sel">
                                                <?php
                                                echo $this->Form->input('city_id', array(
                                                    'type' => 'select',
                                                    'options' => $cities,
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
                                            <label class="form-label span3" for="checkboxes">Location</label>
                                            <div class="span9 controls sel">
                                             <?php
                                             echo $this->Form->input('location_id', array(
                                                'type' => 'select',  
                                                'options' => $locations,
                                                'empty' => '',
                                                'class' => 'span12 uniform nostyle  cclass select1 required',
                                                'id'=>'cid',
                                                'style' =>'width:100%;',
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
                                        <label class="form-label span3" for="required">How many?</label>

                                        <?php echo $this->Form->input(
                                            'pieces',
                                            array(
                                                'class' => 'span9 text required'
                                                )

                                            ); 
                                            ?>
                                        </div>
                                    </div>
                                </div>
                        </div>

                    </div><!-- End .box -->

                </div><!-- End .span12 -->

            </div><!-- End .row-fluid -->  
        </div>

    </div>
    <div class="modal-footer">
      <a href="#" class="btn" data-dismiss="modal">Close</a>

      <?php 
      echo $this->Form->button(
        'Order', 
        array('class' => 'btn btn-primary', 'type' => 'submit')
        ); ?>
        <?php echo $this->Form->end(); ?>
    </div>
</div>





</div><!-- End contentwrapper -->
        </div><!-- End #content -->