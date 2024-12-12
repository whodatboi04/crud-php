<?php
require_once 'conn.php';

error_reporting(E_ALL);
ini_set('display_errors', 1);


class UpdateAccount extends DbConnect{

    public function __construct(){
        parent::__construct();
    }

    //Update User Profile
    public function updateProfile($userID, $firstname, $lastname, $email) {
        session_start();

        // Check for empty input fields
        if ($this->emptyProfileInput() == false) {
            $_SESSION['message'] = "Please fill in all fields.";
            header("Location: ../update-profile.php");
            exit();
        }

        // Check if email already exists
        if ($this->emailExists($userID) == true) {
            $_SESSION['message'] = "Email already exists.";
            header("Location: ../update-profile.php");
            exit();
        }

        // Update user profile
        $query = "UPDATE users SET firstname = ?, lastname = ?, email = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('sssi', $firstname, $lastname, $email, $userID);
        $stmt->execute();
        $stmt->close();
        
        $_SESSION['message'] = "Profile updated successfully. Please login again.";
        header("Location: ../profile.php");
        exit();
        
    }

    //Check if input fields are empty
    private function emptyProfileInput() {
        if (empty($_POST['firstname']) || empty($_POST['lastname']) || empty($_POST['email'])) {
            return false;
        }
        return true;
    }

    //Check if email is already in exists expecpt for the current email
    private function emailExists($userID) {
        $result = false;
        $email = $_POST['email'];
        
        $query = "SELECT email FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("i", $userID);
        $stmt->execute();
        $stmt->store_result();
    
        if ($stmt->num_rows > 0) {
            $stmt->bind_result($currentEmail);
            $stmt->fetch();
            
            if ($email != $currentEmail) {
                $stmt->close();
                $query2 = "SELECT * FROM users WHERE email = ?";
                $stmt = $this->conn->prepare($query2);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $stmt->store_result();
                if ($stmt->num_rows > 0) {
                    $result = true; 
                }
            }
        }
        $stmt->close();
        return $result;
    }
    

    //Change User Password
    public function changePassword($userID, $currentPassword, $newPassword) {
        session_start();
    
        //Check for empty input fields
        if ($this->emptyInput() == false) {
            $_SESSION['message'] = "All fields are required.";
            header("Location: ../change-password.php");
            exit();
        }

        //Check if the current password matches 
        if (!$this->currentPasswordMatch($userID, $currentPassword)) {
            $_SESSION['message'] = "Current password is incorrect.";
            header("Location: ../change-password.php");
            exit();
        }

        //Check if new password matches current password
        if($this->checkNewPassword() == false) {
            $_SESSION['message'] = "New password must be different from old password.";
            header("Location: ../change-password.php");
            exit();
        }

        //Check new password length 
        if($this->passwordLength() == false) {
            $_SESSION['message'] = "Password must be atleast 8 characters.";
            header("Location: ../change-password.php");
            exit();
        }

        //Check if new password matches confirm password
        if (!$this->passwordMatch($newPassword)) {
            $_SESSION['message'] = "New password and confirm password do not match.";
            header("Location: ../change-password.php");
            exit();
        }
        
        //Update the password
        $hashedNewPassword = password_hash($newPassword, PASSWORD_DEFAULT);
        $query = "UPDATE users SET password = ? WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('si', $hashedNewPassword, $userID);
        $stmt->execute();
        $stmt->close();
    
        $_SESSION['message'] = "Password changed successfully.";
        header("Location: ../profile.php");
        exit();
    }
    

    //Empty Input
    private function emptyInput() {
        $result = false;
        if (empty($_POST['current_password']) || empty($_POST['new_password']) || empty($_POST['confirm_password'])) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
    
    //Current Password Match
    private function currentPasswordMatch($userID, $currentPassword) {
        $query = "SELECT password FROM users WHERE id = ?";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param('i', $userID);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $hashedPassword = $row['password'];
            $currentPassword = trim($currentPassword);

            if (password_verify($currentPassword, $hashedPassword)) {
                return true; 
            }
        }
        return false; 
    }


    //Password Match
    private function passwordMatch(){
        $result = false;

        if($_POST['new_password'] !== $_POST['confirm_password']) {
            $result = false;
        } else {
            $result = true;
        }

        return $result;
    }

    //Password Must be atleast 8 characters
    private function passwordLength(){
        $result = false;
        if (strlen($_POST['new_password']) < 8) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //New Password must different from current password
    private function checkNewPassword(){
        if($_POST['current_password'] === $_POST['new_password']) {
            return false;
        } else {
            return true;
        }
    }
    
}

?>









