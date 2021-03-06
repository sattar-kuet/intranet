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
            No contact Order List <small>Contact with customer to confirm</small>
        </h3>

        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->
        <div class="row">
            <div class="col-md-12">
                <!-- BEGIN EXAMPLE TABLE PORTLET-->
                <div class="portlet box blue">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-phone"></i>No Contact Order
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
                                    <th> Order ID </th>
                                    <th>Product Info</th>
                                    <th>Name</th>
                                    <th>Mobile</th>
                                    <th>City</th>
                                    <th>Location</th>           
                                    <th>Detail Address</th>           
                                    <th>Time passed</th>
                                    <th>Order From </th>
                                    <th>Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                
                                foreach ($alldata as $k => $single):
                                    $reseller = $single['resellers'];
                                    if(!empty($reseller['api_key']) || $reseller['api_key'] !=null){
                                      $refImg = $this->webroot.'reseller/'.$reseller['img'];
                                      $refInfo = $reseller['name'].' '.$reseller['email'];
                                    }
                                    else{
                                      $refImg = $this->webroot.'img/logo.png';
                                      $refInfo = 'Order from main site';
                                    }
                                    $grantTotal = 0;
                                    $total_pieces = 0;
                                    $order = $single['orders'];
                                    $customer = $single['customers'];
                                    $order_products = $single['order_products'];
                                    $products = $single['products'];
                                    $psettings = $single['psettings'];
                                    ?>
                                    <tr>
                                        <td>
                                            #<?php echo $order['id']; ?>
                                        </td>
                                        <td>
                                            <div style="text-align: center;">
                                                <button  class="product_toggle" id="p<?php echo$k + 1; ?>"><span class="fa fa-eye"></span></button>
                                            </div>
                                            <div class="top-cart-content-wrapper display-hide" id="info-p<?php echo$k + 1; ?>">

                                                <?php foreach ($products as $key => $product):
                                                    ?>


                                                    <li>
                                                        <a href="javascript:void(0)">
                                                            <img src="<?php echo $this->webroot . 'productImages/small/' . $psettings[$key]['small_img'] ?>" width="37" height="34"></a>
                                                        <span class="cart-content-count">x <?php
                                                            $total_pieces+=$order_products[$key]['pieces'];
                                                            echo $order_products[$key]['pieces'];
                                                            ?></span>
                                                        <span>
                                                            <?php
                                                            echo $product['name'] . ' By ' . $product['writer'];
                                                            ;
                                                            ?>
                                                        </span>

                                                        <em style="color:red;"><?php
                                                            $discount = $psettings[$key]['sppp'] * $psettings[$key]['discount'] / 100;
                                                            $total = ceil($psettings[$key]['sppp'] - $discount);
                                                            $total *=$order_products[$key]['pieces'];
                                                            //$total +=$psettings[$key]['service_charge'];
                                                            $grantTotal +=$total;
                                                            echo $total;
                                                            ?> TK</em>
                                                    </li>



                                                <?php endforeach; ?>

                                                <div class="alert alert-info">
                                                    <strong>    Service Charge : <?php echo $sc; ?>TK</strong> 
                                                </div>

                                                <a href="#" class="btn purple pull-right" >
                                                    Grant Total : <?php $totalWithSc = $grantTotal + $sc; echo $grantTotal + $sc; ?>TK</a>

                                            </div>  
                                        </td>
                                        <td><?php echo $customer['name']; ?></td>

                                        <td> <a href="tel:<?php echo $customer['mobile']?>"><?php echo $customer['mobile'];?></a><br/><a href="tel:<?php echo $customer['alt_mobile']?>"><?php echo $customer['alt_mobile'];?></a></td>
                                        <td><?php echo $single['city']['name']; ?></td>
                                        <td><?php echo $single['location']['name']; ?></td>
                                        <td><?php echo $customer['detail_addr']; ?></td>
                                        <td>
                                            <?php echo passedTime($order['created']); ?>
                                        </td>
                                        <td><img height="50" width="50" style="border-radius:50px !important;" src="<?php echo $refImg; ?>" alt="<?php echo $refInfo;?>"  title="<?php echo $refInfo; ?>" /> </td>
                                        <td>

                                            <a 
                                                onclick="if (confirm('Are you sure to cancel this order?')) {
                                                                return true;
                                                            }
                                                            return false;"

                                                href="<?php
                                                echo Router::url(array('controller' => 'orders', 'action' => 'cancel', $order['id'])
                                                )
                                                ?>" ><span class="fa fa-ban" title="cancel"></span></a>


                                            &nbsp;
                                            <a  data-toggle="modal" href="#confirmModal<?php echo $order['id']; ?>" > <span class="fa fa-check" title="confirm"></span> </a>

                                            &nbsp;
                                            <a target="_blank" title="edit" href="<?php echo Router::url(array('controller' => 'orders', 'action' => 'edit', $order['id'])) ?>" >
                                                <span class="fa fa-pencil"></span></a>
                                                
                                             &nbsp; 
                                             <?php if(!$order['cashed']){?>
                                             
                                              <a 
                                               onclick="if (confirm('Are you sure that you received cash for this order?')) {
                                                           return true;
                                                       }
                                                       return false;"

                                               href="<?php
                                               echo Router::url(array('controller' => 'orders', 'action' => 'pay', $order['id'].'#'.$totalWithSc)
                                               );
                                               ?>" class="tip"><span class="fa fa-dollar" title="Cashed"></span></a>
                                             
                                             <?php } 
                                               else{ ?>
                                                  
                                                 <a 
                                               onclick="if (confirm('Are you sure to undo payment for this order?')) {
                                                           return true;
                                                       }
                                                       return false;"

                                               href="<?php
                                               echo Router::url(array('controller' => 'orders', 'action' => 'unpay', $order['id'])
                                               );
                                               ?>" class="tip"><span class="fa fa-refresh" title="undo payment"></span></a>
                                               
                                               
                                               <?php
                                               }
                                             ?>   
                                           
                                               
                                              
                                        </td>

                                    </tr>

                                <div id="confirmModal<?php echo $order['id']; ?>" class="modal fade" tabindex="-1" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                                                <h4 class="modal-title">Set delivery time and hit <em>Confirm</em> button </h4>
                                                <div id="info-container">

                                                </div>
                                            </div>
                                            <div class="modal-body">
                                                <div class="scroller" style="height:300px" data-always-visible="1" data-rail-visible1="1">
                                                    <div class="col-md-12">
                                                        <div class="portlet-body form">
                                                            <?php
                                                            echo $this->Form->create('Order', array(
                                                                'inputDefaults' => array(
                                                                    'label' => false,
                                                                    'div' => false
                                                                ),
                                                                'class' => 'form-horizontal form-validate',
                                                                'novalidate' => 'novalidate',
                                                                'action' => 'confirm'
                                                                    )
                                                            );
                                                            ?>
                                                            <div class="form-body">
                                                                <?php echo $this->Form->input('id', array('value' => $order['id'])); ?>
                                                                <?php echo $this->Form->input('cashed', array('value' => $grantTotal, 'class' => 'hide')); ?>

                                                                <div class="form-group" style="margin-bottom: 0px;">
                                                                    <div class="col-md-6">
                                                                        <div class="input-group input-medium date date-picker" data-date-format="dd-mm-yyyy" data-date-start-date="+0d">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'dDate', array(
                                                                                'class' => 'form-control required',
                                                                                'type' => 'text',
                                                                                'readonly' => true
                                                                                    )
                                                                            );
                                                                            ?>
                                                                            <span class="input-group-btn">
                                                                                <button class="btn default" type="button"><i class="fa fa-calendar"></i></button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group" >
                                                                    <div class="col-md-6">
                                                                        <div class="input-group">
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'dTime', array(
                                                                                'class' => 'form-control timepicker timepicker-no-seconds required',
                                                                                'type' => 'text'
                                                                                    )
                                                                            );
                                                                            ?>
                                                                            <span class="input-group-btn">
                                                                                <button class="btn default" type="button"><i class="fa fa-clock-o"></i></button>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <br/>
                                                                <br/>
                                                                <br/>
                                                                <div class="form-group">
                                                                    <label class="control-label col-md-3">Comment
                                                                    </label>
                                                                    <div class="col-md-9">
                                                                        <div class="input-icon right">
                                                                            <i class="fa"></i>
                                                                            <?php
                                                                            echo $this->Form->input(
                                                                                    'comment', array(
                                                                                'type' => 'textarea',
                                                                                'class' => 'form-control'
                                                                                    )
                                                                            );
                                                                            ?>
                                                                        </div>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" data-dismiss="modal" class="btn default">Close</button>
                                                <?php
                                                echo $this->Form->button(
                                                        'Confirm', array('class' => 'btn green', 'type' => 'submit')
                                                );
                                                ?>
                                                <?php echo $this->Form->end(); ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <?php
                            endforeach;
                            ?>
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