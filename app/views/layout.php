<!DOCTYPE html>
<html>

<head>
  <title>ヘッダーつきフルスクリーン</title>
  <meta charset="UTF-8" />
  <link rel="stylesheet" href="css/vendor/sanitize.css">
  <link rel="stylesheet" href="css/style.css">
</head>

<body>
  <div class="app">
    <div class="container">

      <?php echo $sidebarContent; ?>

      <div class="main">
        <div id="graph-content" class="content">
          <?php echo $graphContent; ?>
        </div>

        <div id="search-content" class="content checked">
          <?php echo $searchContent; ?>
        </div>

      </div>
    </div>
  </div>
  <script type="module" src="js/main.js"></script>
</body>

</html>
