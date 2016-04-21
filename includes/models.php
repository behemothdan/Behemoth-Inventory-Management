<?php
	class Page {
		public $title;
		public $slug;
		public $content;
		public $template;
		
		public function setTitle($titleval) {
			$this->title = $titleval;
		}
		
		public function getTitle() {
			return $this->title;
		}
		
		public function setSlug($slugval) {
			$this->slug = $slugval;
		}
		
		public function getSlug() {
			return $this->slug;
		}
		
		public function setContent($contentval) {
			$this->content = $contentval;
		}
		
		public function getContent() {
			return $this->content;
		}
		
		public function setTemplate($templateval) {
			$this->template = $templateval;
		}
		
		public function getTemplate() {
			return $this->template;
		}				
	}
?>