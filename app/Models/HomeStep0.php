<?php

namespace App\Models;

use App;
use App\Models\Page;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class HomeStep0 extends Model
{
    use HasFactory;

    protected $table = 'home_step_0';
    
    private static $page;
    
    public static function setPage($page) 
    {
        self::$page = $page;
    }
    
    
    public function getTitleAttribute() 
    {
        return $this->{ 'title_'.App::getLocale() };
    }


    public function getSection1TitleAttribute() 
    {
        return $this->{ 'section1_title_'.App::getLocale() };
    }


	public function getSection1TextAttribute() 
    {
        return $this->{ 'section1_text_'.App::getLocale() };
    }
    
    
    public function getSection2TitleAttribute() 
    {
        return $this->{ 'section2_title_'.App::getLocale() };
    }


	public function getSection2TextAttribute() 
    {
        return $this->{ 'section2_text_'.App::getLocale() };
    }
    
    
    public function getSection3TitleAttribute() 
    {
        return $this->{ 'section3_title_'.App::getLocale() };
    }


	public function getSection3TextAttribute() 
    {
        return $this->{ 'section3_text_'.App::getLocale() };
    }


    public function getMetaTitleAttribute() 
    {
        if($this->{ 'meta_title_'.App::getLocale() }) {
            return $this->{ 'meta_title_'.App::getLocale() } ;
        } else {
            return $this->{ 'title_'.App::getLocale() };
        }
    }


	public function getMetaDescriptionAttribute() 
    {
        if($this->{ 'meta_description_'.App::getLocale() }) {
            $textAsDesc = strip_tags($this->{ 'meta_description_'.App::getLocale() });
            
            return mb_substr($textAsDesc, 0, 255, 'UTF-8');
        } else {
            $textAsDesc = strip_tags($this->{ 'section1_text_'.App::getLocale() });
            
            return mb_substr($textAsDesc, 0, 255, 'UTF-8');
        }
    }


    public function getMetaUrlAttribute() 
    {
        if(file_exists(public_path('/storage/images/modules/companies/81/meta_'.$this->{ 'id' }.'.jpg'))) {
            return '/storage/images/modules/companies/81/meta_'.$this->{ 'id' }.'.jpg';
        } else if(file_exists(public_path('/storage/images/modules/companies/81/'.$this->{ 'id' }.'.jpg'))) {
            return '/storage/images/modules/companies/81/'.$this->{ 'id' }.'.jpg';
        } else {
            return '/storage/images/meta_default.jpg';
        }
    }
    
    
	public function getFullUrlAttribute() 
    {
        return self::$page->fullUrl.'/'.$this->alias;
    }


    public function getFullUrl($lang) 
    {
        $mainAlias = Page::firstWhere('slug', 'company')->{'alias_'.$lang};
        
        return '/'.$lang.'/'.$mainAlias.'/'.config('activeCompany')->alias.'/'.self::$page->{ 'alias_'.$lang }.'/'.$this->{ 'alias_'.$lang };
    }


    public function partners()
    {
        return $this->hasMany(HomeStep6::class, 'top_level', 'id')->orderByDesc('rang');
    }

    public function services()
    {
        return $this->hasMany(HomeStep1::class, 'top_level', 'id');
    }


    public function products()
    {
        return $this->hasOne(HomeStep2::class, 'top_level', 'id');
    }


    public function reason()
    {
        return $this->hasOne(HomeStep4::class, 'top_level', 'id');
    }
}
