<?php

class Login extends DbConnect{

    public function __construct()
    {
        parent::__construct();
    }

    //Login User
    public function loginUser($email, $password){
        session_start();
        $email = $this->validateUser($email, 'email');
        $password = $this->validateUser($password, 'password');
        
        if($this->emptyInput() == false){
            $_SESSION['message'] = "All fields are required.";
            header("Location: ../index.php");
            exit();
        }else{
            //Query User
            $query = "SELECT * FROM users WHERE email = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param('s', $email);
            $stmt->execute();
            
            // Fetch user data
            $result = $stmt->get_result();
            $user = $result->fetch_assoc(); 
            
            //Check if user exists
            if($result->num_rows == 1){

                //Password Match
                if($user && password_verify($password, $user['password'])){
                    $_SESSION['id'] = $user['id'];
                    $_SESSION['email'] = $user['email'];
                    $_SESSION['firstname'] = $user['firstname'];
                    $_SESSION['lastname'] = $user['lastname'];
                    $_SESSION['message'] = "Login successful.";
                    header("Location: ../home.php");
                    exit();
                }else{
                    $_SESSION['message'] = "Invalid email or password.";
                    header("Location: ../index.php");
                    exit();
                }
            }else{
                $_SESSION['message'] = "Invalid email or password.";
                header("Location: ../index.php");
                exit();
            }
            
        }
    }

    //Validate User
    private function validateUser($data){
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    //Empty Input
    private function emptyInput(){
        if (empty($_POST['email']) || empty($_POST['password'])) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}
?>