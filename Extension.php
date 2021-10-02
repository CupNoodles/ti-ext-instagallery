<?php 

namespace CupNoodles\InstaGallery;


use System\Classes\BaseExtension;

use Event;
use Config;
use Session;
use App;
use Request;

use CupNoodles\InstaGallery\Models\InstaAccounts;
/*
* InstaGallery extension for TastyIgniter
*/
class Extension extends BaseExtension
{

    /**
     * Returns information about this extension.
     *
     * @return array
     */
    public function extensionMeta()
    {
        return [
            'name'        => 'Instagram Gallery',
            'author'      => 'CupNoodles',
            'description' => 'Instagram Gallery for TastyIgniter',
            'icon'        => 'fa-picture-o',
            'version'     => '1.0.0'
        ];
    }

  

    /**
     * Boot method, called right before the request route.
     *
     * @return void
     */
    public function boot()
    {


        
    }

    public function registerSchedule($schedule)
    {
        // refresh the long-lived token every X days
        $schedule->call(function () {
            //$ia = new CupNoodles\InstaGallery\Controllers\InstaAccounts();
            foreach(InstaAccounts::all() as $account){
                $controller = new \CupNoodles\InstaGallery\Controllers\InstaAccounts();
                $controller->onRefreshToken('edit', $account);
            }
        })->cron('0 1 */'.(InstaGallerySettings::get('token_update_frequency')).' * *');
        

        // for each instagram account, schedule a media refresh every X minutes
        $schedule->call(function () {
            foreach(InstaAccounts::all() as $account){
                $controller = new \CupNoodles\InstaGallery\Controllers\InstaAccounts();
                $controller->onRefreshMedia('edit', $account);

            }
        })->cron('*/'.(InstaGallerySettings::get('media_update_frequency')).' * * * *');

    }


    public function registerSettings()
    {
        return [
            'settings' => [
                'label' => 'Instagram API Settings',
                'description' => 'Manage Instagram API settings.',
                'icon' => 'fa fa-picture-o',
                'model' => 'CupNoodles\InstaGallery\Models\InstaGallerySettings',
                'permissions' => ['Module.InstaGallery'],
            ],
        ];
    }

    public function registerNavigation()
    {
        return [
            'design' => [
                'child' => [
                    'units' => [
                        'priority' => 20,
                        'class' => 'InstaAccounts',
                        'href' => admin_url('cupnoodles/instagallery/instaaccounts'),
                        'title' => lang('cupnoodles.instagallery::default.side_menu'),
                        'permission' => 'Admin.InstaGallery',
                    ],
                ],
            ],
        ];
    }


}
