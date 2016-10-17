<div class="table-responsive">
  <table class="table table-striped table-hover table-condensed">
    <thead>
      <tr>
        <th>ID</th>
        <th>Navn</th>
        <th>Strekkode</th>
        <th>Antall</th>
      </tr>
    </thead>
    <tbody>
<?php
  if (isset($Utstyrsliste)) {
    foreach ($Utstyrsliste as $Utstyr) {
?>
      <tr>
        <td><?php echo $Utstyr['UtstyrID']; ?></td>
        <td><?php echo anchor('/Utstyr/Utstyrsinfo/'.$Utstyr['UtstyrID'],$Utstyr['Navn']); ?></td>
        <td><?php echo $Utstyr['Strekkode']; ?></td>
        <td><?php echo ($Utstyr['Forbruksutstyr'] == 1 ? $Utstyr['Antall']." stk" : "&nbsp;"); ?></td>
      </tr>
<?php
    }
  }
?>
    </tbody>
  </table>
</div>
