<?php if (count($ForbruksStatus) > 0) { ?>
<div class="panel panel-default panel-danger">
  <div class="panel-heading"><b>Forbruksutstyr som må oppdateres</b></div>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>Lagerplass</th>
          <th>Navn</th>
          <th>Antall</th>
          <th>Min.antall</th>
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
          <td><?php echo $Utstyr['AntallMinimum']; ?></td>
        </tr>
<?php
  }
?>
      </tbody>
    </table>
  </div>
</div>
<?php } ?>

<?php if (FALSE) { ?>
<div class="panel panel-default panel-danger">
  <div class="panel-heading"><b>Utstyr som trenger vedlikehold</b></div>
</div>
<?php } ?>

<?php if (count($ForbruksStatus) == 0) { ?>
<div class="jumbotron"><h2>Alt er ok! Godt jobba! :-)</h2></div>
<?php } ?>
