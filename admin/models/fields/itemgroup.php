<?php
defined('_JEXEC') or die('restricted access');

jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldItemgroup extends JFormFieldList
{
	protected $type="Itemgroup";
	
	/**
	*	Method to get a list of options for a list input
	*
	*	@return	array	an array of JHtml options
	*/
	protected function getOptions(){
		
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$query->select('jg.id as id, jg.title as title, c.title as category_title');
		$query->from('#__jexchoose_groups as jg');
		$query->where('jg.published=1');
		$query->join('LEFT','#__categories as c ON c.id=jg.catid');
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		
		$options = array();
		if($rows){
			foreach($rows as $row){
				$options[] = JHtml::_('select.option', $row->id, $row->title.' ('.$row->category_title.')');
			}
		}		
		
		return $options;
	}
}