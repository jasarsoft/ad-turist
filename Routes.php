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
        #location
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
        #category
        [
            'Pattern'    => '|^admin/categories/?$|',
            'Controller' => 'AdminVenueCategory',
            'Method'     => 'index'
        ],
        [
            'Pattern'    => '|^admin/categories/add/?$|',
            'Controller' => 'AdminVenueCategory',
            'Method'     => 'add'
        ],
        [
            'Pattern'    => '|^admin/categories/edit/([0-9]+)/?$|',
            'Controller' => 'AdminVenueCategory',
            'Method'     => 'edit'
        ],
        #tags
        [
            'Pattern'    => '|^admin/tags/?$|',
            'Controller' => 'AdminTag',
            'Method'     => 'index'
        ],
        [
            'Pattern'    => '|^admin/tags/add/?$|',
            'Controller' => 'AdminTag',
            'Method'     => 'add'
        ],
        [
            'Pattern'    => '|^admin/tags/edit/([0-9]+)/?$|',
            'Controller' => 'AdminTag',
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
