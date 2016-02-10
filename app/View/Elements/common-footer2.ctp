</div><!-- End #wrapper -->

<!--[if lt IE 9]>
<script src="../../assets/global/plugins/respond.min.js"></script>
<script src="../../assets/global/plugins/excanvas.min.js"></script> 
<![endif]-->

<?php echo $this->Html->script(
  array(
   '/assets/global/plugins/jquery.min',
   '/assets/global/plugins/jquery-migrate.min',
   '/assets/global/plugins/jquery-ui/jquery-ui-1.10.3.custom.min',
   '/assets/global/plugins/bootstrap/js/bootstrap.min',
   '/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min',
   '/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min',
   '/assets/global/plugins/jquery.blockui.min',
   '/assets/global/plugins/jquery.cokie.min',
   '/assets/global/plugins/uniform/jquery.uniform.min',
   '/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min',
   '/assets/global/plugins/fancybox/source/jquery.fancybox.pack',
   '/assets/global/plugins/jquery-file-upload/js/vendor/jquery.ui.widget',
   
   '/assets/global/plugins/jquery-file-upload/js/vendor/tmpl.min',
   '/assets/global/plugins/jquery-file-upload/js/vendor/load-image.min',
   '/assets/global/plugins/jquery-file-upload/js/vendor/canvas-to-blob.min',
   '/assets/global/plugins/jquery-file-upload/blueimp-gallery/jquery.blueimp-gallery.min',
   '/assets/global/plugins/jquery-file-upload/js/jquery.iframe-transport',
   '/assets/global/plugins/jquery-file-upload/js/jquery.fileupload',
   '/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-process',
   '/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-image',
   
   '/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-audio',
   '/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-video',
   '/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-validate',
   '/assets/global/plugins/jquery-file-upload/js/jquery.fileupload-ui',
   
   )
   );
   ?>
   
   <!-- The main application script -->
<!-- The XDomainRequest Transport is included for cross-domain file deletion for IE 8 and IE 9 -->
<!--[if (gte IE 8)&(lt IE 10)]>
    <script src="../../assets/global/plugins/jquery-file-upload/js/cors/jquery.xdr-transport.js"></script>
    <![endif]-->
<!-- END:File Upload Plugin JS files-->

<?php
echo $this->Html->script(
  array(
   '/assets/global/scripts/metronic',
   '/assets/admin/layout/scripts/layout',
   '/assets/admin/layout/scripts/quick-sidebar',
   '/assets/admin/layout/scripts/demo',
   '/assets/admin/pages/scripts/form-fileupload'
   
   )
); 
?>

<script>
        jQuery(document).ready(function() {
        // initiate layout and plugins
        Metronic.init(); // init metronic core components
Layout.init(); // init current layout
QuickSidebar.init(); // init quick sidebar
Demo.init(); // init demo features
        FormFileUpload.init();
        });
    </script>
    
</body>
</html>