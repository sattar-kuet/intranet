<?php
/**
* CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
* Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
*
* Licensed under The MIT License
* For full copyright and license information, please see the LICENSE.txt
* Redistributions of files must retain the above copyright notice.
*
* @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
* @link          http://cakephp.org CakePHP(tm) Project
* @package       app.View.Emails.html
* @since         CakePHP(tm) v 0.10.0.1076
* @license       http://www.opensource.org/licenses/mit-license.php MIT License
*/
?>
<?php
$content = explode("\n", $invoices);


 // foreach ($content as $line):

 //  echo '<p> ' . $line . "</p>\n";
 // endforeach;
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title></title>
    <style type="text/css">
    body {
      padding-top: 0 !important;
      padding-bottom: 0 !important;
      padding-top: 0 !important;
      padding-bottom: 0 !important;
      margin:0 !important;
      width: 100% !important;
      -webkit-text-size-adjust: 100% !important;
      -ms-text-size-adjust: 100% !important;
      -webkit-font-smoothing: antialiased !important;
      background: gray;
    }
    .tableContent img {
      border: 0 !important;
      display: block !important;
      outline: none !important;
    }
    a{
      color:#382F2E;
    }

    p, h1{
      color:#382F2E;
      margin:0;
    }
    p{
      

      text-align: left;
      color: #322727;
      font-size: 20px;
      font-weight: normal;
      line-height: 30px;
    }

    a.link1{
      color:#382F2E;
    }
    a.link2{
      font-size:16px;
      text-decoration:none;
      color:#ffffff;
    }

    h2{
      text-align:left;
      color:#222222; 
      font-size:19px;
      font-weight:normal;
    }
    div,p,ul,h1{
      margin:0;
    }
    .bodycon {
      font-family: Helvetica,Arial,sans-serif;
      width: 600px;
      table-layout: fixed;text-align: left;
      background: #ffffff;
      border: 1px solid #ffffff;
      border-bottom: 2px solid #bcbcbc;
      border-left: 1px solid #cecece;
      border-right: 1px solid #cecece;
    }
    .contentEditable span {
      font-weight: bold;
    }

    .bgBody{
      background: #ffffff;
    }
    .bgItem{
      background: #DBDBDB;
    }
    .movableContent {
      padding-top: 5%;
    }

    </style>
    <script type="colorScheme" class="swatch active">
    {
      "name":"Default",
      "bgBody":"ffffff",
      "link":"382F2E",
      "color":"999999",
      "bgItem":"ffffff",
      "title":"222222"
    }
    </script>
  </head>
  <body paddingwidth="0" paddingheight="0"   style="padding-top: 0; padding-bottom: 0; padding-top: 0; padding-bottom: 0; background-repeat: repeat; width: 100% !important; -webkit-text-size-adjust: 100%; -ms-text-size-adjust: 100%; -webkit-font-smoothing: antialiased;" offset="0" toppadding="0" leftpadding="0">
    <div style="background-color:#dfdfdf;padding:0;margin:0 auto;width:100%">
      <table width="100%" border="0" cellspacing="0" cellpadding="0" class="tableContent bgBody" align="center"  style="font-family:Helvetica,Arial,sans-serif;border-collapse:collapse;width:100%!important;font-family:Helvetica,Arial,sans-serif;margin:0;padding:0">
        <tr><td height='35'></td></tr>
        <tr>
          <td>
            <table width="600" border="0" cellspacing="0" cellpadding="0" align="center" class='bgItem'>
              <tr>
                <td width='40'></td>
                <td width='520'>
                  

                  <div class='movableContent'>
                    <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                      <tr>
                        <td valign='top' align='center'>
                          <div class="contentEditableContainer contentTextEditable">
                            <div class="contentEditable">
                              <!-- <p style='text-align:center;margin:0;font-family:Georgia,Time,sans-serif;font-size:26px;color:#222222;'>Welcome to <span style='color:#69C374;'>Totalcable</span></p> -->
                              <img src="cid:12345" width='200' height='100'>
                             
                            </div>
                          </div>
                        </td>
                      </tr>
                    </table>
                  </div>


                  <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">

                    <!-- =============================== Header ====================================== -->           


                    <tr>
                    Hello I am here..............
                    </tr>
                    <!-- =============================== Body ====================================== -->

                    <tr>
                      <td class='movableContentContainer' valign='top'>

                        

                        

                        <div class='movableContent bodycon' style="font-family: Helvetica,Arial,sans-serif;width: 600px;table-layout: fixed;text-align: left;background: #ffffff;border: 1px solid #ffffff;border-bottom: 2px solid #bcbcbc;border-left: 1px solid #cecece;border-right: 1px solid #cecece;">
                          <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                            <tr><td height='35'></td></tr>
                            

                            

                            <tr>
                              <td align='left'>
                                <div class="contentEditableContainer contentTextEditable">
                                  <div class="contentEditable" align='center'>
                                     <div class="col-xs-7">
                                      

                            <div class="product-page product-pop-up" style="margin-left: 0px !important;">
                                <div class="page-content-wrapper">
                                    <div class="page-content_invo">     
                                        <div>  
                                            <div class="page-bar">
                                                <ul class="page-breadcrumb">
                                                    <li>   </li>
                                                    <li>   </li>
                                                    <li>   </li>
                                                </ul>
                                                <script></script>                                                
                                            </div>
                                            <div  class="printableArea">   
                                                <?php
                                                $pcaddress = $single['package_customers'];
