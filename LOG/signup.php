<?php
    include 'config.php' ;

if(isset($_POST['inscrire'])){

    $nom = mysqli_real_escape_string($conn , $_POST['nom']);
    $prenom = mysqli_real_escape_string($conn , $_POST['prenom']);
    $nomutilisateur = mysqli_real_escape_string($conn , $_POST['nomutilisateur']);
    $pass = mysqli_real_escape_string($conn , md5($_POST['password']));
    $cpass = mysqli_real_escape_string($conn , md5($_POST['cpassword']));
    $email = mysqli_real_escape_string($conn , $_POST['email']);
    

    $select = mysqli_query($conn , "SELECT * FROM users WHERE email = '$email' AND password = '$pass'") or die('query failed');

    function mailCheck ($email , $conn) : bool {
        $sql = "SELECT COUNT(*) FROM users WHERE email = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $email);
        

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_row($result);

        if ($row[0]>= 1){
            return false ;
        }else{
            return true ;
        }
    }

    function userNameCheck ($nomutilisateur , $conn) : bool {
        
        $sql = "SELECT COUNT(*) FROM users WHERE nomutilisateur = ?";
        $stmt = mysqli_prepare($conn, $sql);
        mysqli_stmt_bind_param($stmt, "s", $nomutilisateur);
        

        mysqli_stmt_execute($stmt);

        $result = mysqli_stmt_get_result($stmt);
        $row = mysqli_fetch_row($result);

        if ($row[0]>= 1){
            return false ;
        }else{
            return true ;
        }


    }
    
    
    if (strlen($pass)>8 || $pass == $cpass ){
        if ( mailCheck($email,$conn) && userNameCheck($nomutilisateur , $conn)){
            if(mysqli_num_rows($select) > 0){
                $message[] = 'user already exist!';
                 } 
                 else {
                    mysqli_query($conn, "INSERT INTO users ( nom , prenom  , nomutilisateur, password, email) VALUES('$nom', '$prenom', '$nomutilisateur', '$pass', '$email')") or die("query failed");
                    $message[] = 'registered successfully!';
                    echo "good";
                    //header('location:login.html');
                }
        } else {
            
            echo 'user already exist';
            $message[] = 'user alredy exist';
        }
       
    } 
    else {
    // email or password not the same
        echo 'diferent password';
        $message[] = 'password or email are not the same';
    }
   
}
?>