<?php
if(!defined('MODX_BASE_PATH')){die('What are you doing? Get out of here!');}
/**
 * embedYoutubeVideo
 * 
 * Embed video from Youtube
 *
 * @category snippet
 * @version 0.4
 * @license LGPL
 * @author supaweb (http://www.supaweb.ru)
 * @internal @modx_category Content
 * 
 * @param videoLink {string} - Link to Youtube video. You can copy url of the video. Default: Value of current document tv param called - youtube.
 * @param dimension {string} - Horizontal and vertical dimension for embed iframe. Semicolon (',') is a divider. Default: 960,720.
 */
 
 
/*

Example
[[embedYoutubeVideo?videoLink=`[+tv.youtube+]` &dimension=`328,246`]]

*/

if(!$videoLink){
	$staticinfo = $modx -> getDocument($modx->documentIdentifier);
	$tempv = $modx->getTemplateVarOutput('youtube',$staticinfo["id"]);
	$videoLink = $tempv[youtube];
}
if(empty($videoLink))return false;
if(!$dimension) $videoDimension = array('960', '720');
else {
	$videoDimension = explode(',', $dimension);
}
$videoServer = substr($videoLink, 0,16);
$videoLinkLen = strpos($videoLink, "watch?v=");
$videoIdStr = substr($videoLink, $videoLinkLen+8);
if($videoArr = explode('&',$videoIdStr))$videoId = $videoArr[0];
else $videoId = $videoIdStr;
if($videoServer=='http://youtu.be/')$videoId = substr($videoLink, 16);
$output = '<div class="video"><iframe width="' . $videoDimension[0] . '" height="' . $videoDimension[1] . '" src="//www.youtube.com/embed/'.$videoId.'?rel=0" frameborder="0" allowfullscreen></iframe></div>';
return $output;
