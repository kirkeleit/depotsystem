<h3 class="sub-header">Aktivitet</h3>

<?php echo form_open_multipart('Aktiviteter/Aktivitet/'.$Aktivitet['AktivitetID']); ?>
<input type="hidden" name="AktivitetID" value="<?php echo set_value('AktivitetID',$Aktivitet['AktivitetID']); ?>" />
<div class="panel panel-primary">
  <div class="panel-body">

    <div class="form-group">
      <label for="AktivitetTypeID">Aktivitetstype:</label>
      <select class="form-control" name="AktivitetTypeID">
        <option value="0" <?php echo set_select('AktivitetTypeID',0,($Aktivitet['AktivitetTypeID'] == 0) ? TRUE : FALSE); ?>>(ikke valgt)</option>
<?php
  foreach ($Aktivitetstyper as $Aktivitetstype) {
?>
        <option value="<?php echo $Aktivitetstype['AktivitetTypeID']; ?>" <?php echo set_select('AktivitetTypeID',$Aktivitetstype['AktivitetTypeID'],($Aktivitet['AktivitetTypeID'] == $Aktivitetstype['AktivitetTypeID']) ? TRUE : FALSE); ?>><?php echo $Aktivitetstype['Navn']; ?></option>
<?php
  }
?>
      </select>
    </div>

    <div class="form-group">
      <label for="Navn">Navn/sted:</label>
      <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Aktivitet['Navn']); ?>" />
    </div>

    <div class="form-group">
      <label for="Notater">Notater:</label>
      <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Aktivitet['Notater']); ?></textarea>
    </div>

  </div>

  <div class="panel-footer">
    <div class="input-group">
      <div class="btn-group">
        <input type="submit" class="btn btn-primary" value="Lagre" name="AktivitetLagre" />
      </div>
    </div>
  </div>
</div>

<div class="panel panel-info">
  <div class="panel-heading"><b>Utstyrslister</b></div>
<?php if (isset($Utstyrslister)) { ?>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>Opprettet</th>
          <th>Endret</th>
          <th>Beskrivelse</th>
          <th>Utstyrslinjer</th>
        </tr>
      </thead>
      <tbody>
<?php foreach ($Utstyrslister as $Utstyrsliste) { ?>
        <tr>
          <td><?php echo date('d.m.Y H:i',strtotime($Utstyrsliste['DatoRegistrert'])); ?></td>
          <td><?php echo date('d.m.Y H:i',strtotime($Utstyrsliste['DatoEndret'])); ?></td>
          <td><?php echo anchor('Aktiviteter/Utstyrsliste/'.$Utstyrsliste['UtstyrslisteID'],$Utstyrsliste['Beskrivelse']); ?></td>
          <td><?php echo $Utstyrsliste['AntallLinjer']." stk"; ?></td>
        </tr>
<?php } ?>
      </tbody>
    </table>
  </div>
<?php } ?>
</div>
<?php echo form_close(); ?>
