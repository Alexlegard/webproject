<?php
class Users
{
    public function getUsers($dbcon){
        $sql = "SELECT * FROM users";
        $pdo = $dbcon->prepare($sql);
        $pdo->execute();
        $users = $pdo->fetchAll(PDO::FETCH_OBJ);
        return $users;
    }	
    
	 public function register($fname, $lname, $email, $password, $signdate, $db)
    {
        $sql = "INSERT INTO users (fname, lname, email, password, signdate) 
              VALUES (:fname, :lname, :email, :password, :signdate) ";
        $pdo = $db->prepare($sql);
        $pdo->bindParam(':fname', $fname);
        $pdo->bindParam(':lname', $lname);
        $pdo->bindParam(':email', $email);
        $pdo->bindParam(':password', $password);
        $pdo->bindParam(':signdate', $signdate);

        $user = $pdo->execute();
        return $user;
    }

	
	
}
?>