<?php $view->extend('ImageGridBundle::layout') ?>

<?php $view->slots->start('sidebar') ?>
  <button id="move-up">go up</button>
  <button id="move-left">go left</button>
  <button id="move-right">go right</button>
  <button id="move-down">go down</button>
  <button id="reload">reload</button>
  <div id="zoom"></div>
<?php $view->slots->stop() ?>

<div id="data">
  <span id="uri"><?php echo $view->router->generate('navigator') ?></span>
  <span id="scale"><?php echo $scale ?></span>
  <span id="x-offset"><?php echo $x_offset ?></span>
  <span id="y-offset"><?php echo $y_offset ?></span>
</div>

<table cellpadding="0" cellspacing="0">
<?php for ($i = $y_offset; $i < $y_limit; $i++): ?>
	<tr>
	<?php for ($j = $x_offset; $j < $x_limit; $j++): ?>
		<td>
			<img width="100" height="100"
        src="<?php echo $view->router->generate('show_grid_cell', array(
          'scale' => $scale, 'x' => $j, 'y' => $i, 'w' => 100, 'h' => 100))
        ?>" alt="<?php echo sprintf('%s,%s', $j, $i) ?>" />
		</td>
	<?php endfor; ?>
	</tr>
<?php endfor; ?>
</table>

