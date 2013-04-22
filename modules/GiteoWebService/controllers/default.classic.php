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


    function index() {
        

        $response = $this->getResponse('json');
        $monURL = $_SERVER['REQUEST_URI'];
        $urlquery = parse_url($monURL, PHP_URL_QUERY);
        $request = explode("|", $urlquery);
        var_dump($request);
        switch ($request[0]) {
            case "GET":






                foreach (explode("&", $request[2]) as $chunk) {
                    $param = explode("=", $chunk);
                    //var_dump($param);
                    $Factory = jDao::get($request[1]);
                    if ($param[1] == "?") {
                      
                        $listOfAll = $Factory->findAll();
                    } else {
                        
                        $conditions = jDao::createConditions();
                        $conditions->addCondition($param[0], '=', $param[1]);
                        $listOfAll = $Factory->findBy($conditions);
                    }
                }

                var_dump($request[1]);


                $xmldao = new DomDocument;
                $chemin = '../../GiteoWebService/modules/GiteoWebService/daos/'.$request[1].'.dao.xml';
                $xmldao->load($chemin);
                
                $Listeprop = $xmldao->getElementsByTagName("property");
                var_dump($Listeprop);

                $response->data = array();

                foreach ($listOfAll as $val) {
                    $chaine = array();
                    foreach ($Listeprop as $Listename) {

                        $toEval = '$var = $val->' . $Listename->getAttribute("name") . ';';
                        eval($toEval);
                        $chaine[$Listename->getAttribute("name")] = $var;
                    }
                    $response->data[] = $chaine;
                 
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

}

