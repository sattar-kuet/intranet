<div id="content" class="clearfix">
  <div class="contentwrapper"><!--Content wrapper-->

    <div class="heading">

      <h3>All Agents</h3>                    


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
        <li class="active">All Agents</li>
      </ul>

    </div><!-- End .heading-->

    <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

    <div class="row-fluid">

      <div class="span12">

        <div class="box gradient">

          <div class="title">
            <h4>
              <span>All Orders which are not contacted</span>
            </h4>
          </div>
          <?php echo $this->Session->flash(); ?>
          <div class="content noPad clearfix">
            <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
              <thead>
                <tr>
                  <th>Product Info</th>
                  <th>Name</th>
                  <th>Email</th>
                  <th>Mobile</th>
                  <th>Alt Mobile</th>
                  <th>City</th>
                  <th>Location</th> 
                  <th>How many </th>             
                  <th>Time passed</th>
                  <th>Action </th>
                </tr>
              </thead>
              <tbody>
                <?php

                foreach ($allNoContacts as $k=>$single):
                  $order = $single['Order'];

                ?>
                <tr class="odd gradeX">
                  <td>   
                   <button class="product_toggle" id="p<?php echo$k+1;?>"><span class="icon16 icomoon-icon-eye-3"></span></button>   
                  <div class="content hide" id="info-p<?php echo$k+1;?>" style="display: block;">
                   
                        <div class="alert alert-success book-info-wrapper">
                          <div class="book-info">
                            <span class="book-name"><?php echo $single['products']['name'];?> </span> <br/>
                            -By <span class="writer-name"><?php echo $single['products']['writer'];?> </span>
                          </div>
                          <p><span class="label label-warning">Price</span><span class="label label-inverse"><?php echo $single['psettings']['sppp'];?>TK</span><p/>
                            <p><span class="label label-warning">Discount</span> <span class="label label-inverse"><?php echo $single['psettings']['discount'];?>%</span><p/>
                             <p> <span class="label label-warning">Service Charge</span> <span class="label label-inverse"><?php echo $single['psettings']['service_charge'];?> TK</span><p/>
                              <p><span class="label label-warning">Total</span><span class="label label-inverse"><?php 
                                $discount=$single['psettings']['sppp']*$single['psettings']['discount']/100;  
                                $total=$single['psettings']['sppp']-$discount+$single['psettings']['service_charge'];
                                echo  ceil($total);?> TK</span>
                              </p>
                            </div>  
                        </div><!-- End .box --> 
                      </td>
                        <td><?php echo $order['name']; ?></td>
                        <td><?php echo $order['email']; ?></td>
                        <td><?php echo $order['mobile']; ?></td>
                        <td><?php echo $order['alt_mobile']; ?></td>
                        <td><?php echo $single['City']['name']; ?></td>
                        <td><?php echo $single['Location']['name']; ?></td>
                        <td><?php echo $order['pieces']; ?></td>
                        <td>
                         <button class="btn btn-inverse" href="#"><?php echo passedTime($order['created']); ?></button>
                       </td>


                       <td>   
                        <div class="controls center">


                          <a aria-describedby="qtip-7" data-hasqtip="true" title="" oldtitle="Edit task"
                          onclick="if (confirm(&quot;Are you sure to cancel this order?&quot;)) { return true; } return false;"

                          href="<?php echo Router::url(array('controller'=>'orders','action'=>'cancel',$order['id'])
                          )?>" class="tip"><span class="icon12 iconic-icon-move-horizontal-alt2" title="cancel"></span></a>

                          <a aria-describedby="qtip-8" data-hasqtip="true" oldtitle="Remove task" 
                          href="#myModal" data-toggle="modal"  name='id' data-id="<?php echo $order['id']; ?>"
                          class="tip"><span class="icon12 icomoon-icon-checkmark" title="confirm"></span></a>

                        </div>
                      </td>                                          
                    </tr>

                    <?php
                    endforeach;
                    ?>


                  </tbody>

                </table>
              </div>

            </div><!-- End .box -->

          </div><!-- End .span12 -->

        </div><!-- End .row-fluid -->

        <!-- Page end here -->    
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
                      <span>Set the delivary time and Hit Confirm button</span>
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
                    'novalidate'=>'novalidate',
                    'action' => 'confirm'
                    )
                    ); ?>

                    <div class="form-row row-fluid">
                     <?php echo $this->Form->input('id', array('type'=>'text','id'=>'ID'));  ?>
                     <div class="span12">
                      <div class="row-fluid">
                        <label class="form-label span4" for="checkboxes">Set Delivary Time</label>
                        <div class="span8">                                      
                          <?php echo $this->Form->input(
                            'comment',
                            array(
                              'class' => 'span9 text required',
                              'id' => 'combined-picker',
                              'value' => ''


                              )

                            ); 
                            ?>
                          </div>
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