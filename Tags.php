<?php
/**
 * Tags.php 
 * <p>
 * Object to find and extract key words (tags) from a set of text.
 * </p>
 * 
 * @author Armando Padilla, <armando_padilla_81@yahoo.com>
 * 
 */
class Tags {


	public function getMostlyUsedWord($keywords){
	
	
	    $mostlyUsedWords = array();
	    $visited         =  array();
	
	    foreach($keywords as $word1){
	
	        $count = 0;
	        foreach($keywords as $word2){
	
	            if($word1 == $word2){
	                $count++;
	
	            }
	
	        }
	
	        if(!array_search($word1, $visited)){
	            array_push($mostlyUsedWords, array("word" => $word1, "weight" => $count));
	        }
	
	        array_push($visited, $word1);
	
	    }
	
	
	    return $this->msort($mostlyUsedWords);
	
	}

	public function msort($array, $id="weight") {
	        $temp_array = array();
	        while(count($array)>0) {
	            $lowest_id = 0;
	            $index=0;
	            foreach ($array as $item) {
	                if (isset($item[$id]) && $array[$lowest_id][$id]) {
	                    if ($item[$id]<$array[$lowest_id][$id]) {
	
	                        $lowest_id = $index;
	                    }
	                }
	                $index++;
	            }
	            $temp_array[] = $array[$lowest_id];
	            $array = array_merge(array_slice($array, 0,$lowest_id), array_slice($array, $lowest_id+1));
	        }
	        return $temp_array;
	}

	
	/**
	 * Return all the names located in the text.
	 *
	 * @param unknown_type $description
	 */
	public function getTags($description){
	
	    $sentences = explode(".", $description);
	    $names     = array();
	
	    foreach($sentences as $sentence){
	
	        $words = explode(" ", trim($sentence));
	
	        for($i=0; $i<count($words); $i++){
	
	            $localName = "";
	
	            if($words[$i] != ""){
	                //if the word is upper case
	                if($words[$i][0] == strtoupper(strtolower($words[$i][0]))){
	
	                    $localName .= $words[$i]." ";
	
	                    //foreach word in the sentence
	                    $j = $i+1;
	                    $isUpperCase = 1;
	                    while($isUpperCase == 1 && $j<count($words)){
	
	                    		if($words[$j] != ""){

	                    			if($words[$j][0] == strtoupper(strtolower($words[$j][0]))){
		
		                                $localName .= $words[$j]." ";
		
		                            }else{
		                                $isUpperCase = 0;
		                            }
	                    		}
	                    		
	                            $j++;
	
	                    }//End while
	
	
	                    array_push($names, $localName);
	                    $localName = "";
	
	                    $i = $j-1; //We dont want to run through the visited words.
	
	                }//End if
	
	            }//End - check if its not empty
	
	        }//End foreach word.
	
	    }//End foreach sentence
	
	    return $names;
	}



}