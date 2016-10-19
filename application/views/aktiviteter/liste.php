<div class="panel panel-default">
  <div class="panel-heading"><b>Aktiviteter</b></div>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>Dato</th>
          <th>Navn/sted</th>
          <th>Lister</th>
          <th>Type</th>
        </tr>
      </thead>
      <tbody>
<?php
  if (isset($Aktiviteter)) {
    foreach ($Aktiviteter as $Aktivitet) {
?>
        <tr>
          <td><?php echo date('d.m.Y',strtotime($Aktivitet['DatoRegistrert'])); ?></td>
          <td><?php echo anchor('/Aktiviteter/Aktivitet/'.$Aktivitet['AktivitetID'],$Aktivitet['Navn']); ?></td>
          <td><?php echo $Aktivitet['AntallLister']." stk"; ?></td>
          <td><?php echo $Aktivitet['AktivitetTypeNavn']; ?></td>
        </tr>
<?php
    }
  }
?>
      </tbody>
    </table>
  </div>
</div>

<div class="panel panel-info">
  <div class="panel-heading"><b>Plukklister</b></div>
  <div class="table-responsive">
    <table class="table table-striped table-hover table-condensed">
      <thead>
        <tr>
          <th>ID</th>
          <th>Påbegynt</th>
          <th>Sist endret</th>
          <th>Aktivitet</th>
          <th>Beskrivelse</th>
          <th>Linjer</th>
        </tr>
      </thead>
      <tbody>
<?php
  if (isset($Plukklister)) {
    foreach ($Plukklister as $Plukkliste) {
?>
        <tr>
          <td><?php echo $Plukkliste['PlukklisteID']; ?></td>
          <td><?php echo date('d.m.Y',strtotime($Plukkliste['DatoRegistrert'])); ?></td>
          <td><?php echo date('d.m.Y',strtotime($Plukkliste['DatoEndret'])); ?></td>
          <td><?php echo $Plukkliste['AktivitetNavn']; ?></td>
          <td><?php echo anchor('/Aktiviteter/Plukkliste/'.$Plukkliste['PlukklisteID'],$Plukkliste['Beskrivelse']); ?></td>
          <td><?php echo $Plukkliste['AntallLinjer']; ?></td>
        </tr>
<?php
    }
  } else {
?>
        <tr>
          <td colspan="6">Ingen åpne plukklister.</td>
        </tr>
<?php
  }
?>
      </tbody>
    </table>
  </div>
</div>
