<?php

require_once "Connection.php";

if (session_id() == "") {
    session_start();
}

class Session {

    /**
     * Don't allow to create it's instance
     */
    private function __construct() {
        /* Locked */
    }

    /**
     * Get singleton session's instance
     * @return Session - Instance of session
     */
    public static function getInstance() {
        if (self::$instance == null) {
            return self::$instance = new Session();
        } else {
            return self::$instance;
        }
    }

    /**
     * Get value by key for current session or return it's default value
     * @param string $key - Name of key
     * @param mixed $default - Default value, if values hasn't been set
     * @param bool $unset - Set true to unset it's value before return
     * @return mixed - Value associated with key
     */
    public function get($key, $default = null, $unset = false) {
        if (isset($_SESSION[$key])) {
            $r = $_SESSION[$key];
            if ($unset) {
                unset($_SESSION[$key]);
            }
            return $r;
        } else {
            return $default;
        }
    }

    /**
     * Set some value by it's key for current session
     * @param string $key - Name of value's key
     * @param mixed $value - Value to set
     * @return mixed - Just set value
     */
    public function set($key, $value) {
        return $_SESSION[$key] = $value;
    }

    /**
     * The function logs in a user
     * @param int $id - User's ID
     * @param string $login - User's login
     * @param string $password - User's password
     */
    public function login($id, $login, $password) {
        $_SESSION["user"] = [
            "id" => $id,
            "login" => $login,
            "password" => $password
        ];
    }

    /**
     * Check user's access
     * @param string $privilege - Name of privilege
     * @return bool - True on access allowed or false on failure
     */
    public function checkAccess($privilege) {
        if ($this->isGuest()) {
            return false;
        } else {
            $id = $_SESSION["user"]["id"];
        }
        if (is_array($privilege)) {
            foreach ($privilege as $p) {
                if (!$this->checkAccess($p)) {
					return false;
				}
            }
			return true;
        } else {
			$stmt = Connection::getInstance()->prepare(<<< SQL
          SELECT 1 FROM user AS u
            INNER JOIN role AS r ON r.id = u.role_id
            INNER JOIN privilege_to_role AS p_r ON p_r.role_id = r.id
          WHERE u.id = :user_id AND p_r.privilege_id = :privilege_id
SQL
			);
			$stmt->execute([
				":user_id" => $id,
				":privilege_id" => $privilege
			]);
			if ($stmt->fetchObject() !== false) {
				return true;
			} else {
				return false;
			}
		}
    }

    /**
     * The function logs out the user
     */
    public function logout() {
        unset($_SESSION["user"]);
    }

    /**
     * Check if session contains user's information
     *
     * @return bool - True if session contains user's information
     */
    public function isGuest() {
        return !isset($_SESSION["user"]);
    }

    /**
     * @var Session - Singleton session instance
     */
    private static $instance = null;
}

