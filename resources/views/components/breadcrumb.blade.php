<?php

// Get the URL path and split it into segments
$path = parse_url(url()->current(), PHP_URL_PATH);
$segments = explode('/', $path);

// Remove the first empty segment and the last segment
array_shift($segments);
$lastSegment = array_pop($segments);

// Generate the breadcrumb HTML
$html = '<nav class="text-gray-500 font-medium py-4 px-6 md:px-6 max-w-screen-xl mx-auto" aria-label="Breadcrumb">';
$html .= '<ol class="list-none p-0 inline-flex">';
foreach ($segments as $key => $segment) {
    $url = implode('/', array_slice($segments, 0, $key+1));
    $html .= '<li class="flex items-center">';
    $html .= '<a href="/'.$url.'" class="hover:text-gray-700">'.ucwords(str_replace('-',' ',$segment)).'</a>';
    $html .= '<svg class="w-3 h-3 mx-2 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M236.7 273.9L94.1 416.5c-9.4 9.4-24.6 9.4-33.9 0L22.6 378c-9.4-9.4-9.4-24.6 0-33.9l117.9-117.9L22.6 108.3c-9.4-9.4-9.4-24.6 0-33.9l37.6-37.6c9.4-9.4 24.6-9.4 33.9 0L236.7 238c9.4 9.4 9.4 24.6 0 35.9z"/></svg>';
    $html .= '</li>';
}
$html .= '<li class="flex items-center">';
$html .= '<span>'.ucwords(str_replace('-',' ',$lastSegment)).'</span>';
$html .= '</li>';
$html .= '</ol>';
$html .= '</nav>';

// Output the breadcrumb HTML
echo $html;
?>