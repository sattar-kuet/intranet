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
            Denied review List <small> See the review and take necessary action</small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-phone"></i>Denied feedback
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">

                        <?php echo $this->Session->flash(); ?>

                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>

                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Review</th>
                                    <th>Rating out of 5</th>           
                                    <th>Status</th>           
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($alldata as $k => $single):
                                    $review = $single['Review'];
                                    ?>
                                    <tr>
                                        <td><?php echo $review['name']; ?></td>
                                        <td><?php echo $review['email']; ?></td>
                                        <td><?php echo $review['content']; ?></td>

                                        <td><?php echo $review['rating']; ?></td>
                                        <td><?php echo $review['status']; ?></td>
                                        <td>
                                           <a 
                                                onclick="if (confirm('Are you sure to approve this review?')) {
                                                    return true;
                                                    }
                                                    return false;"

                                                href="<?php
                                                echo Router::url(array('controller' => 'reviews', 'action' => 'approve', $review['id'])
                                                )
                                                ?>" ><span class="fa fa-check" title="approve"></span></a>
                                            &nbsp;&nbsp;
                                            <a 
                                                onclick="if (confirm('Are you sure to delete this review?')) {
                                                            return true;
                                                            }
                                                            return false;"

                                                href="<?php
                                                echo Router::url(array('controller' => 'reviews', 'action' => 'delete', $review['id'])
                                                )
                                                ?>" ><span class="fa  fa-trash-o" title="delete"></span></a>

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

