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

<body class="bg-gray-100 text-gray-800 min-h-screen">
    <!-- <h1>Profile</h1>
    <h2>Welcome, <?php echo $_SESSION['name']; ?>!</h2>
    <p>User ID: <?php echo $_SESSION['user_id']; ?></p>
    <p>Email: <?php echo $_SESSION['email']; ?></p>
    <p>Password: <?php echo $_SESSION['password']; ?></p>
    <a href="logout.php">Logout</a> -->



    <div class="container mx-auto px-4 py-2 max-w-4xl">
        <!-- tailwind Profile Header Card -->
        <div class="bg-white rounded-2xl shadow-md p-6 mb-8">
            <h1 class="text-3xl font-bold text-indigo-600 mb-2">👤 Profile</h1>
            <p class="text-lg font-medium">Welcome, <span class="text-gray-900"><?php echo htmlspecialchars($userinfo['username']); ?></span>!</p>
            <div class="mt-4 space-y-2">
                <p><strong>User ID:</strong> <?php echo htmlspecialchars($userinfo['id']); ?></p>
                <p><strong>Email:</strong> <?php echo htmlspecialchars($userinfo['email']); ?></p>
            </div>

            <!-- bootstrap old version initial -->
            <!-- <h1>Profile</h1>
            <h2>Welcome, <?php echo htmlspecialchars($userinfo['username']); ?>!</h2>
            <p><strong>User ID:</strong> <?php echo htmlspecialchars($userinfo['id']); ?></p>
            <p><strong>Email:</strong> <?php echo htmlspecialchars($userinfo['email']); ?></p>
            <p><strong>Account Created:</strong> <?php echo htmlspecialchars($userinfo['created_at']); ?></p>

            <a href="logout.php" class="btn btn-danger">Logout</a>
            <a href="dashboard.php" class="btn btn-primary">Dashboard</a> -->

            <!-- Update Button modal for Update User profile (Opens Update Form) button -->
            <!-- <button
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

            <button
                type="button"
                class="btn btn-success"
                data-bs-toggle="modal"
                data-bs-target="#changePasswordModal">
                Change Password
            </button> -->


            <!-- tailwind Action Buttons -->
            <div class="mt-6 flex flex-wrap gap-3">
                <!-- <a href="logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg shadow">Logout</a> -->
                <a href="dashboard.php" class="bg-indigo-500 hover:bg-indigo-600 text-white px-4 py-2 rounded-lg shadow">Dashboard</a>
                <button
                    type="button"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-4 py-2 rounded-lg shadow"
                    data-bs-toggle="modal"
                    data-bs-target="#updateModal"
                    onclick="openUpdateForm(
            '<?php echo htmlspecialchars($userinfo['id']); ?>',
            '<?php echo htmlspecialchars($userinfo['username']); ?>',
            '<?php echo htmlspecialchars($userinfo['email']); ?>'
          )">
                    ✏️ Update Profile
                </button>
                <button
                    type="button"
                    class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg shadow"

                    data-bs-toggle="modal"
                    data-bs-target="#changePasswordModal">
                    🔒 Change Password
                </button>
            </div>
        </div>


    </div>



    <div class="container mx-auto max-w-4xl">
        <!-- <h1>Update Profile</h1> -->

        <!-- Display success or error messages -->
        <?php if (isset($_SESSION['message'])): ?>
            <div class="alert alert-<?php echo $_SESSION['message_type']; ?> alert-dismissible fade show" role="alert">
                <?php echo $_SESSION['message']; ?>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            <?php unset($_SESSION['message'], $_SESSION['message_type']); ?>
        <?php endif; ?>


        <!-- bootstrap old version Profile Update Form -->
        <!-- <form action="../../backend/controllers/authController.php" method="POST">
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
            <button type="submit" name="update_profile" class="btn btn-primary">Update Profile</button>
        </form> -->


        <!-- tailwind Update Profile Form -->
        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-semibold text-indigo-600 mb-4">Update Your Information</h2>
            <form action="../../backend/controllers/authController.php" method="POST" class="space-y-4">
                <div>
                    <label for="username" class="block text-sm font-medium">Username</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($userinfo['username']); ?>"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <div>
                    <label for="email" class="block text-sm font-medium">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($userinfo['email']); ?>"
                        class="w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                </div>
                <button type="submit" name="update_profile"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-6 py-2 rounded-lg shadow">
                    Save Changes
                </button>
            </form>
        </div>
    </div>

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
                        <!-- <input class="form-control" type="password" name="password" id="password"
                            placeholder="New Password (leave blank to keep current password)"><br> -->

                        <!-- <textarea class="form-control" name="comment" id="comment" placeholder="Comment" required></textarea><br> -->
                        <button class="btn btn-success" type="submit" name="update_profile">Update Profile</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Update Form Change Password -->
    <!-- modal bootstrap initial -->
    <div class="modal fade" id="changePasswordModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Change Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../backend/controllers/authController.php" method="POST">
                        <input type="hidden" name="id" id="id" value="<?php echo htmlspecialchars($userinfo['id']); ?>">
                        <p><strong>User ID:</strong> <?php echo htmlspecialchars($userinfo['id']); ?></p>

                        <input class="form-control" type="password" name="current_password" id="current_password"
                            placeholder="Current Password" required><br>
                        <input class="form-control" type="password" name="new_password" id="new_password"
                            placeholder="New Password" required><br>
                        <input class="form-control" type="password" name="confirm_password" id="confirm_password"
                            placeholder="Confirm Password" required><br>

                        <button class="btn btn-success" type="submit" name="change_password">Update Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/profile.js"></script>



    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

</body>

</html>