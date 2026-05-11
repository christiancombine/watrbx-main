
<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Site Config");
$pagebuilder->buildheader();

global $db;

$siteconfig = $db->table("site_config")->get();

?>
<div class="main-content">

    <h2>Site Configuration</h2>
    <div>
        <table>
            <thead>
                <tr>
                    <th class="bold bigger">Key</th>
                    <th class="bold bigger">Value</th>
                    <th class="bold bigger">Edit</th>
                </tr>
            </thead>
            <?php foreach ($siteconfig as $config){ ?>

                <tbody id="tablebody">
                        <tr>
                            <td><?=$config->thekey?></td>
                            <td><?=$config->value?></td>
                            <td><a href="/config/<?=$config->id?>/edit">Edit</a></td>
                        </tr>
                </tbody>

            <? } ?>
        </table>
    </div>
    <br><br>
    <small>Note: These only show values in the database, not the .env file.</small>
</div>
</body>
</html>