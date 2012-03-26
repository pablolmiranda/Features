<?php 

use Features\Feature;
use Features\Exceptions\FeatureViewNotFoundException;

class FeatureTest extends PHPUnit_Framework_TestCase{
	
	function setUp(){
		$this->feature = new ExampleFeature;
	}

	function test_feature_should_have_a_save_hook(){
		$this->feature->save();
	}

	function test_feature_should_have_a_update_hook(){
		$this->feature->update();
	}

	function test_feature_should_render_the_right_view(){
		$expected_view = 'example_view.php';
		$this->assertView($expected_view, $this->feature->render());
	}

	function test_feature_should_render_a_empty_html_if_the_view_doesnt_exists(){
		$some_view = 'not_existent_example_view.php';
		$this->feature->viewName = $some_view;
		$expectedHTML = '';
		$this->assertViewHTML($expectedHTML, $this->feature->render());
	}

	function test_feature_should_render_the_right_html_for_the_view(){
		$expectedHTML = '<html><head><title>Example View</title></head><body><h1>Example View</h1></body></html>';
		$this->assertViewHTML($expectedHTML, $this->feature->render());
	}

	function test_feature_should_render_the_right_javascript_file(){
		$expected_javascript_file = 'example.js';
		$this->assertJS($expected_javascript_file, $this->feature->render());
	}

	function test_feature_should_render_the_correct_inline_javascript(){
		$expected_inline_js = 'var i = function(){ return 1};';
		$this->assertJSInline($expected_inline_js, $this->feature->render());
	}

	protected function assertView($expected_view_name, $resulted_view){
		$this->assertEquals($expected_view_name, $resulted_view->viewName);
	}

	protected function assertViewHTML($expected_html, $resulted_view){
		$this->assertEquals($expected_html, $resulted_view->html);
	}

	protected function assertJS($expected_js, $resulted_view){
		$this->assertEquals($expected_js, $resulted_view->jsName);
	}

	protected function assertJSInline($expected_inline_js, $resulted_view){
		$this->assertEquals($expected_inline_js, $resulted_view->jsInline);
	}
}

class ExampleFeature extends Feature{
	var $viewName = 'example_view.php';
	var $jsFileName = 'example.js';
	var $jsInline = 'var i = function(){ return 1};';
}