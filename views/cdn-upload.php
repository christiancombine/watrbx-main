
<?php 
use watrlabs\watrkit\pagebuilder;
$pagebuilder = new pagebuilder();
$pagebuilder->set_page_name("CDN Upload");
$pagebuilder->buildheader();
?>
<div class="main-content">

    <h1>upload to the cdn</h1>
    <br><br><br><br>

    <form method="post" action="/api/v1/cdn-upload" enctype="multipart/form-data">
        <input type="text" name="path" placeholder="path"/><br><br>
        <input type="file" name="file" /><br><br>
        <button>Upload</button>
    </form>

</div>
</body>
</html>