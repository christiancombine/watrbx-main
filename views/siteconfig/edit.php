
<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("Edit Config");
$pagebuilder->buildheader();

$id = (int)$id;
?>
<div class="main-content">

    <h2>Edit Value</h2>

    <form action="/api/v1/update-config" method="POST">
        <input name="id" type="int" value="<?=$id?>" class="hidden">
        <div class="form-group">
            <label>New Value:</label>
            <textarea name="newvalue"></textarea>
        </div>
        <button id="submitbtn">Submit</button>
    </form>

    <br><br>
    <p>Note: for true or false, please keep it fully lowercase.</p>

</div>
</body>
</html>