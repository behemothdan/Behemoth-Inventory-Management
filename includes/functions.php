<?php
	function getPage($slug) {
		global $db;
		connect();
		$currentpage = new Page;
		
		$selectcurrentpage = "SELECT * FROM `pages` WHERE `slug` = '" . $slug . "'";
		
		if ($select = $db->query($selectcurrentpage)){			
			while ($row = $select->fetch(PDO::FETCH_BOTH)){
				$currentpage->setTitle($row['title']);
				$currentpage->setContent($row['content']);
				$currentpage->setTemplate($row['template']);
			}
		}
		$db = null;
		return $currentpage;
	}	
?>