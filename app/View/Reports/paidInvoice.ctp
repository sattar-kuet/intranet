
<style type="text/css">
    .alert {
        padding: 6px;
        margin-bottom: 5px;
        border: 1px solid transparent;
        border-radius: 4px;
        text-align: center;
    }
    .txtArea { width:300px; }
    .signupfont{
        font-size: 14px !important; 
    }
    .fancybox-inner{
        width:844px !important;
    }
    .fancybox-wrap {
        width: 860px !important;
    }
</style>

<div class="page-content-wrapper">
    <!-- BEGIN PAGE CONTENT-->
    <div class="page-content">
        <div  class="col-md-12 col-sm-12">
            <h3 class="page-title">
                Complete the transactions <small>(individually)</small>
            </h3>
            <?php echo $this->Session->flash(); ?>
            <!-- END EXAMPLE TABLE PORTLET-->
            <div class="col-md-12">
                <!-------------payment history start----------------->
                <div  class="col-md-12 col-sm-12">
                    <div>
                        <div class="portlet box " style="background-color: tomato; border: tomato solid 2px;">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-list-ul"></i>Statement
                                </div>
                                <div class="tools">
                                    <a  class="reload toggle" data-id="transaction" ></a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                    <div class="row" id="transaction" style="display: none;">
                                        <div  class="col-md-12 col-sm-12">
                                            <div  class="col-md-9 col-sm-9">
                                            </div>  
                                        </div>
                                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%" >
                                            <thead>
                                                <tr >  
                                                    <th>Invoice</th>
                                                    <th>Payment info</th>
                                                    <th>Amount</th>
                                                    <th>Balance</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $balance = array();
                                                foreach ($data['transactions'] as $single):
                                                    $bill = $single['bill'];
                                                    $payments = $single['payment'];

                                                    $amount = $bill['payable_amount'];
                                                    if ($bill['status'] == 'approved') {
                                                        $amount = (-1) * $bill['payable_amount'];
                                                    }
                                                    $balance[] = $amount;
                                                    // $prevIndex = -1;
                                                    $payment_date = $bill['next_payment'];

                                                    $payment_time = strtotime($payment_date);
                                                    $currenttime = strtotime(date('Y-m-d'));
                                                    $next7days = strtotime("+7 day");
                                                    $time_remaining = $next7days - $payment_time;
                                                    $diff = 7 * 24 * 60 * 60;
//                                                echo $next7days;
//                                                echo ':'.$payment_time.'<br>'.$diff;
//                                                echo '<hr>';

                                                    if (count($balance) > 1) {
                                                        $prevIndex = count($balance) - 2;
                                                        $balance[] = $balance[$prevIndex] + $balance[$prevIndex + 1];
                                                    }
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td>
                                                            <a href="#invoice-pop-up<?php echo $bill['id']; ?>" class="btn btn-default fancybox-fast-view"> <?php echo empty($bill['invoice']) ? $bill['id'] : $bill['invoice']; ?></a><br>
                                                        </td>
                                                        <td>
                                                <li>
                                                    Payable Amount : <?php echo $bill['payable_amount']; ?> 
                                                </li>
                                                <li>
                                                    Invoice Date : 
                                                    <?php echo date('m-d-Y', strtotime($bill['next_payment'])); ?>
                                                    <a  target="_blank" title="Edit" href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $bill['id'])) ?>" >
                                                        <span class="fa fa-pencil " target ="_blank"></span>
                                                    </a>
                                                </li>
                                                </td>
                                                <td>
                                                    <?php
                                                    echo $amount; // + $bill['discount'];
                                                    ?>
                                                </td>
                                                <td>
                                                    <?php echo end($balance); ?>
                                                </td>
                                                </tr>

                                                <?php
