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
                            <i class="fa fa-search"></i>Search Customer Information
                        </div>
                        <!--                        <div class="tools">
                                                    <a href="javascript:;" class="reload">
                                                    </a>
                                                </div>-->
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('PackageCustomer', array(
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

                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input('param', array(
                                        'type' => 'text',
                                        'placeholder' => 'Type first name or last name or cell number or mac',
                                        'class' => 'form-control required',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <!--                            <div class="form-group">
                                                            <label class="control-label col-md-3">
                                                            </label>
                                                            <div class="col-md-6">
                            <?php
                            echo $this->Form->input('home', array(
                                'type' => 'select',
                                'options' => $homes,
                                'empty' => 'Select Home No',
                                'class' => 'form-control select2me pclass',
                                    )
                            );
                            ?>
                                                            </div>
                                                        </div>-->

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
                    <div class="portlet-title line" style="color:red;">
                        <div class="caption">
                            <i class="fa fa-envelope-o fa-lg" style="color:red;"></i>Announcements From Admin 
                        </div>
                        <!--                        <div class="tools">
                        
                                                    <a href="" class="reload" data-original-title="" title="">
                                                    </a>
                        
                                                </div>-->
                    </div>
                    <!--  <div class="portlet-body" id="chats" style="overflow-y: scroll; max-height: 300px;"/> -->
                    <div class="portlet-body" id="chats"/>
                    <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto;"><div class="scroller" style="overflow: hidden; width: auto;" data-always-visible="1" data-rail-visible1="1" data-initialized="1">
                            <ul class="chats ">

                                <?php
                                foreach ($admin_messages as $message):
                                    ?>

                                    <li class="in">
                                        <!--<line style="border-bottom: 1px solid #999; display: block;">-->
                                           <!--<img class="avatar" alt="" src="<?php echo $this->webroot; ?>/assets/admin/layout/img/avatar1.jpg">-->
                                        <!--<div class="message">-->
    <!--                                            <span class="arrow">
                                            </span>-->

                                        <a style="color: #E02222; font-weight: bold;" href="#" class="name">
                                            <?php echo $message['u']['name']; ?> </a>                                                
                                        <span class="datetime">
                                            at
                                            <?php
                                            $dt = new DateTime($message['m']['created']);
                                            echo $dt->format('g:i A');
                                            ;
                                            ?>  
                                        </span>
                                        <span class="body">
                                            <?php echo $message['m']['message']; ?> 
                                        </span>                                      
                                    </li> 
                                    <span class="devider"></span>
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

        <div class="row-fluid">
            <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                <thead>
                    <tr>                                           
                        <th>Name</th>
                        <th>Customer Detail</th>
                        <th>Package</th>
                        <th>Status</th>
                        <th>Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($data['customer'] as $index => $d):
                        $customer = $d;
//                        pr($customer['status']); exit;
                        $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                . $customer['zip'];
                        $package = array();
                        if (count($data['package']) > 0) {
                            $package = $data['package'][$index];
                        }
                        ?>
                        <tr class="odd gradeX">

                            <td><?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?></td>
                            <td>
                                <ul>
                                    <li>Cell:<?php echo $customer['cell']; ?></li>
                                    <li>Address:<?php echo $customer_address; ?></li>
                                </ul>
                            </td>
                            
                            <td>
                                <?php if (count($package) > 0): ?>
                                    <ul>
                                        <li> Package Name: <?php echo $package['name']; ?></li>
                                        <li> Month: <?php echo $package['duration']; ?></li>
                                        <li> Charge: <?php echo $package['charge']; ?></li>
                                    </ul>
                                    <?php
                                endif;
                                ?>
                            </td>
                            <td>                               
                                <?php echo $customer['status']; ?>                               
                            </td>
                            <td>
                                <?php
                                echo $this->Form->create('PackageCustomer', array(
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
                                    'value' => $customer['id']
                                        )
                                );
                                ?>
                                <?php
                                echo $this->Form->input('status', array(
                                    'type' => 'select',
                                    'options' => Array('ticket' => 'Generate Ticket', 'repair' => 'Repair', 'info' => 'Customer  Information', 'history' => 'Ticket History'),
                                    'empty' => 'Select Action',
                                    'class' => 'form-control form-filter input-sm ',
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
                    endforeach;
                    ?>
                </tbody>
            </table>
        </div>
        <?php ?>
    </tbody>
    <?php
endif;
?>
</div>
</div>
<!-- END CONTENT -->

