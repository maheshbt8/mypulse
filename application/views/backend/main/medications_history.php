<?php
$patient_info = $this->crud_model->select_outpatient_inf($param2);
//print_r($patient_info);
foreach ($patient_info as $row) {


$doctor   = $this->db->get_where('prescription' , array('patient_id' => $row['patient_id'] ))->result_array();
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
                <td align="right" valign="top">
              
                    <?php foreach ($doctor as $row2){ ?>
                    <?php $name = $this->db->get_where('doctor' , array('doctor_id' => $row2['doctor_id'] ))->row()->name;
                          echo 'Doctor Name: '.$name;?><br>
                    <?php echo 'Date: '.date("d M, Y", $row2['timestamp']); ?><br>
                    <?php echo 'Time: '.date("H:i", $row2['timestamp']); ?><br>
                    
                </td>
            </tr>
        </table>
        <hr>
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-primary" data-collapsed="0">
                        
                    <div class="panel-body">
                            
                        <b><?php echo get_phrase('case_history'); ?> :</b>
                        
                        <p><?php echo $row2['case_history']; ?></p>
                        
                        <hr>
                            
                        <b><?php echo get_phrase('medication'); ?> :</b>
                        
                        <p><?php echo $row2['medication']; ?></p>
                        
                        <hr>
                        
                        <b><?php echo get_phrase('note'); ?> :</b>
                        
                        <p><?php echo $row2['note']; ?></p>

                    </div>

                </div>

            </div>
        </div>
        <?php } ?>
    </div>
    <br>

    <a onClick="PrintElem('#prescription_print')" class="btn btn-primary btn-icon icon-left hidden-print">
        Print Prescription
        <i class="entypo-doc-text"></i>
    </a>
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