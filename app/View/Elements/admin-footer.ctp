</div>
<!-- END CONTAINER -->
<!-- BEGIN FOOTER -->
<div class="page-footer">
    <div class="page-footer-inner">

    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
</div>
<?php echo $this->element('common-footer'); ?> 
<?php
echo $this->Html->script(
        array(
            'admin/ajaxLoad',
            'admin/orderManagement',
            'admin/menu',
            //div view by payment category
            'customerinfo',
            // datepicker range            
            '/jquery-ui-daterangepicker-0.4.3/jquery-ui',
            '/jquery-ui-daterangepicker-0.4.3/moment.min',
            '/jquery-ui-daterangepicker-0.4.3/jquery.comiseo.daterangepicker',
            //  'formValidationJs/1.jquery-1.11.1.min',
            'formValidationJs/2.jquery.validate.min',
            'formValidationJs/3.additional-methods.min',
            'formValidationJs/formValidation',
            'http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js',
            'serviceManageDrodown.validation'
//            '/smartMenusPlugin/jquery',
        )
);
?>

<script>
    $(function () {
        $("#e1").daterangepicker();
    });
    $("#e2").daterangepicker({
        presetRanges: [{
                text: 'Today',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment()
                }
            }, {
                text: 'Tomorrow',
                dateStart: function () {
                    return moment().add('days', 1)
                },
                dateEnd: function () {
                    return moment().add('days', 1)
                }
            }, {
                text: 'Next 7 Days',
                dateStart: function () {
                    return moment()
                },
                dateEnd: function () {
                    return moment().add('days', 6)
                }
            }, {
                text: 'Next Week',
                dateStart: function () {
                    return moment().add('weeks', 1).startOf('week')
                },
                dateEnd: function () {
                    return moment().add('weeks', 1).endOf('week')
                }
            }],
        applyOnMenuSelect: false,
        datepickerOptions: {
            maxDate: null
        }
    });
</script>
</body>
<!-- END BODY -->
</html>