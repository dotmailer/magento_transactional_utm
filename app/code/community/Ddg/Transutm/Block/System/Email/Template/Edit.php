<?php
class Ddg_Transutm_Block_System_Email_Template_Edit extends Mage_Adminhtml_Block_System_Email_Template_Edit
{
	public function __construct()
	{
		parent::__construct();
		$this->setTemplate('transactional/email/edit.phtml');
	}

}