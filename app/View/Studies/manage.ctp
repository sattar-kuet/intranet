<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }

</style>

<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            No contact Order List <small>Contact with customer to confirm</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-phone"></i>No Contact Order
                        </div>
                        <?php echo $this->Session->flash(); ?>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">



                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr> 
                                    <th>Topics</th>
                                    <th>Detail</th>
                                    <th>Video</th> 
                                    <th>Level</th> 
                                    <th>Subject</th>
                                    <th>Chapter</th>
                                    <th>Status </th>
                                    <th>Action</th>

                                </tr>
                                
                            </thead>
                            <tbody>
                                  <?php
                                            foreach ($studies as $single):
                                                $study = $single['Study'];
                                                ?>
                                            <tr >
                                                <td><?php echo $study ['topics']; ?></td>
                                                 <td><?php echo $study ['details']; ?></td>
                                                 <td><?php echo $study ['video']; ?></td>
                                                <td><?php echo $single['Level']['name']; ?></td>
                                                <td><?php echo $single['Subject']['name']; ?></td>
                                                <td><?php echo $single['Chapter']['name']; ?></td>
                                                <td><?php echo $study ['status']; ?></td>
                                           
                                                <td>   
                                                    <div class="controls center">
                                                        <a title="view" target="_blank" href="<?php echo Router::url(array('controller'=>'studies','action'=>'edit',$study['id']))?>" ><span class="fa  fa-eye"></span></a>
                                                        &nbsp;&nbsp;
                        
                                                        <?php if($study['status'] == 'approved'):?>

                                                          <a  title="Block"
                                                           onclick="if (confirm(&quot;Are you sure to block this question?&quot;)) { return true; } return false;"

                                                           href="<?php echo Router::url(array('controller'=>'studies','action'=>'block',$study['id'])
                                                         )?>" ><span class="fa fa-ban"></span></a>
                                                          <?php endif; ?>
                                                       
                                                        <?php if($study['status']!='approved'):?>
                                                        <a title="approve"  
                                                        onclick="if (confirm(&quot;Are you sure to approve this question?&quot;)) { return true; } return false;"

                                                           href="<?php echo Router::url(array('controller'=>'studies','action'=>'approve',$study['id'])
                                                         )?>"
                                                         ><span class="fa fa-check"></span></a>
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
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->

