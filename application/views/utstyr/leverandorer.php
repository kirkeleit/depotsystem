<h3 class="sub-header">Leverandører</h3>

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
  if (isset($Leverandorer)) {
    foreach ($Leverandorer as $Leverandor) {
?>
      <tr>
        <td><?php echo $Leverandor['LeverandorID']; ?></td>
        <td><?php echo anchor('Utstyr/Leverandor/'.$Leverandor['LeverandorID'],$Leverandor['Navn']); ?></td>
        <td><?php echo date("d.m.Y",strtotime($Leverandor['DatoRegistrert'])); ?></td>
        <td><?php echo $Leverandor['AntallUtstyr']; ?> stk</td>
      </tr>
<?php
    }
  }
?>
    </tbody>
  </table>
</div>

<?php echo anchor('Utstyr/Registrereleverandor','Registrere ny leverandør'); ?>
