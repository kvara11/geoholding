<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Language extends Model {
	/**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'languages';
	
	private static $lang;
	private static $page;
	private static $alias0Model = false;
	private static $alias1Model = false;
	private static $alias2Model = false;
	private static $alias3Model = false;


	public static function setLang($value) {
		self :: $lang = $value;
	}

	public static function setPage($value) {
		self :: $page = $value;
	}

	public static function setAlias0Model($object) {
		self :: $alias0Model = $object;
	}

	public static function setAlias1Model($object) {
		self :: $alias1Model = $object;
	}

	public static function setAlias2Model($object) {
		self :: $alias2Model = $object;
	}

	public static function setAlias3Model($object) {
		self :: $alias3Model = $object;
	}


	public function getFullUrlAttribute() {
		$full_url = '';
		
		if(self :: $page -> like_default) {
			if($this -> like_default) {
				$full_url = '/';
			} else {
				$full_url = '/'.$this -> title;
			}
		} else {
			$full_url = '/'.$this -> title.'/'.self :: $page -> { 'alias_'.$this -> title };
		}


		if(self :: $alias0Model) {
			$full_url .= '/'.self :: $alias0Model -> { 'alias_'.$this -> title };
		}

		if(self :: $alias1Model) {
			$full_url .= '/'.self :: $alias1Model -> { 'alias_'.$this -> title };
		}

		if(self :: $alias2Model) {
			$full_url .= '/'.self :: $alias2Model -> { 'alias_'.$this -> title };
		}

		if(self :: $alias3Model) {
			$full_url .= '/'.self :: $alias3Model -> { 'alias_'.$this -> title };
		}


        return $full_url;
    }


	public function getActiveAttribute() {
		if(self :: $lang -> title == $this -> title) {
			return true;
		}

		return false;
    }
}
