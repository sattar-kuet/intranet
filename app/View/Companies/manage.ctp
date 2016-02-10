<div id="content" class="clearfix">
    <div class="contentwrapper"><!--Content wrapper-->

        <div class="heading">

            <h3>All Company List</h3>                    


            <div class="resBtnSearch">
                <a href="#"><span class="icon16 icomoon-icon-search-3"></span></a>
            </div>


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
                <li class="active">All Company</li>
            </ul>

        </div><!-- End .heading-->

        <!-- Build page from here: Usual with <div class="row-fluid"></div> -->

        <div class="row-fluid">

            <div class="span12">

                <div class="box gradient">

                    <div class="title">
                        <h4>
                            <span>All Company list</span>
                        </h4>
                    </div>
                    <?php echo $this->Session->flash(); ?>
                    <div class="content noPad clearfix">
                        <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
                            <thead>
                                <tr>
                                    <th>Company Name</th>
                                    <th>Owner Name</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($companies as $single):
                                    $company = $single['Company'];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td><?php echo $company['name']; ?></td>
                                        <td><?php echo $company['owner_name']; ?></td>
                                        <td>   
                                            <div class="controls center">
                                                <a aria-describedby="qtip-7" data-hasqtip="true" title="" oldtitle="Edit task" target="_blank" href="<?php echo Router::url(array('controller' => 'companies', 'action' => 'edit', $company['id'])) ?>" class="tip"><span class="icon12 icomoon-icon-pencil"></span></a>
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