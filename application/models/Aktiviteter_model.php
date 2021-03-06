<?php
  class Aktiviteter_model extends CI_Model {

    function aktivitetstyper() {
      $rtyper = $this->db->query("SELECT AktivitetTypeID,Navn FROM Aktivitetstyper ORDER BY Navn");
      foreach ($rtyper->result_array() as $rtype) {
        $typer[] = $rtype;
        unset($rtype);
      }
      if (isset($typer)) {
        return $typer;
      }
    }

    function aktiviteter() {
      $raktiviteter = $this->db->query("SELECT AktivitetID,DatoRegistrert,DatoEndret,DatoLukket,DatoSlettet,AktivitetTypeID,(SELECT Navn FROM Aktivitetstyper t WHERE (t.AktivitetTypeID=a.AktivitetTypeID)) AS AktivitetTypeNavn,Navn,(SELECT COUNT(*) FROM Plukklister p WHERE (p.AktivitetID=a.AktivitetID)) AS AntallLister FROM Aktiviteter a WHERE (DatoSlettet='0000-00-00 00:00:00') AND (DatoLukket='0000-00-00 00:00:00') ORDER BY DatoRegistrert ASC");
      foreach ($raktiviteter->result_array() as $raktivitet) {
        $aktiviteter[] = $raktivitet;
        unset($raktivitet);
      }
      if (isset($aktiviteter)) {
        return $aktiviteter;
      }
    }

    function aktivitet($ID) {
      $raktiviteter = $this->db->query("SELECT AktivitetID,DatoRegistrert,DatoEndret,DatoLukket,DatoSlettet,AktivitetTypeID,Navn,Notater,(SELECT COUNT(*) FROM Plukklister p WHERE (p.AktivitetID=a.AktivitetID)) AS AntallLister FROM Aktiviteter a WHERE (AktivitetID=".$ID.") LIMIT 1");
      if ($aktivitet = $raktiviteter->row_array()) {
        return $aktivitet;
      }
    }

    function lagreaktivitet($ID = null,$aktivitet) {
      $aktivitet['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $aktivitet['DatoRegistrert'] = $aktivitet['DatoEndret'];
        $this->db->query($this->db->insert_string('Aktiviteter',$aktivitet));
        $aktivitet['AktivitetID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Aktiviteter',$aktivitet,'AktivitetID='.$ID));
        $aktivitet['AktivitetID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Aktiviteten "'.$aktivitet['Navn'].'" ble vellykket oppdatert!');
      }
      return $aktivitet;
    }

    function lukkaktivitet($ID) {
      $this->db->query("UPDATE Aktiviteter SET DatoSlettet='".date('Y-m-d H:i:s')."' WHERE AktivitetID=".$ID." LIMIT 1");
      $this->session->set_flashdata('Infomelding','Aktiviteten er nå lukket!');
    }

    function slettaktivitet($ID) {
      $this->db->query("UPDATE Aktiviteter SET DatoSlettet='".date('Y-m-d H:i:s')."' WHERE AktivitetID=".$ID." LIMIT 1");
      $this->session->set_flashdata('Infomelding','Aktiviteten er nå slettet!');
    }

    function plukklister($filter = null) {
      $sql = "SELECT PlukklisteID,DatoRegistrert,DatoEndret,AktivitetID,(SELECT Navn FROM Aktiviteter a WHERE (a.AktivitetID=p.AktivitetID)) AS AktivitetNavn,Beskrivelse,(SELECT COUNT(*) FROM PlukklisteXUtstyr x WHERE (x.PlukklisteID=p.PlukklisteID)) AS AntallLinjer FROM Plukklister p WHERE (DatoSlettet Is Null) AND (DatoLukket Is Null)";
      if (isset($filter['AktivitetID'])) {
        $sql .= " AND (AktivitetID=".$filter['AktivitetID'].")";
      }
      $sql .= " ORDER BY DatoRegistrert ASC";
      $rplukklister = $this->db->query($sql);
      foreach ($rplukklister->result_array() as $rplukkliste) {
        $plukklister[] = $rplukkliste;
        unset($rplukkliste);
      }
      if (isset($plukklister)) {
        return $plukklister;
      }
    }

    function plukkliste($ID) {
      $rplukklister = $this->db->query("SELECT PlukklisteID,DatoRegistrert,DatoEndret,AktivitetID,Beskrivelse,Notater FROM Plukklister WHERE (PlukklisteID=".$ID.") LIMIT 1");
      if ($plukkliste = $rplukklister->row_array()) {
        return $plukkliste;
      }
    }

    function lagreplukkliste($ID = null,$plukkliste) {
      $plukkliste['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $plukkliste['DatoRegistrert'] = $plukkliste['DatoEndret'];
        $this->db->query($this->db->insert_string('Plukklister',$plukkliste));
        $plukkliste['PlukklisteID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Plukklister',$plukkliste,'PlukklisteID='.$ID));
        $plukkliste['PlukklisteID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Plukklisten "'.$plukkliste['Beskrivelse'].'" ble vellykket oppdatert!');
      }
      return $plukkliste;
    }

    function slettplukkliste($ID) {
      $this->db->query("DELETE FROM PlukklisteXUtstyr WHERE PlukklisteID=".$ID);
      $this->db->query("UPDATE Plukklister SET DatoSlettet='".date('Y-m-d H:i:s')."' WHERE PlukklisteID=".$ID." LIMIT 1");
      $this->session->set_flashdata('Infomelding','Plukklisten er nå slettet!');
    }

    function plukklisteleggtilutstyr($PlukklisteID,$Strekkode) {
      $utstyrsliste = $this->db->query("SELECT UtstyrID FROM Utstyr WHERE (Strekkode='".$Strekkode."') AND (Forbruksutstyr=0)");
      if ($utstyr = $utstyrsliste->row_array()) {
        $this->db->query("INSERT INTO PlukklisteXUtstyr (PlukklisteID,UtstyrID,DatoRegistrertUt) VALUES (".$PlukklisteID.",".$utstyr['UtstyrID'].",NOW())");
        $this->session->set_flashdata('Infomelding','Utstyret er lagt til i plukklisten!');
      } else {
        $this->session->set_flashdata('Feilmelding','Klarte ikke å finne utstyret med strekkode '.$Strekkode.'. Prøv igjen!');
      }
    }

    function plukklistefjernutstyr($PlukklisteID,$Utstyrsliste) {
      foreach ($Utstyrsliste as $Utstyr) {
        $this->db->query("UPDATE PlukklisteXUtstyr SET DatoRegistrertInn=NOW() WHERE PlukklisteID=".$PlukklisteID." AND UtstyrID=".$Utstyr);
      }
      $rutstyrsliste = $this->db->query("SELECT UtstyrID FROM PlukklisteXUtstyr WHERE (PlukklisteID=".$PlukklisteID.") AND (DatoRegistrertInn='0000-00-00 00:00:00')");
      if ($rutstyrsliste->num_rows() == 0) {
        $this->db->query("UPDATE Plukklister SET DatoLukket=NOW() WHERE PlukklisteID=".$PlukklisteID." LIMIT 1");
      }
    }

    function utstyrsliste($PlukklisteID) {
      $rutstyrsliste = $this->db->query("SELECT u.UtstyrID,Navn,ProdusentID,(SELECT Navn FROM Produsenter p WHERE (p.ProdusentID=u.ProdusentID)) AS ProdusentNavn,KategoriID,(SELECT Navn FROM Kategorier k WHERE (k.KategoriID=u.KategoriID)) AS KategoriNavn,Strekkode,IF(DatoRegistrertInn='0000-00-00 00:00:00',1,0) AS Status FROM Utstyr u INNER JOIN PlukklisteXUtstyr x ON u.UtstyrID=x.UtstyrID WHERE x.PlukklisteID=".$PlukklisteID);
      foreach ($rutstyrsliste->result_array() as $utstyr) {
        $utstyrsliste[] = $utstyr;
        unset($utstyr);
      }
      if (isset($utstyrsliste)) {
        return $utstyrsliste;
      }
    }

    function lagretapskadeskjema($data) {
      foreach ($data['Utstyrsliste'] as $Utstyr) {
        $this->db->query("INSERT INTO Vedlikeholdsliste (DatoRegistrert,DatoEndret,UtstyrID,SkadeType,Kommentar) VALUES (NOW(),NOW(),'".$Utstyr['UtstyrID']."','".$Utstyr['SkadeType']."','".$Utstyr['Kommentar']."')");
        $this->db->query("UPDATE PlukklisteXUtstyr SET DatoRegistrertInn=NOW() WHERE PlukklisteID=".$data['PlukklisteID']." AND UtstyrID=".$Utstyr['UtstyrID']);
      }
      $this->db->query("UPDATE Plukklister SET DatoLukket=NOW() WHERE PlukklisteID=".$data['PlukklisteID']." LIMIT 1");
    }

    function brukslogger() {
      $rbrukslogger = $this->db->query("SELECT BruksloggID,DatoRegistrert,AktivitetID,UtstyrID,Timer,Kilometer,Tilstand,Kommentar,Notater FROM Brukslogger b ORDER BY DatoRegistrert ASC");
      foreach ($rbrukslogger->result_array() as $rbrukslogg) {
        $brukslogger[] = $rbrukslogg;
        unset($rbrukslogg);
      }
      if (isset($brukslogger)) {
        return $brukslogger;
      }
    }

    function brukslogg($ID) {
      $rbrukslogger = $this->db->query("SELECT BruksloggID,DatoRegistrert,AktivitetID,UtstyrID,Timer,Kilometer,Tilstand,Kommentar,Notater FROM Brukslogger b WHERE (BruksloggID=".$ID.") ORDER BY DatoRegistrert ASC");
      if ($rbrukslogg = $rbrukslogger->row_array()) {
        return $rbrukslogg;
      }
    }

    function lagrebrukslogg($ID,$brukslogg) {
      $brukslogg['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $brukslogg['DatoRegistrert'] = $brukslogg['DatoEndret'];
        $this->db->query($this->db->insert_string('Brukslogger',$brukslogg));
        $brukslogg['BruksloggID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Brukslogger',$brukslogg,'BruksloggID='.$ID));
        $brukslogg['BruksloggID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Bruksloggen ble vellykket oppdatert!');
      }
      return $brukslogg;
    }

  }
