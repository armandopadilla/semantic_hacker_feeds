<?php
/**
 * Media Class
 * <p>
 * Class containing all relevant supporting media types for
 * a group of text.
 * <p>
 * 
 * @author Armando Padilla, <armando_padilla_81@yahoo.com>
 */
class Media {


	function getPhotos($keywordsContainer){

	    $keywords = "";
	
	    for($i=0; $i<count($keywordsContainer); $i++){
	   
	        $keywords .= $keywordsContainer[$i].",";
	
	    }
		    
	    $keywords = rtrim($keywords, ",");
		
	    
	    $photosContainer = array();
	
	    require_once "Zend/Service/Flickr.php";
	    $flickr = new Zend_Service_Flickr("d4385109404c7539edc3ac7fe28723d9");
	
	    try{
	
	        $photos = $flickr->tagSearch($keywords);
	
	
	    }catch(Zend_Service_Flickr $e){
	
	        echo $e->getMessage();
	
	    }
	
	
	    foreach($photos as $photo){
	
	        $thumb = $photo->Thumbnail->uri;
	
	        array_push($photosContainer, "<img src='".$thumb."' />");
	
	    }
	
	    return $photosContainer;
	
	
	}




    function getVideos($keywords){

        $videoQuery = "";
        foreach($keywords as $word){
            $videoQuery .= $word.",";
        }
        echo $videoQuery = rtrim($videoQuery, ",");

        //get videos from youtube
        require_once "Zend/Loader.php";
        Zend_Loader::loadClass("Zend_Gdata_YouTube");

        $youtube = new Zend_Gdata_YouTube();
        $query = $youtube->newVideoQuery();
        $query->videoQuery = $videoQuery;
        $query->startindex = 0;
        $query->maxResults = 1;
        $query->orderBy = 'viewCount';
        $videos = $youtube->getVideoFeed($query);


        foreach($videos as $video){

            echo $video->mediaGroup->title->text."<br>";
            echo $video->mediaGroup->description->text."<br>";
            echo "<a href='".$video->mediaGroup->player[0]->url."'><img src='".$video->mediaGroup->thumbnail[0]->url."' /></a><bR>";


        }


    }


}//End class Media