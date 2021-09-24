<?php

namespace CupNoodles\InstaGallery\Models;

use Model;

use CupNoodles\InstaGallery\Models\InstaAccounts;

/**
 * InstaProfiles Class
 */
class InstaMedia extends Model
{
    /**
     * @var string The database table name
     */
    protected $table = 'instagram_media';

    /**
     * @var string The database table primary key
     */
    protected $primaryKey = 'media_id';

    protected $fillable = [
        'media_id',
        'account_id',
        'media_type',
        'caption',
        'media_url',
        'created_at',
        'updated_at'
    ];

    public $relation = [
        'belongsTo' => ['CupNoodles\InstaGallery\Models\InstaAccounts', 'account_id', 'id']
    ];

    public static function getByUsername($username){
        $account_id = InstaAccounts::where('username', $username)->find(1)->id;
        return static::where('account_id', $account_id)->get();
    }
 
}
