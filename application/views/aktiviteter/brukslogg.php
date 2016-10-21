<?php echo form_open_multipart('Aktiviteter/Brukslogg/'.$Brukslogg['BruksloggID'],array('class'=>'form-horizontal')); ?>
<input type="hidden" name="BruksloggID" value="<?php echo set_value('BruksloggID',$Brukslogg['BruksloggID']); ?>" />
<div class="panel panel-primary">
  <div class="panel-heading"><b>Brukslogg</b></div>

  <div class="panel-body">
    <div class="form-group">
      <label for="AktivitetID" class="col-sm-2 control-label">Aktivitet:</label>
      <div class="col-sm-10">
        <select class="form-control" name="AktivitetID">
          <option value="0" <?php echo set_select('AktivitetID',0,($Brukslogg['AktivitetID'] == 0) ? TRUE : FALSE); ?>>(Aktivitet ikke valgt)</option>
<?php
  foreach ($Aktiviteter as $Aktivitet) {
?>
          <option value="<?php echo $Aktivitet['AktivitetID']; ?>" <?php echo set_select('AktivitetID',$Aktivitet['AktivitetID'],($Brukslogg['AktivitetID'] == $Aktivitet['AktivitetID']) ? TRUE : FALSE); ?>><?php echo $Aktivitet['Navn']; ?></option>
<?php
  }
?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="UtstyrID" class="col-sm-2 control-label">Utstyr:</label>
      <div class="col-sm-10">
        <select class="form-control" name="UtstyrID">
          <option value="0" <?php echo set_select('UtstyrID',0,($Brukslogg['UtstyrID'] == 0) ? TRUE : FALSE); ?>>(Utstyr ikke valgt)</option>
<?php
  foreach ($Utstyrsliste as $Utstyr) {
?>
          <option value="<?php echo $Utstyr['UtstyrID']; ?>" <?php echo set_select('UtstyrID',$Utstyr['UtstyrID'],($Brukslogg['UtstyrID'] == $Utstyr['UtstyrID']) ? TRUE : FALSE); ?>><?php echo $Utstyr['ProdusentNavn'].' '.$Utstyr['Navn']; ?></option>
<?php
  }
?>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="Timer" class="col-sm-2 control-label">Timer:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="Timer" step="1" value="<?php echo set_value('Timer',$Brukslogg['Timer']); ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="Kilometer" class="col-sm-2 control-label">Kilometer:</label>
      <div class="col-sm-10">
        <input type="number" class="form-control" name="Kilometer" step="0.1" value="<?php echo set_value('Kilometer',$Brukslogg['Kilometer']); ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="Tilstand" class="col-sm-2 control-label">Tilstand:</label>
      <div class="col-sm-10">
        <select class="form-control" name="Tilstand">
          <option value="0" <?php echo set_select('Tilstand',0,($Brukslogg['Tilstand'] == 0) ? TRUE : FALSE); ?>>Utstyret er i orden</option>
          <option value="1" <?php echo set_select('Tilstand',1,($Brukslogg['Tilstand'] == 1) ? TRUE : FALSE); ?>>Trenger vedlikehold</option>
          <option value="2" <?php echo set_select('Tilstand',2,($Brukslogg['Tilstand'] == 2) ? TRUE : FALSE); ?>>Utstyret er skadet/ødelagt</option>
          <option value="3" <?php echo set_select('Tilstand',3,($Brukslogg['Tilstand'] == 3) ? TRUE : FALSE); ?>>Utstyret er mistet</option>
        </select>
      </div>
    </div>

    <div class="form-group">
      <label for="Kommentar" class="col-sm-2 control-label">Kommentar:</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="Kommentar" value="<?php echo set_value('Kommentar',$Brukslogg['Kommentar']); ?>" />
      </div>
    </div>

    <div class="form-group">
      <label for="Notater" class="col-sm-2 control-label">Notater:</label>
      <div class="col-sm-10">
        <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Brukslogg['Notater']); ?></textarea>
      </div>
    </div>
  </div>

  <div class="panel-footer">
    <div class="form-group">
      <div class="btn-group col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Lagre" name="BruksloggLagre" />
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>
