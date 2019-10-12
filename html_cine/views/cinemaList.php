<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title></title>
  </head>
  <body>
    <?php foreach($cinemas as $cine): ?>
      <div><?= $cine->getName() ?></div>
    <?php endforeach; ?>
  </body>
</html>
