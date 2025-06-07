<?php if(isset($data["error"])){ ?>
    <div>
        <p>
          <?= $data["error"] ?>
        </p>
    </div>
<?php } ?>
<form autocomplete="off"action="<?= $data['action'] ?>" method="post">
  <input type="text" name="email" required />
  <input type="password" name="password" required />
  <button type="submit">Sign in</button>
</form>
