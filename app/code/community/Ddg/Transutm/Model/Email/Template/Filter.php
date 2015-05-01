`<?php

class Ddg_Transutm_Model_Email_Template_Filter extends Mage_Core_Model_Email_Template_Filter
{

	public function storeDirective($construction)
	{

		$params = $this->_getIncludeParameters($construction[2]);
		if (!isset($params['_query'])) {
			$params['_query'] = array();
			//set the default utm data. dm utm
			$params['_query'] = $this->_getUtmData();
		}
		foreach ($params as $k => $v) {
			if (strpos($k, '_query_') === 0) {
				$params['_query'][substr($k, 7)] = $v;
				unset($params[$k]);
			}
		}

		$params['_absolute'] = $this->_useAbsoluteLinks;

		if ($this->_useSessionInUrl === false) {
			$params['_nosid'] = true;
		}

		if (isset($params['direct_url'])) {
			$path = '';
			$params['_direct'] = $params['direct_url'];
			unset($params['direct_url']);
		}
		else {
			$path = isset($params['url']) ? $params['url'] : '';
			unset($params['url']);
		}

		return Mage::app()->getStore(Mage::getDesign()->getStore())->getUrl($path, $params);
	}


	private function _getUtmData()
	{
		$source = Mage::getStoreConfig(Ddg_Transutm_Helper_Data::XML_CONFIG_UTM_SOURCE);
		$medium = Mage::getStoreConfig(Ddg_Transutm_Helper_Data::XML_CONFIG_UTM_MEDIUM);
		$campaign = Mage::getStoreConfig(Ddg_Transutm_Helper_Data::XML_CONFIG_UTM_CAMPAIGN);

		if ($source && $medium && $campaign)
			return array(
				'utm_source' => $source,
				'utm_medium' => $medium,
				'utm_campaign' => $campaign
			);
		return array();
	}
}