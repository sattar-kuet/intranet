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
                                                <th>Category</th>
                                                <th>Product Name</th>
                                                <th>Total Import</th>
                                                <th>Cost</th>
                                                <th>Due</th>
                                                <th>Stock</th>
                                                <th>Sold</th>
                                                <th>Profit</th>
                                                <th>Service charge</th>
                                                <th>SPPP</th>
                                                <th>BPPP</th>
                                                
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                            foreach ($filteredArray as $single):
                                                $stock= $single['Import']['amount']-$single[0]['total_sell'];
                                                $discount=$single['psettings']['sppp']*$single['psettings']['discount']/100;  
                                    $total=$single['psettings']['sppp']-$discount+$single['psettings']['service_charge'];
                                    $outcome=ceil($total)*$single[0]['total_sell'];
                                    $profit = $outcome - $single['Import']['cost'];

                                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $single['Category']['name']; ?></td>
                                                <td><?php echo $single['Product']['name']; ?></td>
                                                <td><?php echo $single['Import']['amount']; ?></td>
                                                <td><?php echo $single['Import']['cost']; ?></td>
                                                <td><?php echo $single['Import']['cost']-$single['Import']['paid']; ?></td>
                                                <td><?php echo $stock.'('.$stock*$total.'TK)'; ?></td>
                                                  <td><?php echo $single[0]['total_sell'].'('.$outcome.'TK)'; ?></td>
                                            
                                            <td><?php echo $profit; ?></td>
                                             <td><?php echo $single['psettings']['service_charge']; ?></td>
                                              <td><?php echo $single['psettings']['sppp']; ?></td>
                                               <td><?php echo $single['psettings']['bppp']; ?></td>
                                            
                                                
                                                
                                 
                                                                                
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