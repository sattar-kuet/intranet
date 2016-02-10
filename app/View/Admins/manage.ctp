<div id="content" class="clearfix">
            <div class="contentwrapper"><!--Content wrapper-->
                <div class="heading">
                    <h3>All Admins</h3>                    
                    <div class="resBtnSearch">
                        <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
                    </div>
                    

                </div><!-- End .heading-->
                    
                <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

                    <div class="row-fluid">

                        <div class="span12">

                            <div class="box gradient">

                                <div class="title">
                                    <h4>
                                        <span>All Admins list</span>
                                    </h4>
                                </div>
                                 <?php echo $this->Session->flash(); ?>
                                <div class="content noPad clearfix">
                                    <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($agents as $single):
                                                $agent = $single['Admin'];
                                                ?>
                                            <tr class="odd gradeX">
                                                <td><?php echo $agent['name']; ?></td>
                                                <td><?php echo $agent['email']; ?></td>
                                                <td><?php echo $agent['status']; ?></td>
                                                
                                                <td>   
                                                    <div class="controls center">
                                                        <a aria-describedby="qtip-7" data-hasqtip="true" title="" oldtitle="Edit task" target="_blank" href="<?php echo Router::url(array('controller'=>'admins','action'=>'edit',$agent['id']))?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>

                                                         <a aria-describedby="qtip-8" data-hasqtip="true" title="" oldtitle="Remove task"
                                                         onclick="if (confirm(&quot;Are you sure to delete this Admin?&quot;)) { return true; } return false;"
                                                          href="<?php echo Router::url(array('controller'=>'admins','action'=>'delete',$agent['id'])
                                                         )?>" class="tip"><span class="icon12 icomoon-icon-remove"></span></a>                          
                                                        <?php if($agent['status']!='blocked'):?>

                                                          <a aria-describedby="qtip-7" data-hasqtip="true" title="" oldtitle="Edit task"
                                                           onclick="if (confirm(&quot;Are you sure to block this Admin?&quot;)) { return true; } return false;"

                                                           href="<?php echo Router::url(array('controller'=>'admins','action'=>'block',$agent['id'])
                                                         )?>" class="tip"><span class="icon12 iconic-icon-move-horizontal-alt2"></span></a>
                                                          <?php endif; ?>
                                                       
                                                        <?php if($agent['status']!='active'):?>
                                                        <a aria-describedby="qtip-8" data-hasqtip="true" title="" oldtitle="Remove task" 
                                                        onclick="if (confirm(&quot;Are you sure to active this Admin?&quot;)) { return true; } return false;"

                                                           href="<?php echo Router::url(array('controller'=>'admins','action'=>'active',$agent['id'])
                                                         )?>"
                                                         class="tip"><span class="icon12 icomoon-icon-checkmark"></span></a>
                                                    <?php endif; ?>
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