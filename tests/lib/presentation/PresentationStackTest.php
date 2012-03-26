<?php

use Presentation\PresentationStack;
use Features\Feature;

class PresentationStackTest extends PHPUnit_Framework_TestCase{
	
	function setUp(){
		$this->presentationStack = new PresentationStack;
		$this->feature_1 = new ExampleFeature;
		$this->feature_2 = new ExampleFeature;
		$this->presentationStack->push($this->feature_1);
		$this->presentationStack->push($this->feature_2);
	}

	function test_presentation_stack_should_be_able_to_pull_features(){
		$this->assertEquals(2, $this->presentationStack->size());
	}

	function test_presentation_stack_should_pop_features(){
		$this->assertEquals(2, $this->presentationStack->size());
		$poppedFeature = $this->presentationStack->pop();
		$this->assertInstanceOf('Features\Feature', $poppedFeature);
		$this->assertEquals(1, $this->presentationStack->size());
	}

	function test_presentation_stack_should_render_presentation(){
		$this->assertInstanceOf('Presentation\Presentation', $this->presentationStack->render());
	}

	function test_presentation_stack_should_have_the_right_views(){
		$expected_views = array(
			$this->feature_1->render()->filepath, 
			$this->feature_2->render()->filepath
		);
		$this->assertEquals($expected_views, $this->presentationStack->render()->renderedViews);
	}

	function test_presentation_stack_should_have_the_right_javascript(){
		$expected_views = array(
			$this->feature_1->render()->jsName,
			$this->feature_2->render()->jsName
		);
		$this->assertEquals($expected_views, $this->presentationStack->render()->renderedJS);
	}

	function test_presentation_stack_should_render_the_right_javascript_include_tags(){
		$expected_js_tags = array(
			$this->renderJSTag($this->feature_1->render()->jsName),
			$this->renderJSTag($this->feature_2->render()->jsName),
		);
		$this->assertEquals($expected_js_tags, $this->presentationStack->render()->renderedJSTags);
	}

	protected function renderJSTag($js_path){
		return "<script type=\"text/javascript\" src=\"$js_path\"></script>";
	}
}