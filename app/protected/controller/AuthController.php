<?php
Doo::loadController('CoreController');
class AuthController extends CoreController
{
    
    const USERNAME = 'username';
    const PASSWORD = 'password';

    public function beforeRun($resource, $action)
    {
        parent::beforeRun($resource, $action);
        $this->data[self::MENU_LINK_URL] = $this->buildLinkURL();
    }

    public function logout()
    {
        unset($_SESSION['user']);
        session_destroy();
        return Doo::conf()->APP_URL;
    }

    public function login()
    {
        $this->data[self::PAGE_TITLE] = 'Logga in';
        
        if ($this->isPost()) {
            //validate login-form
            $v = new DooValidator();
            $error = $v->validate($_POST, 'login-rules');
            $this->data[self::ERRORS] = $error;

            if (empty($error)) {

                $_POST[self::USERNAME] = trim($_POST[self::USERNAME]);
                $_POST[self::PASSWORD] = trim($_POST[self::PASSWORD]);

                Doo::loadModel('User');
                $user = new User();
                $user->username = $_POST[self::USERNAME];
                $user->pwd = $_POST[self::PASSWORD];
                $user = $user->getUser();
                if ($user) {
                    $this->auth->setSecurityLevel(DooAuth::LEVEL_HIGH);
                    $this->auth->setData($user->username, 'member');
                    $this->session->username = $user->username;
                    $this->session->id = $user->id;
                    $this->data[self::IS_LOGGED_IN] = true;
                    DooUriRouter::redirect($this->data[self::BASE_URL]);
                }
            }
        }

        $this->renderc('login', $this->data);
    }

    public function register()
    {
        $this->data[self::PAGE_TITLE] = 'Registrera dig!';
        
        if (!$this->isLoggedIn()) {

            if ($this->isPost()) {
                $v = new DooValidator();
                $error = $v->validate($_POST, 'register-user-rules');
                $this->data[self::ERRORS] = $error;

                if (empty($error)) {
                    Doo::loadModel('User');
                    $user = new User();
                    $user->username = $_POST[self::USERNAME];
                    $user = $user->find(array('limit' => 1));
                    if ($user) {
                        $this->data[self::ERRORS] = array('ohh nej!' => 'användarnamnet existerar redan');
                    } else {
                        $user = new User();
                        $user->username = $_POST[self::USERNAME];
                        $user->pwd = $_POST[self::PASSWORD];
                        $user->addUser();
                        DooUriRouter::redirect($this->data[self::BASE_URL]);
                    }
                }
            }
            $this->render('register', $this->data);
        } else {
            $this->render('not-authorized', $this->data);
        }
    }

}
