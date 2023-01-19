
  <form method="<?= $config["config"]["method"] ?? "GET" ?>" action="<?= $config["config"]["action"] ?? "" ?>">
    <?php foreach ($config["inputs"] as $name => $configInput): ?>

    <input name="<?= $name ?>" 
      placeholder="<?= $configInput["placeholder"] ?? "" ?>"
      class="<?= $configInput["class"] ?? "" ?>" 
      type="<?= $configInput["type"] ?? "text" ?>"
      value="<?= $configInput["value"] ?? "" ?>"
      <?php if (!empty($configInput["required"])): ?> required="required" <?php endif; ?>><br>

    <?php endforeach; ?>




   
  </form>
