<h3 class="sub-header">Utstyrsliste</h3>

<?php echo form_open_multipart('Aktiviteter/Utstyrsliste/'.$Utstyrsliste['UtstyrslisteID']); ?>
<input type="hidden" name="UtstyrslisteID" value="<?php echo set_value('UtstyrslisteID',$Utstyrsliste['UtstyrslisteID']); ?>" />
<div class="panel panel-primary">
  <div class="panel-heading"><b>Informasjon</b> <span class="pull-right clickable"><i class="glyphicon glyphicon-chevron-up"></i></span></div>
  <div class="panel-body">

    <div class="form-group">
      <label for="AktivitetID">Aktivitet:</label>
      <select class="form-control" name="AktivitetID">
        <option value="0" <?php echo set_select('AktivitetID',0,($Utstyrsliste['AktivitetID'] == 0) ? TRUE : FALSE); ?>>(ingen aktivitet)</option>
<?php
  foreach ($Aktiviteter as $Aktivitet) {
?>
        <option value="<?php echo $Aktivitet['AktivitetID']; ?>" <?php echo set_select('AktivitetID',$Aktivitet['AktivitetID'],($Utstyrsliste['AktivitetID'] == $Aktivitet['AktivitetID']) ? TRUE : FALSE); ?>><?php echo $Aktivitet['Navn']; ?></option>
<?php
  }
?>
      </select>
    </div>

    <div class="form-group">
      <label for="Beskrivelse">Beskrivelse:</label>
      <input type="text" class="form-control" name="Beskrivelse" value="<?php echo set_value('Beskrivelse',$Utstyrsliste['Beskrivelse']); ?>" />
    </div>

    <div class="form-group">
      <label for="Notater">Notater:</label>
      <textarea class="form-control" name="Notater"><?php echo set_value('Notater',$Utstyrsliste['Notater']); ?></textarea>
    </div>
  </div>

  <div class="panel-footer">
    <div class="input-group">
      <div class="btn-group">
        <input type="submit" class="btn btn-primary" value="Lagre" name="UtstyrslisteLagre" />
      </div>
    </div>
  </div>
</div>

<div class="panel panel-info">
  <div class="panel-heading"><b>Liste over utstyr</b></div>
<?php if ($Utstyrsliste['UtstyrslisteID'] > 0) { ?>
  <div class="panel-body">
    <input type="text" class="form-control" name="UtstyrStrekkode" value="" placeholder="Skriv inn ID/strekkode på utstyret og trykk på enter" autofocus />
  </div>
<?php } ?>
<?php if (isset($ListeOverUtstyr)) { ?>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>Kategori</th>
          <th>Produsent</th>
          <th>Navn</th>
          <th>Strekkode</th>
        </tr>
      </thead>
      <tbody>
<?php foreach ($ListeOverUtstyr as $Utstyr) { ?>
        <tr>
          <td><?php echo $Utstyr['KategoriNavn']; ?></td>
          <td><?php echo $Utstyr['ProdusentNavn']; ?></td>
          <td><?php echo $Utstyr['Navn']; ?></td>
          <td><?php echo $Utstyr['Strekkode']; ?></td>
        </tr>
<?php } ?>
      </tbody>
    </table>
  </div>
<?php } ?>
</div>
<?php echo form_close(); ?>
<script>
$(document).on('click', '.panel-heading span.clickable', function(e){
    var $this = $(this);
	if(!$this.hasClass('panel-collapsed')) {
		$this.parents('.panel').find('.panel-body').slideUp();
		$this.addClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-up').addClass('glyphicon-chevron-down');
	} else {
		$this.parents('.panel').find('.panel-body').slideDown();
		$this.removeClass('panel-collapsed');
		$this.find('i').removeClass('glyphicon-chevron-down').addClass('glyphicon-chevron-up');
	}
})
</script>
