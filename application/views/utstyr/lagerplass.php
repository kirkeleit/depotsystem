<h3 class="sub-header">Lagerplass</h3>

<?php echo form_open_multipart('Utstyr/Lagerplass/'.$Lagerplass['LagerplassID']); ?>
<input type="hidden" name="LagerplassID" value="<?php echo set_value('LagerplassID',$Lagerplass['LagerplassID']); ?>" />
<div class="panel panel-default">
  <div class="panel-body">

    <div class="form-group">
      <label for="Navn">Navn:</label>
      <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Lagerplass['Navn']); ?>" />
    </div>

    <div class="form-group">
      <label for="Notater">Notater:</label>
      <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Lagerplass['Notater']); ?></textarea>
    </div>

    <div class="form-group">
      <label for="Strekkode">Strekkode:</label>
      <input type="text" class="form-control" name="Strekkode" value="<?php echo set_value('Strekkode',$Lagerplass['Strekkode']); ?>" />
    </div>

    <div class="form-group">
      <label for="ForeldreLagerplassID">Lagerplass:</label>
      <select class="form-control" name="ForeldreLagerplassID">
        <option value="0" <?php echo set_select('ForeldreLagerplassID',0,($Lagerplass['ForeldreLagerplassID'] == 0) ? TRUE : FALSE); ?>>(ingen lagerplass)</option>
<?php
  foreach ($Lagerplasser as $ForeldreLagerplass) {
    if ($ForeldreLagerplass['LagerplassID'] != $Lagerplass['LagerplassID']) {
?>
        <option value="<?php echo $ForeldreLagerplass['LagerplassID']; ?>" <?php echo set_select('ForeldreLagerplassID',$ForeldreLagerplass['LagerplassID'],($Lagerplass['ForeldreLagerplassID'] == $ForeldreLagerplass['LagerplassID']) ? TRUE : FALSE); ?>><?php echo $ForeldreLagerplass['Navn']; ?></option>
<?php
    }
  }
?>
      </select>
    </div>

  </div>
  <div class="panel-footer">
    <div class="input-group">
      <div class="btn-group">
        <input type="submit" class="btn btn-primary" value="Lagre" name="LagerplassLagre" />
        <input type="submit" class="btn btn-danger" value="Slett" name="LagerplassSlett" />
      </div>
    </div>
  </div>
</div>
