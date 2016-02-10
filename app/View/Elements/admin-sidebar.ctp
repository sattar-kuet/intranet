  <div id="wrapper">

    <!--Responsive navigation button-->  
    <div class="resBtn">
        <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
    </div>

    <!--Left Sidebar collapse button-->  
    <div class="collapseBtn leftbar">
       <a href="#" class="tipR" title="Hide Left Sidebar"><span class="icon12 minia-icon-layout"></span></a>
   </div>

   <!--Sidebar background-->
   <div id="sidebarbg"></div>
   <!--Sidebar content-->
   <div id="sidebar">

    <div class="shortcuts">
        <ul>
            <li><a href="support.html" title="Support section" class="tip"><span class="icon24 icomoon-icon-support"></span></a></li>
            <li><a href="#" title="Database backup" class="tip"><span class="icon24 icomoon-icon-database"></span></a></li>
            <li><a href="charts.html" title="Sales statistics" class="tip"><span class="icon24 icomoon-icon-pie-2"></span></a></li>
            <li><a href="#" title="Write post" class="tip"><span class="icon24 icomoon-icon-pencil"></span></a></li>
        </ul>
    </div><!-- End search -->            

    <div class="sidenav">

        <div class="sidebar-widget" style="margin: -1px 0 0 0;">
            <h5 class="title" style="margin-bottom:0">Navigation</h5>
        </div><!-- End .sidenav-widget -->

        <div class="mainnav">
            <ul>
                <li>
                    <a href="#"><span class="icon16 typ-icon-users"></span>Agent Manaement</a>
                    <ul class="sub">
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'admins','action'=>'create'))?>"><span class="icon16 icomoon-icon-plus"></span>Create Agent</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'admins','action'=>'manage'))?>"><span class="icon16 wpzoom-settings"></span>Manage Agent</a>
                        </li>
                             
                        </ul>
                    </li>
                    <li>
                    <a href="#"><span class="icon16 icomoon-icon-basket"></span>Order Management</a>
                    <ul class="sub">
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'orders','action'=>'nocontact'))?>"><span class="icon16 icomoon-icon-phone"></span>No Contact Order</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'orders','action'=>'confirmed'))?>"><span class="icon16 icomoon-icon-checkmark"></span>Confirmed Order</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'orders','action'=>'sold'))?>"><span class="icon16  icomoon-icon-coin"></span>Sold Order</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'orders','action'=>'canceled'))?>"><span class="icon16  iconic-icon-minus-alt "></span>Canceled Orderr</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'admins','action'=>'create'))?>"><span class="icon16 iconic-icon-equalizer"></span>Filter Order</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'orders','action'=>'all'))?>"><span class="icon16 iconic-icon-move"></span>All Order</a>
                        </li>
                             
                        </ul>
                    </li>
                      <li>
                    <a href="#"><span class="icon16 icomoon-icon-calculate-2"></span>Product Management</a>
                    <ul class="sub">
                        <li>
                        <a href="<?php echo Router::url(array('controller'=>'products','action'=>'category'))?>"><span class="icon16 iconic-icon-move-alt2"></span>Add new category</a>
                        </li>
                        <li>
                        <a href="<?php echo Router::url(array('controller'=>'products','action'=>'editcategory'))?>"><span class="icon16 icomoon-icon-pencil-4"></span>Edit category</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'products','action'=>'add'))?>"><span class="icon16 icomoon-icon-plus"></span>Add new product</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'orders','action'=>'confirmed'))?>"><span class="icon16 icomoon-icon-pencil-4"></span>Edit product</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'products','action'=>'import'))?>"><span class="icon16   icomoon-icon-arrow-down-right-2"></span>Import product</a>
                        </li>
                          
                          <li>
                            <a href="<?php echo Router::url(array('controller'=>'products','action'=>'settings'))?>"><span class="icon16 wpzoom-settings"></span>Product Setting</a>
                        </li>
                        </ul>
                    </li>
                       <li>
                    <a href="#"><span class="icon16 icomoon-icon-coins"></span>Finance Management</a>
                    <ul class="sub">
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'orders','action'=>'nocontact'))?>"><span class="icon16   icomoon-icon-plus-2"></span>Confirm Recieve</a>
                        </li>
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'orders','action'=>'confirmed'))?>"><span class="icon16 icomoon-icon-eye-3 "></span>Overall status</a>
                        </li>
                      
                         
                        </ul>
                    </li>
                    <li>
                            <a href="<?php echo Router::url(array('controller'=>'products','action'=>'status'))?>"><span class="icon16  icomoon-icon-eye-3"></span>View Product Status</a>
                        </li> 
                </ul>
            </div>
        </div><!-- End sidenav -->
</div><!-- End #sidebar -->