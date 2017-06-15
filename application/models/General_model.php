<?php
/**
 * @author Yogesh Patel
 * @email  yogesh@techcrista.in
 */
class General_model extends CI_Model {
    var $cityTbl = "hms_city";
    var $stateTbl = "hms_state";
    var $districtTbl = "hms_district";
    var $countryTbl = "hms_country";

    function getCountries($q="") {
        if($q!=""){
            $this->db->like("name",$q);
        }
        $res = $this->db->get($this->countryTbl);
        if ($res->num_rows()) return $res->result_array();
        else return array();
    }

    function getSates($q="",$cid=0){
        if($q!=""){
            $this->db->like("name",$q);
        }
        if($cid > 0){
            $this->db->where("country_id",$cid);
        }
        $res = $this->db->get($this->stateTbl);
        return $res->result_array();
    }

    function getDistricts($q="",$sid=0){
        if($q!=""){
            $this->db->like("name",$q);
        }
        if($sid > 0){
            $this->db->where("state_id",$sid);
        }
        $res = $this->db->get($this->districtTbl);
        return $res->result_array();
    }

    function getCities($q="",$did=0){
        if($q!=""){
            $this->db->like("name",$q);
        }
        if($did > 0){
            $this->db->where("district_id",$did);
        }
        $res = $this->db->get($this->cityTbl);
        return $res->result_array();
    }

    function getCityName($cid=0){
        $this->db->where('id',$cid);
        $res = $this->db->get($this->cityTbl);
        $res = $res->row_array();
        return isset($res['name']) ? $res['name'] : "";
    }

    function getStateName($sid=0){
        $this->db->where('id',$sid);
        $res = $this->db->get($this->stateTbl);
        $res = $res->row_array();
        return isset($res['name']) ? $res['name'] : "";
    }

    function getDistrictName($did=0){
        $this->db->where('id',$did);
        $res = $this->db->get($this->districtTbl);
        $res = $res->row_array();
        return isset($res['name']) ? $res['name'] : "";
    }

    function getCountryName($cid=0){
        $this->db->where('id',$cid);
        $res = $this->db->get($this->countryTbl);
        $res = $res->row_array();
        return isset($res['name']) ? $res['name'] : "";
    }
}