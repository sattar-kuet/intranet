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
            Approved reseller List <small> See the reseller and take necessary action</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-phone"></i>Approved Reseller
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
                                    <th> Phone </th>
                                    <th>Image </th>
                                    <th> URL </th>      
                                    <th>Status</th>           
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($alldata as $k => $single):
                                    $reseller = $single['Reseller'];
                                    ?>
                                    <tr>
                                        <td><?php echo $reseller['name']; ?></td>
                                        <td><?php echo $reseller['email']; ?></td>
                                        <td><?php echo $reseller['mobile']; ?></td>

                                        <td><img height="50" width="50" style="border-radius:50px !important;" src="<?php echo $this->webroot . 'reseller/' . $reseller['img'] ?>"/></td>
                                        <td><a target="_blank" href="<?php echo $this->webroot .'OrderFromReseller/'. $reseller['api_key']; ?>/">get url </a> </td>

                                        <td><?php echo $reseller['status']; ?></td>
                                        <td>

                                            <a 
                                                onclick="if (confirm('Are you sure to deny this Reseller?')) {
                                                                return true;
                                                                }
                                                                return false;"

                                                href="<?php
                                                echo Router::url(array('controller' => 'resellers', 'action' => 'deny', $reseller['id'])
                                                )
                                                ?>" ><span class="fa fa-ban" title="deny"></span></a>
                                            &nbsp;&nbsp;
                                            <a 
                                                onclick="if (confirm('Are you sure to delete this Reseller?')) {
                                                                return true;
                                                                }
                                                                return false;"

                                                href="<?php
                                                echo Router::url(array('controller' => 'resellers', 'action' => 'delete', $reseller['id'])
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

