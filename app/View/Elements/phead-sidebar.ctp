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
                    <a href="#"><span class="icon16 typ-icon-users"></span>Chunk Management</a>
                    <ul class="sub">
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'chunks','action'=>'create'))?>"><span class="icon16 icomoon-icon-plus"></span>Create Chunk</a>
                        </li>
                     
                        <li>
                            <a href="<?php echo Router::url(array('controller'=>'chunks','action'=>'manage'))?>"><span class="icon16 wpzoom-settings"></span>Manage Chunk</a>
                        </li>
                             
                        </ul>
                    </li>
                
                </ul>
            </div>
        </div><!-- End sidenav -->
</div><!-- End #sidebar -->