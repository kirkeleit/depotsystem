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
      $raktiviteter = $this->db->query("SELECT AktivitetID,DatoRegistrert,DatoEndret,DatoLukket,DatoSlettet,AktivitetTypeID,(SELECT Navn FROM Aktivitetstyper t WHERE (t.AktivitetTypeID=a.AktivitetTypeID)) AS AktivitetTypeNavn,Navn,(SELECT COUNT(*) FROM Utstyrslister l WHERE (l.AktivitetID=a.AktivitetID)) AS AntallLister FROM Aktiviteter a ORDER BY DatoRegistrert ASC");
      foreach ($raktiviteter->result_array() as $raktivitet) {
        $aktiviteter[] = $raktivitet;
        unset($raktivitet);
      }
      if (isset($aktiviteter)) {
        return $aktiviteter;
      }
    }

    function aktivitet($ID) {
      $raktiviteter = $this->db->query("SELECT AktivitetID,DatoRegistrert,DatoEndret,DatoLukket,DatoSlettet,AktivitetTypeID,Navn,Notater,(SELECT COUNT(*) FROM Utstyrslister l WHERE (l.AktivitetID=a.AktivitetID)) AS AntallLister FROM Aktiviteter a WHERE (AktivitetID=".$ID.") LIMIT 1");
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

    function utstyrslister($filter = null) {
      $sql = "SELECT UtstyrslisteID,DatoRegistrert,DatoEndret,AktivitetID,(SELECT Navn FROM Aktiviteter a WHERE (a.AktivitetID=l.AktivitetID)) AS AktivitetNavn,Beskrivelse,(SELECT COUNT(*) FROM UtstyrslisteXUtstyr x WHERE (x.UtstyrslisteID=l.UtstyrslisteID)) AS AntallLinjer FROM Utstyrslister l WHERE 1";
      if (isset($filter['AktivitetID'])) {
        $sql .= " AND (AktivitetID=".$filter['AktivitetID'].")";
      }
      $sql .= " ORDER BY DatoRegistrert ASC";
      $rutstyrslister = $this->db->query($sql);
      foreach ($rutstyrslister->result_array() as $rutstyrsliste) {
        $utstyrslister[] = $rutstyrsliste;
        unset($rutstyrsliste);
      }
      if (isset($utstyrslister)) {
        return $utstyrslister;
      }
    }

    function utstyrsliste($ID) {
      $rutstyrslister = $this->db->query("SELECT UtstyrslisteID,DatoRegistrert,DatoEndret,AktivitetID,Beskrivelse,Notater FROM Utstyrslister WHERE (UtstyrslisteID=".$ID.") LIMIT 1");
      if ($utstyrsliste = $rutstyrslister->row_array()) {
        return $utstyrsliste;
      }
    }

    function lagreutstyrsliste($ID = null,$utstyrsliste) {
      $utstyrsliste['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $utstyrsliste['DatoRegistrert'] = $utstyrsliste['DatoEndret'];
        $this->db->query($this->db->insert_string('Utstyrslister',$utstyrsliste));
        $utstyrsliste['UtstyrslisteID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Utstyrslister',$utstyrsliste,'UtstyrslisteID='.$ID));
        $utstyrsliste['UtstyrslisteID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Utstyrslisten "'.$utstyrsliste['Beskrivelse'].'" ble vellykket oppdatert!');
      }
      return $utstyrsliste;
    }

    function utstyrslisteleggtilutstyr($UtstyrslisteID,$Strekkode) {
      $utstyrsliste = $this->db->query("SELECT UtstyrID FROM Utstyr WHERE (Strekkode='".$Strekkode."') AND (Forbruksutstyr=0)");
      if ($utstyr = $utstyrsliste->row_array()) {
        $this->db->query("INSERT INTO UtstyrslisteXUtstyr (UtstyrslisteID,UtstyrID) VALUES (".$UtstyrslisteID.",".$utstyr['UtstyrID'].")");
        $this->session->set_flashdata('Infomelding','Utstyret er lagt til i listen!');
      } else {
        $this->session->set_flashdata('Feilmelding','Klarte ikke å finne utstyret med strekkode '.$Strekkode.'. Prøv igjen!');
      }
    }

    function listeoverutstyr($UtstyrslisteID) {
      $rutstyrsliste = $this->db->query("SELECT u.UtstyrID,Navn,ProdusentID,(SELECT Navn FROM Produsenter p WHERE (p.ProdusentID=u.ProdusentID)) AS ProdusentNavn,KategoriID,(SELECT Navn FROM Kategorier k WHERE (k.KategoriID=u.KategoriID)) AS KategoriNavn,Strekkode FROM Utstyr u INNER JOIN UtstyrslisteXUtstyr x ON u.UtstyrID=x.UtstyrID WHERE x.UtstyrslisteID=".$UtstyrslisteID);
      foreach ($rutstyrsliste->result_array() as $utstyr) {
        $utstyrsliste[] = $utstyr;
      }
      if (isset($utstyrsliste)) {
        return $utstyrsliste;
      }
    }

  }
