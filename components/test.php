<?php

$main = 'https://apkmody.com';

//https://apkmody.com/games/captor-clash/download/0
function scrap($url)
{


    // Initialize cURL
    $ch = curl_init();

    // Set cURL options
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
    curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false); // Disable SSL verification for demo purposes, not recommended for production use

    // Execute the cURL request
    $response = curl_exec($ch);

    // Check for cURL errors
    if (curl_error($ch)) {
        die('cURL error: ' . curl_error($ch));
    }

    // Close cURL
    curl_close($ch);

    // Create a DOMDocument object
    $doc = new DOMDocument();
    // Suppress warnings for malformed HTML
    libxml_use_internal_errors(true);
    // Load the HTML content into the DOMDocument object
    $doc->loadHTML($response);
    // Restore error reporting
    libxml_clear_errors();

    // Create a DOMXPath object
    $xpath = new DOMXPath($doc);

    // Find the anchor tags inside the article tag using XPath
    $anchorNodeList = $xpath->query('//body//article//a[@class="app clickable"]');
    if ($anchorNodeList->length > 0) {
        $objects = array(); // Array to store objects

        // Loop through each anchor tag
        foreach ($anchorNodeList as $anchorNode) {
            // Extract the values from the anchor tag attributes and child elements
            $imageUrl = $xpath->evaluate('string(.//img/@src)', $anchorNode);
            $href = $anchorNode->getAttribute('href');
            $title = $xpath->evaluate('string(.//h3 | .//h2)', $anchorNode);
            $version = $xpath->evaluate('string(.//div[@class="app-name truncate"]/div[1])', $anchorNode);
            $tags = $xpath->query('.//div[@class="app-tags has-small-font-size"]/span', $anchorNode);

            // Create an object to store the extracted data
            $object = new stdClass();
            $object->imageUrl = $imageUrl;
            $object->href = $href;
            $object->title = $title;
            $object->version = $version;

            $tagArray = array();
            foreach ($tags as $tag) {
                $tagArray[] = $tag->textContent;
            }
            $object->tags = $tagArray;

            // Add the object to the array
            $objects[] = $object;
        }

        // Output the objects
        //print_r($objects);

        // header('Content-Type: application/json');

        // Output the JSON encoded data
        // echo json_encode($objects);

        return $objects;
    }

}

$apps = scrap('https://apkmody.io/apps');
?>