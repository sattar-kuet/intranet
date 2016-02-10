<?php if($this->request->params['action'] == 'search'){ ?>
<div class="sidebar col-md-2 col-sm-2">
         <div class="portlet box blue-hoki">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-pencil"></i>Search option
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <?php
                        echo $this->Form->create('Location', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate'
                            
                                )
                        );
                        ?>
                        <div class="form-body">
                            <div class="alert alert-danger display-hide">
                                <button class="close" data-close="alert"></button>
                                You have some form errors. Please check below.
                            </div>
                            <?php echo $this->Session->flash(); ?>


                            <div class="form-group">
                             
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input('city_id', array(
                                        'type' => 'select',
                                        'options' => $cities,
                                        'empty' => 'Select Category',
                                        'class' => 'form-control select2me required pclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            <div class="form-group">
                               
                                <div class="col-md-12">
                                    <?php
                                    echo $this->Form->input('id', array(
                                        'type' => 'select',
                                        'options' => $locations,
                                        'empty' => 'Select Category',
                                        'id' =>'cid',
                                        'class' => 'form-control select2me required cclass',
                                            )
                                    );
                                    ?>
                                </div>
                            </div>

                            
                          
                         

                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-offset-7 col-md-4">
                                    <?php
                                    echo $this->Form->button(
                                            'Add', array('class' => 'btn green', 'type' => 'submit')
                                    );
                                    ?>
                                </div>
                            </div>
                        </div>
                        <?php echo $this->Form->end(); ?>
                        <!-- END FORM-->
                    </div>
                    <!-- END VALIDATION STATES-->
                </div>
          </div>
<?php }

  else{ ?>
  <div class="sidebar col-md-4 col-sm-4">
            <ul class="list-group margin-bottom-25 sidebar-menu">
              <li class="list-group-item clearfix"><a href="<?php echo Router::url(array('controller' => 'tolets', 'action' => 'add')) ?>" ><i class="fa fa-angle-right"></i>Add Tolet</a></li>
              <li class="list-group-item clearfix"><a href="<?php echo Router::url(array('controller' => 'tolets', 'action' => 'manage')) ?>"><i class="fa fa-angle-right"></i>Manage My Tolet</a></li>
              <li class="list-group-item clearfix"><a href="<?php echo Router::url(array('controller' => 'tolets', 'action' => 'logout')) ?>"><i class="icon-key"></i>Logout</a></li>
             </ul>
          </div>
  <?php 
  }
 ?>
