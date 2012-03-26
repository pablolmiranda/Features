<?php

namespace Presentation;

class Presentation{

	var $renderedViews = array();
	var $html = '';
	var $renderedJS = array();
	var $renderedJSTags = array();

	function add($feature){
		$featureView = $feature->render();
		$this->renderedViews[] = $featureView->filepath;
		$this->renderedJS[] = $featureView->jsName;
		$this->html .= $featureView->html;
		$this->renderedJSTags[] = $this->renderJSTag($featureView->jsName);
	}

	protected function renderJSTag($jsPath){
		return "<script type=\"text/javascript\" src=\"$jsPath\"></script>";
	}
	
}