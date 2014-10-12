<?php
class Formating {


//very simple.
//for each word that has a first letter upper cased.
//highlight.
function getDescriptionWithKeyWordsInBold($description){


    $filteredWords =  array("to", "i", "this", "the", "and", "he",
                           "she", "it", "how", "when", "where", "what",
                           "like", "your", "to", "the", "for", "in",
                           "we", "him", "her", "now", "as", "but", "of",
                           "if", "no", "yes", "so", "sometimes", "with", "a", "just", "mt",
                           "mr", "ms", "during", "something", "image", "according", "fortunately",
                           "do");


    //Clean the text
    $description = strip_tags($description);

    //Save each word into a container.
    $words = explode(" ", $description);


    $weightedWords = array();
    $newDesc       = "";

    foreach($words as $word){
		
    	if($word != ""){
			
		
	        if($word[0] == strtoupper(strtolower($word[0])) &&
	           preg_match("/[a-z]*/i", $word) &&
	           !array_search(strtolower($word), $filteredWords)){
	
	                $word = "<b style='background-color:ff0000;'>".$word."</b> ";
	                //$photos = getPhotos(array($word));
	                //foreach($photos as $photo){
	
	                //echo $photo;
	
	                //}
	
	        }else{
	            $word = $word." ";
	        }

        	$newDesc .= $word;
		}
		
		
    }//End foreach

    return $newDesc;

}


}