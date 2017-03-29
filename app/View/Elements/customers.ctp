<div class="row-fluid">
    <table cellpadding="0" cellspacing="0" border="0" class="responsive dynamicTable display table table-bordered" width="100%">
        <thead>
            <tr>                                           
                <th>Name</th>
                <th>Customer Detail</th>
                <th>Package</th>
                <th>Status</th>
                <th>Action</th>

            </tr>
        </thead>
        <tbody>
            <?php
         //    pr($data); exit;
            
            foreach ($data['customer'] as $index => $d):
                $customer = $d;
//                        pr($customer['status']); exit;
                $customer_address = $customer['house_no'] . ' ' . $customer['street'] . ' ' .
                        $customer['apartment'] . ' ' . $customer['city'] . ' ' . $customer['state'] . ' '
                        . $customer['zip'];
                $package = array();
                if (count($data['package']) > 0) {
                    $package = $data['package'][$index];
                }
                ?>
                <tr class="odd gradeX">

                    <td><?php echo $customer['first_name'] . ' ' . $customer['middle_name'] . ' ' . $customer['last_name']; ?></td>
                    <td>
                        <ul>
                            <li>Cell:<?php echo $customer['cell']; ?></li>
                            <li>Address:<?php echo $customer_address; ?></li>
                        </ul>
                    </td>

                    <td>
                        <?php if (count($package) > 0): ?>
                            <ul>
                                <li> Package Name: <?php echo $package['name']; ?></li>
                                <li> Month: <?php echo $package['duration']; ?></li>
                                <li> Charge: <?php echo $package['charge']; ?></li>
                            </ul>
                            <?php
                        endif;
                        ?>
                    </td>
                    <td>                               
                        <?php echo $customer['status']; ?>                               
                    </td>
                    <td>
                        <?php
                        echo $this->Form->create('PackageCustomer', array(
                            'inputDefaults' => array(
                                'label' => false,
                                'div' => false
                            ),
                            'id' => 'form_sample_3',
                            'class' => 'form-horizontal',
                            'novalidate' => 'novalidate',
                            'url' => array('controller' => 'admins', 'action' => 'changeservice')
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('id', array(
                            'type' => 'hidden',
                            'value' => $customer['id']
                                )
                        );
                        ?>
                        <?php
                        echo $this->Form->input('status', array(
                            'type' => 'select',
                            'options' => Array('ticket' => 'Generate Ticket', 'info' => 'Customer  Information', 'history' => 'Ticket History'),
                            'empty' => 'Select Action',
                            'class' => 'form-control form-filter input-sm ',
                                )
                        );
                        ?>
                        <br>
                        <?php
                        echo $this->Form->button(
                                'Go', array('class' => 'btn blue', 'title' => 'Do this selected action', 'type' => 'submit')
                        );
                        ?>
                        <?php echo $this->Form->end(); ?>
                    </td>
                </tr>
                <?php
            endforeach;
            ?>
        </tbody>
    </table>
</div>