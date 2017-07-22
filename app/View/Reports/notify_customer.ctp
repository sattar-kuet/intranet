<div class="page-content-wrapper">
    <div class="page-content">     
        <div class="row">
            <div class="col-xs-12">             
                <table class="table table-striped table-hover table-bordered" id="sample_editable_1">
                    <thead>
                        <tr>
                            <th class="sorting_desc">
                                ID
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($data as $results):
                            ?>
                            <tr>
                                <td class="hidden-480">
                                    <?php echo $results['transactions']['id']; ?>                            
                                </td>
                                <td class="hidden-480">
                                    <a href="<?php
                                    echo Router::url(array('controller' => 'customers',
                                        'action' => 'edit', $results['transactions']['package_customer_id']))
                                    ?>" 
                                       target="_blank">
                                        View customer details
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



