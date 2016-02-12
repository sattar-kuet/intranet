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
                                    <th>Assign To</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $single):
                                    // pr($single['assign_to']); exit;
                                    $ticket = $single['ticket'];
                                    ?>
                                    <tr >
                                        <td><?php echo $ticket['created']; ?></td>
                                        <td><?php echo $single['open_by']['User']['name']; ?></td>
                                        <td><?php echo $ticket['priority']; ?></td>
                                        <td><?php echo $ticket['content']; ?></td>
                                        <td>
                                            <ul>
                                                <li><?php echo $single['assign_to']['dept']['name']; ?></li>
                                                <li><?php echo $single['assign_to']['admin']['name']; ?></li>
                                            </ul>
                                        </td>
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

                                                    <div class="portlet-body form">
                                                        <!-- BEGIN FORM-->
                                                        <?php
                                                        echo $this->Form->create('Ticket', array(
                                                            'inputDefaults' => array(
                                                                'label' => false,
                                                                'div' => false
                                                            ),
                                                            'id' => 'form_sample_3',
                                                            'class' => 'form-horizontal',
                                                            'novalidate' => 'novalidate'
                                                                )
                                                        );
                                                        ?>
                                                        <div class="form-body">
                                                            <div class="alert alert-danger display-hide">
                                                                <button class="close" data-close="alert"></button>
                                                                You have some form errors. Please check below.
                                                            </div>
                                                            <?php echo $this->Session->flash(); ?>

                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Assign to (individual)
                                                                </label>
                                                                <div class="form-group">

                                                                    <div class="col-md-4">
                                                                        <?php
                                                                        echo $this->Form->input('user_id', array(
                                                                            'type' => 'select',
                                                                            'options' => $users,
                                                                            'empty' => 'Select From Existing admins panel user',
                                                                            'class' => 'form-control select2me',
                                                                                )
                                                                        );
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Assign to (Department)
                                                                </label>
                                                                <div class="form-group">

                                                                    <div class="col-md-4">
                                                                        <?php
                                                                        echo $this->Form->input('role_id', array(
                                                                            'type' => 'select',
                                                                            'options' => $roles,
                                                                            'empty' => 'Select Department or Role',
                                                                            'class' => 'form-control select2me',
                                                                                )
                                                                        );
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label col-md-3">Select Priority<span class="required">
                                                                        * </span>
                                                                </label>
                                                                <div class="form-group">

                                                                    <div class="col-md-4">
                                                                        <?php
                                                                        echo $this->Form->input('priority', array(
                                                                            'type' => 'select',
                                                                            'options' => array('low' => 'Low', 'medium' => 'Medium', 'high' => 'High'),
                                                                            'empty' => 'Select Priority',
                                                                            'class' => 'form-control select2me required pclass',
                                                                                )
                                                                        );
                                                                        ?>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                           
                                                        </div>
                                                        <div class="form-actions">
                                                            <div class="row">
                                                                <div class="col-md-offset-7 col-md-4">
                                                                    <?php
                                                                    echo $this->Form->button(
                                                                            'Forward', array('class' => 'btn green', 'type' => 'submit')
                                                                    );
                                                                    ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <?php echo $this->Form->end(); ?>
                                                        <!-- END FORM-->
                                                    </div>

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

