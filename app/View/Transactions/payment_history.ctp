
<!-- Start css for table design and icon-->

<style>
    .ui-datepicker-multi-3 {
        display: table-row-group !important;

    }
</style>

<!-- End css for table design and icon-->

<div id="content" class="clearfix">

    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>Search transaction</h3>                    

            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>

            <div class="search">

                <form id="searchform" action="search.html">
                    <input type="text" id="tipue_search_input" class="top-search text" placeholder="Search here ...">
                    <input type="submit" id="tipue_search_button" class="search-btn nostyle" value="">
                </form>

            </div><!-- End search -->

            <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                    <a href="#" class="tip" oldtitle="back to dashboard" title="" data-hasqtip="true">
                        <span class="icon16 icomoon-icon-screen-2"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 icomoon-icon-arrow-right-2"></span>
                    </span>
                </li>
                <li class="active">Fill up </li>
            </ul>

        </div><!-- End .heading--> 

        <div class="row-fluid">

            <div class="span12">

                <div class="box">

                    <div class="title">
                        <h4>
                            <span>Search paid customer information</span>
                        </h4>

                        <?php echo $this->Session->flash(); ?>

                        <?php
                        if (isset($errors)):
                            echo $errors;
                        endif;
                        ?>   
                    </div>
                    <div class="content">
                        <?php
                        echo $this->Form->create('Transaction', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form-validate',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate'
                                )
                        );
                        ?>
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <label class="form-label span3" for="required">Select date</label>
                                    <?php
                                    echo $this->Form->input(
                                            'daterange', array(
                                        'id' => 'e2',                                       
                                        'class' => 'span9 text'
                                            )
                                    );
                                    ?>
                                </div>
                            </div>
                        </div> 
                        <div class="form-row row-fluid">
                            <div class="span12">
                                <div class="row-fluid">
                                    <div class="form-actions">
                                        <div class="span3"></div>
                                        <div class="span9 controls">
                                            <?php
                                            echo $this->Form->button(
                                                    'Search', array('class' => 'btn btn-success','type' => 'submit')
                                            );
                                            ?>

                                        </div>
                                    </div>
                                </div>
                            </div> 
                        </div>
                        <?php echo $this->Form->end(); ?>
                        
                  <?php echo $this->Session->flash(); ?> <!-- Successful or failed message -->
                    </div>

                </div><!-- End .box -->

            </div><!-- End .span12 -->

        </div><!-- End .row-fluid -->  

        <?php if ($clicked): ?>       

            <div class="row-fluid">
                <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                    <thead>
                        <tr>                                          
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Card No</th>
                            <th>Zip Code</th>
                            <th>Amount</th>
                            <th>Card Exp Date</th>
                            <th>Package Exp Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($paidcustomers as $single):
                            $info = $single['PaidCustomer'];
                            ?>
                            <tr class="odd gradeX">
                                <td><?php echo $info['fname']; ?></td>
                                <td><?php echo $info['lname']; ?></td>
                                <td><?php echo $info['card_no']; ?></td>
                                <td><?php echo $info['zip_code']; ?></td>
                                <td><?php echo $info['amount']; ?></td>
                                <td><?php echo $info['exp_date']; ?></td>
                                <td><?php echo $info['package_exp_date']; ?></td>
                                <td>   
                                            <div class="controls center">                                               
                                        <a onclick="if (confirm(&quot;Are you sure to complete this transaction?&quot)) { return true; } return false;" href="<?php echo Router::url(array('controller'=>'payments','action'=>'individual_transaction', $info['id'])
                                                )?>" class="tip"><span class="icon16 icomoon-icon-coins" title="Make transaction for this customer"></span></a>
                                                
                                            </div>
                                            
                                        </td>
                            </tr>
                            <?php
                        endforeach;
                        ?>
                    </tbody>

                </table>
            </div>

        <?php endif; ?>
