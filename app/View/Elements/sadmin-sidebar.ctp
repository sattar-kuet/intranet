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
            $admins = array('Adminsaddrole', 'Adminseditrole', 'Adminscreate', 'Adminsmanage', 'Adminsedit_admin',);
            if (in_array($this->name . '' . $this->action, $admins)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="javascript:;">
                    <i class="fa fa-user"></i>
                    <span class="title">Admin Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">

                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsaddrole'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'addrole')) ?>">
                            <i class="fa fa-plus"></i>
                            Add Role</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminseditrole'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'editrole')) ?>">
                            <i class="fa fa-pencil"></i>
                            Edit Role</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminscreate'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'create')) ?>">
                            <i class="fa fa-plus"></i>
                            Create Admin</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Adminsmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'manage')) ?>">
                            <i class="fa fa-wrench"></i>
                            Manage Admin</a>
                    </li>                    
                </ul>
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


            <!--            <li 
            <?php
            $payment = array('paymenthistory');
            if (in_array($this->name . '' . $this->action, $payment)):
                ?>
                                                class="active"
                <?php
            endif;
            ?>
                            >                 
                            <a href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'payment_history')) ?>">
                                <i class="fa fa-support"></i>
                                <span class="title">Payment History</span>
                                <span class="arrow "></span>
                            </a>
                        </li>-->


            <li 
            <?php
            $tickets = array('Ticketscreate', 'Ticketsmanage', 'TicketsAssigned_to_me', 'TicketsForwarded_by', 'Ticketssolved_ticket');
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


                    <!--                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketscreate'):
                        ?>
                                                                                        class="active"
                        <?php
                    endif;
                    ?>
                                            >
                                            <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'create')) ?>">
                                                <i class="fa fa-graduation-cap"></i>
                                                Create New</a>
                                        </li>-->
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketsmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'manage')) ?>">
                            <i class="fa icon-info"></i>
                            All Tickets</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Assigned_to_me'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'Assigned_to_me')) ?>">
                            <i class="fa icon-loop"></i>
                            Inform to Me</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Forwarded_by'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'Forwarded_by')) ?>">
                            <i class="fa icon-control-rewind"></i>
                            Forwarded by</a>
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
            $tickets = array('Ticketsadddepartment', 'Ticketseditdepartment');
            if (in_array($this->name . '' . $this->action, $tickets)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa fa-sitemap"></i>
                    <span class="title">Department Manage</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketsadddepartment'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'adddepartment')) ?>">
                            <i class="fa fa-plus"></i>
                            Add Department</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketseditdepartment'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'editdepartment')) ?>">
                            <i class="fa fa-pencil"></i>
                            Edit Department </a>
                    </li>

                </ul>
            </li>
            <li 
            <?php
            $tickets = array('Ticketsaddissue', 'Ticketseditissue');

            if (in_array($this->name . '' . $this->action, $tickets)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa fa-bug"></i>
                    <span class="title">Issues Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketsaddissue'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'addissue')) ?>">
                            <i class="fa fa-plus"></i>
                            Add Issues</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketseditissue'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'editissue')) ?>">
                            <i class="fa fa-pencil"></i>
                            Edit Issues </a>
                    </li>

                </ul>
            </li> 

            <!--
       
             <li 
            <?php
            $transactions = array('Transactionssearch', 'Transactionsexpire_customer');

            if (in_array($this->name . '' . $this->action, $transactions)):
                ?>
                                                            class="active"
                <?php
            endif;
            ?>
                >

                <a href="javascript:;">
                    <i class="fa fa-dollar"></i>
                    <span class="title">Transactions</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
            <?php if ($this->name . '' . $this->action == 'Transactionssearch'):
                ?>
                                                                    class="active"
                <?php
            endif;
            ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'search')) ?>">
                            <i class="fa fa-history"></i>
                            History</a>
                    </li>
                    <li
            <?php if ($this->name . '' . $this->action == 'Transactionsexpire_customer'):
                ?>
                                                                    class="active"
                <?php
            endif;
            ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'expire_customer')) ?>">
                            <i class="fa fa-money"></i>
                            Payments </a>
                    </li>

                </ul>
            </li>

            -->

            <li 
            <?php
            $messages = array('Messagesadd', 'Messagesmanage');

            if (in_array($this->name . '' . $this->action, $messages)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span class="title">Message  Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Messagesadd'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'add')) ?>">
                            <i class="fa fa-plus"></i>
                            Add Message</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Messagesmanage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'messages', 'action' => 'manage')) ?>">
                            <i class="fa fa-wrench"></i>
                            Manage Message</a>
                    </li>


                </ul>
            </li>

            <li 
            <?php
            $services = array('Customersregistration', 'Customersshipment_installation', 'Customersedit_registration', 'Customersfollowup', 'Customersready_installation', 'Customersshipment', 'Customersschedule_done');
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
                    <li

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
                    </li>
                </ul>
            </li>

           <li 
            <?php
            $services = array('Customersready_installation','Customersmoving','Customersshipment', 'Customerstroubleshot_technician', 'Customerstroubleshot_shipment', 'Customerswire_problem', 'Customersremote_problem');
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
            $reports = array('Reportsduecustomers', 'Reportscall_log', 'Reportspayment_history', 'Reportscancel', 'Reportspaidcustomers', 'Reportsactive', 'Reportsblock', 'Reportspayment', 'Reportsnewcustomers', 'Reportsexpcustomers');

            if (in_array($this->name . '' . $this->action, $reports)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa fa-file-word-o"></i>
                    <span class="title">Reports</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Reportsactive'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'active')) ?>">
                            <i class="fa fa-check-square-o"></i>
                            Active</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Reportscancel'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'cancel')) ?>">
                            <i class="fa icon-ban"></i>
                            Cancel </a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Reportspayment_history'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'payment_history')) ?>">
                            <i class="fa icon-credit-card"></i>
                            Payment History </a>
                    </li>

                    <li
                    <?php if ($this->name . '' . $this->action == 'Reportsnewcustomers'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'newcustomers')) ?>">
                            <i class="fa glyphicon glyphicon-log-in"></i>
                            New Customers</a>
                    </li>


                    <li
                    <?php if ($this->name . '' . $this->action == 'Reportsexpcustomers'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'expcustomers')) ?>">
                            <i class="fa fa-warning"></i>
                            Expire Customers</a>
                    </li>
                    <li
                    <?php if ($this->name . '' . $this->action == 'Reportscall_log'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'call_log')) ?>">
                            <i class="fa fa-warning"></i>
                            Call Log</a>
                    </li>
                </ul>
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
                <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'invoice_printqueue')) ?>">
                    <i class="fa fa-print"></i>
                    <span class="title">Print Queue</span>
                    <span class="arrow "></span>
                </a>
            </li>


        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->