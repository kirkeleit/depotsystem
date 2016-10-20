<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Utstyr extends CI_Controller {

    public function index() {
      $this->load->model('Utstyr_model');
      $data['ForbruksStatus'] = $this->Utstyr_model->statusforbruk();
      $this->template->load('standard','utstyr/oversikt',$data);
    }

    public function finn() {
      $this->load->model('Utstyr_model');
      $data['Utstyrsliste'] = $this->Utstyr_model->finnutstyr($this->input->post('FinnUtstyr'));
      if (count($data['Utstyrsliste']) == 1) {
        $Utstyr = $data['Utstyrsliste'][0];
        redirect('Utstyr/Utstyrsinfo/'.$Utstyr['UtstyrID']);
      } else {
        $this->template->load('standard','utstyr/finn',$data);
      }
    }

    public function lagerplasser() {
      $this->load->model('Utstyr_model');
      $data['Lagerplasser'] = $this->Utstyr_model->lagerplasser();
      $this->template->load('standard','utstyr/lagerplasser',$data);
    }

    public function registrerelagerplass() {
      $this->load->model('Utstyr_model');
      $data['Lagerplass'] = null;
      $data['Lagerplasser'] = $this->Utstyr_model->lagerplasser();
      $this->template->load('standard','utstyr/lagerplass',$data);
    }

    public function lagerplass() {
      $this->load->model('Utstyr_model');
      if ($this->input->post('LagerplassLagre')) {
        $ID = $this->input->post('LagerplassID');
        $lagerplass['Navn'] = $this->input->post('Navn');
        $lagerplass['Notater'] = $this->input->post('Notater');
        $lagerplass['Strekkode'] = $this->input->post('Strekkode');
        $lagerplass['ForeldreLagerplassID'] = $this->input->post('ForeldreLagerplassID');
        $lagerplass = $this->Utstyr_model->lagrelagerplass($ID,$lagerplass);
        redirect('Utstyr/Lagerplass/'.$lagerplass['LagerplassID']);
      } elseif ($this->input->post('LagerplassSlett')) {
        $this->Utstyr_model->slettlagerplass($this->input->post('LagerplassID'));
        redirect('Utstyr/Lagerplasser');
      } else {
        $data['Lagerplass'] = $this->Utstyr_model->lagerplass($this->uri->segment(3));
        $data['Lagerplasser'] = $this->Utstyr_model->lagerplasser();
        $data['Utstyrsliste'] = $this->Utstyr_model->utstyrsliste(array('LagerplassID'=>$this->uri->segment(3)));
        $this->template->load('standard','utstyr/lagerplass',$data);
      }
    }

    public function produsenter() {
      $this->load->model('Utstyr_model');
      $data['Produsenter'] = $this->Utstyr_model->produsenter();
      $this->template->load('standard','utstyr/produsenter',$data);
    }

    public function registrereprodusent() {
      $this->load->model('Utstyr_model');
      $data['Produsent'] = null;
      $this->template->load('standard','utstyr/produsent',$data);
    }

    public function produsent() {
      $this->load->model('Utstyr_model');
      if ($this->input->post('ProdusentLagre')) {
        $ID = $this->input->post('ProdusentID');
        $produsent['Navn'] = $this->input->post('Navn');
        $produsent['Notater'] = $this->input->post('Notater');
        $produsent = $this->Utstyr_model->lagreprodusent($ID,$produsent);
        redirect('Utstyr/Produsent/'.$produsent['ProdusentID']);
      } elseif ($this->input->post('ProdusentSlett')) {
        $this->Utstyr_model->slettprodusent($this->input->post('ProdusentID'));
        redirect('Utstyr/Produsenter');
      } else {
        $data['Produsent'] = $this->Utstyr_model->produsent($this->uri->segment(3));
        $this->template->load('standard','utstyr/produsent',$data);
      }
    }

    public function kategorier() {
      $this->load->model('Utstyr_model');
      $data['Kategorier'] = $this->Utstyr_model->kategorier();
      $this->template->load('standard','utstyr/kategorier',$data);
    }

    public function registrerekategori() {
      $this->load->model('Utstyr_model');
      $data['Kategori'] = null;
      $this->template->load('standard','utstyr/kategori',$data);
    }

    public function kategori() {
      $this->load->model('Utstyr_model');
      if ($this->input->post('KategoriLagre')) {
        $ID = $this->input->post('KategoriID');
        $kategori['Navn'] = $this->input->post('Navn');
        $kategori['Notater'] = $this->input->post('Notater');
        $kategori = $this->Utstyr_model->lagrekategori($ID,$kategori);
        redirect('Utstyr/Kategori/'.$kategori['KategoriID']);
      } elseif ($this->input->post('KategoriSlett')) {
        $this->Utstyr_model->slettkategori($this->input->post('KategoriID'));
        redirect('Utstyr/Kategorier');
      } else {
        $data['Kategori'] = $this->Utstyr_model->kategori($this->uri->segment(3));
        $this->template->load('standard','utstyr/kategori',$data);
      }
    }

    public function leverandorer() {
      $this->load->model('Utstyr_model');
      $data['Leverandorer'] = $this->Utstyr_model->leverandorer();
      $this->template->load('standard','utstyr/leverandorer',$data);
    }

    public function registrereleverandor() {
      $this->load->model('Utstyr_model');
      $data['Leverandor'] = null;
      $this->template->load('standard','utstyr/leverandor',$data);
    }

    public function leverandor() {
      $this->load->model('Utstyr_model');
      if ($this->input->post('LeverandorLagre')) {
        $ID = $this->input->post('LeverandorID');
        $leverandor['Navn'] = $this->input->post('Navn');
        $leverandor['Notater'] = $this->input->post('Notater');
        $leverandor = $this->Utstyr_model->lagreleverandor($ID,$leverandor);
        redirect('Utstyr/Leverandor/'.$leverandor['LeverandorID']);
      } elseif ($this->input->post('LeverandorSlett')) {
        $this->Utstyr_model->slettleverandor($this->input->post('LeverandorID'));
        redirect('Utstyr/Leverandorer');
      } else {
        $data['Leverandor'] = $this->Utstyr_model->leverandor($this->uri->segment(3));
        $this->template->load('standard','utstyr/leverandor',$data);
      }
    }

    public function liste() {
      $this->load->model('Utstyr_model');
      $data['Utstyrsliste'] = $this->Utstyr_model->utstyrsliste();
      $this->template->load('standard','utstyr/liste',$data);
    }

    public function registrereutstyr() {
      $this->load->model('Utstyr_model');
      $data['Utstyr'] = null;
      $data['Produsenter'] = $this->Utstyr_model->produsenter();
      $data['Kategorier'] = $this->Utstyr_model->kategorier();
      $data['Lagerplasser'] = $this->Utstyr_model->lagerplasser();
      $this->template->load('standard','utstyr/utstyrsinfo',$data);
    }

    public function utstyrsinfo() {
      $this->load->model('Utstyr_model');
      if ($this->input->post('UtstyrLagre')) {
        $ID = $this->input->post('UtstyrID');
        $utstyr['ProdusentID'] = $this->input->post('ProdusentID');
        $utstyr['KategoriID'] = $this->input->post('KategoriID');
        $utstyr['LagerplassID'] = $this->input->post('LagerplassID');
        $utstyr['Navn'] = $this->input->post('Navn');
        $utstyr['Notater'] = $this->input->post('Notater');
        $utstyr['Strekkode'] = $this->input->post('Strekkode');
        $utstyr['Forbruksutstyr'] = $this->input->post('Forbruksutstyr');
        $utstyr['AntallMinimum'] = $this->input->post('AntallMinimum');
        $utstyr = $this->Utstyr_model->lagreutstyr($ID,$utstyr);
        redirect('utstyr/utstyrsinfo/'.$utstyr['UtstyrID']);
      } else {
        $data['Produsenter'] = $this->Utstyr_model->produsenter();
        $data['Kategorier'] = $this->Utstyr_model->kategorier();
        $data['Lagerplasser'] = $this->Utstyr_model->lagerplasser();
        $data['Utstyr'] = $this->Utstyr_model->utstyrsinfo($this->uri->segment(3));
        $this->template->load('standard','utstyr/utstyrsinfo',$data);
      }
    }
}
