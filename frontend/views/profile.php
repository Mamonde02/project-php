<?php
session_start();
require_once "../../backend/config/database.php";

if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in session. Please log in again.";
    exit();
}

// fetch user information testing...
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$userinfo = $stmt->fetch(PDO::FETCH_ASSOC); // Fetch only one row
// $userinfo = $stmt->fetchAll();
// echo ("<br>user info: " . htmlspecialchars($userinfo[0]['email'])); 

if (!$userinfo) {
    echo "User not found!";
    exit();
}

// $_SESSION['name'] = $userinfo['username'];
// $_SESSION['email'] = $userinfo['email'];
// $_SESSION['password'] = $userinfo['password'];

?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Page</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <!-- <h1>Profile</h1>
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
    <p>User ID: <?php echo $_SESSION['user_id']; ?></p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <p>Password: <?php echo $_SESSION['password']; ?></p>
    <a href="logout.php">Logout</a> -->



    <div class="container mt-4">
        <h1>Profile</h1>
        <h2>Welcome, <?php echo htmlspecialchars($userinfo['username']); ?>!</h2>
        <p><strong>User ID:</strong> <?php echo htmlspecialchars($userinfo['id']); ?></p>
        <p><strong>Email:</strong> <?php echo htmlspecialchars($userinfo['email']); ?></p>
        <!-- <p><strong>Account Created:</strong> <?php echo htmlspecialchars($userinfo['created_at']); ?></p> -->

        <a href="logout.php" class="btn btn-danger">Logout</a>
        <a href="dashboard.php" class="btn btn-primary">Dashboard</a>

        <!-- Update Button modal for Update User profile (Opens Update Form) button -->
        <button
            type="button"
            class="btn btn-warning"
            data-bs-toggle="modal"
            data-bs-target="#updateModal"
            onclick="openUpdateForm( 
            '<?php echo htmlspecialchars($userinfo['id']); ?>',
            '<?php echo htmlspecialchars($userinfo['username']); ?>', 
            '<?php echo htmlspecialchars($userinfo['email']); ?>')">
            Update Profile
        </button>



    </div>



    <div class="container mt-4">
        <h1>Update Profile</h1>

        <!-- Display success or error messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>


        <!-- Profile Update Form -->
        <form action="../../backend/controllers/authController.php" method="POST">
            <div class="mb-3">
                <label for="username" class="form-label">Username</label>
                <input type="text" class="form-control" id="username" name="username"
                    value="<?php echo htmlspecialchars($userinfo['username']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="email" class="form-label">Email address</label>
                <input type="email" class="form-control" id="email" name="email"
                    value="<?php echo htmlspecialchars($userinfo['email']); ?>" required>
            </div>
            <div class="mb-3">
                <label for="password" class="form-label">New Password (leave blank to keep current password)</label>
                <input type="password" class="form-control" id="password" name="password">
            </div>
            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
        </form>
    </div>





    <!-- Update Form -->
    <!-- modal bootstrap initial -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../backend/controllers/authController.php" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($userinfo['id']); ?>">
                        <p><strong>User ID:</strong> <?php echo htmlspecialchars($userinfo['id']); ?></p>

                        <input class="form-control" type="text" name="username" id="username" placeholder="Username"
                            value="<?php echo htmlspecialchars($userinfo['username']); ?>" required><br>
                        <input class="form-control" type="email" name="email" id="email" placeholder="Email"
                            value="<?php echo htmlspecialchars($userinfo['email']); ?>" required><br>
                        <input class="form-control" type="password" name="password" id="password"
                            placeholder="New Password (leave blank to keep current password)"><br>

                        <!-- <textarea class="form-control" name="comment" id="comment" placeholder="Comment" required></textarea><br> -->
                        <button class="btn btn-success" type="submit" name="update_profile">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
        function openUpdateForm(id, username, email) {
            // Set values in the input fields inside the modal
            document.getElementById("id").value = id;
            document.getElementById("username").value = username;
            document.getElementById("email").value = email;
        }
    </script>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>