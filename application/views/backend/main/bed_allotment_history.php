<?php
$patient_info = $this->crud_model->select_patient_inf($param2);
//print_r($patient_info);
foreach ($patient_info as $row) {


$bed   = $this->db->get_where('bed_allotment' , array('patient_id' => $row['patient_id'] ))->result_array();
//echo $this->db->last_query();
?>

    <div id="prescription_print">
        <table width="100%" border="0">
            <tr>
                <td align="left" valign="top">
                    <?php echo 'Patient Name: '.$row['name']; ?><br>
                        <?php echo 'Age: '.$row['age']; ?><br>
                        <?php echo 'Sex: '.$row['sex']; ?><br>
                    
                </td>
                </tr>
        </table>
       <hr>
        <?php foreach ($bed as $row2){ ?>
                    <?php $name = $this->db->get_where('bed' , array('bed_id' => $row2['bed_id'] ))->row()->ward;
                    $ward = $this->db->get_where('beds' , array('id' => $name))->row()->ward;?>
                   
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary" data-collapsed="0">
                        
                    <div class="panel-body">
                        
                        <b>Bed Type:</b> <?php echo $ward; ?>-<?php echo $this->db->get_where('bed' , array('bed_id' => $row2['bed_id'] ))->row()->bed_number;?>
                        <hr>
                        
                        <b>Bed price:</b>
                        <?php $date1=date_create(date("m/d/Y", $row2['allotment_timestamp']));
                  
                        $date2=date_create(date("m/d/Y", $row2['discharge_timestamp']));
                        $diff=date_diff($date1,$date2);
                        $date3=$diff->format("%a");
                        $date4= $this->db->get_where('beds' , array('id' => $name))->row()->price;
                        echo $date3 * $date4;
                        ?>
                        <hr>
                        
                        <b><?php echo get_phrase('allotment_timestamp'); ?> :</b>
                        
                        <?php echo date("d M, Y", $row2['allotment_timestamp']); ?>
                        <hr>
                        <b><?php echo get_phrase('discharge_timestamp'); ?> :</b>
                        
                        <?php echo date("d M, Y", $row2['discharge_timestamp']); ?>
                        
                    </div>

                </div>

            </div>
        </div>
        
        <?php } ?>
    </div>
    <br>
<!--
    <a onClick="PrintElem('#prescription_print')" class="btn btn-primary btn-icon icon-left hidden-print">
        Print Prescription
        <i class="entypo-doc-text"></i>
    </a>-->
<?php } ?>



<script type="text/javascript">

    function PrintElem(elem)
    {
        Popup($(elem).html());
    }

    function Popup(data)
    {
        var mywindow = window.open('', 'prescription', 'height=400,width=600');
        mywindow.document.write('<html><head><title>Prescription</title>');
        mywindow.document.write('<link rel="stylesheet" href="assets/css/neon-theme.css" type="text/css" />');
        mywindow.document.write('<link rel="stylesheet" href="assets/js/datatables/responsive/css/datatables.responsive.css" type="text/css" />');
        mywindow.document.write('</head><body >');
        mywindow.document.write(data);
        mywindow.document.write('</body></html>');

        mywindow.print();
        mywindow.close();

        return true;
    }

</script>