<?php

/**
 * Model configuration options for settings model.
 */

return [
    'form' => [
        'toolbar' => [
            'buttons' => [
                'save' => ['label' => 'lang:admin::lang.button_save', 'class' => 'btn btn-primary', 'data-request' => 'onSave'],
                'saveClose' => [
                    'label' => 'lang:admin::lang.button_save_close',
                    'class' => 'btn btn-default',
                    'data-request' => 'onSave',
                    'data-request-data' => 'close:1',
                ],
            ],
        ],
        'fields' => [
            'token_update_frequency' => [
                'label' => 'lang:cupnoodles.instagallery::default.token_update_frequency',
                'type' => 'text',
                'span' => 'left',
                'default' => '30',
            ],
            'media_update_frequency' => [
                'label' => 'lang:cupnoodles.instagallery::default.media_update_frequency',
                'type' => 'text',
                'span' => 'left',
                'default' => '15',
            ],
        ],
        'rules' => [

        ],
    ],
];
