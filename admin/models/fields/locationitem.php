<?php
defined('_JEXEC') or die('Restricted Access');

//import the list field type
jimport('joomla.form.helper');
JFormHelper::loadFieldClass('checkboxes');

class JFormFieldLocationitem extends JFormFieldCheckboxes
{
	/**
	*	the form field type
	*	@var string
	*/
	protected $type = 'Locationitem';
	
	/**
	*	Method to get a list of options for a list input
	*
	*	@return	array	an array of JHtml options
	*/
	protected function getOptions()
	{
		$locid = JRequest::getVar('id');
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$query->from('#__jexchoose_items');
		$query->select('id as value, text as text');
		$query->where('`published`=1');
		
		$db->setQuery($query);
		$options = $db->loadObjectList();		
		

      // Check for a database error.
      if ($db->getErrorNum()) {
         JError::raiseWarning(500, $db->getErrorMsg());
      }
                
                $options = array_merge(parent::getOptions(), $options);
      return $options;
	}
	protected function getInput()
	{
		
		$itemids = $this->getLocItem();
		
		// Initialize variables.
		$html = array();

		// Initialize some field attributes.
		$class = $this->element['class'] ? ' class="checkboxes ' . (string) $this->element['class'] . '"' : ' class="checkboxes"';

		// Start the checkbox field output.
		$html[] = '<fieldset id="' . $this->id . '"' . $class . '>';

		// Get the field options.
		$options = $this->getOptions();

		// Build the checkbox field output.
		$html[] = '<ul>';
		foreach ($options as $i => $option)
		{

			
			// Initialize some option attributes.
			$checked = (in_array((string) $option->value, (array) $itemids) ? ' checked="checked"' : '');
			$class = !empty($option->class) ? ' class="' . $option->class . '"' : '';
			$disabled = !empty($option->disable) ? ' disabled="disabled"' : '';

			// Initialize some JavaScript option attributes.
			$onclick = !empty($option->onclick) ? ' onclick="' . $option->onclick . '"' : '';

			$html[] = '<li>';
			$html[] = '<input type="checkbox" id="' . $this->id . $i . '" name="' . $this->name . '"' . ' value="'
				. htmlspecialchars($option->value, ENT_COMPAT, 'UTF-8') . '"' . $checked . $class . $onclick . $disabled . '/>';

			$html[] = '<label for="' . $this->id . $i . '"' . $class . '>' . JText::_($option->text) . '</label>';
			$html[] = '</li>';
		}
		$html[] = '</ul>';

		// End the checkbox field output.
		$html[] = '</fieldset>';

		return implode($html);
	}
	protected function getLocItem()
	{
		$locid = JRequest::getVar('id');
		
		$db = JFactory::getDBO();
		$query = $db->getQuery(true);
		
		$query->from('#__jexchoose_xref');
		$query->select('item_id');
		$query->where('location_id='.(int)$locid);
		
		$db->setQuery($query);
		$rows = $db->loadObjectList();
		$itemids = array();
		foreach($rows as $row){
			$itemids[] = $row->item_id;
		}
		
		return $itemids;
	}
}