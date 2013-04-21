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
        $response = $this->getResponse('json');
        $monURL = $_SERVER['REQUEST_URI'];
        $urlquery = parse_url($monURL, PHP_URL_QUERY);
        $request = explode("|", $urlquery);
        var_dump($request);
        switch ($request[0]) {
            case "GET":
              
                //$response = gmethod($request);
                $Factory = jDao::get($request[1]);




        $conditions = jDao::createConditions();
        foreach (explode("&", $request[2]) as $chunk) {
            $param = explode("=", $chunk);
            //var_dump($param);
            if ($param[1] == "?") {
                $listOfAll = $Factory->findAll();
            } else {
                $conditions->addCondition($param[0], '=', $param[1]);
                $listOfAll = $Factory->findBy($conditions);
            }
        }
//
        $chemin='../../GiteoWebService/modules/GiteoWebService/daos/'.$request[1].'.dao.xml';

        //$xmldao = simplexml_load_file($chemin);

          $xmldao = new DomDocument;
          $xmldao->load($chemin);

          $Listeprop = $xmldao->getElementsByTagName("property");
         // $champs->getAttribute("name");
            var_dump($Listeprop);

            
            //echo($chaine);

        $response->data = array();


      

        foreach ($listOfAll as $promo) {
//'id_promotion'=> $promo->id_promotion, 'prm_code'=> $promo->prm_code, 'prm_dateBegin'=> $promo->prm_dateBegin, 'prm_dateEnd'=> $promo->prm_dateEnd, 'prm_commissionRate'=> $promo->prm_commissionRate, 'prm_nbUsesLimit'=> $promo->prm_nbUsesLimit, 'prm_comment'=> $promo->prm_comment,
                  $chaine="";
            foreach ($Listeprop as $Listename){
               // $chaine=$chaine."'".$Listename->getAttribute("name")."'".'=>'+$promo+'->'.$Listename->getAttribute("name").', ';
                $response->data[] = array("'".$Listename->getAttribute("name")."'".'=>'+$promo+'->'.$Listename->getAttribute("name").', ');                
            }

        }

  
        

                break;
            case "POST":


                break;
            case "PUT":


                break;
            case "DELETE":


                break;
        }
        


        return $response;
    }
    
   // function gmethod($request){
    
    
        
   // }

}

