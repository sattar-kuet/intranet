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
                $technicians = array('Techniciansnew');
                if ($this->name . '' . $this->action == 'Techniciansnew'):
                    ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'newcustomers')) ?>">
                    <i class="fa icon-umbrella"></i>
                    <span class="title"> New</span>
                    <span class="arrow "></span>
                </a>
            </li>
            <li
            <?php
            $technicians = array('Techniciansdone');
            if ($this->name . '' . $this->action == 'Techniciansdone'):
                ?>
                    class="active"
                    <?php
                endif;
                ?>
                >
                <a href="<?php echo Router::url(array('controller' => 'technicians', 'action' => 'active_customers')) ?>">
                    <i class="fa icon-check"></i>
                    <span class="title"> Done</span>
                    <span class="arrow "></span>
                </a>
            </li>

        </ul>
        <!-- END SIDEBAR MENU -->
    </div>


    <!-- END SIDEBAR -->