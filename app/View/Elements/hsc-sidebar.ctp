<div id="wrapper">
<span class='level hide' id='hsc'> </span>
    <!--Responsive navigation button-->  
    <div class="resBtn">
        <a href="#"><span class="icon16 minia-icon-list-3"></span></a>
    </div>
    <!--Left Sidebar collapse button-->  
    <div class="collapseBtn leftbar">
        <a href="#" class="tipR" title="Hide Left Sidebar"><span class="icon12 minia-icon-layout"></span></a>
    </div>
    <!--Sidebar background-->
    <div id="sidebarbg"></div>
    <!--Sidebar content-->
    <div id="sidebar">
        <div class="sidenav">
            <div class="sidebar-widget" style="margin: -1px 0 0 0;">
                <h5 class="title" style="margin-bottom:0"><?php echo $leftMenu['level']['name']; ?></h5>
            </div><!-- End .sidenav-widget -->
            <div class="mainnav">
                <ul>
                    <?php foreach ($leftMenu['subject'] as $subject): ?> 
                        <li>
                            <a href="#"><span class="icon16   icomoon-icon-graduation"></span><?php echo $subject['name']; ?></a>
                            <ul class="sub">
                                <?php foreach ($subject['chapter'] as $chapter): ?>
                                    <li>
                                        <a href="#"><span class="icon16   icomoon-icon-graduation"></span><?php echo $chapter['name']; ?></a>
                                        <ul class="sub">
                                            <li>
                                                <a href="/<?php echo $this->request->params['action']; ?>" class="getContentByClick" id="<?php echo $chapter['level_id'].','.$chapter['subject_id'].','.$chapter['chapter_id']; ?>"><span class="icon16 icomoon-icon-plus"></span>Study</a>
                                            </li>
                                            <li>
                                                <a href="/<?php echo $this->request->params['action']; ?>" class="getContentByClick" id="<?php echo $chapter['level_id'].','.$chapter['subject_id'].','.$chapter['chapter_id']; ?>" ><span class="icon16 icomoon-icon-pencil-4" ></span>Practice</a>
                                            </li>

                                            <li>
                                                <a href="/<?php echo $this->request->params['action']; ?>" class="getContentByClick" id="<?php echo $chapter['level_id'].','.$chapter['subject_id'].','.$chapter['chapter_id']; ?>"><span class="icon16 icomoon-icon-pencil-4"></span>Test</a>
                                            </li>
                                        </ul>
                                    </li>

                                <?php endforeach;
                                ?>
                            </ul>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div><!-- End sidenav -->
    </div><!-- End #sidebar -->