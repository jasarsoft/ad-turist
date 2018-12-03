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
        #venues
        [
            'Pattern'    => '|^admin/venues/?$|',
            'Controller' => 'AdminVenue',
            'Method'     => 'index'
        ],
        [
            'Pattern'    => '|^admin/venues/add/?$|',
            'Controller' => 'AdminVenue',
            'Method'     => 'add'
        ],
        [
            'Pattern'    => '|^admin/venues/edit/([0-9]+)/?$|',
            'Controller' => 'AdminVenue',
            'Method'     => 'edit'
        ],
        
        #image
        [
            'Pattern'    => '|^admin/images/venue/([0-9]+)/?$|',
            'Controller' => 'AdminVenueImage',
            'Method'     => 'listVenueImages'
        ],
        [
            'Pattern'    => '|^admin/images/venue/([0-9]+)/add/?$|',
            'Controller' => 'AdminVenueImage',
            'Method'     => 'uploadImage'
        ],
        
        [
            'Pattern'    => '|^category/([a-z0-9\-]+)/?$|',
            'Controller' => 'Main',
            'Method'     => 'listByCategory'
        ],
        
        #index
        [
            'Pattern'    => '|^([0-9]+)?/?$|',
            'Controller' => 'Main',
            'Method'     => 'index'
        ],
        [
            'Pattern'    => '|^.*$|',
            'Controller' => 'Main',
            'Method'     => 'index'
        ]
    ];
