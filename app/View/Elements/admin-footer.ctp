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
            'customerinfo',
            )
);
?>

</body>
<!-- END BODY -->
</html>