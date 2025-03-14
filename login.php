<?php

    header('Content-Type: text/html; charset=utf-8');
    // Kết nối cơ sở dữ liệu
    $conn = mysqli_connect('localhost', 'root', '', 'thinh') or die ('Lỗi kết nối'); mysqli_set_charset($conn, "utf8");
    
    // Dùng isset để kiểm tra Form
    if(isset($_POST['Signup'])){
    $username = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);
    $errors=[];

    
    
    if (empty($username)) {
    array_push($errors, "Username is required"); 
    }
    if (empty($email)) {
    array_push($errors, "Email is required"); 
    }
    if (empty($password)) {
    array_push($errors, "Two password do not match"); 
    }
    
    // Kiểm tra username hoặc email có bị trùng hay không
    $sql = "SELECT * FROM member WHERE username = '$username' OR email = '$email'";
    
    // Thực thi câu truy vấn
    $result = mysqli_query($conn, $sql);
    
    // Nếu kết quả trả về lớn hơn 1 thì nghĩa là username hoặc email đã tồn tại trong CSDL
    if (mysqli_num_rows($result) > 0)
    {
    echo '<script language="javascript">alert("Bị trùng tên hoặc chưa nhập tên!"); window.location="login.php";</script>';
    
    // Dừng chương trình
    die ();
    }
    else {
    $sql = "INSERT INTO member (username, password, email) VALUES ('$username','$password','$email')";
        echo '<script language="javascript">alert("Đăng ký thành công!"); window.location="login.php";</script>';
        
        if (mysqli_query($conn, $sql)){
            echo "Tên đăng nhập: ".$_POST['name']."<br/>";
            echo "Mật khẩu: " .$_POST['password']."<br/>";
            echo "Email đăng nhập: ".$_POST['email']."<br/>";
          
        }
        else {
            echo '<script language="javascript">alert("Có lỗi trong quá trình xử lý"); window.location="login.php";</script>';
        }
    }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="login.css">
</head>
<body>
    <h2>Weekly Coding Challenge #1: Sign in/up Form</h2>
    <div class="container" id="container">
        <div class="form-container sign-up-container">
            <form action="#" method="post">
                <h1>Create Account</h1>
                <!-- <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div> -->
                <span>or use your email for registration</span>
                <input type="text" name="name"placeholder="Name" />
                <input type="email" name="email"placeholder="Email" /><input type="password" name="password"placeholder="Password" />
                <input class="btn" name="Signup" type="submit" value="Signup">
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action="#" method="Post">
                <h1>Sign in</h1>
                <!-- <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div> -->
                <span>or use your account</span>
                <input type="email" placeholder="Email" />
                <input type="password" placeholder="Password" />
                <a href="#">Forgot your password?</a>
                <input class="btn" name="Signin" type="submit" value="Sign in">
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>To keep connected with us please login with your personal info</p>
                    <button class="btn ghost" id="signIn">Sign In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello, Friend!</h1>
                    <p>Enter your personal details and start journey with us</p>
                    <button class="btn ghost" id="signUp">Sign Up</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        signUpButton.addEventListener('click', () => {
            container.classList.add("right-panel-active");
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove("right-panel-active");
        });
    </script>


    
</body>
</html>
