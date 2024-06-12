<div class="content-area">
    <?php if ($this->session->flashdata("error")) : ?>
        <div class="alert alert-danger rounded-2 m-1">
            <?= $this->session->flashdata("error"); ?>
        </div>
    <?php endif; ?>
    <form action="<?= base_url("CctvController/upload_video"); ?>" method="post" enctype="multipart/form-data">
        <label for="userfile">Video</label>
        <input type="file" name="userfile" size="20" />
        <label for="name">Name</label>
        <input type="text" name="name" id="name">

        <br> <br>
        <input type="submit" value="Upload" />
    </form>
</div>