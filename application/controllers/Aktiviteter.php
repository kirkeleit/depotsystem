<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Aktiviteter extends CI_Controller {

    public function index() {
      $this->load->model('Aktiviteter_model');
      $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
      $data['Plukklister'] = $this->Aktiviteter_model->plukklister();
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
      } else {
        $data['Aktivitet'] = $this->Aktiviteter_model->aktivitet($this->uri->segment(3));
        $data['Aktivitetstyper'] = $this->Aktiviteter_model->aktivitetstyper();
        $data['Utstyrslister'] = $this->Aktiviteter_model->utstyrslister(array('AktivitetID' => $this->uri->segment(3)));
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
      } else {
        $data['Plukkliste'] = $this->Aktiviteter_model->plukkliste($this->uri->segment(3));
        $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
        $data['Utstyrsliste'] = $this->Aktiviteter_model->utstyrsliste($this->uri->segment(3));
        $this->template->load('standard','aktiviteter/plukkliste',$data);
      }
    }

  }
