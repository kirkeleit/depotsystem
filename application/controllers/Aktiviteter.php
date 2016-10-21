<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Aktiviteter extends CI_Controller {

    public function index() {
      $this->load->model('Aktiviteter_model');
      $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
      $data['Plukklister'] = $this->Aktiviteter_model->plukklister();
      $data['Brukslogger'] = $this->Aktiviteter_model->brukslogger();
      $this->template->load('standard','aktiviteter/liste',$data);
    }

    public function nyaktivitet() {
      $this->load->model('Aktiviteter_model');
      $data['Aktivitet'] = null;
      $data['Aktivitetstyper'] = $this->Aktiviteter_model->aktivitetstyper();
      $this->template->load('standard','aktiviteter/aktivitet',$data);
    }

    public function aktivitet() {
      $this->load->model('Aktiviteter_model');
      if ($this->input->post('AktivitetLagre')) {
        $ID = $this->input->post('AktivitetID');
        $aktivitet['AktivitetTypeID'] = $this->input->post('AktivitetTypeID');
        $aktivitet['Navn'] = $this->input->post('Navn');
        $aktivitet['Notater'] = $this->input->post('Notater');
        $aktivitet = $this->Aktiviteter_model->lagreaktivitet($ID,$aktivitet);
        redirect('Aktiviteter/Aktivitet/'.$aktivitet['AktivitetID']);
      } elseif ($this->input->post('AktivitetSlett')) {
        $this->Aktiviteter_model->slettaktivitet($this->input->post('AktivitetID'));
        redirect('Aktiviteter/');
      } elseif ($this->input->post('AktivitetLukk')) {
        $this->Aktiviteter_model->lukkaktivitet($this->input->post('AktivitetID'));
        redirect('Aktiviteter/');
      } else {
        $data['Aktivitet'] = $this->Aktiviteter_model->aktivitet($this->uri->segment(3));
        $data['Aktivitetstyper'] = $this->Aktiviteter_model->aktivitetstyper();
        $data['Plukklister'] = $this->Aktiviteter_model->plukklister(array('AktivitetID' => $this->uri->segment(3)));
        $this->template->load('standard','aktiviteter/aktivitet',$data);
      }
    }

    public function nyplukkliste() {
      $this->load->model('Aktiviteter_model');
      $data['Plukkliste'] = null;
      $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
      $this->template->load('standard','aktiviteter/plukkliste',$data);
    }

    public function plukkliste() {
      $this->load->model('Aktiviteter_model');
      if ($this->input->post('UtstyrStrekkode')) {
        $ID = $this->input->post('PlukklisteID');
        $this->Aktiviteter_model->plukklisteleggtilutstyr($ID,trim($this->input->post('UtstyrStrekkode')));
        redirect('Aktiviteter/Plukkliste/'.$ID);
      } elseif ($this->input->post('PlukklisteLagre')) {
        $ID = $this->input->post('PlukklisteID');
        $plukkliste['AktivitetID'] = $this->input->post('AktivitetID');
        $plukkliste['Beskrivelse'] = $this->input->post('Beskrivelse');
        $plukkliste['Notater'] = $this->input->post('Notater');
        $plukkliste = $this->Aktiviteter_model->lagreplukkliste($ID,$plukkliste);
        redirect('Aktiviteter/Plukkliste/'.$plukkliste['PlukklisteID']);
      } elseif ($this->input->post('PlukklisteAvslutt')) {
        $data['PlukklisteID'] = $this->input->post('PlukklisteID');
        $data['Utstyrsliste'] = $this->Aktiviteter_model->utstyrsliste($this->uri->segment(3));
        $this->template->load('standard','aktiviteter/tapskadeskjema',$data);
      } elseif ($this->input->post('PlukklisteSlett')) {
        $this->Aktiviteter_model->slettplukkliste($this->input->post('PlukklisteID'));
        redirect('Aktiviteter');
      } elseif ($this->input->post('PlukklisteUtstyrInn')) {
        $ID = $this->input->post('PlukklisteID');
        $this->Aktiviteter_model->plukklistefjernutstyr($ID,$this->input->post('UtstyrID'));
        redirect('Aktiviteter/Plukkliste/'.$ID);
      } else {
        $data['Plukkliste'] = $this->Aktiviteter_model->plukkliste($this->uri->segment(3));
        $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
        $data['Utstyrsliste'] = $this->Aktiviteter_model->utstyrsliste($this->uri->segment(3));
        $this->template->load('standard','aktiviteter/plukkliste',$data);
      }
    }

    public function tapskadeskjema() {
      $this->load->model('Aktiviteter_model');
      if ($this->input->post('TapSkadeLagre')) {
        $data['PlukklisteID'] = $this->input->post('PlukklisteID');
        $UtstyrID = $this->input->post('UtstyrID');
        $SkadeType = $this->input->post('SkadeType');
        $Kommentar = $this->input->post('Kommentar');
        for ($x=0; $x<sizeof($UtstyrID); $x++) {
          $Utstyr['UtstyrID'] = $UtstyrID[$x];
          $Utstyr['SkadeType'] = $SkadeType[$x];
          $Utstyr['Kommentar'] = $Kommentar[$x];
          $Utstyrsliste[] = $Utstyr;
          unset($Utstyr);
        }
        $data['Utstyrsliste'] = $Utstyrsliste;
        $this->Aktiviteter_model->lagretapskadeskjema($data);
        redirect('Aktiviteter');
      }
    }

    public function nybrukslogg() {
      $this->load->model('Aktiviteter_model');
      $this->load->model('Utstyr_model');
      $data['Brukslogg'] = null;
      $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
      $data['Utstyrsliste'] = $this->Utstyr_model->utstyrsliste(array('Bruksregistrering'=>'1'));
      $this->template->load('standard','aktiviteter/brukslogg',$data);
    }

    public function brukslogg() {
      $this->load->model('Aktiviteter_model');
      $this->load->model('Utstyr_model');
      if ($this->input->post('BruksloggLagre')) {
        $ID = $this->input->post('BruksloggID');
        $data['AktivitetID'] = $this->input->post('AktivitetID');
        $data['UtstyrID'] = $this->input->post('UtstyrID');
        $data['Timer'] = $this->input->post('Timer');
        $data['Kilometer'] = $this->input->post('Kilometer');
        $data['Tilstand'] = $this->input->post('Tilstand');
        $data['Kommentar'] = $this->input->post('Kommentar');
        $data['Notater'] = $this->input->post('Notater');
        $data = $this->Aktiviteter_model->lagrebrukslogg($ID,$data);
        redirect('/Aktiviteter/Brukslogg/'.$data['BruksloggID']);
      } else {
        $data['Brukslogg'] = $this->Aktiviteter_model->brukslogg($this->uri->segment(3));
        $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
        $data['Utstyrsliste'] = $this->Utstyr_model->utstyrsliste(array('Bruksregistrering'=>'1'));
        $this->template->load('standard','aktiviteter/brukslogg',$data);
      }
    }

  }
