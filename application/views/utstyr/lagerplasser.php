<div class="panel panel-info">
  <div class="panel-heading"><b>Lagerplasser</b></div>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>ID</th>
          <th>Navn</th>
          <th>Strekkode</th>
          <th>Registrert</th>
          <th>Utstyr</th>
          <th>Lagerplass</th>
        </tr>
      </thead>
      <tbody>
<?php
  if (isset($Lagerplasser)) {
    foreach ($Lagerplasser as $Lagerplass) {
?>
        <tr>
          <td><?php echo $Lagerplass['LagerplassID']; ?></td>
          <td><?php echo anchor('Utstyr/Lagerplass/'.$Lagerplass['LagerplassID'],$Lagerplass['Navn']); ?></td>
          <td><?php echo $Lagerplass['Strekkode']; ?></td>
          <td><?php echo date("d.m.Y",strtotime($Lagerplass['DatoRegistrert'])); ?></td>
          <td><?php echo $Lagerplass['AntallUtstyr']; ?> stk</td>
          <td><?php echo $Lagerplass['ForeldreLagerplassID']; ?></td>
        </tr>
<?php
    }
  }
?>
      </tbody>
    </table>
  </div>
</div>

<?php echo anchor('Utstyr/Registrerelagerplass','Registrere ny lagerplass'); ?>
