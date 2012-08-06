<?php
defined('_JEXEC') or die('restricted access');
jimport('joomla.html.html');
JHtml::_('behavior.tooltip');
?>
<style type="text/css">
	.choose_even{background-color:#ddd;}
	.result_even{background-color:#D2C8EC;height:40px;}
	.result_odd{height:40px;}
</style>
<?php
if($this->items){
?>
	<form action="" method="post" >
		<table width="100%" class="choose_table" style="border:0;" border="0" cellpadding="0" cellspacing="0">		
			<?php
			$i = 0;
			foreach($this->items as $item){
			$checked = '';
			if(is_int($i/2)){
				$rowClass = 'even';
			}else{
				$rowClass = 'odd';
			}
			if($this->selected && in_array($item->id, $this->selected)){
				$checked = 'checked="checked"';
			}
			
			?>
				<tr class="choose_<?php echo $rowClass; ?>">
					<td>
					<input type="checkbox" name="select[]" value="<?php echo $item->id; ?>" <?php echo $checked; ?> /><?php echo $item->text; ?>
					</td>
				</tr>
			<?php
			$i++;
			}
			?>
			<?php echo JHtml::_('form.token'); ?>
			
			<input type="hidden" name="option" value="com_jexchoose" />
			
		
		</table>
		<input type="submit" name="reset" value="herstel" class="button" />
		<button class="button" onClick="this.form.submit()" name="sendList">Zoek..</button>
	</form>
	<?php
	if($this->selected){
		?>
		<div class="results_div">
		<?php
		if($this->locations){
			$locs = $this->locations;
			?>			
				<table width="100%" class="results_table" style="border:0;" border="0" cellpadding="0" cellspacing="0">
					<?php
						$i = 0;
						foreach($locs as $loc){
						if(is_int($i/2)){
							$rowClass = 'even';
						}else{
							$rowClass = 'odd';
						}
							?>
								<tr class="result_<?php echo $rowClass; ?>">
									<td><a href="<?php echo $loc->link; ?>" title="<?php echo $loc->name; ?>" class="choose_link"><?php echo $loc->name; ?></a></td>
									<td>
									<?php
										if($loc->logo != ''){
											?>
											<img src="<?php echo $loc->logo; ?>" width="40px" />
											<?php
										}
									?>
									</td>
								</tr>
							<?php
							$i++;
						}
					?>
				</table>			
			<?php
		} else{
			// moet nog: language file voor in het installatie pakket
			//echo JText::_('COM_JEXCHOOSE_NORESULT');
			echo '<h3>Geen resultaten. Probeer het nog eens met andere criteria.</h3>';
		}
		?>
		</div>
		<?php
	}
	?>
<?php
}
?>