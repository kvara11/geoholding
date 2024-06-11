<?php

namespace App\Http\Controllers;

use App;
use App\Models\Page;
use App\Models\Language;
use App\Http\Controllers\FrontController;
use App\Models\AboutUsStep0;
use App\Models\BrandsStep0;
use App\Models\BrandsStep1;
use App\Models\CompaniesStep0;
use App\Models\ContactsStep0;
use App\Models\HomeStep0;
use App\Models\VacanciesStep0;
use App\Models\VacanciesStep1;

class CompaniesController extends FrontController
{
    private const PAGE_SLUG = 'company';
    
    private static $page;

    function __construct() 
    {
        parent::__construct();
        
        self::$page = Page::firstWhere('slug', self::PAGE_SLUG);

        CompaniesStep0::setPage(self::$page);
        AboutUsStep0::setPage(Page::firstWhere('slug', 'about-us'));
        HomeStep0::setPage(Page::firstWhere('slug', 'home'));
        BrandsStep0::setPage(Page::firstWhere('slug', 'brands'));
        VacanciesStep0::setPage(Page::firstWhere('slug', 'vacancies'));
        ContactsStep0::setPage(Page::firstWhere('slug', 'contact'));
    }

    // public static function getStep0() 
    // {
    //     $language = Language::firstWhere('title', App::getLocale());

    //     $data = array_merge(self::getDefaultData($language,
    //                                                 self::$page),
    //                         [
    //                             'companies' => CompaniesStep0::orderByDesc('rang')->get(),
    //                         ]);

    //     return view('modules.companies.step0', $data);
    // }

    public static function getStep1($lang, $step0Alias)
    {
        $language = Language::firstWhere('title', $lang);
        $activeCompany = CompaniesStep0::firstWhere('alias_'.$language->title, $step0Alias);
        
        # save active company
        config(['activeCompany' => $activeCompany]);

        $homePage = Page::firstWhere('slug', 'home');
        return redirect(url('/'.$lang.'/'.self::$page->alias.'/'.$step0Alias.'/' . $homePage->{'alias_'.$lang}));
    }


    public static function getStep2($lang, $step0Alias, $step1Alias) 
    {
        $activePageSlug = Page::where('alias_'.$lang, $step1Alias)->value('slug');
        $activeCompany = CompaniesStep0::firstWhere('alias_'.$lang, $step0Alias);
        
        # for FrontController -> getDefaultData
        config(['activeCompany' => $activeCompany]);
        
        switch ($activePageSlug) {

            case 'home':
                $activeHome = HomeStep0::firstWhere('top_level', $activeCompany->id);
                $brandsPage = BrandsStep0::firstWhere('top_level', $activeCompany->id);

                $activeBlock = $activeHome;
                $data = array('activeHome' => $activeHome, 'brandsPage' => $brandsPage);
                $bladeFile = 'home';
                break;
            
            case 'about-us':
                $activeAbout = AboutUsStep0::firstWhere('top_level', $activeCompany->id);
                $contactPage = ContactsStep0::firstWhere('top_level', $activeCompany->id);

                $activeBlock = $activeAbout;
                $data = array('activeAbout' => $activeAbout, 'contactPage' => $contactPage);
                $bladeFile = 'about-us';
                break;
            
            case 'brands':
                $activeBrand = BrandsStep0::with(['brands' => function ($query) {
                                        $query->orderBy('rang', 'desc');
                                    }])->firstWhere('top_level', $activeCompany->id);

                $activeBlock = $activeBrand;
                $data = array('activeBrand' => $activeBrand);
                $bladeFile = 'brands';
                break;
            
            case 'vacancies':
                $activeVacancy = VacanciesStep0::where('top_level', $activeCompany->id)->first();

                if (isset($activeVacancy)) {
                    $vacancies = $activeVacancy->vacancies()
                                        ->where('last_date', '>', date('Y-m-d'))
                                        ->orderBy('id', 'desc')
                                        ->paginate(10);
                }

                $data = VacanciesStep1::paginate();
                
                $activeBlock = $activeVacancy;
                $data = array('activeVacancy' => $activeVacancy, 'vacancies' => $vacancies);
                $bladeFile = 'vacancies';
                break;
            
            case 'contact':
                $activeContact = ContactsStep0::firstWhere('top_level', $activeCompany->id);
                
                $activeBlock = $activeContact;
                $data = array('activeContact' => $activeContact);
                $bladeFile = 'contact';
                break;
            
            default:   
                $homePage = Page::firstWhere('slug', 'home');
                
                return redirect(url('/'.$lang.'/'.self::$page->alias.'/'.$step0Alias.'/' . $homePage->{'alias_'.$lang}));
                break;
        }
        
        $language = Language::firstWhere('title', $lang);
        
        $fullData = array_merge(self::getDefaultData($language, 
                                                self::$page,
                                                $activeBlock),
                                            $data);

        return view("modules.companies.$bladeFile", $fullData);
    }


    public function getStep3($lang, $step0Alias, $step1Alias, $step2Alias)
    {
        $activePageSlug = Page::where('alias_'.$lang, $step1Alias)->value('slug');
        $activeCompany = CompaniesStep0::firstWhere('alias_'.$lang, $step0Alias);
        
        # for FrontController -> getDefaultData
        config(['activeCompany' => $activeCompany]);

        switch ($activePageSlug) {

            case 'vacancies':
                $language = Language::firstWhere('title', $lang);
                $activeVacancy = VacanciesStep1::firstWhere('alias_'.$language->title, $step2Alias);

                $activeBlock = $activeVacancy;
                $data = array('active' => $activeVacancy, 'hr_email' => VacanciesStep0::select('hr_email')->firstWhere('top_level', $activeVacancy->top_level));
                $bladeFile = 'vacanciesStep1';
                break;
            
            default:
                $homePage = Page::firstWhere('slug', 'home');
                    
                return redirect(url('/'.$lang.'/'.self::$page->alias.'/'.$step0Alias.'/' . $homePage->{'alias_'.$lang}));
                break;
        }

        $language = Language::firstWhere('title', $lang);
        
        $fullData = array_merge(self::getDefaultData($language, 
                                                self::$page,
                                                $activeBlock),
                                            $data);

        return view("modules.companies.$bladeFile", $fullData);
    }
}
