<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?> 

<div id="main-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                     <div class="panel-heading">
                        <h4 class="panel-title">Prescription</h4>
                     </div>
                        <div class="panel-body panel_body_custome">
                        <div class="row" id="inPatientDiv" style="">
                            <div class="col-md-12"> 
                            <div class="Prescription">
                              <h2>Title : <small><?= $pres_data['title'];?></small></h2>
                              <h2>Doctor : <small><?= $pres_data['doctor_name'];?></small></h2>
                              <h2>Doctor Contact: <small><?= $pres_data['doctor_contact'];?></small></h2>
                              <h2>Hospital : <small><?= $pres_data['hospital_name'];?></small></h2>
                              <h2>Hospital Email : <small><?= $pres_data['hospital_email'];?></small></h2>
                              <h2>Hospital Address : <small><?= $pres_data['hospital_address'];?></small></h2>
                            </div>
                            <?php// print_r($pres_data); ?> 
                          
                            </div>    
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
                     <div class="panel-heading">
                        <h4 class="panel-title">Item</h4>
                     </div>
                        <div class="panel-body panel_body_custome">
                        <div class="row" id="inPatientDiv" style="">
                            <div class="col-md-12"> 
                              <div class="table-responsive project-stats">  
                                 <table class="table">
                                     <thead>
                                         <tr>
                                             <th>#</th>
                                             <th>Drug</th>
                                             <th>Strength</th>
                                             <th>Dosage</th>
                                             <th>Duration</th>
                                             <th>Note</th>
                                             <th>Quantity</th>
                                             <th>Action</th>                                       
                                         </tr>
                                     </thead>
                                      <tbody>
                                         <tr>
                                             <th scope="row">1</th>
                                             <td><?= $pres_data['items'][0]['drug'];?></td>
                                             <td><?= $pres_data['items'][0]['strength'];?></td>
                                             <td><?= $pres_data['items'][0]['dosage'];?></td>
                                             <td><?= $pres_data['items'][0]['duration'];?></td>
                                             <td><?= $pres_data['items'][0]['note'];?></td>
                                             <td class="qty"><?= $pres_data['items'][0]['qty'];?></td>
                                             <td><a  class="btn btn-primary editquantity" ><i class="glyphicon glyphicon-pencil"></i></a>&nbsp;<a data-id="<?= $pres_data['items'][0]['id'];?>" class="btn btn-success updatequantity" style="display: none;">Update</a></td>
                                         </tr>                                         
                                     </tbody>               
                                  </table>
                              </div>                                
                            </div>    
                        </div>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>
<?php
    $this->load->view('template/footer.php');
?>
<script type="text/javascript">
    $(document).ready(function(){
   
         $(document).on('click','.editquantity',function(){
           var value = $('.qty').attr('contenteditable');              
            if (value == 'false') {
                $('.qty').attr('contenteditable','true');
            }
            else {
                $('.qty').attr('contenteditable','false');
            }         
               $('.qty').focus();
               $('.updatequantity').show();
               
          });

         $(document).on('click','.updatequantity',function(){
                var qty = $('.qty').text();
                var id = $(this).data('id');
         $.ajax({
                    url: "<?php echo site_url(); ?>/patients/updateItemQuantity",
                    type: "GET",
                    jsonpCallback: 'callback',
                    data: {id:id,quantity:qty},
                    error: function() {
                      callback();
                    },
                    success: function(res) {
                        //callback(res);
                        console.log(res);
                        if(res==1){
                            toastr.success('Quantity Updated Successfully','');
                        }
                        else{
                            toastr.error('Unable to Update Quantity','');
                        }
                    $('.updatequantity').hide();
                    }
                });

         });

    });

</script>