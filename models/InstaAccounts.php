<?php

namespace CupNoodles\InstaGallery\Models;

use Model;
use CupNoodles\InstaGallery\Models\InstaMedia;
/**
 * InstaProfiles Class
 */
class InstaAccounts extends Model
{
    /**
     * @var string The database table name
     */
    protected $table = 'instagram_accounts';

    /**
     * @var string The database table primary key
     */
    protected $primaryKey = 'id';

    public $casts = [
    ];

    public $relation = [
        'hasMany' => ['CupNoodles\InstaGallery\Models\InstaMedia', 'id', 'account_id']
    ];

    public function medias()
    {
        return $this->hasMany(InstaMedia::class);
    }
 
}
