<?php

namespace Features;
use Features\Exceptions\FeatureViewNotFoundException;

class FeatureView{

	var $viewName;
	var $jsName;
	var $jsInline;
	var $html;
	var $options;
	var $filepath;

	function __construct($viewName, $options = array()){
		$this->options = $options;
		$path = dirname(__FILE__) . '/../../views/';
		$this->viewName = $viewName;
		$filepath = $path . $viewName;
		if(!file_exists($filepath)){
			$this->html = '';
			return;
		}
		$this->filepath = $filepath;
		ob_start();
		require($this->filepath);
		$this->html = ob_get_clean();

		$this->jsName = $this->extractOptions('js_filename');
		$this->jsInline = $this->extractOptions('js_inline');
	}

	protected function extractOptions($key){
		if(array_key_exists($key, $this->options))
			return $this->options[$key];
		return NULL;
	}
}