<style>
  p{
    color: #000;
  }
</style>
<div class="row">
<div class="col-md-12">
<div class="panel panel-primary" data-collapsed="0">
<div class="panel-body">
<div id="Borge" class="w3-container person" style="display: block;min-height: 350px;">
  <h4 class="w3-opacity">Title : <?= $notifications['title']?></h4>
  <h4><i class="fa fa-clock-o"></i> <?php echo date('M d,Y h:i A',strtotime($notifications['created_at']));?>.<input type="button" class="btn btn-info  pull-right" value="<?php echo get_phrase('close'); ?>" onclick="window.location.href = '<?= $this->session->userdata('last_page'); ?>'"></h4>
  <hr>
  <?= $notifications['notification_text'];?>
</div>
</div>
</div>
</div>
</div>
