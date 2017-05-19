<?php
class LanguageLoader
{
    function initialize() {
        $ci =& get_instance();
        $ci->load->helper('language');
        
        $site_lang = $ci->session->userdata('site_lang');
        if (!$site_lang) {
            $site_lang = 'english';
            $ci->session->set_userdata(array('site_lang'=>'english'));
            
        }
        $menu = $ci->lang->load('menu',$ci->session->userdata('site_lang'),true);
        $ci->session->set_userdata(array("menu"=>$menu));
        $ci->lang->load('message',$ci->session->userdata('site_lang'));
    }
}