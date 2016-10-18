<h3 class="sub-header">Utstyrsinfo</h3>

<div class="panel panel-default">
  <div class="panel-body">
    <div class="form-group">
      <label for="ProdusentID">Produsent:</label><br />
      <?php echo $Utstyr['ProdusentNavn']; ?>
    </div>

    <div class="form-group">
      <label for="KategoriID">Kategori:</label><br />
      <?php echo $Utstyr['KategoriNavn']; ?>
    </div>

    <div class="form-group">
      <label for="LagerplassID">Lagerplass:</label><br />
      <?php echo $Utstyr['LagerplassNavn']; ?>
    </div>

    <div class="form-group">
      <label for="Navn">Navn:</label><br />
      <?php echo $Utstyr['Navn']; ?>
    </div>

    <div class="form-group">
      <label for="Notater">Notater:</label><br />
      <?php echo $Utstyr['Notater']; ?>
    </div>

    <div class="form-group">
      <label for="Strekkode">Strekkode:</label><br />
      <?php echo $Utstyr['Strekkode']; ?>
    </div>

    <div class="form-group">
      <label for="Forbruksutstyr">Type:</label><br />
      <?php echo ($Utstyr['Forbruksutstyr'] == 1 ? 'Forbruksutstyr' : 'Vanlig utstyr'); ?>
    </div>

  </div>
  <div class="panel-footer">
    <?php echo anchor('Utstyr/endreutstyr/'.$Utstyr['UtstyrID'],'Endre'); ?>
  </div>
</div>

<?php if (isset($Utstyr['Forbruk'])) { ?>
<div class="panel panel-default">
  <div class="panel-heading">Forbruk</div>
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
  foreach ($Utstyr['Forbruk'] as $Forbruk) {
?>
          <tr>
            <td><?php echo date("d.m.Y",strtotime($Forbruk['DatoRegistrert'])); ?></td>
            <td<? echo ($Forbruk['Antall'] < 0 ? ' class="bg-danger"' : ''); ?>><?php echo $Forbruk['Antall']; ?></td>
            <td><?php echo $Forbruk['Kommentar']; ?></td>
          </tr>
<?php
  }
?>
        </tbody>
      </table>
    </div>
</div>
<?php } ?>
