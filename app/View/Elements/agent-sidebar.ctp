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
            $tickets = array('Ticketscreate', 'Ticketsmanage', 'Ticketsmy');
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
                    <?php if ($this->name . '' . $this->action == 'Ticketsmy'):
                        ?>
                            class="active"
                            <?php
                        endif;
                        ?>
                        >
                        <a href="<?php echo Router::url(array('controller' => 'tickets', 'action' => 'my')) ?>">
                            <i class="fa fa-wrench"></i>
                            My Tickets</a>
                    </li>
                </ul>           

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
                <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'customer_registration')) ?>">
                    <i class="fa fa-support"></i>
                    <span class="title">Customer Registration</span>
                    <span class="arrow "></span>
                </a>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>


    <!-- END SIDEBAR -->