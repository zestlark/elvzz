<?php
require('test.php');
$games1 = scrap($main . '/apps');
$games2 = scrap($main . '/apps/premium');
?>




<!-- apps -->

<div class="_wrap flex container justify-center mx-auto">


    <?php
    include('components/aside.php');
    ?>

    <section class="text-gray-600 body-font px-4">
        <div class="container px-5 py-24 mx-auto">
            <h1 class="text-1xl p-3 mb-8 -mt-5 rounded font-medium sticky bg-gray-100" style="z-index: 3;top:75px">Apps
            </h1>
            <div class="flex flex-wrap -m-4">
                <?php
                foreach ($games1 as $app) {
                    // print_r($app->imageUrl);
                    // echo "<br/><br/>";
                
                    echo '
    <div onclick="hrefgo(\'' . $app->href . '\')" class="lg:w-1/6 md:w-1/4 sm:w-1/2 p-4 sm:full w-1/2 ">
                <a class="block relative  rounded relative">
                    <img alt="" class="absolute rounded object-cover object-center w-full h-full block"
                      style="aspect-ratio:1/1; filter:blur(10px);z-index:1;margin-top:10px;scale:0.95;"  src="' . $app->imageUrl . '">
                      <img alt="" class="relative rounded object-cover object-center w-full h-full block"
                      style="aspect-ratio:1/1;z-index:2;"  src="' . $app->imageUrl . '">
                </a>
                <div class="mt-4">
                ';

                    foreach ($app->tags as $tag) {
                        echo '<small class="border border-blue-500 mr-2 bold p-0.5 rounded px-2">' . $tag . '</small>';
                    }

                    echo '</h3>
                    <h2 class="text-gray-600 title-font text-lg font-medium mt-2">' . $app->title . '</h2>
                    <p class="mt-1 text-sm">' . $app->version . '</p>
                </div>
            </div>
    ';
                }
                ?>

                <?php
                foreach ($games2 as $app) {
                    // print_r($app->imageUrl);
                    // echo "<br/><br/>";
                
                    echo '
    <div onclick="hrefgo(\'' . $app->href . '\')" class="lg:w-1/6 md:w-1/4 sm:w-1/2 p-4 sm:full w-1/2 ">
                <a class="block relative  rounded relative">
                    <img alt="" class="absolute rounded object-cover object-center w-full h-full block"
                      style="aspect-ratio:1/1; filter:blur(10px);z-index:1;margin-top:10px;scale:0.95;"  src="' . $app->imageUrl . '">
                      <img alt="" class="relative rounded object-cover object-center w-full h-full block"
                      style="aspect-ratio:1/1;z-index:2;"  src="' . $app->imageUrl . '">
                </a>
                <div class="mt-4">
                ';

                    foreach ($app->tags as $tag) {
                        echo '<small class="border border-blue-500 mr-2 bold p-0.5 rounded px-2">' . $tag . '</small>';
                    }

                    echo '</h3>
                    <h2 class="text-gray-600 title-font text-lg font-medium mt-2">' . $app->title . '</h2>
                    <p class="mt-1 text-sm">' . $app->version . '</p>
                </div>
            </div>
    ';
                }
                ?>

            </div>
        </div>
    </section>
</div>
<!-- /apps -->