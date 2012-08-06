<?php
	/**
	*	admin part
	*/
defined('_JEXEC') or die('Restricted Access');

//import formrule library
jimport('joomla.form.formrule');
	
	/**
	*	formrule class
	*/
class JFormRuleLogo extends JFormRule
{
	/**
	*	The regular expression
	*	@access	protected
	*	@var	string
	*/
	protected $regex = '';
}