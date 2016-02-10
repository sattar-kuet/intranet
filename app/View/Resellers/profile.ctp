<style>
    .profile-userpic img {
        width: 120px;
        height: 150px;
    }
    #earning .form-control{
        border: none;
    }
    div#sample_6_filter {
        display: none;
    }
    div#sample_6_wrapper>div>div {
        width: 100%;
    }
    img {
        max-width: 100%;
    }
    #temp-winner-pic img {
        border-radius: 100% !important;
    }
    #temp-winner-pic {
        text-align: center;
    }

</style>

<!-- BEGIN PAGE CONTENT-->
<div class="row margin-top-20">
    <div class="col-md-12">
        <!-- BEGIN PROFILE SIDEBAR -->
        <div class="profile-sidebar">
            <!-- PORTLET MAIN -->
            <div class="portlet light profile-sidebar-portlet">
                <!-- SIDEBAR USERPIC -->
                <?php
                $reseller = $return['reseller'];
                $points = $return['points'];
                $badge = $return['badge'];
                $netPoint = $return['netPoint'];
                ?>
                <div class="profile-userpic">
                    <img src="<?php echo $this->webroot ?>reseller/<?php echo $reseller['img']; ?>" class="img-responsive" alt="">
                </div>
                <!-- END SIDEBAR USERPIC -->
                <!-- SIDEBAR USER TITLE -->
                <div class="profile-usertitle">
                    <div class="profile-usertitle-name">
                        <?php echo $reseller['name']; ?>
                    </div>

                </div>
                <!-- END SIDEBAR USER TITLE -->
                <!-- SIDEBAR BUTTONS -->
                <div class="profile-userbuttons">
                    <i class="fa fa-certificate" style="color: <?php echo $badge['color']; ?>"></i>  <?php echo $netPoint . ' ' . $badge['name']; ?>
                </div>
                <!-- END SIDEBAR BUTTONS -->
                <!-- SIDEBAR MENU -->
                <div class="profile-usermenu">
                    <ul class="nav">
                        <li class="active" id="account-overview">
                            <a href="javascript:void(0)">
                                <i class="icon-home"></i>
                                Overview </a>
                        </li>
                        <li>
                            <a href="javascript:void(0)" id="account-settings">
                                <i class="icon-settings"></i>
                                Account Settings </a>
                        </li>
                        <li>
                            <a href=" <?php echo Router::url(array('controller' => 'resellers', 'action' => 'logout')) ?>" >
                                <i class="icon-settings"></i>
                                Logout </a>
                        </li>

                    </ul>
                </div>
                <!-- END MENU -->
            </div>
            <!-- END PORTLET MAIN -->

        </div>
        <!-- END BEGIN PROFILE SIDEBAR -->
        <!-- BEGIN PROFILE CONTENT -->
        <div class="profile-content">
            <div class="row" >


                <div class="col-md-12" id="accountOverview">
                    <!-- BEGIN PORTLET -->

                    <div class="col-md-6">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption caption-md">
                                    <i class="icon-bar-chart theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Your Activity</span>
                                </div>
                                <div class="actions">
                                    <div class="btn-group btn-group-devided" data-toggle="buttons">
                                        <ul class="nav nav-tabs">
                                            <li class="active">
                                                <a href="#url" data-toggle="tab">
                                                    URL </a>
                                            </li>
                                            <li>
                                                <a href="#points" data-toggle="tab">
                                                    Points </a>
                                            </li>
                                            <li>
                                                <a href="#earning" data-toggle="tab">
                                                    Earning </a>
                                            </li>
                                            <li>
                                                <a href="#withdraw" data-toggle="tab">
                                                    Withdraw </a>
                                            </li>

                                        </ul>


                                    </div>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="tab-content">
                                    <!--URL-->
                                    <div class="tab-pane active" id="url">
                                        <p><?php echo $this->webroot . 'OrderFromReseller/' . $reseller['api_key']; ?></p>
                                        <a class="btn btn-circle blue-soft" target="_blank" href="<?php echo $this->webroot . 'OrderFromReseller/' . $reseller['api_key']; ?>/">GO TO THIS URL </a> 
                                    </div>
                                    <!--END URL-->
                                    <!--Point section--> 
                                    <div class="tab-pane " id="points">
                                        <div class="row number-stats margin-bottom-30 point-section">
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="stat-left">
                                                    <div class="stat-chart">
                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                        <div id="penaltyChart"></div>
                                                    </div>
                                                    <div class="stat-number">
                                                        <div class="title">
                                                            Penalty
                                                        </div>
                                                        <div class="number">
                                                            <?php echo $penaltyPoints; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="stat-right">
                                                    <div class="stat-chart">
                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                        <div id="pendingChart"></div>
                                                    </div>
                                                    <div class="stat-number">
                                                        <div class="title">
                                                            Pending
                                                        </div>
                                                        <div class="number">
                                                            <?php echo $pendingPoints; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4 col-xs-4">
                                                <div class="stat-right">
                                                    <div class="stat-chart">
                                                        <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                                        <div id="successChart"></div>
                                                    </div>
                                                    <div class="stat-number">
                                                        <div class="title">
                                                            Success
                                                        </div>
                                                        <div class="number">
                                                            <?php echo $successPoints; ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!--END Point section-->
                                    <!--Earning Section--> 
                                    <div class="tab-pane" id="earning">
                                        <div class="table-scrollable table-scrollable-borderless earning-section">
                                            <table class="table  table-hover table-light" id="sample_editable_1">
                                                <thead>
                                                    <tr class="uppercase">
                                                        <th>
                                                            Month
                                                        </th>

                                                        <th>
                                                            Earnings
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <?php foreach ($return['earnings']['monthly'] as $earning): ?>
                                                    <tr>
                                                        <td >
                                                            <?php echo $earning['month']; ?>
                                                        </td>

                                                        <td>
                                                            <span class="bold theme-font"><?php echo $earning['amount'] . ' TK'; ?> </span>   
                                                        </td>
                                                    </tr>

                                                <?php endforeach; ?>

                                            </table>
                                        </div>
                                        <br/>

                                        <div id="withdrawAction">
                                            <div class="bubblingG " style="visibility:hidden;">
                                                <span id="bubblingG_1">
                                                </span>
                                                <span id="bubblingG_2">
                                                </span>
                                                <span id="bubblingG_3">
                                                </span>
                                            </div>
                                            <button type="button" id="balance-txt" class="btn green ">BALANCE: <?php echo $return['total']['balance']; ?>TK </button> </br>

                                            <?php
                                            echo $this->Form->create('ResellerAccount', array(
                                                'inputDefaults' => array(
                                                    'label' => false,
                                                    'div' => false
                                                ),
                                                'id' => 'resellerWithdrawForm',
                                                'url' => array('controller' => 'resellers', 'action' => 'withdraw')
                                                    )
                                            );
                                            ?>



                                            <div class="input-group">
                                                <div class="input-icon">
                                                    <i>TK</i>
                                                    <?php
                                                    echo $this->Form->input(
                                                            'withdraw', array(
                                                        'class' => 'form-control',
                                                        'type' => 'text',
                                                        'placeholder' => 'Type withdraw amount'
                                                            )
                                                    );
                                                    ?>
                                                </div>
                                                <span class="input-group-btn">
                                                    <!--<button id="genpassword" class="btn btn-success" type="button"><i class="fa fa-arrow-left fa-fw"></i> Withdraw </button>-->

                                                    <?php
                                                    echo $this->Form->button(
                                                            '<i class="fa fa-arrow-left fa-fw"></i> Withdraw', array(
                                                        'class' => 'btn btn btn-success',
                                                        'id' => 'resellerWithdrawBtn',
                                                        'type' => 'submit',
                                                        'escape' => false
                                                            )
                                                    );
                                                    ?> 
                                                </span>
                                            </div>

                                            <?php echo $this->Form->end(); ?>

                                        </div>


                                    </div>

                                    <!--END Earning-->


                                    <!--Withdraw Section--> 
                                    <div class="tab-pane" id="withdraw">
                                        <div class="table-scrollable table-scrollable-borderless earning-section">
                                            <table class="table table-striped table-bordered table-hover" id="sample_6">

                                                <thead>
                                                    <tr class="uppercase">
                                                        <th >
                                                            Withdraw Time
                                                        </th>
                                                        <th>
                                                            Amount
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach ($return['withdraw'] as $withdraw): ?>
                                                        <tr>
                                                            <td >
                                                                <?php
                                                                echo $firstM = date('l jS  F Y ', strtotime($withdraw['ResellerAccount']['created']));
                                                                ;
                                                                ?>
                                                            </td>
                                                            <td>
                                                                <span class="bold theme-font"><?php echo $withdraw['ResellerAccount']['withdraw'] . ' TK'; ?></span>   
                                                            </td>
                                                        </tr>

                                                    <?php endforeach; ?>
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>

                                    <!--END Withdraw-->


                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END PORTLET -->

                    <div class="col-md-6">
                        <!-- BEGIN PORTLET -->
                        <div class="portlet light">
                            <div class="portlet-title tabbable-line">
                                <div class="caption caption-md">
                                    <i class="icon-globe theme-font hide"></i>
                                    <span class="caption-subject font-blue-madison bold uppercase">Hot News</span>
                                </div>
                                <ul class="nav nav-tabs">
                                    <li class="active">
                                        <a href="#winner" data-toggle="tab">
                                            Next Winner </a>
                                    </li>
                                    <!--   <li>
                                           <a href="#adminMsg" data-toggle="tab">
                                               Admin Message </a>
                                           </li> -->
                                </ul>
                            </div>
                            <div class="portlet-body">
                                <!--BEGIN TABS-->
                                <div class="tab-content" style="padding: 0px 15px;">
                                    <div class="tab-pane active " id="winner">
                                        <?php echo $return['winner']; ?> 
                                    </div>
                                    <div class="tab-pane" id="adminMsg">
                                        Message will Go here...
                                    </div>
                                </div>
                                <!--END TABS-->
                            </div>
                        </div>
                        <!-- END PORTLET -->
                    </div>

                </div>
                <div class="col-md-12 display-hide"  id="accountSettings">
                    <div class="portlet light">
                        <div class="portlet-title tabbable-line">
                            <div class="caption caption-md">
                                <i class="icon-globe theme-font hide"></i>
                                <span class="caption-subject font-blue-madison bold uppercase">Account Setting</span>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#personalInfo" data-toggle="tab">Personal Info</a>
                                </li>
                                <li>
                                    <a href="#avatar" data-toggle="tab">Change Profile Picture</a>
                                </li>
                                <li>
                                    <a href="#password_change" data-toggle="tab">Change Password</a>
                                </li>

                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="tab-content">
                                <!-- PERSONAL INFO TAB -->

                                <div class="tab-pane active" id="personalInfo">
                                    <div class="bubblingG " style="visibility:hidden;">
                                        <span id="bubblingG_1">
                                        </span>
                                        <span id="bubblingG_2">
                                        </span>
                                        <span id="bubblingG_3">
                                        </span>
                                    </div>

                                    <?php
                                    echo $this->Form->create('Reseller', array(
                                        'inputDefaults' => array(
                                            'label' => false,
                                            'div' => false
                                        ),
                                        'id' => 'changePersonalInfoForm',
                                        'url' => array('controller' => 'resellers', 'action' => 'changePersonalInfo')
                                            )
                                    );
                                    ?>

                                    <?php
                                    echo $this->Form->input(
                                            'id', array(
                                        'value' => $reseller['id'],
                                            )
                                    );
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label">Full Name</label>
                                        <?php
                                        echo $this->Form->input(
                                                'name', array(
                                            'class' => 'form-control ',
                                            'type' => 'text',
                                            'value' => $reseller['name'],
                                            'placeholder' => 'Full Name'
                                                )
                                        );
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">Mobile Number</label>
                                        <?php
                                        echo $this->Form->input(
                                                'mobile', array(
                                            'class' => 'form-control ',
                                            'type' => 'text',
                                            'value' => $reseller['mobile'],
                                            'placeholder' => 'Phone Number'
                                                )
                                        );
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Your current Or Last Institute</label>
                                        <?php
                                        echo $this->Form->input(
                                                'institute', array(
                                            'class' => 'form-control ',
                                            'type' => 'text',
                                            'value' => $reseller['institute'],
                                            'placeholder' => 'Type Your current Or Last Institute'
                                                )
                                        );
                                        ?>
                                    </div>
                                    <div class="margiv-top-10">
                                        <?php
                                        echo $this->Form->button(
                                                'Save Changes', array(
                                            'class' => 'btn green-haze pull-right',
                                            'id' => 'resellerPersonalInfoChangeBtn',
                                            'type' => 'submit'
                                                )
                                        );
                                        ?> 

                                    </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                                <!-- END PERSONAL INFO TAB -->

                                <!-- CHANGE AVATAR TAB -->
                                <div class="tab-pane" id="avatar">

                                    <div class="bubblingG " style="visibility:hidden;">
                                        <span id="bubblingG_1">
                                        </span>
                                        <span id="bubblingG_2">
                                        </span>
                                        <span id="bubblingG_3">
                                        </span>
                                    </div>

                                    <?php
                                    echo $this->Form->create('Reseller', array(
                                        'inputDefaults' => array(
                                            'label' => false,
                                            'div' => false
                                        ),
                                        'type' => 'file',
                                        'id' => 'changeAvatarForm',
                                        'url' => array('controller' => 'resellers', 'action' => 'changeAvatar')
                                            )
                                    );
                                    ?>

                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'value' => $reseller['email'],
                                        'type' => 'hidden'
                                            )
                                    );
                                    ?>

                                    <div class="form-group">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
                                                <?php
                                                if (empty($reseller['img'])) {
                                                    $avatar = $this->webroot . 'img/' . 'no-img.png';
                                                } else {
                                                    $avatar = $this->webroot . 'reseller/' . $reseller['img'];
                                                }
                                                ?>
                                                <img src="<?php echo $avatar; ?>"/>
                                            </div>
                                            <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 200px; max-height: 150px;">
                                            </div>
                                            <div>
                                                <span class="btn default btn-file">
                                                    <span class="fileinput-new">
                                                        Select image </span>
                                                    <span class="fileinput-exists">
                                                        Change </span>

                                                    <?php
                                                    echo $this->Form->input(
                                                            'img', array(
                                                        'type' => 'file',
                                                            )
                                                    );
                                                    ?>
                                                </span>
                                                <a href="#" class="btn default fileinput-exists" data-dismiss="fileinput">
                                                    Remove </a>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="margin-top-10">
                                        <?php
                                        echo $this->Form->button(
                                                'Save Changes', array(
                                            'class' => 'btn green-haze',
                                            'id' => 'changeAvatarBtn',
                                            'type' => 'submit'
                                                )
                                        );
                                        ?> 
                                    </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>
                                <!-- END CHANGE AVATAR TAB -->

                                <!-- CHANGE PASSWORD TAB -->
                                <div class="tab-pane" id="password_change">
                                    <div class="bubblingG " style="visibility:hidden;">
                                        <span id="bubblingG_1">
                                        </span>
                                        <span id="bubblingG_2">
                                        </span>
                                        <span id="bubblingG_3">
                                        </span>
                                    </div>

                                    <?php
                                    echo $this->Form->create('Reseller', array(
                                        'inputDefaults' => array(
                                            'label' => false,
                                            'div' => false
                                        ),
                                        'id' => 'changePasswordForm',
                                        'url' => array('controller' => 'resellers', 'action' => 'changePassword')
                                            )
                                    );
                                    ?>

                                    <?php
                                    echo $this->Form->input(
                                            'email', array(
                                        'value' => $reseller['email'],
                                        'type' => 'hidden'
                                            )
                                    );
                                    ?>

                                    <?php
                                    echo $this->Form->input(
                                            'id', array(
                                        'value' => $reseller['id'],
                                            )
                                    );
                                    ?>
                                    <div class="form-group">
                                        <label class="control-label">Current Password</label>
                                        <?php
                                        echo $this->Form->input(
                                                'old_password', array(
                                            'class' => 'form-control ',
                                            'type' => 'password',
                                            'autocomplete' => 'off',
                                            'placeholder' => 'Type Current password'
                                                )
                                        );
                                        ?>
                                    </div>

                                    <div class="form-group">
                                        <label class="control-label">New Password</label>
                                        <?php
                                        echo $this->Form->input(
                                                'password', array(
                                            'class' => 'form-control ',
                                            'type' => 'Password',
                                            'placeholder' => 'Type New Password'
                                                )
                                        );
                                        ?>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">Re-Type New Password</label>
                                        <?php
                                        echo $this->Form->input(
                                                'rpassword', array(
                                            'class' => 'form-control ',
                                            'type' => 'password',
                                            'placeholder' => 'Re-type New Password'
                                                )
                                        );
                                        ?>
                                    </div>
                                    <div class="margiv-top-10">
                                        <?php
                                        echo $this->Form->button(
                                                'Save Changes', array(
                                            'class' => 'btn green-haze pull-right',
                                            'id' => 'changePasswordBtn',
                                            'type' => 'submit'
                                                )
                                        );
                                        ?> 

                                    </div>
                                    <?php echo $this->Form->end(); ?>
                                </div>

                            </div>
                            <!-- END CHANGE PASSWORD TAB -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END PROFILE CONTENT -->
</div>
</div>
<!-- END PAGE CONTENT-->

<style>
    .table-scrollable {
        overflow-x: hidden;
        border: none;
        margin: 0 !important;
    }
    div#sample_editable_1_filter {
        display: none;
    }  
</style>

<script>
    document.addEventListener("DOMContentLoaded", function (event) {
        $("#penaltyChart").sparkline(<?php echo $penaltyChart; ?>, {
            type: 'bar',
            width: '100',
            barWidth: 6,
            height: '45',
            barColor: '#F36A5B',
            negBarColor: '#e02222'
        });

        $("#pendingChart").sparkline(<?php echo $pendingChart; ?>, {
            type: 'bar',
            width: '100',
            barWidth: 6,
            height: '45',
            barColor: '#5C9BD1',
            negBarColor: '#e02222'
        });
        $("#successChart").sparkline(<?php echo $successChart; ?>, {
            type: 'bar',
            width: '100',
            barWidth: 6,
            height: '45',
            barColor: '#45B6AF',
            negBarColor: '#e02222'
        });
    });


</script>