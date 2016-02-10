<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>All program List</h3>                    


            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>

            <div class="search">

                <form id="searchform" action="search.html">
                    <input type="text" id="tipue_search_input" class="top-search" placeholder="Search here ..." />
                    <input type="submit" id="tipue_search_button" class="search-btn" value=""/>
                </form>

            </div><!-- End search -->

            <ul class="breadcrumb">
                <li>You are here:</li>
                <li>
                    <a href="#" class="tip" title="back to dashboard">
                        <span class="icon16 icomoon-icon-screen-2"></span>
                    </a> 
                    <span class="divider">
                        <span class="icon16 icomoon-icon-arrow-right-2"></span>
                    </span>
                </li>
                <li class="active">All Program</li>
            </ul>

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span12">

                <div class="box gradient">

                    <div class="title">
                        <h4>
                            <span>All program list</span>
                        </h4>
                    </div>
                    <?php echo $this->Session->flash(); ?>
                    <div class="content noPad clearfix">
                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Start</th>
                                    <th>End</th>
                                    <th>Duration</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                function secondToTime($input=null){
                                    $h=floor($input/3600);
                                    $input=$input%3600;
                                    $m=floor($input/60);
                                    $input=$input%60;
                                    $s=$input;
                                    $format='';
                                    if($h>12){
                                        $h=$h-12;
                                       $format='PM';
                                    }
                                    else{
                                        $format='AM'; 
                                    }
                                    if($h<10)
                                        $h='0'.$h;
                                    
                                    if($m<10)
                                        $m='0'.$m;
                                    
                                    if($s<10)
                                        $s='0'.$s;
                                    return $h.':'.$m.':'.$s.$format;
                                }
                                foreach ($chunks as $single):
                                    $program = $single['Chunk'];
                                    $d = strtotime($program['duration']) - strtotime('TODAY');
                                    $parsed = date_parse($program['start']);
                                    $st = $parsed['hour'] * 3600 + $parsed['minute'] * 60 + $parsed['second'];
                                    $t = $st + $d;
                                   
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $program['name']; ?></td>
                                        <td><?php echo $program['start']; ?></td>
                                        <td><?php echo secondToTime($t); ?></td>
                                        <td><?php echo $program['duration']; ?></td>
                                        <td>   
                                            <div class="controls center">
                                                <a aria-describedby="qtip-7" data-hasqtip="true" title="Edit Duration" oldtitle="Edit task" target="_blank" href="<?php echo Router::url(array('controller' => 'chunks', 'action' => 'editduration', $program['id'])) ?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>

                                                                     



                                            </div>
                                        </td>
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
</div><!-- End #content -->