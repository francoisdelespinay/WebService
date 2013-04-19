<?php
/**
* @package   GiteoWebService
* @subpackage GiteoWebService
* @author    your name
* @copyright 2011 your name
* @link      http://www.yourwebsite.undefined
* @license    All rights reserved
*/

class defaultCtrl extends jController {
    /**
    *
    */
    function index() {
        
        //$monURL = jUrl::get("GiteoWebService~index@classic", array("param"=>""));
        
        $PromotionFactory=jDao::get("promotion");
        $Promotion2Factory = jDao::get("promotion2");
        $response = $this->getResponse('json');
        $listOfAllPromotion=$PromotionFactory->findAll();
        $listOfAllPromotion2=$Promotion2Factory->findAll();
        

        $response->data = array();
        
        foreach ($listOfAllPromotion as $promo) {
        $response->data[] = array('id_promotion' => $promo->id_promotion,'prm_code'=>$promo->prm_code ,'prm_comment' => $promo->prm_comment);
               
        }
        //var_dump($monURL);
        //var_dump($response); 

        return $response;
    }
}
