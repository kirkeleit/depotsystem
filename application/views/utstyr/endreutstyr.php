<h3 class="sub-header">Endre utstyr</h3>

<?php echo form_open_multipart('Utstyr/Endreutstyr/'.$Utstyr['UtstyrID']); ?>
<input type="hidden" name="UtstyrID" value="<?php echo set_value('UtstyrID',$Utstyr['UtstyrID']); ?>" />
<div class="panel panel-default">
  <div class="panel-body">
    <div class="form-group">
      <label for="ProdusentID">Produsent:</label>
      <select class="form-control" name="ProdusentID">
        <option value="0" <?php echo set_select('ProdusentID',0,($Utstyr['ProdusentID'] == 0) ? TRUE : FALSE); ?>>(ingen produsent)</option>
<?php
  foreach ($Produsenter as $Produsent) {
?>
        <option value="<?php echo $Produsent['ProdusentID']; ?>" <?php echo set_select('ProdusentID',$Produsent['ProdusentID'],($Utstyr['ProdusentID'] == $Produsent['ProdusentID']) ? TRUE : FALSE); ?>><?php echo $Produsent['Navn']; ?></option>
<?php
  }
?>
      </select>
    </div>

    <div class="form-group">
      <label for="KategoriID">Kategori:</label>
      <select class="form-control" name="KategoriID">
        <option value="0" <?php echo set_select('KategoriID',0,($Utstyr['KategoriID'] == 0) ? TRUE : FALSE); ?>>(ingen kategori)</option>
<?php
  foreach ($Kategorier as $Kategori) {
?>
        <option value="<?php echo $Kategori['KategoriID']; ?>" <?php echo set_select('KategoriID',$Kategori['KategoriID'],($Utstyr['KategoriID'] == $Kategori['KategoriID']) ? TRUE : FALSE); ?>><?php echo $Kategori['Navn']; ?></option>
<?php
  }
?>
      </select>
    </div>

    <div class="form-group">
      <label for="LagerplassID">Lagerplass:</label>
      <select class="form-control" name="LagerplassID">
        <option value="0" <?php echo set_select('LagerplassID',0,($Utstyr['LagerplassID'] == 0) ? TRUE : FALSE); ?>>(ingen lagerplass)</option>
<?php
  foreach ($Lagerplasser as $Lagerplass) {
?>
        <option value="<?php echo $Lagerplass['LagerplassID']; ?>" <?php echo set_select('LagerplassID',$Lagerplass['LagerplassID'],($Utstyr['LagerplassID'] == $Lagerplass['LagerplassID']) ? TRUE : FALSE); ?>><?php echo $Lagerplass['Navn']; ?></option>
<?php
  }
?>
      </select>
    </div>

    <div class="form-group">
      <label for="Navn">Navn:</label>
      <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Utstyr['Navn']); ?>" />
    </div>

    <div class="form-group">
      <label for="Notater">Notater:</label>
      <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Utstyr['Notater']); ?></textarea>
    </div>

    <div class="form-group">
      <label for="Strekkode">Strekkode:</label>
      <input type="text" class="form-control" name="Strekkode" value="<?php echo set_value('Strekkode',$Utstyr['Strekkode']); ?>" />
    </div>

    <div class="form-group">
      <label for="Forbruksutstyr">Type:</label>
      <select class="form-control" name="Forbruksutstyr">
        <option value="0" <?php echo set_select('Forbruksutstyr',0,($Utstyr['Forbruksutstyr'] == 0) ? TRUE : FALSE); ?>>Vanlig utstyr</option>
        <option value="1" <?php echo set_select('Forbruksutstyr',1,($Utstyr['Forbruksutstyr'] == 1) ? TRUE : FALSE); ?>>Forbruksutstyr</option>
      </select>
    </div>

  </div>
  <div class="panel-footer">
    <div class="input-group">
      <div class="btn-group">
        <input type="submit" class="btn btn-primary" value="Lagre" name="UtstyrLagre" />
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>
