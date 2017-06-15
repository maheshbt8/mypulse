<?php if (!defined('BASEPATH')) exit('No direct script access allowed');
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class General extends CI_Controller {
    function __construct() {
        parent::__construct();
        $this->load->model('general_model');
    }

    public function getCountries() {
        $q = $this->input->get("q", null, "");
        $result = $this->general_model->getCountries($q);
        echo json_encode($result);
    }

    public function getStates(){
        $q = $this->input->get("q", null, "");
        $cid = $this->input->get("cid",null,0);
        $result = $this->general_model->getSates($q,$cid);
        echo json_encode($result);
    }

    public function getDistricts(){
        $q = $this->input->get("q", null, "");
        $sid = $this->input->get("sid",null,0);
        $result = $this->general_model->getDistricts($q,$sid);
        echo json_encode($result);
    }

    public function getCities(){
        $q = $this->input->get("q", null, "");
        $did = $this->input->get("did",null,0);
        $result = $this->general_model->getCities($q,$did);
        echo json_encode($result);
    }

}