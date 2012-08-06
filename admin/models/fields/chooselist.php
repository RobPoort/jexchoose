<?php
defined('_JEXEC') or die('restricted access');

jimport('joomla.form.helper');
JFormHelper::loadFieldClass('list');

class JFormFieldChooselist extends JFormFieldList
{
	/**
	*	the form field type
	*	@var string
	*/
	protected $type = 'Chooselist';
	
	/**
	*	Method to get a list of options for a list input
	*
	*	@return	array	an array of JHtml options
	*/
	protected function getOptions(){
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$query->select('id,title');
		$query->from('#__categories');
		$query->where("extension='com_jexchoose'");
		
		$db->setQuery((string)$query);
		$rows = $db->loadObjectList();
		
		$options = array();
		if($rows){
			foreach($rows as $row){
				$options[] = JHtml::_('select.option', $row->id, $row->title);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}