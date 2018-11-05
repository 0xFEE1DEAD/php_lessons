<?php

function get_file_extension($filename) {
  $matches = null;
	$result = preg_match('/^\w+(\.[A-z]{1,5})$/', $filename, $matches);
  if ($result) {
  	return isset($matches[1]) ? $matches[1] : null;
  }
  return null;
}

function check_file_extension($filename, $filetype) {
	$regexps = [
  	'archive' => '/^\w+\.(zip|rar|7z|gz|cab|gzip|tar|tar-gz|tgz|zipx|ace)$/i',
    'audio' => '/^\w+\.(wav|mp3|ogg|flac|pcm)$/i',
    'video' => '/^\w+\.(mp4|avi|flv|wmv|mov)$/i',
    'image' => '/^\w+\.(jpeg|jpg|gif|bmp|png|svg)$/i',
  ];
  return preg_match($regexps[$filetype], $filename);
}

function get_title_str($source) {
  $matches = null;
	$result = preg_match('#<title>([A-zА-я0-9_\s]+)<\/title>#', $source, $matches);
  if ($result) {
  	return isset($matches[1]) ? $matches[1] : null;
  }
  return null;
}

function get_a_href($source) {
  $matches = null;
	$result = preg_match_all('#<a.+href=["\'](.+)["\']#', $source, $matches);
  if ($result) {
  	return isset($matches[1]) ? $matches[1] : null;
  }
  return null;
}

function get_img_src($source) {
  $matches = null;
	$result = preg_match_all('#<img.+src=["\'](.+)["\']#', $source, $matches);
  if ($result) {
  	return isset($matches[1]) ? $matches[1] : null;
  }
  return null;
}

function highlight_str($source, $str) {
  return preg_replace('/(' . $str . ')/', '<strong>${1}</strong>', $source);
}


function search_smiles($source) {
  return preg_replace(['#:\)#', '#;\)#', '#:\(#'], ['<img src="smile.png" alt=":)">', '<img src="wink.png" alt=";)">', '<img src="sad.png" alt=":(">'], $source);
}

function delete_space_repeats($source) {
	 return preg_replace('/\s{2,}/', ' ', $source);
}