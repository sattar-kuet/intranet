<div class="page-content-wrapper">
    <div class="page-content">
        <!-- BEGIN PAGE HEADER-->
        <div class="page-bar">
            <ul class="page-breadcrumb">
                <li>   </li>
                <li>   </li>
                <li>   </li>
            </ul>
            <script></script>
            <div class="page-toolbar">
                <div class="btn-group pull-right">
                    <a id="btnclick" class="btn btn-lg blue hidden-print margin-bottom-5" target="_blank" onclick="printDiv('printableArea')">
                        Print <i class="fa fa-print"></i>
                    </a>

                </div>
            </div>
        </div>
        <!-- END PAGE HEADER-->
        <!-- BEGIN PAGE CONTENT-->

        <div class="invoice" id="printableArea">
            <div class="row invoice-logo">
                <div class="col-xs-12 invoice-logo-space">
                    <!--<img src="../../assets/admin/pages/media/invoice/walmart.png" class="img-responsive" alt="">-->
                    <div class="row">
                        <div class="col-xs-6">
                            <h3 class="page-title">
                                Follow up Customer List <small></small>
                            </h3>
                        </div>
                        <div class="col-xs-4">
                        </div>
                        <div class="col-xs-2 invoice-payment">
                            <div style="text-align: left;">
                                <div>   Total Cable USA</div>
                                <div>P.O. BOX 770068,</div>
                                <div>WOODSIDE,</div>
                                <div>NY 11377</div>
                                <div>
                                    <div style="left: 103.238px; top: 144.543px; font-size: 25px; font-family: sans-serif;">☎<small style="font-size: 12px;">&nbsp 1-212-444-8138</small></div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xs-6">
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-xs-6">                    
                </div>
                <div class="col-xs-4">
                </div>
                <div class="col-xs-2 invoice-payment">
                    <div style="text-align: left;">

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xs-12">
                    <table class="table table-striped table-hover">
                        <thead>
                            <tr>
<!--                                <th>
                                    Account No
                                </th>-->
                                <th class="hidden-480">
                                    Name
                                </th>
                                <th class="hidden-480">
                                    Address
                                </th>
<!--                                <th>
                                    Mac
                                </th>-->
                                <th class="hidden-480">
                                    Emergency Contact
                                </th>
                                <th>
                                    Package
                                </th>
                                <th class="hidden-480">
                                    Follow update
                                </th>
                                <th class="hidden-480">
                                    Comment
                                </th>
                                <th class="hidden-480">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>

                            <?php
                            foreach ($allData as $results):
                   
                                ?>
                                <tr>
    <!--                                    <td>                          
                                    <?php // echo $results['pc']['c_acc_no'];  ?>
                                    </td>-->
                                    <td>
                                        <a href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'edit_customer_registration', $results['pc']['id'])) ?>" target="_blank"><?php echo $results['pc']['middle_name'] . " " . $results['pc']['last_name']; ?></a> 
                                    </td>
                                    <td class="hidden-480">
                                        <?php echo $results['pc']['street'] . ", " . $results['pc']['apartment']; ?>                            
                                    </td>
    <!--                                    <td>
                                    <?php // echo $results['pc']['mac'];  ?>
                                    </td>-->
                                    <td class="hidden-480">  
                                        <?php if (!empty($results['pc']['cell'])): ?> 
                                            Cell:    <?php echo $results['pc']['cell']; ?>   
                                        <?php endif; ?>
                                        <br>
                                        <?php if (!empty($result['pc']['home'])): ?>
                                            Home : <?php echo $results['pc']['home']; ?>
                                        <?php endif ?>
                                    </td>
                                    <td class="hidden-480">
                                        <?php
                                        if ($results['pc']['custom_package_id'] == null) {
                                            echo $results['ps']['name'];
                                        } else {
                                            echo $results['cp']['duration'] . ' Months, Custom package ' . $results['cp']['charge'] . '$';
                                        }
                                        ?>
                                    </td>
                                    <td>
                                        <?php echo $results['pc']['follow_date']; ?>
                                    </td>
                                    <td>
                                        <?php echo $results['c']['content']; ?>
                                    </td>
                                    <td>
                                        <a 
                                            onclick="if (confirm( & quot; Are you sure to Done? & quot; )) {
                                                            return true;
                                                            }
                                                            return false;"

                                            href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'done', $results['pc']['id'])) ?>" title="Done">
                                            <span class="fa  fa-check "></span>
                                        </a>
                                        <a 
                                            onclick="if (confirm( & quot; Are you sure to Ready to installition? & quot; )) {
                                                            return true;
                                                            }
                                                            return false;"

                                            href="<?php echo Router::url(array('controller' => 'admins', 'action' => 'ready', $results['pc']['id'])) ?>" title="Ready to Instalition">
                                            <span class="fa  fa-forward "></span>
                                        </a>
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
