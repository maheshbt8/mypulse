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
                            <div class="table-responsive project-stats">  
                           <table class="table">
                               <thead>
                                   <tr>
                                       <th>#</th>
                                       <th>Title</th>
                                       <th>Doctor</th>
                                       <th>Doctor Contact</th>
                                       <th>Hospital</th>
                                       <th>Hospital Email</th>
                                       <th>Hospital Address</th>                                       
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr>
                                       <th scope="row">1</th>
                                       <td><?= $pres_data['title'];?></td>
                                       <td><?= $pres_data['doctor_name'];?></td>
                                       <td><?= $pres_data['doctor_contact'];?></td>
                                       <td><?= $pres_data['hospital_name'];?></td>
                                       <td><?= $pres_data['hospital_email'];?></td>
                                       <td><?= $pres_data['hospital_address'];?></td>
                                   </tr>
                                   
                               </tbody>
                            </table>
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
                                             <td contenteditable class="editquantity"><?= $pres_data['items'][0]['qty'];?></td>
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