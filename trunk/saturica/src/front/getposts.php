<?php

// read_rss(display_n_items,feed_url)
function read_rss($display=0,$url='') {
    $doc = new DOMDocument();
    $doc->load($url);
    $itemArr = array();
    foreach ($doc->getElementsByTagName('item') as $node) {
        if ($display == 0) {
            break;
        }

        $itemRSS = array (
            'title'       => $node->getElementsByTagName('title')->item(0)->nodeValue,
            'description' => $node->getElementsByTagName('description')->item(0)->nodeValue,
            'link'        => $node->getElementsByTagName('link')->item(0)->nodeValue,
            'pubdate'     => $node->getElementsByTagName('pubDate')->item(0)->nodeValue
        );

         array_push($itemArr, $itemRSS);

        $display--;
    }
    return $itemArr;
}


function GetPosts($url)
{
	$count = 1;  // limit max posts to 5 
	$html = "";
	$items = read_rss(5,$url);
	$html .= "<ul>";
	foreach ( $items as $item ) 
	{
		$content = $item['title'] .' - '. $item['description'];
		$html .= '<li><a href="' . $item['link'] . '">' . $content .'</a>';
		/*if ($count == 3)
		{
			break; // limit max posts to 3
		}
		$count++;*/	
	}
	$html .="</ul>";
return $html;
}
?>