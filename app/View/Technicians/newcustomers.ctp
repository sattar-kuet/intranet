<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
</style>
<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <h3 class="page-title">
            Follow up Customer List <small></small>
        </h3>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box green">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-user"></i>
                        </div>

                        <div class="tools">
                            <a href="javascript:;" class="reload">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <?php echo $this->Session->flash(); ?> 
                        <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                            <thead>
                                <tr>
                                    <th class="hidden-480">
                                        Name
                                    </th>
                                    <th class="hidden-480">
                                        Address
                                    </th>
                                    <th class="hidden-480">
                                        Emergency Contact
                                    </th>
                                    <th class="hidden-480">
                                        Dead line
                                    </th>
                                    <th>
                                        Wear
                                    </th>                              
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($filteredData as $results):
                                    $customer = $results['customers'];
                                    $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                            $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                            . $customer['zip'];
                                    ?>
                                    <tr>
                                        <td>
                                            <?php
                                            echo $results['customers']['first_name'] . " " .
                                            $results['customers']['middle_name'] . " " .
                                            $results['customers']['last_name'];
                                            ?>
                                        </td>
                                        <td>
                                            <?php echo $customer_address; ?> 
                                        </td>
                                        <td class="hidden-480">  
                                            <?php if (!empty($results['customers']['cell'])): ?> 
                                                Cell:    <?php echo $results['customers']['cell']; ?>   
                                            <?php endif; ?>
                                            <br>
                                            <?php if (!empty($results['customers']['home'])): ?>
                                                Home : <?php echo $results['customers']['home']; ?>
                                            <?php endif ?>
                                        </td>
                                        <td>
                                            <?php echo $results['customers']['from']; ?>- -
                                            <?php echo $results['customers']['to']; ?> 
                                        </td>
                                        <td class="hidden-480">
                                            <?php echo $results['customers']['wire']; ?> 
                                        </td>                                        
                                    </tr>
                                <?php endforeach; ?>                           
                            </tbody>
                        </table>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>
        <!-- END PAGE CONTENT -->
    </div>
</div>
<!-- END CONTENT -->
