<?php echo form_open_multipart('Utstyr/Produsent/'.$Produsent['ProdusentID'],array('class'=>'form-horizontal')); ?>
<input type="hidden" name="ProdusentID" value="<?php echo set_value('ProdusentID',$Produsent['ProdusentID']); ?>" />
<div class="panel panel-primary">
  <div class="panel-heading"><b>Produsent</b></div>
  <div class="panel-body">

    <div class="form-group">
      <label for="Navn" class="col-sm-2 control-label">Navn:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Produsent['Navn']); ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="Notater" class="col-sm-2 control-label">Notater:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Produsent['Notater']); ?></textarea>
      </div>
    </div>

  </div>
  <div class="panel-footer">
    <div class="form-group">
      <div class="btn-group col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Lagre" name="ProdusentLagre" />
        <input type="submit" class="btn btn-danger" value="Slett" name="ProdusentSlett" />
      </div>
    </div>
  </div>
</div>
