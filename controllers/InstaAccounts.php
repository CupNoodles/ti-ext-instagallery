<?php

namespace CupNoodles\InstaGallery\Controllers;

use AdminMenu;
use DB;

use GuzzleHttp\Client;

use CupNoodles\InstaGallery\Models\InstaMedia;
use CupNoodles\InstaGallery\Models\InstaGallerySettings;

class InstaAccounts extends \Admin\Classes\AdminController
{

    const LIST_URL = "https://graph.instagram.com/me/media?fields=id,caption,media_url,media_type,timestamp,permalink&access_token=";
    const REFRESH_URL = "https://graph.instagram.com/refresh_access_token?grant_type=ig_refresh_token&access_token=";

    public $implement = [
        'Admin\Actions\ListController',
        'Admin\Actions\FormController'
    ];

    public $listConfig = [
        'list' => [
            'model' => 'CupNoodles\InstaGallery\Models\InstaAccounts',
            'title' => 'cupnoodles.instagallery::default.text_title',
            'emptyMessage' => 'cupnoodles.instagallery::default.text_empty',
            'defaultSort' => ['id', 'DESC'],
            'configFile' => 'instaaccounts_config',
        ],
    ];

    public $formConfig = [
        'name' => 'cupnoodles.instagallery::default.text_form_name',
        'model' => 'CupNoodles\InstaGallery\Models\InstaAccounts',
        'request' => 'CupNoodles\InstaGallery\Requests\InstaAccounts',
        'create' => [
            'title' => 'lang:admin::lang.form.create_title',
            'redirect' => 'cupnoodles/instagallery/instaaccounts/edit/{id}',
            'redirectClose' => 'cupnoodles/instagallery/instaaccounts',
        ],
        'edit' => [
            'title' => 'lang:admin::lang.form.edit_title',
            'redirect' => 'cupnoodles/instagallery/instaaccounts/edit/{id}',
            'redirectClose' => 'cupnoodles/instagallery/instaaccounts',
        ],
        'preview' => [
            'title' => 'lang:admin::lang.form.preview_title',
            'redirect' => 'cupnoodles/instagallery/instaaccounts',
        ],
        'delete' => [
            'redirect' => 'cupnoodles/instagallery/instaaccounts',
        ],
        'configFile' => 'instaaccounts_config',
    ];


    public function __construct()
    {
        parent::__construct();

    }

    /**
     * @param mixed $httpClient
     */
    public function setHttpClient($httpClient): void
    {
        $this->httpClient = $httpClient;
    }

    /**
     * @return Client
     */
    public function getHttpClient()
    {
        return $this->httpClient ?? new Client();
    }

    public function onRefreshAccountToken($action, $account_id){

        if(!is_object($account_id)){
            $model = $this->formFindModelObject($account_id);
        }
        else{
            $model = $account_id;
        }
        
        try{
            $httpResponse = $this->getHttpClient()->get(static::REFRESH_URL . $model->access_token);
            if($httpResponse->getStatusCode() == 200){
                $response = json_decode($httpResponse->getBody());
                $model->access_token = $response->access_token;
                $model->save();
            }
        }
        catch(Exception $e){
            throw new ApplicationException('Failed to refresh access token');
        }
    }

    public function onRefreshMedia($action, $account_id){

        if(!is_object($account_id)){
            $model = $this->formFindModelObject($account_id);
        }
        else{
            $model = $account_id;
            $account_id = $model->id;
        }
        
        
        try{
            $httpResponse = $this->getHttpClient()->get(static::LIST_URL . $model->access_token);
        }
        catch(Exception $e){
            throw new ApplicationException('Failed to get Instagram media.');
        }
        if($httpResponse->getStatusCode() == 200){
            $response = json_decode($httpResponse->getBody());
            
            $media_keys = [];
            $count = 0;
            foreach($response->data as $media){
                if($count < $model->cache_num){
                    // don't use updateOrInsert so that we don't override changes we've made to captions
                    if(InstaMedia::where('media_id', $media->id)->exists()){
                        InstaMedia::where('media_id', $media->id)->update(
                            [
                                'account_id' => $account_id,
                                'caption' => $media->caption,
                                'media_type' => $media->media_type,
                                'media_url' => $media->media_url,
                                'created_at' => $media->timestamp,
                                'permalink' => $media->permalink,
                                'updated_at' => DB::raw('now()')
                            ]);
                    }
                    else{
                        InstaMedia::insert(
                            [
                                'media_id' => $media->id,
                                'account_id' => $account_id,
                                'caption' => $media->caption,
                                'media_type' => $media->media_type,
                                'media_url' => $media->media_url,
                                'created_at' => $media->timestamp,
                                'permalink' => $media->permalink,
                                'updated_at' => DB::raw('now()'),
                                'active' => (bool)InstaGallerySettings::get('auto_active')
                            ]);
                    }
                    
                        $media_keys []= $media->id;
                }
                $count++;
            }

            // remove media not within the count
            InstaMedia::where('account_id', $account_id)->whereNotIn('media_id', $media_keys)->delete();

        }
        return [$response];
    }
}
