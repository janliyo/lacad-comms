<div class="content-area">
  <div class="table-container">
    <table>
      <tr>
        <th></th>
        <th>Name</th>
        <th>Date Uploaded</th>
        <th>
          <div class="col text-right">
            <a href="<?= base_url("CctvController/upload"); ?>">Upload New</a>
          </div>
        <th>
      </tr>
      <?php foreach ($recordings as $recording): ?>
      <tr>
        <td><img src="path-to-thumbnail.jpg" alt="Video Thumbnail" class="thumbnail"></td>
        <td><?= $recording["name"]; ?></td>
        <td><?= $recording["uploadDate"]; ?></td>
        <td class="action-buttons">
          <button class="button">View</button>
          <button class="button">Edit</button>
          <button class="button">Delete</button>
        </td>
      </tr>
      <?php endforeach; ?>
    </table>
  </div>

  <div class="d-flex justify-content-center">
    <?= $links; ?>
  </div>
</div>