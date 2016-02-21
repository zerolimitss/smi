<?php
defined('ACCESS') or exit('No Access');

const SITE_URL = '/realnews/';
const TITLE = 'Real News';

const MODEL = 'core/model';
const CONTROLLER = 'core/controller';
const VIEW = 'template/default/';
const LIB = 'lib/';

const UPLOAD_IMG = 'images/';
const QUANTITY = 5; //search
const QUANTITY_A = 10; //archive

const DB_HOST = 'localhost';
const DB_USER = 'root';
const DB_PASS = '';
const DB_NAME = 'news';

$header_sts = [
    'styles' => ['css/style.css'],
    'scripts' => ['js/jquery-1.7.2.min.js','js/func.js'],
    'styles-admin' => ['css/style-admin.css'],
    'scripts-admin' => ['js/jquery-1.7.2.min.js','js/func.js'],
];

setlocale(LC_ALL, 'rus_RUS');