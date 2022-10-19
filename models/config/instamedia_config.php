<?php


$config['list']['toolbar'] = [
    'buttons' => [
        'accounts' => [
            'label' => lang('cupnoodles.instagallery::default.accounts'),
            'class' => 'btn btn-default',
            'href' => 'cupnoodles/instagallery/instaaccounts',
        ],
    ],
];

$config['list']['columns'] = [
    'edit' => [
        'type' => 'button',
        'iconCssClass' => 'fa fa-pencil',
        'attributes' => [
            'class' => 'btn btn-edit',
            'href' => admin_url('cupnoodles/instagallery/instamedia/edit/{media_id}'),
        ],
    ],
    'username' => [
        'relation' => 'accounts',
        'select' => 'username',
        'label' => 'lang:cupnoodles.instagallery::default.account_name',
        'sortable' => false,
    ],
    'media_url' => [
        'label' => 'lang:cupnoodles.instagallery::default.media_image',
        'type' => 'text',
        'sortable' => false,
        'formatter' => function($something, $column, $value){
            return '<img src="' . $value . '" class="admin-inline-instagallery-img" />';
            
        },
    ],
    'display_title' => [
        'label' => 'lang:cupnoodles.instagallery::default.display_title',
        'type' => 'text',
        'sortable' => false,
    ],
    'active' => [
        'label' => 'lang:cupnoodles.instagallery::default.active',
        'type' => 'text',
        'sortable' => false,
        'formatter' => function($something, $column, $value){

            return '
            <div class="form-group switch-field span-right " data-field-name="status" id="form-field-category-status-group">
                <div class="field-custom-container">
                    <div class="form-check form-switch">
                        <input type="checkbox" id="'. $something->media_id .'_status" data-media-id="'.$something->media_id.'" class="form-check-input instagallery-media-active" value="'.(int)$value.'" role="switch" ' . ($value ? 'checked="checked"' : '' ) . ' >
                        <label class="form-check-label" for="'. $something->media_id .'_status">Inactive/Active</label>
                    </div>
                </div>
            </div>

        ';
            
        },
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
    ],
];

$config['form']['tabs'] = [
    'defaultTab' => 'lang:cupnoodles.instagallery::default.text_tab_general',
    'fields' => [
        'display_title' => [
            'label' => 'lang:cupnoodles.instagallery::default.display_title',
            'type' => 'text',
            'span' => 'right',
        ],
        'caption' => [
            'label' => 'lang:cupnoodles.instagallery::default.caption',
            'type' => 'textarea',
            'span' => 'right',
        ],
        'active' => [
            'label' => 'lang:cupnoodles.instagallery::default.active',
            'type' => 'switch',
            'span' => 'right',
        ],
        'url' => [
            'label' => 'lang:cupnoodles.instagallery::default.url_override',
            'type' => 'text',
            'span' => 'right',
        ],

    ],
];

return $config;
