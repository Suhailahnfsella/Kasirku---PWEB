<?php
class AdminModel
{
    private $db;

    public function __construct()
    {
        $this->db = include_once __DIR__ . '/../database/db_connection.php';
    }

    public function getUserByUsername($username)
    {
        $query = "SELECT * FROM tbl_admin WHERE username_admin = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param('s', $username);
        $stmt->execute();
        $result = $stmt->get_result();
        return $result->fetch_assoc();
    }

    public function isUsernameExist($usernameLogin, $usernameAdmin) {
        $query = "SELECT COUNT(*) as count FROM tbl_admin WHERE username_admin = ? AND username_admin != ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $usernameAdmin, $usernameLogin);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function isEmailExist($usernameLogin, $emailAdmin) {
        $query = "SELECT COUNT(*) as count FROM tbl_admin WHERE email_admin = ? AND username_admin != ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ss", $emailAdmin, $usernameLogin);
        $stmt->execute();
        $result = $stmt->get_result()->fetch_assoc();
        return $result['count'] > 0;
    }

    public function updateAdmin($usernameLogin, $usernameAdmin, $emailAdmin, $passwordAdmin) {
        $query = "UPDATE tbl_admin SET username_admin = ?, email_admin = ?, password_admin = ? WHERE username_admin = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssss", $usernameAdmin, $emailAdmin, $passwordAdmin, $usernameLogin);
        return $stmt->execute();
    }
}
