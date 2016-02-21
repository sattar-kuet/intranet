<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse" style="width: 247px; margin-top: 11px;">
        <!-- BEGIN SIDEBAR MENU -->
        <ul class="page-sidebar-menu" data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200">
            <!-- DOC: To remove the sidebar toggler from the sidebar you just need to completely remove the below "sidebar-toggler-wrapper" LI element -->
            <li class="sidebar-toggler-wrapper">
                <!-- BEGIN SIDEBAR TOGGLER BUTTON -->
                <div class="sidebar-toggler">
                </div>
                <!-- END SIDEBAR TOGGLER BUTTON -->
            </li>
            <!-- DOC: To remove the search box from the sidebar you just need to completely remove the below "sidebar-search-wrapper" LI element -->
            <li class="sidebar-search-wrapper">
                <form class="sidebar-search " action="extra_search.html" method="POST">
                    <a href="javascript:;" class="remove">
                        <i class="icon-close"></i>
                    </a>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search...">
                        <span class="input-group-btn">
                            <a href="javascript:;" class="btn submit"><i class="icon-magnifier"></i></a>
                        </span>
                    </div>
                </form>
                <!-- END RESPONSIVE QUICK SEARCH FORM -->
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
            
             <li 
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
            </li>
            
            <li 
            <?php

            $tickets = array('Ticketscreate', 'Ticketsmanage',);
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
                            <i class="fa fa-wrench"></i>
                            Manage</a>
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

            $tickets = array('Ticketsaddmassage',);

            if (in_array($this->name . '' . $this->action, $tickets)):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >

                <a href="javascript:;">
                    <i class="fa fa-envelope"></i>
                    <span class="title">Massage  Management</span>
                    <span class="arrow "></span>
                </a>
                <ul class="sub-menu">
                    <li
                    <?php if ($this->name . '' . $this->action == 'Ticketsaddmassage'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >

                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'addmassage')) ?>">
                            <i class="fa fa-plus"></i>
                            Add Massage</a>
                    </li>
                    

                </ul>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>

<!-- END SIDEBAR -->