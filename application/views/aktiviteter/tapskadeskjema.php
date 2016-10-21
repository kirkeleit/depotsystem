<?php echo form_open_multipart('Aktiviteter/TapSkadeSkjema/',array('class'=>'form-horizontal')); ?>
<input type="hidden" name="PlukklisteID" value="<?php echo set_value('PlukklisteID',$PlukklisteID); ?>" />
<div class="panel panel-danger">
  <div class="panel-heading"><b>Registrere tap/skade/vedlikehold</b></div>
  <ul class="list-group">
<?php foreach ($Utstyrsliste as $Utstyr) { ?>
<?php if ($Utstyr['Status'] == 1) { ?>
        <li class="list-group-item">
          <input type="hidden" name="UtstyrID[]" value="<?php echo $Utstyr['UtstyrID']; ?>" />
          <div class="form-group">
            <label class="col-sm-2 control-label">Navn:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" value="<?php echo $Utstyr['ProdusentNavn']." ".$Utstyr['Navn']; ?>" readonly/>
            </div>
          </div>
          <div class="form-group">
            <label for="SkadeType" class="col-sm-2 control-label">Skadetype:</label>
            <div class="col-sm-10">
              <select class="form-control" name="SkadeType[]">
                <option value="1">Trenger vedlikehold</option>
                <option value="2">Utstyret er skadet/ødelagt</option>
                <option value="3">Utstyret er mistet</option>
              </select>
            </div>
          </div>
          <div class="form-group">
            <label class="col-sm-2 control-label">Kommentar:</label>
            <div class="col-sm-10">
              <input type="text" class="form-control" name="Kommentar[]" value="" />
            </div>
          </div>
        </li>
<?php } ?>
<?php } ?>
  </ul>
  <div class="panel-footer">
    <div class="form-group">
      <div class="btn-group col-sm-offset-2 col-sm-10">
        <input type="submit" class="btn btn-primary" value="Lagre" name="TapSkadeLagre" />
      </div>
    </div>
  </div>
</div>
<?php echo form_close(); ?>
