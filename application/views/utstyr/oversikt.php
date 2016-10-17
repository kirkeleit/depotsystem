<?php if (isset($ForbruksStatus)) { ?>
<div class="panel panel-default panel-danger">
  <div class="panel-heading"><b>Forbruksutstyr som må oppdateres</b></div>
  <div class="panel-body">
    <div class="table-responsive">
      <table class="table table-striped table-hover table-condensed">
        <thead>
          <tr>
            <th>Lagerplass</th>
            <th>Navn</th>
            <th>Antall</th>
            <th>Min.antall</th>
            <th>Siste forbruk</th>
          </tr>
        </thead>
        <tbody>
<?php
  foreach ($ForbruksStatus as $Utstyr) {
?>
          <tr>
            <td><?php echo $Utstyr['Lagerplass']; ?></td>
            <td><?php echo anchor('Utstyr/Utstyrsinfo/'.$Utstyr['UtstyrID'],$Utstyr['Navn']); ?></td>
            <td><?php echo $Utstyr['Antall']; ?></td>
            <td><?php echo $Utstyr['MinimumsAntall']; ?></td>
            <td><?php echo date("d.m.Y",strtotime($Utstyr['SisteForbruk'])); ?></td>
          </tr>
<?php
  }
?>
        </tbody>
      </table>
    </div>
  </div>
</div>
<?php } ?>

<div class="panel panel-default panel-danger">
  <div class="panel-heading"><b>Utstyr som trenger vedlikehold</b></div>
  <div class="panel-body">
  </div>
</div>
