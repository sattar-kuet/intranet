
<style>

    tr, td {
        border: 1px solid black !important;
    }
</style>

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
                                Sales and Support Department Report<small></small>
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
                    <table class="table table-striped">

                        
                            <tr border ="1">
                                <td style="text-align: center;"> 
                                    TODAYS INBOUND REPORT
                                </td>  

                                <td style="text-align: center;" colspan="4">                                        
                                    TOTAL IN BOUND CALL DCC
                                </td>  
                                <td style="text-align: center;"> 
                                    17
                                </td>  

                                <td style="text-align: center;" colspan="4">                                        
                                    TOTAL CARD INFO TAKEN
                                </td>  

                                <td style="text-align: center;"> 
                                    1
                                </td>  
                            </tr>

                            <tr>
                                <td style="text-align: center;" rowspan="2"> 
                                    TOTAL IN BOUND CALL SUPPORT 
                                </td>  

                                <td style="text-align: center;" rowspan="2">                                        
                                   <?php echo $total['totalSupport'];?>
                                </td>  
                                <td style="text-align: center;"> 
                                    SALES DONE
                                </td>  

                                <td style="text-align: center;">                                        
                                    0
                                </td>  

                                <td style="text-align: center;"> 
                                    SALES QUERY
                                </td>  

                                <td style="text-align: center;">                                        
                                    1
                                </td>  
                                <td style="text-align: center;"> 
                                    OUT OF SERVICE/INTER UPTION IN OUR END
                                </td>  

                                <td style="text-align: center;">                                        
                                    0
                                </td>

                                <td style="text-align: center;"> 
                                    INBOUND WHOLE SERVICE CANCEL
                                </td>  

                                <td style="text-align: center;">                                        
                                    0
                                </td>  
                                <td style="text-align: center;"> 
                                    CANCEL FROM HOLD
                                </td>  

                            </tr>   
                            <tr>
                                <td style="text-align: center;">                                        
                                    RECONNECT
                                </td>  

                                <td style="text-align: center;"> 
                                    0
                                </td>  

                                <td style="text-align: center;">                                        
                                    VOD
                                </td>  
                                <td style="text-align: center;"> 
                                    0
                                </td>  

                                <td style="text-align: center;">                                        
                                    ADDITIONAL SALES RECEIVE
                                </td>

                                <td style="text-align: center;"> 
                                    0   
                                </td>  

                                <td style="text-align: center;">                                        
                                    CANCEL FROM DEALER & AGENT
                                </td>  
                                <td style="text-align: center;"> 
                                    0
                                </td>  
                                <td style="text-align: center;"> 
                                    0
                                </td> 
                            </tr>   
                            <tr>
                                <td style="text-align: center;">                                        
                                    TOTAL IN BOUND CALL ACCOUNTS
                                </td>  

                                <td style="text-align: center;"> 
                                   <?php echo $total['totalAccount']?>
                                </td>  

                                <td style="text-align: center;">                                        
                                    CARD INFO TAKEN
                                </td>  
                                <td style="text-align: center;">                                        
                                    1
                                </td>  
                                <td style="text-align: center;"> 
                                    CHECK SEND
                                </td>  

                                <td style="text-align: center;">                                        
                                    0
                                </td>

                                <td style="text-align: center;"> 
                                    MONEY ORDER ONLINE PAYMENT    
                                </td>  

                                <td style="text-align: center;">                                        
                                    0
                                </td>  
                                <td style="text-align: center;"> 
                                    SERVICE UNHOLD
                                </td>  
                                <td style="text-align: center;"> 
                                    0
                                </td> 
                                <td style="text-align: center;"> 

                                </td> 
                            </tr>   

                       
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
