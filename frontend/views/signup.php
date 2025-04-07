<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>

<body>
    <!-- base of the authController backend logic -->
    <!-- if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signup'])) -->
    <!-- <form action="../../backend/controllers/authController.php" method="POST">

        <input type="text" name="username" placeholder="Username" required><br>
        <input type="email" name="email" placeholder="Email" required><br>
        <input type="password" name="password" placeholder="Password" required><br>

        <button type="submit" name="signup">Signup</button>

    </form>
    <a href="login.php">Already have an account? Login</a> -->

    <form action="../../backend/controllers/authController.php" method="POST" class="form">
        <p class="title">Register </p>
        <p class="message">Signup now and get full access to our app. </p>
        <!-- <div class="flex"> -->
        <label>
            <input required="" placeholder="" type="text" name="username" class="input">
            <span>Username</span>
        </label>

        <!-- <label>
                <input required="" placeholder="" type="text" class="input">
                <span>Lastname</span>
            </label> -->
        <!-- </div> -->

        <label>
            <input required="" placeholder="" type="email" name="email" class="input">
            <span>Email</span>
        </label>

        <label>
            <input required="" placeholder="" type="password" name="password" class="input">
            <span>Password</span>
        </label>
        <label>
            <input required="" placeholder="" type="password" name="confirm_password" class="input">
            <span>Confirm password</span>
        </label>
        <button name="signup" class="submit">Submit</button>
        <p class="signin">Already have an acount ?
            <a href="login.php">Signin</a>
        </p>
    </form>

    <!-- script function for confirm password will match -->




</body>

<style>
    .form {
        box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);
        margin: 0 auto;
        margin-top: 50px;
        display: flex;
        flex-direction: column;
        gap: 10px;
        max-width: 350px;
        background-color: #fff;
        padding: 64px;
        border-radius: 20px;
        position: relative;
    }

    .title {
        font-size: 28px;
        color: royalblue;
        font-weight: 600;
        letter-spacing: -1px;
        position: relative;
        display: flex;
        align-items: center;
        padding-left: 30px;
    }

    .title::before,
    .title::after {
        position: absolute;
        content: "";
        height: 16px;
        width: 16px;
        border-radius: 50%;
        left: 0px;
        background-color: royalblue;
    }

    .title::before {
        width: 18px;
        height: 18px;
        background-color: royalblue;
    }

    .title::after {
        width: 18px;
        height: 18px;
        animation: pulse 1s linear infinite;
    }

    .message,
    .signin {
        color: rgba(88, 87, 87, 0.822);
        font-size: 14px;
    }

    .signin {
        text-align: center;
    }

    .signin a {
        color: royalblue;
    }

    .signin a:hover {
        text-decoration: underline royalblue;
    }

    .flex {
        display: flex;
        width: 100%;
        gap: 6px;
    }

    .form label {
        position: relative;
    }

    .form label .input {
        width: 100%;
        padding: 10px 10px 20px 10px;
        outline: 0;
        border: 1px solid rgba(105, 105, 105, 0.397);
        border-radius: 10px;
    }

    .form label .input+span {
        position: absolute;
        left: 10px;
        top: 15px;
        color: grey;
        font-size: 0.9em;
        cursor: text;
        transition: 0.3s ease;
    }

    .form label .input:placeholder-shown+span {
        top: 15px;
        font-size: 0.9em;
    }

    .form label .input:focus+span,
    .form label .input:valid+span {
        top: 30px;
        font-size: 0.7em;
        font-weight: 600;
    }

    .form label .input:valid+span {
        color: green;
    }

    .submit {
        border: none;
        outline: none;
        background-color: royalblue;
        padding: 10px;
        border-radius: 10px;
        color: #fff;
        font-size: 16px;
        transform: .3s ease;
        cursor: pointer;
    }

    .submit:hover {
        background-color: rgb(56, 90, 194);
    }

    @keyframes pulse {
        from {
            transform: scale(0.9);
            opacity: 1;
        }

        to {
            transform: scale(1.8);
            opacity: 0;
        }
    }
</style>

</html>