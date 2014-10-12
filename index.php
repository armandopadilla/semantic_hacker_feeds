<?php
/**
 * Handles the collection of articles/feeds and other supporting media
 * for the application.  Tags, photos, meaning, recommendations are all set here.
 *
 * @author Armando Padilla, <armando_padilla_81@yahoo.com>
 */
require_once "Zend/Feed.php";
require_once "Tags.php";
require_once "Media.php";
require_once "Formating.php";
require_once "SemanticHacker.php";
require_once "Filter.php";


try{

    /**
     * INITIALIZE ALL THE FEEDS WE WANT TO USE
     */
    $rssTester = "http://feeds.feedburner.com/trojanwire";

    /**
     * CREATE AN INSTANCE OF THE FEED READER FROM ZEND
     */
	$feeds = Zend_Feed::import($rssTester);

	/**
	 * FOREACH FEED GET THE LATEST ARTICLES.
     * Note:  Should we add some form of caching?  Im sure some we can cache based on feed
	 */
	
	echo "<b>A few notes about results below::</b><br>";
	echo "<b>Dataset from:</b> Trojanwire.com RSS Feeds<br>";
	echo "<b>Highlighted items:</b>  Keywords extracted for meaning and crawling.<br><br>";
	echo "<br><br>";
	
	
	foreach($feeds as $feed){

		//Initialize the variables.
		$title       = $feed->title();
		$description = $feed->description();
		echo "<b>".$title."</b><br>";
		echo Formating::getDescriptionWithKeyWordsInBold($description);
		
		
		//Semantic Meaning 
		echo "<br><br><b>Semantic Keywords (using SemanticHacker API) - What this article is about at a high level.</b><br>";
		$semanticTags = SemanticHacker::getSemanticTags($description);
		
		$semanticTagsText = "";
		foreach($semanticTags as $tags){
			
			$semanticTagsText .= str_replace("_", " ", $tags).", ";
			
		}
		$semanticTagsText = rtrim($semanticTagsText, ", ");
		echo $semanticTagsText;
		
		
		
		//Get the keywords(tags)
		$keyWords = Tags::getTags($description);
		$keyWords = Filter::getFilteredContent($keyWords);
		
		//If we found keywords go ahead and grab some photos.
		if(count($keyWords) > 0){

			echo "<br><br><b>Flickr Photos found for article.</b><br>";
			//Get Photos.
			$photos = Media::getPhotos($keyWords);

			//Foreach photo display it.
			foreach($photos as $photo){

				echo $photo;

			}//End foreach

		}//End if
			
		echo "<br><br><hr><br><br>";

	}//End foreach

}catch(Zend_Feed_Exception $e){
	echo $e->getMessage();
}