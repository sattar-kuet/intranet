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
                                    <th>Subject</th>
                                    <th>Open Time</th>
                                    <th>Detail</th>
                                    <th>History</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($data as $single):
                                     $issue = end($single['history']); 
                              
                                    $ticket = $single['ticket'];
                                    ?>
                                    <tr >
                                        <td><?php echo $issue['i']['name']; ?></td>
                                        <td><?php echo $ticket['created']; ?></td>
                                        <td><?php echo $ticket['content']; ?></td>
                                        <td>
                                            <ol>
                                                <?php
                                                $lasthistory = $single['history'][0]['tr'];
                                                foreach ($single['history'] as $history):
                                                    ?>
                                                    <li>
                                                        Forwarded By: <?php echo $history['fb']['name']; ?>
                                                        Forwarded To: <?php echo $history['fi']['name']; ?> <?php echo $history['fd']['name']; ?>
                                                        Forward Time: <?php echo $history['tr']['created']; ?>
                                                        Ticket Status: <?php echo $history['tr']['status']; ?>
                                                    </li> 
                                                <?php endforeach; ?>
                                            </ol>
                                        </td>
                                        <td>   
                                            <div class="controls center text-center">

                                                <?php if ($lasthistory['status'] == 'open') { ?>
                                                    <a 

                                                        onclick="if (confirm('Are you sure to close this ticket?')) {
                                                                            return true;
                                                                        }
                                                                        return false;"
                                                        href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'close', $lasthistory['id'])) ?>" title="Close">
                                                        <span class="fa fa-ban fa-lg"></span>
                                                    </a> 
                                                    &nbsp; 
                                                    <a 

                                                        onclick="if (confirm('Are you sure this ticket is solved?')) {
                                                                            return true;
                                                                        }
                                                                        return false;"
                                                        href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'solved', $lasthistory['id'])) ?>" title="Solved">
                                                        <span class="fa fa-check fa-lg"></span>
                                                    </a>
                                                    &nbsp;
                                                    <a 

                                                        onclick="if (confirm('This ticket is still UNSOLVED! Proceed?')) {
                                                                            return true;
                                                                        }
                                                                        return false;"
                                                        href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'unsolved', $lasthistory['id'])) ?>" title="Unolved">
                                                        <span class="fa fa-times fa-lg"></span>
                                                    </a>
                                                    &nbsp;
                                                    <a 
                                                        href="#" title="Forward">
                                                        <span id="<?php echo $ticket['id'];?>" class="fa fa-mail-forward fa-lg forward_ticket"></span>
                                                    </a>


                                                    <div id="forward_dialog<?php echo $ticket['id'];?>" class="portlet-body form" style="display: none;">
                                                        <!-- BEGIN FORM-->
                                                        <?php
                                                        echo $this->Form->create('Track', array(
                                                            'inputDefaults' => array(
                                                                'label' => false,
                                                                'div' => false
                                                            ),
                                                            'id' => 'form_sample_3',
                                                            'class' => 'form-horizontal',
                                                            'novalidate' => 'novalidate',
                                                            'url' => array('controller' => 'tickets', 'action' => 'forward')
                                                                )
                                                        );
                                                        ?>

                                                        <?php
                                                        echo $this->Form->input('ticket_id', array(
                                                            'type' => 'hidden',
                                                            'value' => $ticket['id'],
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
                                                                <label class="control-label col-md-4" style="padding-top: 0px;">Assign to (individual)
                                                                </label>
                                                                <div class="form-group">

                                                                    <div class="col-md-7">
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
                                                                <label class="control-label col-md-4" style="padding-top: 0px;">Assign to (Department)
                                                                </label>
                                                                <div class="form-group">

                                                                    <div class="col-md-7">
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
                                                                <label class="control-label col-md-4" style="padding-top: 0px;">Select Priority<span class="required">
                                                                        * </span>
                                                                </label>
                                                                <div class="form-group">

                                                                    <div class="col-md-7">
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
                                                    echo 'Nothing to do';
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

