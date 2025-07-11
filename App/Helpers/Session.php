<?php
namespace App\Helpers;

class Session
{
    private static $instances = [];
    private $signedIn = false;
    public $userId;
    public $userRole;
    public $message;

    private function __construct()
    {
        session_start();
        $this->checkLogin();
        $this->checkMessage();
    }

    private function __clone(){}

    public static function getInstance(): Session
    {
        $cls = static::class;
        if (!isset(self::$instances[$cls])) {
            self::$instances[$cls] = new static();
        }

        return self::$instances[$cls];
    }


    public function isSignedIn()
    {
        return $this->signedIn;
    }

    public function checkLogin()
    {
        if (isset($_SESSION['userId'])) {
            $this->userId = $_SESSION['userId'];
            $this->userRole = $_SESSION['userRole'] ?? null;
            $this->signedIn = true;
        } else {
            unset($this->userId);
            unset($this->userRole);
            $this->signedIn = false;
        }
    }

    public function login($user)
    {
        if ($user) {
            $this->userId = $user->id;
            $this->userRole = $user->role;
            $_SESSION['userId'] = $user->id;
            $_SESSION['userRole'] = $user->role;
            $this->signedIn = true;
        }
    }

    public function logout()
    {
        unset($_SESSION['userId']);
        unset($_SESSION['userRole']);
        unset($this->userId);
        unset($this->userRole);
        $this->signedIn = false;
    }

    public function message($msg = "")
    {
        if (!empty($msg)) {
            $this->message = $_SESSION['message'] = $msg;
        } else {
            return $this->message;
        }
    }

    public function checkMessage()
    {
        if (isset($_SESSION['message'])) {
            $this->message = $_SESSION['message'];
            unset($_SESSION['message']);
        } else {
            $this->message = "";
        }
    }

    public function authenticateWithCode($code)
    {
        $user = User::where('code', $code)->first();

        if($user) {
            $_SESSION['user_id'] = $user->id;
            $_SESSION['user_role'] = $user->role;
            return $user->role;
        }
        return false;
}
}
?>
