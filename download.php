<?php
include('layout/top.php');
?>


<?php
include('components/nav.php');
?>

<?php
// URL to scrape

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $url = $_GET['url'];

    // Get the HTML content of the URL
    $html = file_get_contents($url . '/download/0');

    // Extract the download button
    $downloadButtonPattern = '/<div class="wp-block-button has-custom-width wp-block-button__width-100">\s*<a id="download-button" href="([^"]+)" class="wp-block-button__link has-vivid-cyan-blue-background-color clickable"><span class="material-symbols-rounded notranslate">download<\/span> Download \(([\d.]+ [A-Z]+)\)<\/a>\s*<\/div>/i';
    if (preg_match($downloadButtonPattern, $html, $downloadButtonMatches)) {
        $downloadUrl = $downloadButtonMatches[1];
        $downloadSize = $downloadButtonMatches[2];
    }

    // Extract the image URL
    $imagePattern = '/<figure class="wp-block-image">\s*<img [^>]*src="([^"]+)"[^>]*>\s*<\/figure>/i';
    if (preg_match($imagePattern, $html, $imageMatches)) {
        $imageUrl = $imageMatches[1];
    }

    // Extract the download name
    $downloadNamePattern = '/<div class="entry-content"><h1 class="has-medium-font-size has-text-align-center no-margin">Download ([^<]+)<\/h1><span class="has-text-align-center has-small-font-size has-cyan-bluish-gray-color margin-bottom-15 truncate">([^<]+)<\/span><\/div>/i';
    if (preg_match($downloadNamePattern, $html, $downloadNameMatches)) {
        $downloadTitle = $downloadNameMatches[1];
        $downloadFilename = $downloadNameMatches[2];
    }

    $html2 = file_get_contents($url);


    $iconImagePattern = '/<div class="app-icon">\s*<img[^>]+src="([^"]+)"/';

    if (preg_match($iconImagePattern, $html2, $iconImageMatches)) {
        $iconImageUrl = $iconImageMatches[1];
    }

    $descPattern = '/<div class="entry-block entry-content main-entry-content">.*?<p>(.*?)<\/p>/s';
    if (preg_match($descPattern, $html2, $descPatternMatches)) {
        $desc = $descPatternMatches[1];
    }

    // $tablePattern = '/<table[^>]*>/';
    // if (preg_match($tablePattern, $html2, $tablePatternMatches)) {
    //     $table = $tablePatternMatches[0];

    // }

    $screenshotPattern = '/<div class="screenshots beauty-scroll" id="lightgallery">(.*?)<\/div>/s';
    if (preg_match($screenshotPattern, $html2, $screenshotPatternMatches)) {
        $screenshot = $screenshotPatternMatches[0];
        //echo "screenshot: $screenshot" . PHP_EOL;
    }


}
?>


<section class="text-gray-600 body-font">
    <div class="container px-5 py-24 mx-auto flex flex-col">
        <div class="lg:w-4/6 mx-auto">
            <div class="rounded-lg h-auto overflow-hidden">
                <img alt="content" class="object-cover object-center h-full w-full" src="<?php echo $imageUrl ?>">
            </div>
            <div class="flex flex-col sm:flex-row mt-10">
                <div class="sm:w-1/3 text-center sm:pr-8 sm:py-8">
                    <div
                        class="w-20 h-20 rounded-full inline-flex items-center justify-center bg-gray-200 text-gray-400">
                        <img src="<?php echo $iconImageUrl ?>" alt="">
                    </div>
                    <div class="flex flex-col items-center text-center justify-center">
                        <h2 class="font-medium title-font mt-4 text-gray-900 text-lg">
                            <?php echo $downloadTitle ?>
                        </h2>
                        <div class="w-12 h-1 bg-indigo-500 rounded mt-2 mb-4"></div>
                        <p class="text-base">
                            <?php echo $downloadSize ?>
                        </p>
                    </div>
                </div>
                <div
                    class="sm:w-2/3 sm:pl-8 sm:py-8 sm:border-l border-gray-200 sm:border-t-0 border-t mt-4 pt-4 sm:mt-0 text-center sm:text-left">

                    <div class="mt-0 mb-7">
                        <a href="<?php echo $url . '/download/0' ?>"
                            class="flex items-center justify-center rounded-md border border-transparent bg-indigo-600 px-6 py-3 text-base font-medium text-white shadow-sm hover:bg-indigo-700">Download

                            <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" class="w-4 h-4 ml-2" viewBox="0 0 24 24">
                                <path d="M5 12h14M12 5l7 7-7 7"></path>
                            </svg>
                        </a>
                    </div>
                    <p class="leading-relaxed text-lg mb-4">
                        <?php echo $desc ?>
                    </p>

                </div>
            </div>
        </div>
    </div>
    <?php echo $screenshot ?>
</section>

<style>
    .screenshots {
        display: flex;
        margin: -20px;
        justify-content: center;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .screenshot {
        width: 15%;
        min-width: 150px;
        margin-bottom: 10px;
    }
</style>

<?php
include('layout/bottom.php');
?>