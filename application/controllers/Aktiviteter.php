<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Aktiviteter extends CI_Controller {

    public function index() {
      $this->load->model('Aktiviteter_model');
      $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
      $data['Utstyrslister'] = $this->Aktiviteter_model->utstyrslister();
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

    public function nyutstyrsliste() {
      $this->load->model('Aktiviteter_model');
      $data['Utstyrsliste'] = null;
      $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
      $this->template->load('standard','aktiviteter/utstyrsliste',$data);
    }

    public function utstyrsliste() {
      $this->load->model('Aktiviteter_model');
      if ($this->input->post('UtstyrStrekkode')) {
        $ID = $this->input->post('UtstyrslisteID');
        $this->Aktiviteter_model->utstyrslisteleggtilutstyr($ID,trim($this->input->post('UtstyrStrekkode')));
        redirect('Aktiviteter/Utstyrsliste/'.$ID);
      } elseif ($this->input->post('UtstyrslisteLagre')) {
        $ID = $this->input->post('UtstyrslisteID');
        $utstyrsliste['AktivitetID'] = $this->input->post('AktivitetID');
        $utstyrsliste['Beskrivelse'] = $this->input->post('Beskrivelse');
        $utstyrsliste['Notater'] = $this->input->post('Notater');
        $utstyrsliste = $this->Aktiviteter_model->lagreutstyrsliste($ID,$utstyrsliste);
        redirect('Aktiviteter/Utstyrsliste/'.$utstyrsliste['UtstyrslisteID']);
      } else {
        $data['Utstyrsliste'] = $this->Aktiviteter_model->utstyrsliste($this->uri->segment(3));
        $data['Aktiviteter'] = $this->Aktiviteter_model->aktiviteter();
        $data['ListeOverUtstyr'] = $this->Aktiviteter_model->listeoverutstyr($this->uri->segment(3));
        $this->template->load('standard','aktiviteter/utstyrsliste',$data);
      }
    }

  }
