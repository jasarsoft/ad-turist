<?php
    abstract class Configuration {
        const DB_HOST = 'localhost';
        const DB_NAME = 'ad-turist';
        const DB_USER = 'root';
        const DB_PASS = 'root';

        const BASE_PATH = '/ad-turist/';
        const BASE_URL = 'http://localhost:8080' . Configuration::BASE_PATH;
        
        const USER_SALT = 'jd38UDDhj83ejd0831jsadikuaZen883';
        
        const IMAGE_DATA_PATH = 'data/images/';
        
        const ITEM_PER_PAGE = 5;
    }