//                                                    $invoices[0]['package_customers']
                                                $customer_address_one = $pcaddress['house_no'] . ' ' . $pcaddress['street'] . ' ' .
                                                        $pcaddress['apartment'];
                                                $customer_address_two = $pcaddress['city'] . ' ' . $pcaddress['state'] . ' '
                                                        . $pcaddress['zip'];
                                                ?>                
                                                <div style="page-break-before:always" >&nbsp;</div> 
                                                <div class="row">
                                                    <div class="col-xs-4">                              
                                                        <ul class="list-unstyled" style=" text-align: left; color: #555; margin-left: 1px;">
                                                            <img style="margin-top: 31px;"src="<?php echo $this->webroot; ?>assets/frontend/layout/img/totalcable.jpg">                                                  
                                                            <div style="margin-left: 17px;">P.O BOX 170,E.MEADOM, NY 11554</div>
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-3">                               
                                                        <ul class="list-unstyled">                                   
                                                        </ul>
                                                    </div>
                                                    <div class="col-xs-5 invoice-payment">                             

                                                    </div>
                                                </div>                  
                                                <hr style="display: block; border-style: inset; border-color:  darkmagenta;">

                                                <div class="row invoice-logo">
                                                    <div class="row" style="margin-top: 0;">                          
                                                        <div class="col-xs-7">                              

                                                            <table style=" margin-left: 105px; border: #555 solid 1px; min-width: 275px;">
                                                                <th style=" border: #555 solid 1px; padding-left: 2px;">
                                                                    <b style=" color: #000;">Bill To</b>
                                                                </th>
                                                                <tr>
                                                                    <td style="padding-left: 5px; min-height: 115px; line-height: 15px;">
                                                                        <?php // if (!empty($single['0']['name'])):   ?>
                                                                        <?php echo $single['package_customers']['first_name'] . ' ' . $single['package_customers']['middle_name'] . ' ' . $single['package_customers']['last_name']; ?>


                                                                        <br>
                                                                        <?php echo $customer_address_one; ?><br>
                                                                        <?php echo $customer_address_two; ?>

                                                                    </td>
                                                                </tr>
                                                            </table>                               
                                                        </div>                            
                                                        <div class="col-xs-5 invoice-payment">       

                                                            <ul class="list-unstyled" style=" text-align: right; color: #000; margin-right: 17px;">
                                                                <li>
                                                                    <h1 style=" color: #000 !important;">Invoice #<?php echo getInvoiceNumbe($single['transactions']['id']); ?></h1>
                                                                </li>
                                                                <li style="color: #555;">
                                                                    <b style=" color: #000;">Date of Invoice: </b><?php echo date('Y-m-d'); ?>
                                                                </li>
                                                                <li style="color: #555;">
                                                                    <b style=" color: #000;">Terms:</b> Net 7 Days
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <hr  style="border-color: white;">
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
                                                <div class="row"style=" margin-top: 9px;">
                                                    <div class="col-xs-12 ">
                                                        <table class="table table-striped table-hover margin-top-20" style=" margin-top: 60px; border:  #555 solid 1px;">
                                                            <thead  style="border-bottom: #555 solid 3px;">
                                                                <tr style="height: 101px; border:  #555 solid 1px;">
                                                                    <th class="hidden-480" style=" padding-bottom: 39px; text-align: center; color: #000 !important; color: white; width: 51px;font-size: 19px; font-weight: bold;">
                                                                        #
                                                                    </th>                                    
                                                                    <th class="hidden-480 " style=" color: #333 !important; padding: 0px 0px 39px 19px;">
                                                                        DESCRIPTION
                                                                    </th>
                                                                    <th class="hidden-480"  style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                                                        STB QUANTITY
                                                                    </th>

                                                                    <th class="hidden-480" style=" color: #333 !important; text-align: center; padding-bottom: 39px;">
                                                                        SUBSCRIPION
                                                                    </th>
                                                                    <th class="hidden-480" style=" color: #333 !important; padding-bottom: 39px; text-align: center;">
                                                                        PAYABLE AMOUNT
                                                                    </th>
                                                                    <th class="hidden-480"  style=" padding-bottom: 39px; text-align: center; font-size: 15px;  color: #000 !important; width: 101px;">
                                                                        TOTAL
                                                                    </th>                                      
                                                                </tr>
                                                            </thead>
                                                            <tbody>                                   
                                                                <tr style="height: 101px;">
                                                                    <td  style=" padding: 39px; text-align: center; font-size: 19px; font-weight: bold; color: #000 !important; width: 101px;">
                                                                        <?php echo getInvoiceNumbe($single['transactions']['id']); ?>
                                                                    </td>
                                                                    <td style=" color: #333 !important; padding: 43px 0px 0px 19px ;">
                                                                        <b style="color: #333 !important;"><?php echo $single['psettings']['name']; ?></b><br>    
                                                                        <?php echo $single['packages']['name']; ?>
                                                                    </td> 
                                                                    <td style=" color: #333 !important; text-align: center;  padding: 43px 0px 0px 9px ;">
                                                                        <?php echo $single['package_customers']['mac']; ?>
                                                                    </td>


                                                                    <td style=" color: #333 !important; text-align: center; padding: 43px 0px 0px 9px ;">
                                                                        <?php echo $single['psettings']['duration']; ?>
                                                                    </td>
                                                                    <td style=" color: #333 !important; padding: 43px 0px 0px 9px; text-align: center;">
                                                                        <?php if (!empty($single['transactions']['payable_amount'])): ?>
                                                                            $ <?php echo $single['transactions']['payable_amount']; ?>.00
                                                                        <?php endif ?>
                                                                    </td>

                                                                    <td  style=" padding: 43px 0px 0px 9px ; text-align: center; font-size: 19px; font-weight: bold; color: #000 !important; width: 151px;">
                                                                        <?php if (!empty($single['transactions']['id'])): ?>
                                                                            $<?php echo $single['transactions']['id']; ?>.00 USD
                                                                        <?php endif ?>
                                                                    </td>                                          
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <br>
                                                        <div class="row " style=" margin-top: 44px;">
                                                            <div class="col-xs-3">                    
                                                            </div>
                                                            <div class="col-xs-3">
                                                            </div>
                                                            <div class="col-xs-6 invoice-payment">
                                                                <div class="col-xs-6">  
                                                                    <b style=" color: #000;">Paid Amount</b>
                                                                </div>
                                                                <div class="col-xs-6" style="text-align: right;">
                                                                    $<?php echo $single['transactions']['id']; ?>.00 USD      
                                                                </div>
                                                                <hr style="border-color: #990000 !important; ">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-xs-3">                    
                                                            </div>
                                                            <div class="col-xs-3">
                                                            </div>
                                                            <div class="col-xs-6 invoice-payment">
                                                                <div class="col-xs-6">  
                                                                    <b style=" color: #000;">Total Amount Due</b>
                                                                </div>
                                                                <div class="col-xs-6" style="text-align: right;">
                                                                    $<?php echo $single['transactions']['payable_amount'] - $single['transactions']['id']; ?>.00 USD      
                                                                </div>
                                                                <hr style="border-color: #990000 !important; ">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row" style="margin-top: 141px;">
                                                    <div class="col-xs-4">                              
                                                        <h6>Please write <b style="font-weight: normal !important; color:red !important;">INVOICE NUMBER</b> on check</h6>
                                                    </div>
                                                    <div class="col-xs-4">                               

                                                    </div>

                                                    <div class="col-xs-4">                             
                                                        <h6>Make check payable to <b style="font-weight: normal !important; color:red !important;">TOTAL CABLE BD</b></h6>
                                                    </div>
                                                </div> 


                                                <div class="row" style="background-color:  yellowgreen !important; border-top:  red solid 1px;">
                                                    <div class="col-xs-4" style="text-align: center;">                              
                                                        <h5 style=" color: white !important;"> e-mail: info@totalcablebd.com</h5>
                                                    </div>
                                                    <div class="col-xs-4">                               

                                                    </div>
                                                    <div class="col-xs-4" style="text-align: center;">                             
                                                        <h5 style=" color: white !important;">Web: totalcablebd.com</h5>
                                                    </div>
                                                </div>                

                                            </div>
                                        </div>          
                                    </div> 
                                </div>
                            </div>                     
                    
                </div>

                                  </div>
                                </div>
                              </td>
                            </tr>

                            <tr><td height='35'></td></tr>

                             <tr>
                              <td align='center'>
                                <table>
                                  <tr>
                                    <td align='center' bgcolor='#69C374' style='background:#69C374; padding:15px 18px;-webkit-border-radius: 4px; -moz-border-radius: 4px; border-radius: 4px;'>
                                      <div class="contentEditableContainer contentTextEditable">
                                        <div class="contentEditable" align='center'>
                                          <a target='_blank' href='#' class='link2' style='color:#ffffff;'>Activate your Account</a>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                              </td>
                            </tr> 
                            <tr><td height='20'></td></tr>
                          </table>
                        </div>

                        <div lass='movableContent'>
                          <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                            
                            <tr><td  style='border-bottom:1px solid #DDDDDD;'></td></tr>

                            <tr><td height='25'></td></tr>

                            <tr>
                              <td>
                                <table width="520" border="0" cellspacing="0" cellpadding="0" align="center">
                                  <tr>
                                    <td valign='top' align='left' width='370'>
                                      <div class="contentEditableContainer contentTextEditable">
                                        <div class="contentEditable" align='center'>
                                          <p  style='text-align: left;color: #322727;font-size: 12px;font-weight: normal;line-height: 20px;'>
                                            <span style='font-weight:bold;'>TotalCableUSA Inc. </span>
                                            <br>
                                            3719 57TH ST <br>
                                            Woodside, New York 11377 <br>
                                            Phone: 1-212-444-8138 <br>
                                            Fax: 1-631-451-9393<br>
                                            Email: Info@TotalCableUSA.com<br>
                                            Skype: www.totalcableusa.com<br>
                                            <br>
                                          </p>
                                        </div>
                                      </div>
                                    </td>

                                    <td width='30'></td>

                                    <td valign='top' width='52'>
                                      <div class="contentEditableContainer contentFacebookEditable">
                                        <div class="contentEditable">
                                          <a target='_blank' href="https://www.facebook.com/TotalCable"><img src="cid:123456" width='52' height='53' alt='facebook icon' data-default="placeholder" data-max-width="52" data-customIcon="true"></a>
                                        </div>
                                      </div>
                                    </td>

                                    <td width='16'></td>

                                    <td valign='top' width='52'>
                                      <div class="contentEditableContainer contentTwitterEditable">
                                        <div class="contentEditable">
                                          <a target='_blank' href="https://twitter.com/Total_Cable"><img src="cid:1234567" width='52' height='53' alt='twitter icon' data-default="placeholder" data-max-width="52" data-customIcon="true"></a>
                                        </div>
                                      </div>
                                    </td>
                                  </tr>
                                </table>
                                
                              </td>
                            </tr>
                          </table>
                        </div>

                      </td>
                    </tr>



                    <!-- =============================== footer ====================================== -->



                  </table>
                </td>
                <td width='40'></td>
              </tr>
            </table>
          </td>
        </tr>

        <tr><td height='88'></td></tr>


      </table>
    </div>


  </body>
</html>

