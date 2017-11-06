<?php
    $this->load->view('template/header.php');
    $this->load->view('template/left.php');
?>    
    <input type="hidden" id="left_active_menu" value="1" />
    <div class="row">
        <div class="card ">
            <div class="card-head">
                <header><?php echo $this->lang->line('doctors');?></header>
                <div class="custome_card_header">
                    <a class="btn btn-success m-b-sm addbtn" data-toggle="tooltip" href="javascript:void(0);" data-toggle="modal" data-target="#edit" style=""><?php echo $this->lang->line('buttons')['addNew'];?></a>
                    <a class="btn btn-danger m-b-sm multiDeleteBtn" data-at="doctors" href="javascript:void(0);"  style="margin-left:10px"><?php echo $this->lang->line('buttons')['delete'];?></a>
                    <?php $this->load->view('template/exbtn');?>
                </div>
            </div>
            <div class="card-body">
                <table id="doctors" class="table table-striped table-bordered table-hover table-checkable order-column valign-middle" >
                    <thead>
                        <tr>
                            <th style="width:10px"></th>
                            <th><?php echo $this->lang->line('tableHeaders')['doctor'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['hospital'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['branch'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['department'];?></th>
                            <th><?php echo $this->lang->line('tableHeaders')['status'];?></th>
                            <th width="20px">#</th>
                        </tr>
                    </thead>
                    
                    <tbody>
                    </tbody>
                </table>  
            </div>
        </div>    
    </div>
<?php
    $this->load->view('template/footer.php');
?>
<script type="text/javascript">
	$(document).ready(function(){
        var dt = $("#doctors").DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": "<?php echo site_url(); ?>/index/getDataTabedoctors"
        });
        <?php $this->load->view('template/exdt');?>
        $(".dataTables_filter").attr("style","display: flex;float: right");
    });
</script>