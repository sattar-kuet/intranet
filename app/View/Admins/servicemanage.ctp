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
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-6">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-search"></i>Search customer information by cell no
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('PaidCustomer', array(
                        'inputDefaults' => array(
                        'label' => false,
                        'div' => false
                        ),
                        'id' => 'form_sample_3',
                        'class' => 'form-horizontal',
                        'novalidate' => 'novalidate',
                        //'url' => array('controler' => 'Admins', 'action' => 'changeservice')
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
                                <label class="control-label col-md-3">
                                </label>
                                <div class="col-md-6">
                                    <?php
                                    echo $this->Form->input('cell', array(
                                    'type' => 'select',
                                    'options' => $cells,
                                    'empty' => 'Select Cell No',
                                    'class' => 'form-control select2me required pclass',
                                    )
                                    );
                                    ?>
                                </div>
                            </div>

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-7 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                    'Search', array('class' => 'btn green', 'type' => 'submit')
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
            </div>

            <div class="col-md-6 col-sm-6">
                <!-- BEGIN PORTLET-->
                <div class="portlet">
                    <div class="portlet-title line">
                        <div class="caption">
                            <i class="fa fa-envelope-o fa-lg"></i>Message from Admin
                        </div>
                        <div class="tools">

                            <a href="" class="reload" data-original-title="" title="">
                            </a>

                        </div>
                    </div>
                    <div class="portlet-body" id="chats">
                        <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;"><div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                                <ul class="chats">
                                    <?php
                                    foreach ($admin_messages as $message):
                                    ?>
                                    <li class="in">
                                        <!--<img class="avatar" alt="" src="<?php echo $this->webroot; ?>/assets/admin/layout/img/avatar1.jpg">-->
                                        <!--<div class="message">-->
<!--                                            <span class="arrow">
                                            </span>-->
                                            <a href="#" class="name">
                                                <?php echo $message['User']['name']; ?> </a>                                                
                                            <span class="datetime">
                                                at <?php echo $message['Message']['created']; ?>  </span>
                                            <span class="body">
                                                <?php echo $message['Message']['message']; ?> </span>
                                        <!--</div>-->
                                    </li>                                    
                                    <?php endforeach ?>
                                </ul>
                            </div><div class="slimScrollBar" style="width: 7px; position: absolute; top: 0px; opacity: 0.4; display: block; border-radius: 7px; z-index: 99; right: 1px; height: 185.485px; background: rgb(187, 187, 187);"></div><div class="slimScrollRail" style="width: 7px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; opacity: 0.2; z-index: 90; right: 1px; background: rgb(234, 234, 234);"></div></div>
                    </div>
                </div>
                <!-- END PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->        

        <?php if ($clicked): ?>

<<<<<<< HEAD
            <div class="row-fluid">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                        <tr>                                           
                            <th>Name</th>
                            <th>Cell</th>
                            <th>Package</th>
                            <th>Status</th>
                            <th>Action</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $info = $customer_info['PaidCustomer'];
                        ?>
                        <tr class="odd gradeX">

                            <td><?php echo $info['lname']; ?></td>
                            <td><?php echo $info['cell']; ?></td>
                            <td><?php echo $info['psetting_id']; ?></td>
                            <td><?php echo $info['status']; ?></td>
                            <td>

                                <?php
                                echo $this->Form->create('PaidCustomer', array(
                                    'inputDefaults' => array(
                                        'label' => false,
                                        'div' => false
                                    ),
                                    'id' => 'form_sample_3',
                                    'class' => 'form-horizontal',
                                    'novalidate' => 'novalidate',
                                    'url' => array('controller' => 'admins', 'action' => 'changeservice')
                                        )
                                );
                                ?>

                                <?php
                                echo $this->Form->input('id', array(
                                    'type' => 'hidden',
                                    'value' => $info['id']
                                        )
                                );
                                ?>
                                <?php
                                echo $this->Form->input('status', array(
                                    'type' => 'select',
                                    'options' => Array('ticket' => 'Generate Ticket', 'canceled' => 'Cancel', 'continue' => 'Continue', 'hold' => 'Hold', 'reconnect' => 'Reconnect','payment' => 'Payment' ),
                                    'empty' => 'Select Action',
                                    'class' => 'form-control form-filter input-sm',
                                        )
                                );
                                ?>

                                <br>

                                <?php
                                echo $this->Form->button(
                                        'Go', array('class' => 'btn blue', 'title' => 'Do this selected action', 'type' => 'submit')
                                );
                                ?>
                                <?php echo $this->Form->end(); ?>


                            </td>



                        </tr>
                        <?php
                        ?>
                    </tbody>


        <!--        <div class="row">
                    <div class="col-md-12">
                         BEGIN EXAMPLE TABLE PORTLET
                        <div class="portlet box blue">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-ticket"></i>List of all tickets for selected customer
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
                                            <th>Subject</th>
                                            <th>Customer Info</th>
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
        $customer = end($single['history']);
        $customer = $customer['pc'];
        $ticket = $single['ticket'];
        ?>
                                                <tr >
                                                    <td><?php echo $issue['i']['name']; ?></td>
                                                    <td>
                                                        <ul>
                                                            <li> Name: <?php echo $customer['fname'] . ' ' . $customer['lname']; ?> </li> 
                                                            <li> Cell: <?php echo $customer['cell']; ?> </li> 
                                                        </ul>
                                                    </td>
                                                    <td><?php echo $ticket['created']; ?></td>
                                                    <td><?php echo $ticket['content']; ?></td>
                                                    <td>
                                                        <ol>
        <?php
        $lasthistory = $single['history'][0]['tr'];
        foreach ($single['history'] as $history):
        ?>
                                                                    <li>
        <?php if ($history['tr']['status'] != 'open') { ?>
                                                                                <strong><?php echo ucfirst($history['tr']['status']); ?> By:</strong>
        <?php } else {
        ?>
                                                                                <strong>Forwarded By:</strong>
        <?php
        }
        ?>
        <?php echo $history['fb']['name']; ?>
                                                                        &nbsp;&nbsp;<strong>Forwarded To:</strong> <?php echo $history['fi']['name']; ?> <?php echo $history['fd']['name']; ?><br>
                                                                        <strong>Time:</strong> <?php echo $history['tr']['created']; ?>
                
                                                                        &nbsp;&nbsp;<strong>Status:</strong> <?php echo $history['tr']['status']; ?><br>
        <?php
        if (!empty($history['tr']['comment'])):
        echo '<strong>';
        echo 'Comment : ';
        echo '</strong>';
        echo $history['tr']['comment'];
        endif;
        ?> 
                                                                    </li>
                                                                    <br>
        <?php endforeach; ?>
                                                        </ol>
                                                    </td>
            
            
                                                    <td>   
                                                        <div class="controls center text-center">
            
            
        <?php if ($lasthistory['status'] == 'open') { ?>
                
                
                                                                    <a 
                                                                        href="#" title="Solved">
                                                                        <span id="<?php echo $ticket['id']; ?>" class="fa fa-check fa-lg solve_ticket"></span>
                                                                    </a>
                                                                    &nbsp;
                                                                    <a 
                                                                        href="#" title="Unresolved">
                                                                        <span id="<?php echo $ticket['id']; ?>" class="fa fa-times fa-lg unsolve_ticket"></span>
                
                
                                                                    </a>
                                                                    &nbsp;
                
                                                                    <a 
                                                                        href="#" title="Forward">
                
                                                                        <span id="<?php echo $ticket['id']; ?>" class="fa fa-mail-forward fa-lg forward_ticket"></span>
                                                                    </a>
                
                
                
                                                                    <div id="forward_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">
                
                
                                                                         BEGIN FORM
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
                
                                                                                <div class="form-group">
                
                                                                                    <div class="col-md-12">
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
                
                                                                                <div class="form-group">
                
                                                                                    <div class="col-md-12">
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
                
                                                                                <div class="form-group">
                
                                                                                    <div class="col-md-12">
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
                                                                            <div class="form-group">
                
                                                                                <div class="form-group">
                
                                                                                    <div class="col-md-12">
        <?php
        echo $this->Form->input('comment', array(
        'type' => 'textarea',
        'class' => 'form-control required',
        'placeholder' => 'Write your comments'
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
                                                                         END FORM
                                                                    </div>
                
                                                                    <div id="solve_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">
                
                                                                         BEGIN FORM
        <?php
        echo $this->Form->create('Track', array(
        'inputDefaults' => array(
        'label' => false,
        'div' => false
        ),
        'id' => 'form_sample_3',
        'class' => 'form-horizontal',
        'novalidate' => 'novalidate',
        'url' => array('controller' => 'tickets', 'action' => 'solve')
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
        <?php
        echo $this->Form->input('user_id', array(
        'type' => 'hidden',
        'value' => $lasthistory['user_id'],
        )
        );
        ?>
        <?php
        echo $this->Form->input('role_id', array(
        'type' => 'hidden',
        'value' => $lasthistory['role_id'],
        )
        );
        ?>
        <?php
        echo $this->Form->input('issue_id', array(
        'type' => 'hidden',
        'value' => $lasthistory['issue_id'],
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
                
                                                                                <div class="form-group">
                
                                                                                    <div class="col-md-12">
        <?php
        echo $this->Form->input('comment', array(
        'type' => 'textarea',
        'class' => 'form-control required txtArea',
        'placeholder' => 'Write your comments'
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
        'Done', array('class' => 'btn green', 'type' => 'submit')
        );
        ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
        <?php echo $this->Form->end(); ?>
                                                                         END FORM
                                                                    </div> 
                
                                                                    <div id="unsolve_dialog<?php echo $ticket['id']; ?>" class="portlet-body form" style="display: none;">
                
                                                                         BEGIN FORM
        <?php
        echo $this->Form->create('Track', array(
        'inputDefaults' => array(
        'label' => false,
        'div' => false
        ),
        'id' => 'form_sample_3',
        'class' => 'form-horizontal',
        'novalidate' => 'novalidate',
        'url' => array('controller' => 'tickets', 'action' => 'unsolve')
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
        <?php
        echo $this->Form->input('user_id', array(
        'type' => 'hidden',
        'value' => $lasthistory['user_id'],
        )
        );
        ?>
        <?php
        echo $this->Form->input('role_id', array(
        'type' => 'hidden',
        'value' => $lasthistory['role_id'],
        )
        );
        ?>
        <?php
        echo $this->Form->input('issue_id', array(
        'type' => 'hidden',
        'value' => $lasthistory['issue_id'],
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
                                                                                <div class="form-group">
                                                                                    <div class="col-md-12">
        <?php
        echo $this->Form->input('comment', array(
        'type' => 'textarea',
        'class' => 'form-control required txtArea',
        'placeholder' => 'Write your comments'
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
        'Done', array('class' => 'btn green', 'type' => 'submit')
        );
        ?>
                                                                                </div>
                                                                            </div>
                                                                        </div>
        <?php echo $this->Form->end(); ?>
                                                                         END FORM
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
                         END EXAMPLE TABLE PORTLET
                    </div>
                </div>-->
        <?php
        endif;
        ?>
    </div>
</div>
<!-- END CONTENT -->

