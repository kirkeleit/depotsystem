<?php
  class Utstyr_model extends CI_Model {

    function finnutstyr($Strekkode) {
      $rutstyrsliste = $this->db->query("SELECT UtstyrID,DatoRegistrert,Navn,Strekkode,Forbruksutstyr,AntallMinimum,IF(u.Forbruksutstyr=1,(SELECT COALESCE(SUM(Antall),0) FROM UtstyrForbruk WHERE (UtstyrForbruk.UtstyrID=u.UtstyrID)),1) AS Antall,(SELECT Navn FROM Kategorier k WHERE (k.KategoriID=u.KategoriID)) AS KategoriNavn,(SELECT Navn FROM Produsenter p WHERE (p.ProdusentID=u.ProdusentID)) AS ProdusentNavn,(SELECT Navn FROM Lagerplasser l WHERE (l.LagerplassID=u.LagerplassID)) AS LagerplassNavn,(SELECT COUNT(*) FROM PlukklisteXUtstyr x WHERE (x.UtstyrID=u.UtstyrID) AND (x.DatoRegistrertInn='0000-00-00 00:00:00')) AS Status FROM Utstyr u WHERE (UtstyrID='".$Strekkode."') OR (Strekkode='".$Strekkode."') OR (Navn Like '".$Strekkode."') ORDER BY Navn");
      foreach ($rutstyrsliste->result_array() as $rutstyr) {
        $utstyrsliste[] = $rutstyr;
        unset($rutstyr);
      }
      if (isset($utstyrsliste)) {
        return $utstyrsliste;
      }
    }

    function lagerplasser() {
      $rlagerplasser = $this->db->query("SELECT LagerplassID,Navn,ForeldreLagerplassID,Strekkode,DatoRegistrert,(SELECT COUNT(*) FROM Utstyr WHERE (LagerplassID=l.LagerplassID)) AS AntallUtstyr FROM Lagerplasser l WHERE (DatoSlettet Is Null) ORDER BY Navn ASC");
      foreach ($rlagerplasser->result_array() as $rlagerplass) {
        $lagerplasser[] = $rlagerplass;
        unset($rlagerplass);
      }
      if (isset($lagerplasser)) {
        return $lagerplasser;
      }
    }

    function lagerplass($ID) {
      $rlagerplasser = $this->db->query("SELECT LagerplassID,Navn,Notater,ForeldreLagerplassID,Strekkode FROM Lagerplasser WHERE (LagerplassID=".$ID.") LIMIT 1");
      if ($lagerplass = $rlagerplasser->row_array()) {
        return $lagerplass;
      }
    }

    function lagrelagerplass($ID = null,$lagerplass) {
      $lagerplass['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $lagerplass['DatoRegistrert'] = $lagerplass['DatoEndret'];
        $this->db->query($this->db->insert_string('Lagerplasser',$lagerplass));
        $lagerplass['LagerplassID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Lagerplasser',$lagerplass,'LagerplassID='.$ID));
        $lagerplass['LagerplassID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Lagerplassen "'.$lagerplass['Navn'].'" ble vellykket oppdatert!');
      }
      return $lagerplass;
    }

    function slettlagerplass($ID) {
      $this->db->query("UPDATE Lagerplasser SET DatoSlettet='".date('Y-m-d H:i:s')."' WHERE LagerplassID=".$ID." LIMIT 1");
    }

    function produsenter() {
      $rprodusenter = $this->db->query("SELECT ProdusentID,Navn,DatoRegistrert,(SELECT COUNT(*) FROM Utstyr WHERE (ProdusentID=p.ProdusentID)) AS AntallUtstyr FROM Produsenter p WHERE (DatoSlettet Is Null) ORDER BY Navn ASC");
      foreach ($rprodusenter->result_array() as $rprodusent) {
        $produsenter[] = $rprodusent;
        unset($rprodusent);
      }
      if (isset($produsenter)) {
        return $produsenter;
      }
    }

    function produsent($ID) {
      $rprodusenter = $this->db->query("SELECT ProdusentID,Navn,Notater FROM Produsenter WHERE (ProdusentID=".$ID.") LIMIT 1");
      if ($produsent = $rprodusenter->row_array()) {
        return $produsent;
      }
    }

    function lagreprodusent($ID = null,$produsent) {
      $produsent['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $produsent['DatoRegistrert'] = $produsent['DatoEndret'];
        $this->db->query($this->db->insert_string('Produsenter',$produsent));
        $produsent['ProdusentID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Produsenter',$produsent,'ProdusentID='.$ID));
        $produsent['ProdusentID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Produsenten "'.$produsent['Navn'].'" ble vellykket oppdatert!');
      }
      return $produsent;
    }

    function slettprodusent($ID) {
      $this->db->query("UPDATE Produsenter SET DatoSlettet='".date('Y-m-d H:i:s')."' WHERE ProdusentID=".$ID." LIMIT 1");
    }

    function kategorier() {
      $rkategorier = $this->db->query("SELECT KategoriID,Navn,DatoRegistrert,(SELECT COUNT(*) FROM Utstyr WHERE (KategoriID=k.KategoriID)) AS AntallUtstyr FROM Kategorier k WHERE (DatoSlettet Is Null) ORDER BY Navn ASC");
      foreach ($rkategorier->result_array() as $rkategori) {
        $kategorier[] = $rkategori;
        unset($rkategori);
      }
      if (isset($kategorier)) {
        return $kategorier;
      }
    }

    function kategori($ID) {
      $rkategorier = $this->db->query("SELECT KategoriID,Navn,Notater FROM Kategorier WHERE (KategoriID=".$ID.") LIMIT 1");
      if ($kategori = $rkategorier->row_array()) {
        return $kategori;
      }
    }

    function lagrekategori($ID = null,$kategori) {
      $kategori['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $kategori['DatoRegistrert'] = $kategori['DatoEndret'];
        $this->db->query($this->db->insert_string('Kategorier',$kategori));
        $kategori['KategoriID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Kategorier',$kategori,'KategoriID='.$ID));
        $kategori['KategoriID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Kategorien "'.$kategori['Navn'].'" ble vellykket oppdatert!');
      }
      return $kategori;
    }

    function slettkategori($ID) {
      $this->db->query("UPDATE Kategorier SET DatoSlettet='".date('Y-m-d H:i:s')."' WHERE KategoriID=".$ID." LIMIT 1");
    }

    function leverandorer() {
      $rleverandorer = $this->db->query("SELECT LeverandorID,Navn,DatoRegistrert,(SELECT COUNT(*) FROM Utstyr WHERE (LeverandorID=l.LeverandorID)) AS AntallUtstyr FROM Leverandorer l WHERE (DatoSlettet Is Null) ORDER BY Navn ASC");
      foreach ($rleverandorer->result_array() as $rleverandor) {
        $leverandorer[] = $rleverandor;
        unset($rleverandor);
      }
      if (isset($leverandorer)) {
        return $leverandorer;
      }
    }

    function leverandor($ID) {
      $rleverandorer = $this->db->query("SELECT LeverandorID,Navn,Notater FROM Leverandorer WHERE (LeverandorID=".$ID.") LIMIT 1");
      if ($leverandor = $rleverandorer->row_array()) {
        return $leverandor;
      }
    }

    function lagreleverandor($ID = null,$leverandor) {
      $leverandor['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $leverandor['DatoRegistrert'] = $leverandor['DatoEndret'];
        $this->db->query($this->db->insert_string('Leverandorer',$leverandor));
        $leverandor['LeverandorID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Leverandorer',$leverandor,'LeverandorID='.$ID));
        $leverandor['LeverandorID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Leverandøren "'.$leverandor['Navn'].'" ble vellykket oppdatert!');
      }
      return $leverandor;
    }

    function slettleverandor($ID) {
      $this->db->query("UPDATE Leverandorer SET DatoSlettet='".date('Y-m-d H:i:s')."' WHERE LeverandorID=".$ID." LIMIT 1");
    }

    function utstyrsliste($filter = null) {
      $sql = "SELECT UtstyrID,DatoRegistrert,Navn,Strekkode,Forbruksutstyr,AntallMinimum,IF(u.Forbruksutstyr=1,(SELECT COALESCE(SUM(Antall),0) FROM UtstyrForbruk WHERE (UtstyrForbruk.UtstyrID=u.UtstyrID)),1) AS Antall,(SELECT Navn FROM Kategorier k WHERE (k.KategoriID=u.KategoriID)) AS KategoriNavn,(SELECT Navn FROM Produsenter p WHERE (p.ProdusentID=u.ProdusentID)) AS ProdusentNavn,(SELECT Navn FROM Lagerplasser l WHERE (l.LagerplassID=u.LagerplassID)) AS LagerplassNavn,(SELECT COUNT(*) FROM PlukklisteXUtstyr x WHERE (x.UtstyrID=u.UtstyrID) AND (x.DatoRegistrertInn='0000-00-00 00:00:00')) AS Status FROM Utstyr u WHERE 1";
      if (isset($filter['LagerplassID'])) {
        $sql .= " AND (LagerplassID=".$filter['LagerplassID'].")";
      }
      if (isset($filter['Bruksregistrering'])) {
        if ($filter['Bruksregistrering'] == 0) {
          $sql .= " AND (Bruksregistrering=0)";
        } elseif ($filter['Bruksregistrering'] == 1) {
          $sql .= " AND (Bruksregistrering>0)";
        }
      }
      $sql .= " ORDER BY Navn ASC";
      $rutstyrsliste = $this->db->query($sql);
      foreach ($rutstyrsliste->result_array() as $rutstyr) {
        $utstyrsliste[] = $rutstyr;
        unset($rutstyr);
      }
      if (isset($utstyrsliste)) {
        return $utstyrsliste;
      }
    }

    function utstyrsinfo($ID) {
      $rutstyrsliste = $this->db->query("SELECT UtstyrID,DatoRegistrert,DatoEndret,ProdusentID,(SELECT Navn FROM Produsenter p WHERE (p.ProdusentID=u.ProdusentID)) AS ProdusentNavn,KategoriID,(SELECT Navn FROM Kategorier k WHERE (k.KategoriID=u.KategoriID)) AS KategoriNavn,LagerplassID,(SELECT Navn FROM Lagerplasser l WHERE (l.LagerplassID=u.LagerplassID)) AS LagerplassNavn,Navn,Notater,Strekkode,Forbruksutstyr,AntallMinimum,Bruksregistrering FROM Utstyr u WHERE (UtstyrID=".$ID.") LIMIT 1");
      if ($utstyr = $rutstyrsliste->row_array()) {
        if ($utstyr['Forbruksutstyr'] == 1) {
          $rforbruksliste = $this->db->query("SELECT ID,DatoRegistrert,UtstyrID,AktivitetID,Antall,Kommentar FROM UtstyrForbruk WHERE (UtstyrID=".$utstyr['UtstyrID'].") ORDER BY DatoRegistrert DESC");
          $utstyr['Forbruk'] = $rforbruksliste->result_array();
          unset($rforbruksliste);
        }
        $rplukklister = $this->db->query("SELECT p.PlukklisteID,DatoRegistrertUt,DatoRegistrertInn,Beskrivelse,p.AktivitetID,(SELECT Navn FROM Aktiviteter WHERE (AktivitetID=p.AktivitetID)) AS AktivitetNavn FROM PlukklisteXUtstyr x INNER JOIN Plukklister p ON p.PlukklisteID=x.PlukklisteID WHERE (UtstyrID=".$utstyr['UtstyrID'].") ORDER BY DatoRegistrertUt DESC");
        $utstyr['Plukklister'] = $rplukklister->result_array();
        return $utstyr;
      }
    }

    function lagreutstyr($ID = null, $utstyr) {
      $utstyr['DatoEndret'] = date('Y-m-d H:i:s');
      if ($ID == null) {
        $utstyr['DatoRegistrert'] = $utstyr['DatoEndret'];
        $this->db->query($this->db->insert_string('Utstyr',$utstyr));
        $utstyr['UtstyrID'] = $this->db->insert_id();
      } else {
        $this->db->query($this->db->update_string('Utstyr',$utstyr,'UtstyrID='.$ID));
        $utstyr['UtstyrID'] = $ID;
      }
      if ($this->db->affected_rows() > 0) {
        $this->session->set_flashdata('Infomelding','Utstyr "'.$utstyr['Navn'].'" ble vellykket oppdatert!');
      }
      return $utstyr;
    }

    function statusforbruk() {
      $rutstyrsliste = $this->db->query("SELECT UtstyrID,DatoRegistrert,Navn,Strekkode,Forbruksutstyr,(SELECT COALESCE(SUM(Antall),0) FROM UtstyrForbruk WHERE (UtstyrForbruk.UtstyrID=u.UtstyrID)) AS Antall,AntallMinimum,(SELECT Navn FROM Lagerplasser l WHERE (l.LagerplassID=u.LagerplassID)) AS Lagerplass,(SELECT DatoRegistrert FROM UtstyrForbruk f WHERE (f.UtstyrID=u.UtstyrID) ORDER BY DatoRegistrert DESC LIMIT 1) AS SisteForbruk FROM Utstyr u WHERE (Forbruksutstyr=1) AND ((SELECT COALESCE(SUM(Antall),0) FROM UtstyrForbruk WHERE (UtstyrForbruk.UtstyrID=u.UtstyrID))<AntallMinimum) ORDER BY Navn ASC");
      foreach ($rutstyrsliste->result_array() as $rutstyr) {
        $utstyrsliste[] = $rutstyr;
        unset($rutstyr);
      }
      if (isset($utstyrsliste)) {
        return $utstyrsliste;
      }
    }

  }
