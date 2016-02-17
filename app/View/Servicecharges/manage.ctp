<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->

                <div class="heading">

                    <h3>All Service charges</h3>                    
                   

                    <div class="resBtnSearch">
                        <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
                    </div>
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
                        <li class="active">All Service charges</li>
                    </ul>

                </div><!-- End .heading-->
                    
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                    <div class="row-fluid">

                        <div class="span12">

                            <div class="box gradient">

                                <div class="title">
                                    <h4>
                                        <span>All service charges</span>
                                    </h4>
                                </div>
                                 <?php echo $this->Session->flash(); ?>
                                <div class="content noPad clearfix">
                                    <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Quantity</th>
                                                <th>Discount</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                          
                                            foreach ($sc as $single):
                                                $serviceCharge = $single['ServiceCharge'];
                                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $serviceCharge ['pieces']; ?></td>
                                                <td><?php echo $serviceCharge ['discount'].'%'; ?></td>                                                                                         
                                                <td>   
                                                    <div class="controls center">
                                                        <a aria-describedby="qtip-7" data-hasqtip="true" title="" oldtitle="Edit task" target="_blank" href="<?php echo Router::url(array('controller'=>'Servicecharges','action'=>'edit',$serviceCharge ['id']))?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>

                                                    </div>
                                                </td>
                                            </tr>

                                            <?php
                                            endforeach;
                                            ?>
                                           <tr class="odd gradeX">
                                                <td><?php echo $zsc['ZeroServiceCharge']['pieces']; ?></td>
                                                <td>100%</td>                                                                                         
                                                <td>   
                                                    <div class="controls center">
                                                        <a aria-describedby="qtip-7" data-hasqtip="true" title="" oldtitle="Edit task" target="_blank" href="<?php echo Router::url(array('controller'=>'Servicecharges','action'=>'zedit',$zsc['ZeroServiceCharge']['id']))?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>

                                                    </div>
                                                </td>
                                            </tr>
                                            
                                        </tbody>
                                      
                                    </table>
                                </div>

                            </div><!-- End .box -->

                        </div><!-- End .span12 -->

                    </div><!-- End .row-fluid -->
               
                <!-- Page end here -->               
            </div><!-- End contentwrapper -->
        </div><!-- End #content -->