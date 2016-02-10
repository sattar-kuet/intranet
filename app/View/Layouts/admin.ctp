<?php echo $this->element('common-header'); ?> 
<?php echo $this->element('admin-header'); ?> 
<?php

if (!empty($sidebar)) {
    echo $this->element($sidebar . '-sidebar');
} else {
    echo $this->element('admin-sidebar');
}
?>
<?php echo $this->fetch('content'); ?>
<?php echo $this->element('common-footer'); ?> 
