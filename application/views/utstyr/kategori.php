<?php echo form_open_multipart('Utstyr/Kategori/'.$Kategori['KategoriID']); ?>
<input type="hidden" name="KategoriID" value="<?php echo set_value('KategoriID',$Kategori['KategoriID']); ?>" />
<div class="panel panel-default">
  <div class="panel-heading"><b>Kategori</b></div>
  <div class="panel-body">

    <div class="form-group">
      <label for="Navn">Navn:</label>
      <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Kategori['Navn']); ?>" />
    </div>

    <div class="form-group">
      <label for="Notater">Notater:</label>
      <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Kategori['Notater']); ?></textarea>
    </div>

  </div>
  <div class="panel-footer">
    <div class="input-group">
      <div class="btn-group">
        <input type="submit" class="btn btn-primary" value="Lagre" name="KategoriLagre" />
        <input type="submit" class="btn btn-danger" value="Slett" name="KategoriSlett" />
      </div>
    </div>
  </div>
</div>
