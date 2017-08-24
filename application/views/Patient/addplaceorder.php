<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?> 

<div id="main-wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-white">
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
                                       <th>Prescription</th>
                                       <th>Action</th>
                                   </tr>
                               </thead>
                               <tbody>
                                            <tr>
                                                <th scope="row">1</th>
                                                <td>new</td>
                                                <td>Dr. Ravi Patel</td>
                                                <td><a href='#' data-url='doctors/previewprescription/<?=$mr['id'];?>' data-id='<?=$mr['id'];?>' class='previewtem'><i class="fa fa-file"></i></a></td></td>
                                            </tr>
                                   
                               </tbody>
                            </table>
                        </div>
                            <?php print_r($pres_data); ?> 
                            </div>    
                        </div>
                        </div>
                    </div>
                </div>
            </div>                        
        </div>