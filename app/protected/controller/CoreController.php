<?php

class CoreController extends DooController
{
    /**
     * Auth session object of the application
     * @var DooAuth
     */
    public $auth;

    /**
     * Session object of the application
     * @var DooSession
     */
    public $session;

    /**
     * @var Data array
     */
    public $data;

    //Common constants
    const USERID = 'user_id';
    const PAGE_TITLE = 'title';
    const BASE_URL = 'baseurl';
    const ERRORS = 'error';
    const MENU_LINK_URL = 'linkUrl';
    const IS_LOGGED_IN = 'isLoggedIn';

    public function __construct()
    {
        $this->prepareCategories();
        $this->data[self::PAGE_TITLE] = 'BerntLinking';
        $this->data[self::BASE_URL] = Doo::conf()->APP_URL;
        if (empty($this->data[self::IS_LOGGED_IN])) {
            $this->data[self::IS_LOGGED_IN] = false;
        }

        $this->auth = new DooAuth('LinkMe');
        $this->auth->setSalt(Doo::conf()->SECURITY_SALT);
        $this->auth->start();
        $this->session = Doo::session('LinkMe');
        if ($this->isLoggedIn()) {
            $this->data[self::IS_LOGGED_IN] = true;
            //$this->data['username'] = $this->auth->__get('_username');
            $this->data['user-id'] = $this->session->id;
        } else {
            $this->data[self::IS_LOGGED_IN] = false;
        }
    }

    /**
     * check if iser is logged in
     * @return boolean
     */
    public function isLoggedIn()
    {
        if ($this->auth->isValid()) {
            return true;
        }
        return false;
    }

    /**
     * Creates baseURL for links in menu
     * @return string
     */
    public function buildLinkURL()
    {
        if (!empty($this->params['category'])) {
            $url = $this->data[self::BASE_URL] . 'index.php/c/' . $this->params['category'] . '/';
        } else {
            $url = $this->data[self::BASE_URL] . "index.php/s/";
        }
        return $url;
    }

    /**
     * gets all available categories 
     * @return void
     */
    public function prepareCategories()
    {
        Doo::loadModel('Category');
        $categories = new Category();
        $this->data['categories'] = $categories->find();
    }

    /**
     * check if POST request
     * @return boolean
     */
    public function isPost()
    {
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            return true;
        }
        return false;
    }

    /**
     * check if GET request
     * @return boolean
     */
    public function isGet()
    {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            return true;
        }
        return false;
    }

}
