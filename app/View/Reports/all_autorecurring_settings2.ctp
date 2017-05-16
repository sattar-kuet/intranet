<?php  //pr($data); exit;?>
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
                                <a href="<?php echo Router::url(array('controller' => 'reports', 'action' => 'allAutorecurringSettings', $i, $data['start'], $data['end'])) ?>"><?php echo $i; ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                    <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                        <thead>
                            <tr>
                                <th>
                                    Customer Detail
                                </th>
                            
                                <th>
                                    Auto recurring Detail
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            foreach ($data['allData'] as $results):
<<<<<<< HEAD:app/View/Reports/all_autorecurring_settings2.ctp
                               // pr($results); exit;

                                $customer = $results['pc'];
=======
                                $customer = $results['package_customers'];
>>>>>>> ca59ad6461495e6bf58c4bff14140e61e2c9e5f9:app/View/Reports/allAutorecurring.ctp
                                $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                                        $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                                        . $customer['zip'];
                                ?>
                                <tr>
                                  
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
                                       
                           

                            <td class="hidden-480">
                                
                                <li> <b>Auto Recurring :</b> <?php echo $results['pc']['auto_r']; ?> </li>                           
                                <li> <b>Repeating interval :</b> <?php echo $results['pc']['r_duration']; ?> </li>                           
                                <li> <b>Payment Date :</b> <?php echo $results['pc']['recurring_date']; ?> </li>                           
                                <li> <b>Recurring From Date :</b> <?php echo $results['pc']['r_form']; ?> </li>                           
                                <li> <b>Payable Amount :</b> <?php echo $results['pc']['payable_amount']; ?> </li>                           
                                <li> <b>Card No :</b> <?php echo $results['pc']['card_check_no']; ?> </li>                           
                                <li> <b>Expire Date :</b> <?php echo $results['pc']['exp_date']; ?> </li>                           
                                <li> <b>First Name :</b> <?php echo $results['pc']['cfirst_name'] ?></li>
                                <li> <b>Last Name : </b><?php echo $results['pc']['clast_name']; ?> </li>                           
                                <li> <b>CVV Code :</b> <?php echo $results['pc']['cvv_code']; ?></li>                           
                                <li> <b>Zip :</b> <?php echo $results['pc']['czip']; ?></li>  
                           
                            </td>
                            </tr>
                        <?php endforeach; ?>  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



