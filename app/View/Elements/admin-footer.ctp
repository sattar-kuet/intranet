</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">
        <?php echo date('Y'); ?> &copy; jegeachi.com.
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
            'admin/menu'
            )
);
?>

</body>
<!-- END BODY -->
</html>