//                                                  pr('hh'); exit;
                                                foreach ($data['transactions'] as $payment):
                                                    
                                                    $amount = -1 * $payment['tr']['payable_amount'];
                                                    $balance[] = $amount;
                                                    $prevIndex = count($balance) - 2;
                                                    $balance[] = $balance[$prevIndex] + $balance[$prevIndex + 1];
                                                    ?>
                                                    <tr class="odd gradeX">
                                                        <td> 
                                                            <a href="#invoice-pop-up<?php echo $payment['tr']['id']; ?>" class="btn btn-default fancybox-fast-view"> <?php echo empty($payment['tr']['invoice']) ? $payment['tr']['id'] : $payment['tr']['invoice']; ?></a><br>
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <?php if ($payment['tr']['pay_mode'] == 'card'): ?>

                                                                    <li>Pay Mode : <?php echo $payment['tr']['pay_mode']; ?></li> 
                                                                    <li>Status : <?php echo $payment['tr']['status']; ?></li>
                                                                    <?php if ($payment['tr']['status'] == 'error'): ?>
                                                                        <ul>
                                                                            <li>Error Message : <?php echo $payment['tr']['error_msg']; ?></li> 
                                                                        </ul>
                                                                    <?php endif;
                                                                    ?>
                                                                    <li>Transaction No : <?php echo $payment['tr']['trx_id']; ?></li> 
                                                                    <li>Card No : <?php echo substr($payment['tr']['card_no'], -4); ?></li>  
                                                                    <li>Zip Code : <?php echo $payment['tr']['zip_code']; ?></li>  
                                                                    <li>Expire Date : <?php echo $payment['tr']['exp_date']; ?></li>
                                                                <?php elseif ($payment['tr']['pay_mode'] == 'cash'): ?>
                                                                    <li>Pay Mode : <?php echo $payment['tr']['pay_mode']; ?></li> 
                                                                    <li> Cash By : <?php echo $payment['tr']['cash_by']; ?> </li>
                                                                    <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $payment['tr']['id'])) ?>" >
                                                                        <span class="fa fa-pencil" target ="_blank"></span>
                                                                    </a>
                                                                <?php elseif ($payment['tr']['pay_mode'] == 'refund'): ?>
                                                                    <li>Pay Mode : <?php echo $payment['tr']['pay_mode']; ?></li>
                                                                    <li>Check Info : <?php echo $payment['tr']['check_info']; ?></li>
                                                                    <ul> <li>Amount : <?php echo $payment['tr']['paid_amount']; ?></li>
                                                                        <li>Refund Date : <?php echo date('m-d-Y', strtotime($payment['tr']['created'])); ?></li>
                                                                    </ul>
                                                                    <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $payment['tr']['id'])) ?>" >
                                                                        <span class="fa fa-pencil" target ="_blank"></span>
                                                                    </a>
                                                                <?php else: ?>
                                                                    <li>Pay Mode : <?php echo $payment['tr']['pay_mode']; ?></li> 
                                                                    <li>Check Info : <?php echo $payment['tr']['check_info']; ?></li>
                                                                    <?php if (!empty($payment['tr']['check_image'])): ?>
                                                                        <img src="<?php echo $this->webroot . 'check_images' . '/' . $payment['tr']['check_image']; ?>"  width="50px" height="50px" />
                                                                    <?php endif; ?>
                                                                    <a  target="_blank" title="Edit"  href="<?php echo Router::url(array('controller' => 'transactions', 'action' => 'edit', $payment['tr']['id'])) ?>" >
                                                                        <span class="fa fa-pencil" target ="_blank"></span>
                                                                    </a>
                                                                <?php endif; ?> 

                                                                <li> Payment Date: <?php echo date('m-d-Y', strtotime($payment['tr']['created'])); ?> </li>
                                                                <li> Payment of : #<?php echo $payment['tr']['transaction_id']; ?> </li>
                                                            </ul>
                                                        </td>
                                                        <td>
                                                            <?php
                                                            echo $amount;
                                                            ?>
                                                        </td>
                                                        <td><?php echo end($balance); ?></td>
                                                    </tr>

                                                <?php endforeach; ?>
                                                <?php
                                            endforeach;
                                            $due = end($balance);
                                            echo '<span class="due-amount-2 hide">' . $due . '</span>';
                                            ?>
                                            </tbody>
                                        </table>
                                    </div>                                 
                            </div>
                        </div>
                    </div>
                    <!-- END CONTENT -->        
                </div>
            </div>