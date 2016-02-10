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
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Mobile</th>
                                    <th>Alt Mobile</th>
                                    <th>City</th>
                                    <th>Location</th>
                                    <th>How many</th>
                                    <th>Delivary Time</th>
                                    <th>Time Remaining</th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                foreach ($allConfirmed as $single):
                                    $order = $single['Order'];
                                ?>
                                <tr class="odd gradeX">
                                    <td><?php echo $order['name']; ?></td>
                                    <td><?php echo $order['email']; ?></td>
                                    <td><?php echo $order['mobile']; ?></td>
                                    <td><?php echo $order['alt_mobile']; ?></td>
                                    <td><?php echo $single['City']['name']; ?></td>
                                    <td><?php echo $single['Location']['name']; ?></td>
                                    <td><?php echo $order['pieces']; ?></td>
                                    <td><?php echo $order['comment']; ?></td>
                                    <td>
                                        <?php if (strpos(remainingTime($order['comment']),'-')!== false){
                                            ?>
                                            <button class="btn btn-danger" href="#"><?php echo remainingTime($order['comment']); ?></button>
                                            <?php } else{?>
                                            <button class="btn btn-inverse" href="#"><?php echo remainingTime($order['comment']); ?></button>
                                            <?php } ?>
                                        </td>
                                        <td>   
                                            <div class="controls center">


                                              <a aria-describedby="qtip-7" data-hasqtip="true" title="" oldtitle="Edit task"
                                              onclick="if (confirm(&quot;Are you sure to cancel this order?&quot;)) { return true; } return false;"

                                              href="<?php echo Router::url(array('controller'=>'orders','action'=>'cancel',$order['id'])
                                              )?>" class="tip"><span class="icon12 iconic-icon-move-horizontal-alt2" title="cancel"></span></a>



                                              <a aria-describedby="qtip-8" data-hasqtip="true" title="" oldtitle="Remove task" 
                                              onclick="if (confirm(&quot;Are you sure to set it as sold?&quot;)) { return true; } return false;"

                                              href="<?php echo Router::url(array('controller'=>'orders','action'=>'sell',$order['id'])
                                              )?>"
                                              class="tip"><span class="icon12   icomoon-icon-cart-checkout" title="sold"></span></a>

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
      </div><!-- End contentwrapper -->
        </div><!-- End #content -->