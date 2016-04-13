<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE CONTENT-->
        <div class="portlet box yellow">
            <div class="portlet-title">
                <div class="caption">
                    <li class="dropdown dropdown-user">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
                            <img alt="" class="img-circle" src="<?php echo $this->webroot; ?>images/support-512.png">
                            <span class="username username-hide-on-mobile">
                                <?php echo $loggedUser; ?></span>
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="dropdown-menu dropdown-menu-default">

                            <li>
                                <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'logout')) ?>">
                                    <i class="icon-key"></i> Log Out </a>
                            </li>
                        </ul>
                    </li>
                </div>

            </div>
            <div class="portlet-body">
             <?php echo $this->Session->flash(); ?>
             
                <div class="panel-group accordion" id="accordion3">
                 
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1" aria-expanded="false">
                                    ADD EXPENSE ITEM</a>
                            </h4>
                        </div>
                        <div id="collapse_3_1" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body" style="height:200px; overflow-y:auto;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box green">
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <?php
                                                echo $this->Form->create('Expense', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form_sample_3',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                     'url' => array('controller'=>'customers', 'action'=>'addexpense')
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
                                                            echo $this->Form->input(
                                                                    'name', array(
                                                                'class' => 'form-control required',
                                                                'placeholder' => 'Comany Name',
                                                                'type' => 'text'
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
                                                                    'Add', array('class' => 'btn green pull-right', 'type' => 'submit')
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
                                </div>
                            </div>
                        </div>
                        <div id="collapse_3_2" class="panel-collapse collapse" aria-expanded="false" style="height: 0px;">
                            <div class="panel-body" style="height:200px; overflow-y:auto;">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box green">
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <?php
                                                echo $this->Form->create('Company', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form_sample_3',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                     'url' => array('controller'=>'customers', 'action'=>'addcompany')
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
                                                            echo $this->Form->input(
                                                                    'name', array(
                                                                'class' => 'form-control required',
                                                                'placeholder' => 'Comany Name',
                                                                'type' => 'text'
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
                                                                    'Add', array('class' => 'btn green pull-right', 'type' => 'submit')
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
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_3" aria-expanded="false">
                                    ADD PRODUCT </a>
                            </h4>
                        </div>
                        <div id="collapse_3_3" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box green">
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <?php
                                                echo $this->Form->create('Product', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form_sample_3',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'url' => array('controller'=>'products', 'action'=>'add')
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
                                                            echo $this->Form->input(
                                                                    'name', array(
                                                                'class' => 'form-control required',
                                                                'placeholder' => 'Product Name',
                                                                'type' => 'text'
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
                                                                    'Add', array('class' => 'btn green pull-right', 'type' => 'submit')
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
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_4" aria-expanded="false">
                                    IMPORT PRODUCT </a>
                            </h4>
                        </div>
                        <div id="collapse_3_4" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="portlet box green">
                                            <div class="portlet-body form">
                                                <!-- BEGIN FORM-->
                                                <?php
                                                echo $this->Form->create('Import', array(
                                                    'inputDefaults' => array(
                                                        'label' => false,
                                                        'div' => false
                                                    ),
                                                    'id' => 'form_sample_3',
                                                    'class' => 'form-horizontal',
                                                    'novalidate' => 'novalidate',
                                                    'url' => array('controller'=>'products', 'action'=>'import')
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
                                                            echo $this->Form->input('product_id', array(
                                                                'type' => 'select',
                                                                'options' => $products,
                                                                'empty' => 'Select Material',
                                                                'class' => 'form-control select2me required',
                                                                    )
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>

                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'stock', array(
                                                                'class' => 'form-control required',
                                                                'placeholder' => 'Quantity',
                                                                'type' => 'text'
                                                                    )
                                                            );
                                                            ?>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="col-md-12">
                                                            <?php
                                                            echo $this->Form->input(
                                                                    'cost', array(
                                                                'class' => 'form-control required',
                                                                'placeholder' => 'Total Cost',
                                                                'type' => 'text'
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
                                                                    'Import', array('class' => 'btn green pull-right', 'type' => 'submit')
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
                                </div>

                            </div>
                        </div>
                    </div>

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h4 class="panel-title">
                                <a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_5" aria-expanded="false">
                                    View REPORT </a>
                            </h4>
                        </div>
                        <div id="collapse_3_5" class="panel-collapse collapse" aria-expanded="false">
                            <div class="panel-body">
                             <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
            <thead>
                <tr>
                    <th>Company Name</th>
                    <th>Material Name</th>
                    <th>Material Price </th>
                    <th>Sales Man</th>
                    <th>Costing</th>
                    <th>Bill</th>
                    <th>Check</th>
                    <th>Profit</th>
                    <th>Due</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($filteredArray as $single):
                    $bppu = $single['imports']['cost'] / $single['imports']['stock'];
                    $bp = $bppu*$single['reports']['quantity'];
                    $sp = $single['reports']['bill'] + $single['reports']['check'];
                    $total_cost = $single['reports']['trx_cost']+ $single['reports']['entertainment_cost'] + $single['reports']['food_cost'] + $single['reports']['delivery_cost']; 
                    $profit = $bp - $sp - $total_cost;
                    $due = $single['reports']['material_price'] - $single['reports']['bill'] - $single['reports']['check'];
                    
                    ?>
                    <tr class="odd gradeX">
                        <td><?php echo $single['companies']['name']; ?></td>
                        <td><?php echo $single['products']['name']; ?></td>
                        <td><?php echo $single['reports']['material_price']; ?></td>
                        <td><?php echo $single['reports']['sales_man_name']; ?></td>
                        <td>
                        <ul> 
                        <li>Transportation: <?php echo $single['reports']['trx_cost']; ?> </li>
                        <li>Entertainment: <?php echo  $single['reports']['entertainment_cost'];?></li>
                        <li>Food: <?php echo $single['reports']['food_cost'];?> </li>
                        <li>Delivary: <?php echo $single['reports']['delivery_cost']; ?> </li>
                        <li>Total: <?php echo $total_cost; ?> </li>
                        </ul> 
                        </td>
                       
                        <td><?php echo $single['reports']['bill']; ?> BDT</td>
                        <td><?php echo $single['reports']['check']; ?> BDT</td>
                        <td><?php echo $profit; ?> BDT</td>
                        <td><?php echo $due; ?> BDT </td>
                    </tr>
                    <?php
                endforeach;
                ?>
            </tbody>
        </table>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--END content after clicked-->
    </div>
</div>
<!-- END CONTENT -->