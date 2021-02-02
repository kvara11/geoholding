<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model {
    public function getFullData($lang) {
		$pageUpdatedData = (object) array();
		$pageUpdatedData -> title = '';
		$pageUpdatedData -> alias = '';
		$pageUpdatedData -> text = '';

		if($this -> published) {
			$pageUpdatedData = $this;
			
			foreach(Language :: where('published', 1) -> get() as $data) {
				if($data -> title === $lang) {
					$var_title = 'title_'.$lang;
					$var_alias = 'alias_'.$lang;
					$var_text = 'text_'.$lang;


					$pageUpdatedData -> title = $this -> $var_title;
					$pageUpdatedData -> alias = $this -> $var_alias;
					$pageUpdatedData -> text = $this -> $var_text;
				}
			}
		}

		return $pageUpdatedData;
	}
}