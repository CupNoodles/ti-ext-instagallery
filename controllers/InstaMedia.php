<?php

namespace CupNoodles\InstaGallery\Controllers;

use AdminMenu;
use DB;

use CupNoodles\InstaGallery\Models\InstaMedia as InstaMediaModel;

class InstaMedia extends \Admin\Classes\AdminController
{

    public $implement = [
        'Admin\Actions\ListController',
        'Admin\Actions\FormController'
    ];



    public $listConfig = [
        'list' => [
            'model' => 'CupNoodles\InstaGallery\Models\InstaMedia',
            'title' => 'cupnoodles.instagallery::default.text_title',
            'emptyMessage' => 'cupnoodles.instagallery::default.text_empty',
            'defaultSort' => ['id', 'DESC'],
            'configFile' => 'instamedia_config',
        ],
    ];

    public $formConfig = [
        'name' => 'cupnoodles.instagallery::default.text_form_name',
        'model' => 'CupNoodles\InstaGallery\Models\InstaMedia',
        'request' => 'CupNoodles\InstaGallery\Requests\InstaMedia',
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'cupnoodles/instagallery/instamedia/edit/{media_id}',
            'redirectClose' => 'cupnoodles/instagallery/instamedia',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'cupnoodles/instagallery/instamedia/edit/{media_id}',
            'redirectClose' => 'cupnoodles/instagallery/instamedia',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'redirect' => 'cupnoodles/instagallery/instamedia',
        ],
        'delete' => [
            'redirect' => 'cupnoodles/instagallery/instamedia',
        ],
        'configFile' => 'instamedia_config',
    ];


    public function __construct()
    {
        parent::__construct();
        $this->addJS('extensions/cupnoodles/instagallery/assets/js/cupnoodles-instagallery-media.js', 'cupnoodles-instagallery');
        
        $this->addCSS('extensions/cupnoodles/instagallery/assets/css/cupnoodles-instagallery-media.css', 'cupnoodles-instagallery');

    }

    public function save($route){

        $post = post();

        $media = InstaMediaModel::where('media_id', $post['media_id'])->first();
        $media->active = $post['active'] == 'true' ? 1 : 0;
        $media->save();
        die();

    }
}