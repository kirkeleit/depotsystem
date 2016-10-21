<?php echo form_open_multipart('Utstyr/Utstyrsinfo/'.$Utstyr['UtstyrID'],array('class'=>'form-horizontal')); ?>
<input type="hidden" name="UtstyrID" value="<?php echo set_value('UtstyrID',$Utstyr['UtstyrID']); ?>" />
<div class="panel panel-primary">
  <div class="panel-heading"><b>Utstyrsinformasjon</b></div>
  <div class="panel-body">

    <div class="form-group">
      <label for="KategoriID" class="col-sm-2 control-label">Kategori:</label>
      <div class="col-sm-10">
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
    </div>

    <div class="form-group">
      <label for="ProdusentID" class="col-sm-2 control-label">Produsent:</label>
      <div class="col-sm-10">
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
    </div>

    <div class="form-group">
      <label for="LagerplassID" class="col-sm-2 control-label">Lagerplass:</label>
      <div class="col-sm-10">
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
    </div>

    <div class="form-group">
      <label for="Navn" class="col-sm-2 control-label">Navn:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Utstyr['Navn']); ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="Notater" class="col-sm-2 control-label">Notater:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Utstyr['Notater']); ?></textarea>
      </div>
    </div>

    <div class="form-group">
      <label for="Strekkode" class="col-sm-2 control-label">Strekkode:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="Strekkode" value="<?php echo set_value('Strekkode',$Utstyr['Strekkode']); ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="Forbruksutstyr" class="col-sm-2 control-label">Type:</label>
      <div class="col-sm-10">
        <select class="form-control" name="Forbruksutstyr">
          <option value="0" <?php echo set_select('Forbruksutstyr',0,($Utstyr['Forbruksutstyr'] == 0) ? TRUE : FALSE); ?>>Vanlig utstyr</option>
          <option value="1" <?php echo set_select('Forbruksutstyr',1,($Utstyr['Forbruksutstyr'] == 1) ? TRUE : FALSE); ?>>Forbruksutstyr</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="AntallMinimum" class="col-sm-2 control-label">Minsteantall:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="AntallMinimum" value="<?php echo set_value('AntallMinimum',$Utstyr['AntallMinimum']); ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="Bruksregistrering" class="col-sm-2 control-label">Bruksregistrering:</label>
      <div class="col-sm-10">
        <select class="form-control" name="Bruksregistrering">
          <option value="0" <?php echo set_select('Bruksregistrering',0,($Utstyr['Bruksregistrering'] == 0) ? TRUE : FALSE); ?>>Ingen bruksregistrering</option>
          <option value="1" <?php echo set_select('Bruksregistrering',1,($Utstyr['Bruksregistrering'] == 1) ? TRUE : FALSE); ?>>Bruksregistrering (timer)</option>
          <option value="2" <?php echo set_select('Bruksregistrering',2,($Utstyr['Bruksregistrering'] == 2) ? TRUE : FALSE); ?>>Bruksregistrering (kilometer)</option>
        </select>
      </div>
    </div>

  </div>
  <div class="panel-footer">
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Lagre" name="UtstyrLagre" />
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>

<?php if ($Utstyr['Forbruksutstyr'] == 1) { ?>
<?php if (isset($Utstyr['Forbruk'])) { ?>
<div class="panel panel-info">
  <div class="panel-heading"><b>Forbruk</b></div>
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th>Dato</th>
            <th>Antall</th>
            <th>Kommentar</th>
          </tr>
        </thead>
        <tbody>
<?php
  if (count($Utstyr['Forbruk']) > 0) {
    foreach ($Utstyr['Forbruk'] as $Forbruk) {
?>
          <tr>
            <td><?php echo date("d.m.Y",strtotime($Forbruk['DatoRegistrert'])); ?></td>
            <td<? echo ($Forbruk['Antall'] < 0 ? ' class="bg-danger"' : ''); ?>><?php echo $Forbruk['Antall']; ?></td>
            <td><?php echo $Forbruk['Kommentar']; ?></td>
          </tr>
<?php
    }
  } else {
?>
          <tr>
            <td colspan="3">Ingen forbruk registrert.</td>
          </tr>
<?php
  }
?>
        </tbody>
      </table>
    </div>
</div>
<?php } ?>
<?php } ?>

<?php if ($Utstyr['Forbruksutstyr'] == 0) { ?>
<?php if (isset($Utstyr['Plukklister'])) { ?>
<div class="panel panel-info">
  <div class="panel-heading"><b>Plukklister</b></div>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>Aktivitet</th>
          <th>Plukkliste</th>
          <th>Dato ut</th>
          <th>Dato inn</th>
        </tr>
      </thead>
      <tbody>
<?php
  if (count($Utstyr['Plukklister']) > 0) {
    foreach ($Utstyr['Plukklister'] as $Plukkliste) {
?>
        <tr<?php if ($Plukkliste['DatoRegistrertInn'] == '0000-00-00 00:00:00') { echo ' class="warning"'; } ?>>
          <td><?php echo ($Plukkliste['AktivitetID'] > 0 ? anchor('/Aktiviteter/Aktivitet/'.$Plukkliste['AktivitetID'],$Plukkliste['AktivitetNavn']) : '&nbsp;'); ?></td>
          <td><?php echo anchor('/Aktiviteter/Plukkliste/'.$Plukkliste['PlukklisteID'],$Plukkliste['Beskrivelse']); ?></td>
          <td><?php echo date('d.m.Y H:i',strtotime($Plukkliste['DatoRegistrertUt'])); ?></td>
          <td><?php echo ($Plukkliste['DatoRegistrertInn'] != '0000-00-00 00:00:00' ? date('d.m.Y H:i',strtotime($Plukkliste['DatoRegistrertInn'])) : '&nbsp;'); ?></td>
        </tr>
<?php
    }
  } else {
?>
        <tr>
          <td colspan="4">Ingen plukklister er registrert med denne på.</td>
        </tr>
<?php
  }
?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>
<?php } ?>
