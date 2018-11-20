<?php
    return [
        [
            'Pattern'    => '|^login/?$|',
            'Controller' => 'Main',
            'Method'     => 'login'
        ],
        [
            'Pattern'    => '|^logout/?$|',
            'Controller' => 'Main',
            'Method'     => 'logout'
        ],
        [
            'Pattern'    => '|^admin/locations/?$|',
            'Controller' => 'AdminLocation',
            'Method'     => 'index'
        ],
        [
            'Pattern'    => '|^admin/locations/add/?$|',
            'Controller' => 'AdminLocation',
            'Method'     => 'add'
        ],
        [
            'Pattern'    => '|^admin/locations/edit/([0-9]+)/?$|',
            'Controller' => 'AdminLocation',
            'Method'     => 'edit'
        ],
        [
            'Pattern'    => '|^category/([a-z0-9\-]+)/?$|',
            'Controller' => 'Main',
            'Method'     => 'listByCategory'
        ],
        [
            'Pattern'    => '|^.*$|',
            'Controller' => 'Main',
            'Method'     => 'index'
        ]
    ];
