
<?php 
use watrlabs\watrkit\pagebuilder;
use watrlabs\authentication;
use watrbx\admin;
$admin = new admin();
$auth = new authentication();
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Page");
$pagebuilder->buildheader();

$alllogs = $admin::get_logs();

global $db;
?>
<div class="main-content">

<div class="resultstable">
                <table>
                    <thead>
                        <tr>
                            <th class="bold bigger">User</th>
                            <th class="bold bigger">Action</th>
                            <th class="bold bigger">Message</th>
                            <th class="bold bigger">Time</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody">
                            <?php
                                foreach($alllogs as $log){?>
                                <tr>
                                   <td><?=$auth->getuserbyid($log->user)->username?></td>
                                   <td><?=htmlspecialchars($log->action)?></td>
                                   <td><?=htmlspecialchars($log->message)?></td>
                                   <td><?=date("n/j/Y", $log->time)?></td> 
                                </tr>
                                <? } ?>
                        </tbody>
                </table>
            </div>

</div>
</body>
</html>