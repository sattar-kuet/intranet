<?php
echo $this->Html->css(
        array(
            '/assets/admin/layout/css/layout',
            '/assets/admin/layout/css/themes/darkblue',
            '/assets/admin/layout/css/custom',
            
            // date range picker css
            '/jquery-ui-daterangepicker-0.4.3/jquery-ui.min',
            '/jquery-ui-daterangepicker-0.4.3/bootstrap.min',
            '/jquery-ui-daterangepicker-0.4.3/bootstrap-theme.min',
            '/jquery-ui-daterangepicker-0.4.3/styles',
            '/jquery-ui-daterangepicker-0.4.3/prettify',
            '/jquery-ui-daterangepicker-0.4.3/jquery.comiseo.daterangepicker'
        )
);
?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<!-- DOC: Apply "page-header-fixed-mobile" and "page-footer-fixed-mobile" class to body element to force fixed header or footer in mobile devices -->
<!-- DOC: Apply "page-sidebar-closed" class to the body and "page-sidebar-menu-closed" class to the sidebar menu element to hide the sidebar by default -->
<!-- DOC: Apply "page-sidebar-hide" class to the body to make the sidebar completely hidden on toggle -->
<!-- DOC: Apply "page-sidebar-closed-hide-logo" class to the body element to make the logo hidden on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-hide" class to body element to completely hide the sidebar on sidebar toggle -->
<!-- DOC: Apply "page-sidebar-fixed" class to have fixed sidebar -->
<!-- DOC: Apply "page-footer-fixed" class to the body element to have fixed footer -->
<!-- DOC: Apply "page-sidebar-reversed" class to put the sidebar on the right side -->
<!-- DOC: Apply "page-full-width" class to the body element to have full width page without the sidebar menu -->
<body class="page-header-fixed page-quick-sidebar-over-content ">
    <!-- BEGIN HEADER -->
    <div class="page-header navbar navbar-fixed-top"> 
        <!-- BEGIN HEADER INNER -->
        <div class="page-header-inner">
            <div class="page-logo">

                <a href="#">

                    <img src="<?php echo $this->webroot; ?>images/support_icon_headset_orange.png" alt="logo" class="logo-default" style="margin: 9px 0 0 0;">
                </a>
                <div class="menu-toggler sidebar-toggler hide">
                    <!-- DOC: Remove the above "hide" to enable the sidebar toggler button on header -->
                </div>
            </div>
            <div class="top-menu">
                <ul class="nav navbar-nav pull-right">



                    <!-- DOC: Apply "dropdown-dark" class after below "dropdown-extended" to change the dropdown styte -->
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?php echo $this->webroot; ?>images/support-512.png">
                            <span class="username username-hide-on-mobile">
                                You</span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">

                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'logout')) ?>">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>

                    <!-- END QUICK SIDEBAR TOGGLER -->
                </ul>
            </div>


        </div>
        <!-- END HEADER INNER -->
    </div>
    <!-- END HEADER -->
    <div class="clearfix">
    </div>
    <!-- BEGIN CONTAINER -->
    <div class="page-container">