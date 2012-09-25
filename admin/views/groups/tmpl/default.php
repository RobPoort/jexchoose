<?php
defined('_JEXEC') or die('restricted access');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.multiselect');
?>
<form action="<?php echo JRoute::_('index.php?option=com_jexchoose'); ?>" method="post" name="adminForm" id="adminForm">
	<table class="adminlist">
		<tr>
			<th width="5">
				<?php echo JText::_('COM_JEXCHOOSE_GROUPS_HEADING_ID'); ?>
			</th>
			<th width="20">
				<input type="checkbox" name="toggle" value="" onclick="checkAll(<?php echo count($this->items); ?>)" />
			</th>
			<th>
				<?php echo JText::_('COM_JEXCHOOSE_GROUPS_HEADING_NAME'); ?>
			</th>
			<th>
		<?php echo JText::_('COM_JEXCHOOSE_HEADING_CATEGORY'); ?>
	</th>
			<th width="10%">		
				<?php echo JText::_('JGRID_HEADING_ORDERING'); ?>
				<?php echo JHtml::_('grid.order',  $this->items, 'filesave.png', 'groups.saveorder'); ?>
			</th>
			<th width="5%">
				<?php echo JTEXT::_('JPUBLISHED'); ?>
			</th>
		</tr>
		<?php
	foreach($this->items as $i => $item) : ?>
		<tr class="row<?php echo $i % 2; ?>">
			<td>
				<?php echo $item->id; ?>
			</td>
			<td>
				<?php echo JHtml::_('grid.id', $i, $item->id); ?>
			</td>
			<td>
			<a href="index.php?option=com_jexchoose&task=group.edit&id=<?php echo $item->id; ?>">
			<?php		
				echo $item->title;					
			?>
			</a>
			</td>
			<td>
				<?php echo $item->category; ?>
			</td>
			<td class="order">
				<span><?php echo $this->pagination->orderUpIcon($i, true, 'groups.orderup', 'JLIB_HTML_MOVE_UP', true); ?></span>
				<span><?php echo $this->pagination->orderDownIcon($i, $this->pagination->total, true, 'groups.orderdown', 'JLIB_HTML_MOVE_DOWN', true); ?></span>
				<input type="text" name="order[]" size="5" value="<?php echo $item->ordering;?>" <?php //echo $disabled ?> class="text-area-order" />
			</td>
			<td class="center">
				<?php echo JHtml::_('jgrid.published', $item->published, $i, 'groups.', true);?>
			</td>			
		</tr>
	<?php endforeach; ?>
	<tr>
		<td colspan="6"><?php echo $this->pagination->getListFooter(); ?></td>
	</tr>
	</table>
	<div>
		<input type="hidden" name="task" value="" />
		<input type="hidden" name="boxchecked" value="0" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>