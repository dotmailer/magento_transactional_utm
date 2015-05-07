<?php

class Ddg_Transutm_Model_Email_Template_Filter extends Mage_Core_Model_Email_Template_Filter
{

	/**
	 * utm data, utm_source, utm_medium, utm_campaign.
	 * @var array
	 */
	private $_utm = array();

	public function storeDirective($construction)
	{
		//set the custom utm values that will be send.
		$this->setUtmData();
		$params = $this->_getIncludeParameters($construction[2]);

		if (!isset($params['_query'])) {
			$params['_query'] = array();
		}
		foreach ($params as $k => $v) {

			if (strpos($k, '_query_') === 0) {

				$params['_query'][substr($k, 7)] = $v;
				unset($params[$k]);
				$params['_query'] = array_push($params['_query'], $this->_utm);
			}
			if ($k == '_query') {
				if (! empty($params['_query'])){
					foreach ( $this->_utm as $key => $v ) {
						$string = $key . '=' . $v;
						$params['_query'] .= '&' . $string;
					}
				} else {
					$params['_query'] = $this->_utm;
				}

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


	/**
	 * set the utm data, from the template and from the configuration if missing.
	 *
	 */
	private function setUtmData()
	{
		$data= $this->getIncludeProcessor();
		$template = $data[0];
		$utmSource = $template->getUtmSource();
		$utmMedium = $template->getUtmMedium();
		$utmcCampaign = $template->getUtmCampaign();
		if (! $utmSource) {
			$source = Mage::getStoreConfig(Ddg_Transutm_Helper_Data::XML_CONFIG_UTM_SOURCE);
			if ($source)
				$this->_utm['utm_source'] = $source;
		} else {
			$this->_utm['utm_source'] = $utmSource;
		}
		if (! $utmMedium) {
			$medium = Mage::getStoreConfig( Ddg_Transutm_Helper_Data::XML_CONFIG_UTM_MEDIUM );
			if ($medium)
				$this->_utm['utm_medium'] = $medium;
		} else {
			$this->_utm['utm_medium'] = $utmMedium;
		}
		if (! $utmcCampaign) {
			$campaign = Mage::getStoreConfig(Ddg_Transutm_Helper_Data::XML_CONFIG_UTM_CAMPAIGN);
			if ($campaign)
				$this->_utm['utm_campaign'] = $campaign;
		} else {
			$this->_utm['utm_campaign'] = $utmcCampaign;
		}
	}
}