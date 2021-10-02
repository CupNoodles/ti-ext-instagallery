<?php


$config['list']['toolbar'] = [
    'buttons' => [
        'create' => [
            'label' => 'lang:admin::lang.button_new',
            'class' => 'btn btn-primary',
            'href' => admin_url('cupnoodles/instagallery/instaaccounts/create'),
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_delete',
            'class' => 'btn btn-danger',
            'data-attach-loading' => '',
            'data-request' => 'onDelete',
            'data-request-form' => '#list-form',
            'data-request-data' => "_method:'DELETE'",
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
        ],
    ],
];

$config['list']['columns'] = [
    'edit' => [
        'type' => 'button',
        'iconCssClass' => 'fa fa-pencil',
        'attributes' => [
            'class' => 'btn btn-edit',
            'href' => admin_url('cupnoodles/instagallery/instaaccounts/edit/{id}'),
        ],
    ],
    'username' => [
        'label' => 'lang:cupnoodles.instagallery::default.username',
        'type' => 'text'
    ],
    'cache_num' => [
        'label' => 'lang:cupnoodles.instagallery::default.cache_num',
        'type' => 'text'
    ],


];

$config['form']['toolbar'] = [
    'buttons' => [
        'save' => [
            'label' => 'lang:admin::lang.button_save',
            'class' => 'btn btn-primary',
            'data-request' => 'onSave',
            'data-progress-indicator' => 'admin::lang.text_saving',
        ],
        'saveClose' => [
            'label' => 'lang:admin::lang.button_save_close',
            'class' => 'btn btn-default',
            'data-request' => 'onSave',
            'data-request-data' => 'close:1',
            'data-progress-indicator' => 'admin::lang.text_saving',
        ],
        'delete' => [
            'label' => 'lang:admin::lang.button_icon_delete',
            'class' => 'btn btn-danger',
            'data-request' => 'onDelete',
            'data-request-data' => "_method:'DELETE'",
            'data-request-confirm' => 'lang:admin::lang.alert_warning_confirm',
            'data-progress-indicator' => 'admin::lang.text_deleting',
            'context' => ['edit'],
        ],
        'refresh_token' => [
            'label' => 'lang:cupnoodles.instagallery::default.refresh_access_token',
            'class' => 'btn btn-default',
            'data-request' => 'onRefreshAccountToken',
            'context' => ['edit'],
        ],
        'refresh_media' => [
            'label' => 'lang:cupnoodles.instagallery::default.refresh_media',
            'class' => 'btn btn-default',
            'data-request' => 'onRefreshMedia',
            'context' => ['edit'],
        ],
    ],
];

$config['form']['tabs'] = [
    'defaultTab' => 'lang:cupnoodles.instagallery::default.text_tab_general',
    'fields' => [
        'username' => [
            'label' => 'lang:cupnoodles.instagallery::default.username',
            'type' => 'text',
            'span' => 'right',
        ],
        'cache_num' => [
            'label' => 'lang:cupnoodles.instagallery::default.cache_num',
            'type' => 'text',
            'span' => 'right',
        ],
        'access_token' => [
            'label' => 'lang:cupnoodles.instagallery::default.access_token',
            'type' => 'text',
            'span' => 'right',
        ],
    ],
];

return $config;
