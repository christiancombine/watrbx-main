
<?php 
use watrlabs\watrkit\pagebuilder;
use watrbx\admin;
$admin = new admin();
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Server Info");
$pagebuilder->buildheader();

$memoryusage = $admin->getSystemMemInfo();

$unfinshed = str_replace(" kB", "",$memoryusage["MemTotal"]);
$unfinshed2 = str_replace(" kB", "",$memoryusage["MemFree"]);

$memtotal = $unfinshed/1000;
$memfree = $unfinshed2/1000;

$memtotalgb = round($memtotal/1000, 2) . " GB";
$memfreegb = round($memfree/1000, 2) . " GB";

?>
<div class="main-content">
    <div class="header">
        <h1>Server Information</h1>
    </div>
    <br>
    <p>Server Name: <?=$_SERVER["SERVER_NAME"]?><br>Server Version: <?=$_SERVER["SERVER_SOFTWARE"]?><br>Enviroment: <?=$_ENV["APP_ENV"]?></p>
    <br><br>
    <p>Memory Usage: <?=$memfreegb?> used out of <?=$memtotalgb?></p>
</div>
</body>
</html>