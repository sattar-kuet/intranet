<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">   
    <div class="page-sidebar navbar-collapse collapse" style="width: 247px; margin-top: 11px; height: 100%;">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu"  data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>          

            <li 
            <?php
            $services = array('servicemanage');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >                 
                <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'servicemanage')) ?>">
                    <i class="fa fa-support"></i>
                    <span class="title">Service Management</span>
                    <span class="arrow "></span>
                </a>
            </li> 
            
             <li 
            <?php
            $transactionId = array('transactionId');
            if (in_array($this->name . '' . $this->action, $transactionId)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >                 
                <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'transactionId')) ?>">
                    <i class="fa fa-support"></i>
                    <span class="title">Search By Trans ID</span>
                    <span class="arrow "></span>
                </a>
            </li>

            <li 
            <?php
            $tickets = array('Ticketscreate', 'Ticketsmanage', 'Ticketsassigned_to_me', 'Ticketsforwarded_by','Ticketssolved_ticket','Ticketsin_progress');
            if (in_array($this->name . '' . $this->action, $tickets)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-ticket"></i>
                    <span class="title">Ticket Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Assigned_to_me'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'assigned_to_me')) ?>">
                            <i class="fa fa-wrench"></i>
                            Assigned to Me</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Forwarded_by'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'forwarded_by')) ?>">
                            <i class="fa fa-wrench"></i>
                            Forwarded by</a>
                    </li>
                       <li
                    <?php if ($this->name . '' . $this->action == 'in_progress'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'in_progress ')) ?>">
                            <i class="fa fa-fast-forward"></i>
                           In Progress  </a>
                    </li>
                     <li
                    <?php if ($this->name . '' . $this->action == 'solved_ticket'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'solved_ticket')) ?>">
                            <i class="fa glyphicon glyphicon-check"></i>
                            Solved Ticket</a>
                    </li>                   
                    
                </ul> 
                
            <li 
            <?php
            $services = array('Customersregistration','Customersfollowup','Customersschedule_done');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa icon-users"></i>
                    <span class="title">Potential Customer</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersregistration'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'registration')) ?>">
                            <i class="fa icon-note"></i>
                            Opportunity</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customsfollowup'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'followup')) ?>">
                            <i class="fa icon-user-following"></i>
                            Opportunity Follow-up </a>
                    </li>
<!--                    <li

                        <?php if ($this->name . '' . $this->action == 'Customersschedule_done'):
                            ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'schedule_done')) ?>">

                            <i class="fa icon-like"></i>
                            Schedule Done </a>
                    </li>-->
                </ul>
            </li>

           <li 
            <?php
            $services = array('Customersready_installation', 'Customersshipment', 'Customerstroubleshot_technician', 'Customerstroubleshot_shipment', 'Customerswire_problem','Customersmoving', 'Customersremote_problem');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa icon-users"></i>
                    <span class="title">Ready To Installation</span>
                    <span class="arrow "></span>
                </a>
               
                <ul class="sub-menu">                 
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersready_installation'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'ready_installation')) ?>">
                            <i class="fa icon-like"></i>
                            Sales Technician </a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersshipment'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'shipment')) ?>">

                            <i class="fa fa-plane"></i>
                            Sales Shipment </a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customerstroubleshot_technician'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'troubleshot_technician')) ?>">
                            <i class="fa icon-like"></i>
                            Troubleshot Technician</a>
                    </li>

                    <li

                        <?php if ($this->name . '' . $this->action == 'Customerstroubleshot_shipment'):
                            ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'troubleshot_shipment')) ?>">

                            <i class="fa icon-like"></i>
                            Troubleshot Shipment</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersmoving'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'moving')) ?>">
                            <i class="fa icon-like"></i>
                            Moving</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Customerswire_problem'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'wire_problem')) ?>">
                            <i class="fa icon-like"></i>
                            Wire problem</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersremote_problem'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'remote_problem')) ?>">
                            <i class="fa icon-like"></i>
                            Remote Problem</a>
                    </li>
                </ul>
            </li> 
            
               <li 
            <?php
            $services = array('Adminsassignedtotech', 'Adminsdonebytech', 'Adminspostponebytech', 'Adminsrecheduledbytech', 'Adminscancelledbytech', 'Adminsdonebyadmin');
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa icon-users"></i>
                    <span class="title">Work Status</span>
                    <span class="arrow "></span>
                </a>

                <ul class="sub-menu">                 
                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsassignedtotech'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'assignedtotech')) ?>">
                            <i class="fa icon-like"></i>
                            Assigned To Tech</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsdonebytech'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'donebytech')) ?>">

                            <i class="fa fa-plane"></i>
                            done by tech </a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminspostponebytech'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'postponebytech')) ?>">
                            <i class="fa icon-like"></i>
                            Postpone by Tech</a>
                    </li>

                    <li

                        <?php if ($this->name . '' . $this->action == 'Adminsrecheduledbytech'):
                            ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'recheduledbytech')) ?>">

                            <i class="fa icon-like"></i>
                            Rescheduled by Tech</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminscancelledbytech'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'cancelledbytech')) ?>">

                            <i class="fa icon-like"></i>
                            Canceled By Tech</a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsdonebyadmin'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'donebyadmin')) ?>">

                            <i class="fa icon-like"></i>
                            Done By Admin</a>
                    </li>

                </ul>
            </li> 
   
                
<!--             <li 
            <?php

            $services = array('Customersregistration','Customersedit_registration', 'Customersfollowup','Customersready_installation','Customersshipment' );
            if (in_array($this->name . '' . $this->action, $services)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa fa-support"></i>
                    <span class="title">Potential Customer</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customersregistration'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'registration')) ?>">
                            <i class="fa fa-support"></i>
                            Opportunity</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Customsfollowup'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'followup')) ?>">
                            <i class="fa fa-support"></i>
                            Opportunity Follow-up </a>
                    </li>

                    <li

                    <?php if ($this->name . '' . $this->action == 'Customersready_installation'):

                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'ready_installation')) ?>">

                            <i class="fa fa-support"></i>
                            Ready to Installation </a>
                    </li>
                     <li

                    <?php if ($this->name . '' . $this->action == 'Customersshipment'):

                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'shipment')) ?>">

                            <i class="fa fa-plane"></i>
                            Shipment </a>
                    </li>
                </ul>
            </li>
-->

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>


    <!-- END SIDEBAR -->