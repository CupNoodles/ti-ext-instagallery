<?php

namespace CupNoodles\InstaGallery\Models;

use Model;

/**
 * @method static instance()
 */
class InstaGallerySettings extends Model
{
    public $implement = ['System\Actions\SettingsModel'];

    // A unique code
    public $settingsCode = 'cupnoodles_instagallery_settings';

    // Reference to field configuration
    public $settingsFieldsConfig = 'instagallerysettings';

    //
    //
    //
}
