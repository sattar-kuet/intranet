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
                                    <th>Open Time</th>
                                    <th>Ticket From</th>
                                    <th>Priority</th>
                                    <th>Detail</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($tickets as $single):
                                    //  pr($single); exit;
                                    $ticket = $single['Ticket'];
                                    ?>
                                    <tr >
                                        <td><?php echo $ticket['created']; ?></td>
                                        <td><?php echo $single['TicketDepartment']['name']; ?></td>
                                        <td><?php echo $ticket['priority']; ?></td>
                                        <td><?php echo $ticket['content']; ?></td>
                                        <td><?php echo $ticket['status']; ?></td>

                                        <td>   
                                            <div class="controls center">

                                                <?php if ($ticket['status'] != 'closed') { ?>
                                                    <a 

                                                        onclick="if (confirm('Are you sure to close this ticket?')) {
                                                                    return true;
                                                                }
                                                                return false;"
                                                        href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'close', $ticket['id'])) ?>" title="close">
                                                        <span class="fa fa-ban"></span>
                                                    </a>  

                                                <?php
                                                } else {
                                                    echo 'Nothing to Do';
                                                }
                                                ?>



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

