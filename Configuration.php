<?php
    abstract class Configuration {
        const DB_HOST = 'localhost';
        const DB_NAME = 'root';
        const DB_USER = 'root';
        const DB_PASS = 'ad-turist';

        const BASE_PATH = '/ad-turist/';
        const BASE_URL = 'http://localhost:8080' . Configuration::BASE_PATH;
        
        const USER_SALT = 'jd38UDDhj83ejd0831jsadikuaZen883';
    }
