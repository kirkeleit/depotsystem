<h3 class="sub-header">Produsent</h3>

<?php echo form_open_multipart('Utstyr/Produsent/'.$Produsent['ProdusentID']); ?>
<input type="hidden" name="ProdusentID" value="<?php echo set_value('ProdusentID',$Produsent['ProdusentID']); ?>" />
<div class="panel panel-default">
  <div class="panel-body">

    <div class="form-group">
      <label for="Navn">Navn:</label>
      <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Produsent['Navn']); ?>" />
    </div>

    <div class="form-group">
      <label for="Notater">Notater:</label>
      <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Produsent['Notater']); ?></textarea>
    </div>

  </div>
  <div class="panel-footer">
    <div class="input-group">
      <div class="btn-group">
        <input type="submit" class="btn btn-primary" value="Lagre" name="ProdusentLagre" />
        <input type="submit" class="btn btn-danger" value="Slett" name="ProdusentSlett" />
      </div>
    </div>
  </div>
</div>
