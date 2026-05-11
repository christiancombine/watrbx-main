
<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Alt Finder");
$pagebuilder->buildheader();
?>
<div class="main-content">
    <a href="/" style="margin-left: 44px">Lookup Tool</a>
    <a style="margin-left: 44px">Alt Tool</a>
    <hr class="secondhr">

    <form action="/find-alt" method="POST">
        <div class="form-content">
            <div class="form-group">
                <span for="preset-message" class="bold marginleft">UserName</span>
                <input id="searchingusername" name="username" class="lookup">
                <button id="usernamesubmit">Submit</button>
            </div>
        </div>
    </form>

    

    <?php
        if(isset($allalts)){ ?>
            <div class="resultstable">
                <table>
                    <thead>
                        <tr>
                            <th class="bold bigger">Name</th>
                            <th class="bold bigger">ID</th>
                            <th class="bold bigger">Online</th>
                            <th class="bold bigger">Email</th>
                            <th class="bold bigger">Creation Date</th>
                            <th class="bold bigger">Last Activity</th>
                            <th class="bold bigger">Action</th>
                        </tr>
                    </thead>
                    <tbody id="tablebody">

            <? foreach($allalts as $alt){ ?>
                <tr>
                    <td><a href="https://www.watrbx.xyz/users/<?=$alt->id?>/profile"><?=$alt->username?></a></td>
                    <td><?=$alt->id?></td>
                    <td>Online</td>
                    <td><?=$alt->email?></td>
                    <td><?=date("n/j/Y", $alt->regtime)?></td>
                    <td><?=date('Y-m-d H:i:s',$alt->last_visit)?></td>
                    <td><a href="/moderate/<?=$alt->id?>">Perform Action</a></td>
                </tr>
            <? }
        }
    ?>

    
                    
                            
                        </tbody>
                </table>

</div>
</body>
</html>