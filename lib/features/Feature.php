<?php

namespace Features;

class Feature{

	var $viewName;
	var $jsFileName;
	var $jsInline;

	function save(){}

	function update(){}

	function render(){
		$options['js_filename'] = $this->jsFileName;
		$options['js_inline'] = $this->jsInline;
		return new FeatureView($this->viewName, $options);
	}
}