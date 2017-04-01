<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;
    }

</style>

<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .txtArea { width:300px; }
    ul.pagination {
        display: flex;
        justify-content: center;
    }
</style>

<div class="page-content-wrapper" style="margin: 0px; padding: 0px;">
    <div class="">
        <!-- BEGIN PAGE CONTENT-->
        <div class="invoice" id="printableArea">
            <hr>
            <div class="row">
                <div class="col-xs-12">
                    <div class="alert alert-info clearfix" style="color: #000; font-size: 14px;"> 
                        <p> Total Subscription<b>: <?php echo $data['totalCustomer']; ?></b> &nbsp; &nbsp;&nbsp;&nbsp;
                            Total Paid Amount<b>: $<?php echo $data['totalPayment']; ?> </b> </p>
                    </div> 
                    <ul class="pagination" >
                        <?php
                        for ($i = 1; $i <= $data['total_page']; $i++):
                            $active = '';
                            if (isset($this->params['pass'][0]) && $this->params['pass'][0] == $i) {
                                $active = 'active';
                            }
                            ?>
                            <li class="paginate_button <?php echo $active; ?>" aria-controls="sample_editable_1" tabindex="<?php echo $i; ?>">
                                <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'allautorecurring', $i, $data['start'], $data['end'])) ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th class="sorting_desc">
                                    ID
                                </th>
                                <th>
                                    Customer Detail
                                </th>                                            
                                <th>
                                    Package
                                </th>
                                <th>
                                    Auto Recurring Date
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                                    
                            foreach ($data['allData'] as $results):                                
//                                pr($results); exit;
                                $customer = $results['pc'];
                                $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                        $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                        . $customer['zip'];
                                ?>
                                <tr>
                                    <td class="hidden-480">
                                        <?php echo $results['pc']['id']; ?>                            
                                    </td>
                                    <td class="hidden-480">
                                        <a href="<?php
                                        echo Router::url(array('controller' => 'customers',
                                            'action' => 'edit', $results['pc']['id']))
                                        ?>" 
                                           target="_blank">
                                               <?php echo $results['pc']['first_name'] . ' ' . $results['pc']['middle_name'] . ' ' . $results['pc']['last_name']; ?>
                                        </a><br>
                                        <?php echo $customer_address; ?> 
                                    </td> 
                                    <td>
                                        <?php if (!empty($results['pc']['psetting_id'])): ?>

                                            Name: <?php echo $results['ps']['name'] ?><br>
                                            Duration: <?php echo $results['ps']['duration']; ?><br>
                                            Amount: <?php echo $results['ps']['amount']; ?>
                                        <?php elseif (!empty($results['pc']['custom_package_id'])): ?>

                                            Months: <?php echo $results['cp']['duration'] ?><br>                                                        
                                            Custom package: <?php echo $results['cp']['charge']; ?>

                                        <?php else: ?>
                                            Package not set !
                                        <?php endif; ?>
                                    </td>  
                                    <td><?php echo $results['pc']['r_form']; ?></td>
                                </tr>
                            <?php endforeach; ?>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div> 


