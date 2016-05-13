
<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }
</style>

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
            <div class="col-md-12">
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-plus"></i>Call Logs
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Track', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
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
                                <label class="control-label col-md-3" for="required">Select date</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input(
                                            'daterange', array(
                                        'id' => 'e1', /* e1 is past to current date, e2 is past to future date */
                                        'class' => 'span9 text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">                                
                                <label class="control-label col-md-3" for="required">Issue</label>
                                <div class="col-md-4">
                                    <?php
                                    echo $this->Form->input('issue_id', array(
                                        'type' => 'select',
                                        'options' => $issues,
                                        'empty' => 'Select Issue',
                                        'class' => 'form-control select2me required',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">                                
                                <label class="control-label col-md-3" for="required">Agent</label>
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
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-5 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Search', array('class' => 'btn btn-success', 'type' => 'submit')
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
        </div>
      
        
    </div>
      <?php if ($clicked): ?>    
            <div class="page-content-wrapper">
                <div class="page-content">
                    <!-- BEGIN PAGE HEADER-->
                    <h3 class="page-title">
                        <!--Manage the tickets <small>You can resolve, unresolve or froward</small>-->
                    </h3>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <div class="col-md-12">
                            <!-- BEGIN EXAMPLE TABLE PORTLET-->
                            <div class="portlet box green">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-ticket"></i>Call Logs
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
                                                            <li> Name: <?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?> </li> 
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
                                                                    <p><strong>Forwarded To:</strong><ul><li><?php echo $history['fi']['name']; ?> </li><li><?php echo $history['fd']['name']; ?> </li></ul>
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
        <?php endif; ?><!-- END PAGE CONTENT -->
</div>
<!-- END CONTENT -->



