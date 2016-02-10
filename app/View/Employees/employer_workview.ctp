<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3><?php //pr($employee); exit; 
            echo $employee["Employee"]["full_name"];
            ?> </h3> 
              
             <h3>(<?php //pr($employee); exit; 
           echo $employee["Employee"]["designation"];
            ?>)</h3> 
            <h3>Cell:<?php //pr($employee); exit; 
           echo $employee["Employee"]["cell"];
            ?> </h3>                
           
           

            <ul class="breadcrumb">
                <li>Email:<?php //pr($employee); exit; 
           echo $employee["Employee"]["email"];
            ?></li>
              <!--   <li>
                    <a href="#" class="tip" title="back to dashboard">
                        <span class="icon16 icomoon-icon-screen-2"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 icomoon-icon-arrow-right-2"></span>
                    </span>
                </li> -->
                <li class="active">All newses</li>
            </ul>

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span12">

                <div class="box gradient">

                    <div class="title">
                        <h4>
                            <span>All attendence list</span>
                        </h4>
                    </div>
                    <?php echo $this->Session->flash(); ?>
                    <div class="content noPad clearfix">
                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>In Time</th>
                                    <th>Out Time</th>
                                    <th>Date</th>
                                     <!--<th>Image Url</th>
                                    <th>Youtube Url</th>
                                    <th>Insert date</th>                                                                                              
                                    <th>Status</th> 
                                    <th>Action</th> -->
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                  // pr($attendence);
                                  // exit;
                                 
                                foreach ($attendence as $attendence):
                                    //$newses = $single['Attendence'];
                                   
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php


                                         if (!empty($attendence["attendences"]["intime"])){
                                         //    echo date("g:i a", $attendence["attendences"]["intime"]);

                                            echo $attendence["attendences"]["intime"];
                                        } ?></td>
                                        <td><?php if (!empty($attendence["attendences"]["outtime"])){ 
                                            echo $attendence["attendences"]["outtime"];
                                           // echo "g:i a", $attendence["attendences"]["outtime"]);
                                             } ?></td>
                                        <td><?php echo $attendence["attendences"]["date"]; ?></td>
                                        
                                       
                                        
                                    </tr>
                                    <?php
                                endforeach;
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div><!-- End .box -->

            </div><!-- End .span12 -->

        </div><!-- End .row-fluid -->

        <!-- Page end here -->               
    </div><!-- End contentwrapper -->
