<h3 class="sub-header">Leverandør</h3>

<?php echo form_open_multipart('Utstyr/Leverandor/'.$Leverandor['LeverandorID']); ?>
<input type="hidden" name="LeverandorID" value="<?php echo set_value('LeverandorID',$Leverandor['LeverandorID']); ?>" />
<div class="panel panel-default">
  <div class="panel-body">

    <div class="form-group">
      <label for="Navn">Navn:</label>
      <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Leverandor['Navn']); ?>" />
    </div>

    <div class="form-group">
      <label for="Notater">Notater:</label>
      <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Leverandor['Notater']); ?></textarea>
    </div>

  </div>
  <div class="panel-footer">
    <div class="input-group">
      <div class="btn-group">
        <input type="submit" class="btn btn-primary" value="Lagre" name="LeverandorLagre" />
        <input type="submit" class="btn btn-danger" value="Slett" name="LeverandorSlett" />
      </div>
    </div>
  </div>
</div>
