<?php echo form_open_multipart('Aktiviteter/Aktivitet/'.$Aktivitet['AktivitetID'],array('class'=>'form-horizontal')); ?>
<input type="hidden" name="AktivitetID" value="<?php echo set_value('AktivitetID',$Aktivitet['AktivitetID']); ?>" />
<div class="panel panel-primary">
  <div class="panel-heading"><b>Aktivitet</b></div>
  <div class="panel-body">

    <div class="form-group">
      <label for="AktivitetTypeID" class="col-sm-2 control-label">Aktivitetstype:</label>
      <div class="col-sm-10">
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
    </div>

    <div class="form-group">
      <label for="Navn" class="col-sm-2 control-label">Navn/sted:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="Navn" value="<?php echo set_value('Navn',$Aktivitet['Navn']); ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="Notater" class="col-sm-2 control-label">Notater:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Aktivitet['Notater']); ?></textarea>
      </div>
    </div>

  </div>

  <div class="panel-footer">
    <div class="form-group">
      <div class="col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Lagre" name="AktivitetLagre" />
        <input type="submit" class="btn btn-success" value="Lukk" name="AktivitetLukk" />
        <input type="submit" class="btn btn-danger" value="Slett" name="AktivitetSlett" />
      </div>
    </div>
  </div>
</div>

<div class="panel panel-info">
  <div class="panel-heading"><b>Plukklister</b></div>
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
<?php
  if (isset($Plukklister)) {
    foreach ($Plukklister as $Plukkliste) {
?>
        <tr>
          <td><?php echo date('d.m.Y H:i',strtotime($Plukkliste['DatoRegistrert'])); ?></td>
          <td><?php echo date('d.m.Y H:i',strtotime($Plukkliste['DatoEndret'])); ?></td>
          <td><?php echo anchor('Aktiviteter/Plukkliste/'.$Plukkliste['PlukklisteID'],$Plukkliste['Beskrivelse']); ?></td>
          <td><?php echo $Plukkliste['AntallLinjer']." stk"; ?></td>
        </tr>
<?php
    }
  } else {
?>
        <tr>
          <td colspan="4">Ingen plukklister registrert.</td>
        </tr>
<?php
  }
?>
      </tbody>
    </table>
  </div>
</div>
<?php echo form_close(); ?>
