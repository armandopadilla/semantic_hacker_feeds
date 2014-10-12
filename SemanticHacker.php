<?php
/**
 * SemanticHacker - Interactcs with the SemanticHacker APIs.
 **/
class SemanticHacker {

	public function __construct(){}

    function getSemanticTags($description){

        require_once "Zend/Rest/Client.php";
        $client = new Zend_Rest_Client("http://api.semantichacker.com/sh/api");
        $client->token("sbvkpdkl");
        $client->showLabels("true");
        $client->content($description);
        $results = $client->get();


            $elements = $results->signature->dimension;

            $keywords = array();
            foreach($elements as $label){

                $words = $label['label'][0]."<br>";

                //split up the words
                array_push($keywords, explode("/", $words));

            }

            return $keywords[0];


    }

}