<?php echo $this->element('common-header'); ?> 
<?php echo $this->element('admin-header'); ?> 

<?php 
if(isset($sidebar)){
      echo $this->element($sidebar.'-sidebar'); 	
 }
?> 
<?php echo $this->fetch('content'); ?>

<?php echo $this->element('admin-footer'); ?> 