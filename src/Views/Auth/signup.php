<?php if(isset($data["error"])){ ?>
    <div>
        <p>
          <?= $data["error"] ?>
        </p>
    </div>
<?php } ?>
<form autocomplete="off" action="<?= $data['action'] ?>" method="post">
  <input type="text" name="name" required />
  <input type="text" name="email" required />
  <input type="password" name="password" />
  <button type="submit">Sign Up</button>
</form>

