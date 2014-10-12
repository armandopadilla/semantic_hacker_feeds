<?php

class Filter {


    function getFilteredContent($keyWords){


        $filteredWords = array("to", "i", "this", "the", "and", "he",
                               "she", "it", "how", "when", "where", "what",
                               "like", "your", "to", "the", "for", "in",
                               "we", "him", "her", "now", "as", "but", "of",
                               "if", "no", "yes", "so", "sometimes", "with", "a", "just", "mt",
                               "mr", "ms", "during", "something", "image", "according", "fortunately",
                               "do");


        $cleanKeyWords = array();
        foreach($keyWords as $word){

            $strip = array("\"", "'", ",", ".", ")", "(", ":", "]", "[", "?");
            $word = str_replace($strip, "", trim($word));


            if(preg_match("/^[a-z]*( [a-z]*){1,}$/i", $word) &&
               !array_search(strtolower($word), $filteredWords) &&
               !in_array($word, $cleanKeyWords)){

                   //echo $word."<br>";
                   array_push($cleanKeyWords, $word);

            }

        }


        return $cleanKeyWords;

    }

}