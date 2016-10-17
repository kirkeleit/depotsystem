<?php
  defined('BASEPATH') OR exit('No direct script access allowed');

  class Oversikt extends CI_Controller {

    public function index() {
      $this->template->load('standard','oversikt');
    }
}
