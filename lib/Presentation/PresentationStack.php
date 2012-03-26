<?php

namespace Presentation;

class PresentationStack{

	protected $features = array();

	function push($feature){
		array_push($this->features, $feature);
	}

	function pop(){
		return array_pop($this->features);
	}

	function size(){
		return count($this->features);
	}

	function render(){
		$presentation = new Presentation;
		foreach($this->features as $feature){
			$presentation->add($feature);
		}
		return $presentation;
		
	}
}