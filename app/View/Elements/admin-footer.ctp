</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
      
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<?php echo $this->element('common-footer'); ?> 
<?php
echo $this->Html->script(
        array(
            'admin/ajaxLoad',
            'admin/orderManagement',
            'admin/menu',
            
            //div view by payment category
            'customerinfo',     
            
            // datepicker range            
            '/jquery-ui-daterangepicker-0.4.3/jquery-ui',
            '/jquery-ui-daterangepicker-0.4.3/moment.min',
            '/jquery-ui-daterangepicker-0.4.3/jquery.comiseo.daterangepicker'
            
            )
);
?>

</body>
<!-- END BODY -->
</html>