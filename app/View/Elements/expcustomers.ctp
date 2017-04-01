<div class="col-md-12">
    <!-- BEGIN EXAMPLE TABLE PORTLET-->
    <div class="portlet box green">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa ">Total Customers: <?php echo count($data); ?></i>
            </div>
            <div class="tools">
                <a href="javascript:;" class="reload">
                </a>
            </div>
        </div>
        <div class="portlet-body">
            <?php echo $this->Session->flash(); ?> 
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr> 
                                <th class="hidden-480">
                                    Account no.
                                </th>
                                <th class="hidden-480">
                                    Name
                                </th>
                                <th class="hidden-480">
                                    Address
                                </th>
                                <th class="hidden-480">
                                    Mac
                                </th>
                                <th class="hidden-480">
                                    Cell
                                </th>
                                <th>
                                    Package
                                </th>
                                <th class="hidden-480">
                                    Due
                                </th>
                                <th class="hidden-480">
                                    Exp Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>                                    
                            <?php
                            foreach ($data as $info):
                                $customer_address = $info['PackageCustomer']['house_no'] . ' ' . $info['PackageCustomer']['street'] . ' ' .
                                        $info['PackageCustomer']['apartment'] . ' ' . $info['PackageCustomer']['city'] . ' ' . $info['PackageCustomer']['state'] . ' '
                                        . $info['PackageCustomer']['zip'];
                                ?>
                                <tr>
                                    <td><?php echo $info['PackageCustomer']['id']; ?></td>
                                    <td> <a href="<?php echo Router::url(array('controller' => 'customers', 'action' => 'edit', $info['PackageCustomer']['id'])) ?>" target="_blank"><?php echo $info['PackageCustomer']['first_name'] . " " . $info['PackageCustomer']['middle_name'] . " " . $info['PackageCustomer']['last_name']; ?></a> </td>
                                    <td><?php echo $customer_address; ?></td>
                                    <td><?php echo $info['PackageCustomer']['mac']; ?></td>
                                    <td><?php echo $info['PackageCustomer']['cell']; ?></td>
                                    <td>
                                        <?php
                                        if (!empty($info['PackageCustomer']['psetting_id'])) {
                                            echo $info['Psetting']['name'];
                                        } elseif (!empty($info['PackageCustomer']['custom_package_id'])) {
                                            echo $info['CustomPackage']['duration'] . ' Months, Custom package ' . $info['CustomPackage']['charge'] . '$';
                                        } else {
                                            echo 'Package not set !';
                                        }
                                        ?>
                                    </td>
                                    <td>$<?php echo $info['PackageCustomer']['payable_amount']; ?></td>                                               
                                    <td><?php echo date('m-d-Y', strtotime($info['PackageCustomer']['package_exp_date'])); ?></td>
                                </tr>
                            <?php endforeach; ?>                           
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- END EXAMPLE TABLE PORTLET-->
    </div>
</div>