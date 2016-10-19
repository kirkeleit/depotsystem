<div class="panel panel-info">
  <div class="panel-heading"><b>Kategorier</b></div>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>ID</th>
          <th>Navn</th>
          <th>Registrert</th>
          <th>Utstyr</th>
        </tr>
      </thead>
      <tbody>
<?php
  if (isset($Kategorier)) {
    foreach ($Kategorier as $Kategori) {
?>
        <tr>
          <td><?php echo $Kategori['KategoriID']; ?></td>
          <td><?php echo anchor('Utstyr/Kategori/'.$Kategori['KategoriID'],$Kategori['Navn']); ?></td>
          <td><?php echo date("d.m.Y",strtotime($Kategori['DatoRegistrert'])); ?></td>
          <td><?php echo $Kategori['AntallUtstyr']; ?> stk</td>
        </tr>
<?php
    }
  }
?>
      </tbody>
    </table>
  </div>
</div>

<?php echo anchor('Utstyr/Registrerekategori','Registrere ny kategori'); ?>
