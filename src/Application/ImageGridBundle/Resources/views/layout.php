<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <link href="<?php echo $view->assets->getUrl('bundles/imagegrid/css/ui-lightness/jquery-ui.css') ?>" type="text/css" rel="stylesheet" />
    <link href="<?php echo $view->assets->getUrl('bundles/imagegrid/css/main.css') ?>" type="text/css" rel="stylesheet" />
    <script src="<?php echo $view->assets->getUrl('bundles/imagegrid/js/jquery.min.js') ?>"></script>
    <script src="<?php echo $view->assets->getUrl('bundles/imagegrid/js/jquery-ui.min.js') ?>"></script>
    <script src="<?php echo $view->assets->getUrl('bundles/imagegrid/js/navigator.js') ?>"></script>
    <title>
      <?php $view->slots->output('title', 'Medical Images Navigator') ?>
    </title>
  </head>
  <body>
    <div id="canvas">
      <div id="content">
        <?php $view->slots->output('_content') ?>
      </div>
      <div id="sidebar">
        <?php $view->slots->output('sidebar') ?>
      </div>
    </div>
  </body>
</html>

