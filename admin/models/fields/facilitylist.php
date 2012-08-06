<?php
defined('_JEXEC') or die('restricted access');


//import the fieldtype
jimport('joomla.form.helper');

JFormHelper::loadFieldClass('list');

class JFormFieldFacilitylist extends JFormFieldList
{
	/**
	*	the form field type
	*	@var string
	*/
	protected $type = 'Facilitylist';
	
	/**
	*	Method to get a list of options for a list input
	*
	*	@return	array	an array of JHtml options
	*/
	protected function getOptions(){
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$query->select('id,text');
		$query->from('#__jexchoose_items');
		$query->where("published='1'");
		
		$db->setQuery((string)$query);
		$rows = $db->loadObjectList();
		
		$options = array();
		if($rows){
			foreach($rows as $row){
				$options[] = JHtml::_('select.option', $row->id, $row->text);
			}
		}
		$options = array_merge(parent::getOptions(), $options);
		return $options;
	}
}