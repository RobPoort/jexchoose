<?php
defined('_JEXEC') or die('Not here, stupid');

JHtml::_('behavior.tooltip');
JHtml::_('behavior.formvalidation');
?>
<form action="<?php echo JRoute::_('index.php?option=com_jexchoose&view=item&layout=edit&id='.(int)$this->item->id); ?>" method="post" name="adminForm" id="jexitem-form" class="form-validate">
	<div class="width-60 fltlft">
		<fieldset class="adminform">
			<legend><?php echo JText::_('COM_JEXCHOOSE_ITEM_DETAILS'); ?></legend>
			<ul class="adminformlist">
				<?php foreach($this->form->getFieldset('details') as $field) : ?>
					<li><?php echo $field->label;echo $field->input; ?></li>
				<?php endforeach; ?>
			</ul>
		</fieldset>
	</div>
	<div class="width-40 fltrt">
		<?php
			echo JHtml::_('sliders.start', 'jexchoose-slider');
			foreach($params as $name=>$fieldset) :
				echo JHtml::_('sliders.panel', JText::_($fieldset->label), $name.'-params');	
					if(isset($fieldset->description) && trim($filedset->description)) :
		?>
					<p class="tip"><?php echo $this->escape(JText::_($fieldset->description)); ?></p>
		<?php
					endif;
		?>
				<fieldset class="panelform">
					<ul class="adminformlist">
						<?php
							foreach($this->form->getFieldset($name) as $field) :
						?>
							<li><?php echo $field->label;echo $filed->input; ?></li>
						<?php
							endforeach;
						?>
					</ul>
				</fieldset>
		<?php
			endforeach;
			echo JHtml::_('sliders.end');
		?>
	</div>
	<div>
		<input type="hidden" name="task" value="item.edit" />
		<?php echo JHtml::_('form.token'); ?>
	</div>
</form>