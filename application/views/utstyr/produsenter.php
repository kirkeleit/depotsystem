<h3 class="sub-header">Produsenter</h3>

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
  if (isset($Produsenter)) {
    foreach ($Produsenter as $Produsent) {
?>
      <tr>
        <td><?php echo $Produsent['ProdusentID']; ?></td>
        <td><?php echo anchor('Utstyr/Produsent/'.$Produsent['ProdusentID'],$Produsent['Navn']); ?></td>
        <td><?php echo date("d.m.Y",strtotime($Produsent['DatoRegistrert'])); ?></td>
        <td><?php echo $Produsent['AntallUtstyr']; ?> stk</td>
      </tr>
<?php
    }
  }
?>
    </tbody>
  </table>
</div>

<?php echo anchor('Utstyr/Registrereprodusent','Registrere ny produsent'); ?>
