<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Manage asset");
$pagebuilder->buildheader();

$sale = "On-Sale";

if($assetinfo->publicdomain == 1){
    $sale = "On-Sale";
} elseif($assetinfo->publicdomain == 0){
    $sale = "Offsale";
} else {
    $sale = "???";
}

?>
<div class="main-content">
    <div>
        <h1>Choose an action for <br><?=$assetinfo->name?>:</h1>
        <br><br><br><br><br><br>
        <p>
            <a href="#">Manage Info</a><br>
            <a href="/api/v1/toggle-sale?Id=<?=$assetinfo->id?>">Toggle Sale (Currently: <?=$sale?>)</a><br>
            <a href="/api/v1/delete-asset?Id=<?=$assetinfo->id?>">Content Delete</a><br>
        </p>

    </div>

</div>
</body>
</html>