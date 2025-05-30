<?php
session_start();
// import from tha backend directory
require_once "../../backend/config/database.php";


// Debug session
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in session. Please log in again.";
    // header("Location: login.php");
    header("Location: access_denied.php");
    exit();
}


// Fetch user notes
$stmt = $pdo->prepare("SELECT * FROM notes WHERE user_id = ?");
$stmt->execute([$_SESSION['user_id']]);
$notes = $stmt->fetchAll();
// echo ("<br>user id: " . $_SESSION['user_id']);


// fetch user infomation testing...
$stmt = $pdo->prepare("SELECT * FROM users WHERE id = ?");
$stmt->execute([$_SESSION['user_id']]);
$userinfo = $stmt->fetchAll();
// echo ("<br>user info: " . htmlspecialchars($userinfo[0]['email']));

?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap and Font Awesome -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="../css/dashboard.css">
    <!-- // tailwindcss link -->
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<style>
    .cardCat {
        width: 300px;
        height: 250px;
        background-color: #f7f7f7;
        border: 1px solid #ddd;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .card-content {
        padding: 20px;
        font-family: Arial, sans-serif;
        font-size: 16px;
        color: #333;
    }

    #catFact {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
    }


    /* From Uiverse.io by adamgiebl */
    .buttonDesign {
        background: #fbca1f;
        font-family: inherit;
        padding: 0.6em 1.3em;
        font-weight: 900;
        font-size: 18px;
        border: 3px solid black;
        border-radius: 0.4em;
        box-shadow: 0.1em 0.1em;
        cursor: pointer;
    }

    .buttonDelete {
        background: rgb(237, 72, 70);
        font-family: inherit;
        padding: 0.6em 1.3em;
        font-weight: 900;
        font-size: 18px;
        border: 3px solid black;
        border-radius: 0.4em;
        box-shadow: 0.1em 0.1em;
        cursor: pointer;
    }

    .buttonDesign:hover {
        transform: translate(-0.05em, -0.05em);
        box-shadow: 0.15em 0.15em;
    }

    .buttonDesign:active {
        transform: translate(0.05em, 0.05em);
        box-shadow: 0.05em 0.05em;
    }
</style>

<body>

    <?php include('components/navbar.php'); ?>

    <!-- <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2> -->

    <!-- <h3>Your email is: <?php echo $userinfo['email']; ?></h3>
    <h3>Your email is: <?php echo $userinfo['email']; ?></h3> -->

    <!-- <h4>Personal Email Account, <?php echo $_SESSION['useremail']; ?></h4> -->
    <!-- <h4>User ID, <?php echo $_SESSION['user_id']; ?></h4> -->

    <?php
    // Add notes
    if (isset($_GET["msg_success"])) {
        echo '<div class="alert alert-success alert-dismissible fade show" role="alert">';
        echo $_GET["msg_success"];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }

    // Delete notes
    if (isset($_GET["msg_fail"])) {
        echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
        echo $_GET["msg_fail"];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }

    // Update notes
    if (isset($_GET["msg"])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">';
        echo $_GET["msg"];
        echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
        echo '</div>';
    }
    ?>


    <!-- ✅ Bootstrap Toast -->
    <div class="position-fixed bottom-0 end-0 p-3" style="z-index: 11">
        <div id="loginToast" class="toast align-items-center text-white bg-primary border-0"
            role="alert" aria-live="assertive" aria-atomic="true"
            style="min-width: 400px; min-height: 80px; font-size: 1.3rem; box-shadow: 0 0 20px rgba(0,0,0,0.2);">
            <div class="d-flex">
                <div class="toast-body">
                    <?php
                    if (isset($_SESSION['toast_message'])) {
                        echo $_SESSION['toast_message'];
                        unset($_SESSION['toast_message']); // Remove message after showing
                    }
                    ?>
                </div>
                <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
        </div>
    </div>

    <!-- Bootstrap Alert Message -->
    <?php if (isset($_SESSION['alert_message'])): ?>
        <div class="alert alert-<?php echo $_SESSION['alert_type']; ?> alert-dismissible fade show" role="alert">
            <?php echo $_SESSION['alert_message']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php unset($_SESSION['alert_message']);
        unset($_SESSION['alert_type']); ?> <!-- Remove message after showing -->
    <?php endif; ?>


    <!-- Display notes -->
    <h3>Your Notes</h3>
    <table class="table">
        <thead class="table-warning">
            <tr>
                <th>Title</th>
                <th>Note Type</th>
                <th>Comment</th>
                <th>Action</th>
            </tr>
        </thead>
        <?php foreach ($notes as $note): ?>
            <tbody class="table-info">
                <tr>
                    <td><?php echo htmlspecialchars($note['title']); ?></td>
                    <td><?php echo htmlspecialchars($note['notetype']); ?></td>
                    <td><?php echo htmlspecialchars($note['comment']); ?></td>
                    <td>

                        <!-- Delete Form -->
                        <form action="../../backend/controllers/notesController.php" method="POST">
                            <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                            <button
                                class="buttonDelete"
                                type="button" data-bs-toggle="modal"
                                data-bs-target="#deleteModal"
                                type="submit"
                                onclick="openDeleteForm(<?php echo $note['id']; ?>)"
                                name="delete_note">Delete
                            </button>
                        </form>

                        <!-- Update Button (Opens Update Form) -->
                        <button
                            class="buttonDesign"
                            type="button"
                            data-bs-toggle="modal"
                            data-bs-target="#updateModal"
                            onclick="openUpdateForm(<?php echo $note['id']; ?>, 
                        '<?php echo htmlspecialchars($note['title']); ?>', 
                        '<?php echo htmlspecialchars($note['notetype']); ?>', 
                        '<?php echo htmlspecialchars($note['comment']); ?>')">
                            Update
                        </button>

                    </td>
                </tr>
            </tbody>
        <?php endforeach; ?>
    </table>


    <!-- Delete Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Delete Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>Are you sure you want to delete this note?</p>
                </div>
                <div class=" modal-footer">
                    <form action="../../backend/controllers/notesController.php" method="POST">
                        <input type="hidden" name="note_id" id="deleteNoteId">
                        <button type="button" class="btn btn-warning" data-bs-dismiss="modal">Cancel</button>
                        <button class="btn btn-danger" type="submit" name="delete_note">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add New Note</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="../../backend/controllers/notesController.php" method="POST">
                        <input class="form-control" type="text" name="title" placeholder="Title" required><br>
                        <!-- <input class="form-control" type="text" name="notetype" placeholder="Note Type" required><br> -->
                        <select class="form-select" aria-label="Default select example" name="notetype" required>
                            <option value="">Select Category Hobbies</option>
                            <option value="Anime">Anime</option>
                            <option value="Cat Facts">Cat Facts</option>
                            <option value="Jokes">Jokes</option>
                        </select><br>
                        <textarea class="form-control" name="comment" placeholder="Comment" required></textarea><br>
                        <button class="buttonDesign" type="submit" name="add_note">Add Note</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- addmodal -->
    <div class="container-fluid">
        <button
            class="buttonDesign"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#addModal">
            Add Note Modal
        </button>
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
                    <form action="../../backend/controllers/notesController.php" method="POST">
                        <input type="hidden" name="note_id" id="noteId">
                        <input class="form-control" type="text" name="title" id="title" placeholder="Title" required><br>
                        <!-- <input class="form-control" type="text" name="notetype" id="notetype" placeholder="Note Type" required><br> -->
                        <select class="form-select" aria-label="Default select example" name="notetype" id="notetype" required>
                            <option value="">Select Category Hobbies</option>
                            <option value="Anime">Anime</option>
                            <option value="Cat Facts">Cat Facts</option>
                            <option value="Jokes">Jokes</option>
                        </select><br>
                        <textarea class="form-control" name="comment" id="comment" placeholder="Comment" required></textarea><br>
                        <button class="buttonDesign" type="submit" name="update_note">Update Note</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- <div class="container-fluid">
        <div id="updateForm" style="display: none;">
            <h3>Update Note</h3>
            <form action="../../backend/controllers/notesController.php" method="POST">
                <input type="hidden" name="note_id" id="noteId">
                <input class="form-control" type="text" name="title" id="title" placeholder="Title" required><br>
                <input class="form-control" type="text" name="notetype" id="notetype" placeholder="Note Type" required><br>
                <textarea class="form-control" name="comment" id="comment" placeholder="Comment" required></textarea><br>
                <button class="buttonDesign" type="submit" name="update_note">Update Note</button>
                <button class="buttonDelete" type="button" onclick="document.getElementById('updateForm').style.display = 'none'">Cancel</button>
            </form>
        </div>
    </div> -->



    <!-- Weather API & Cat API -->
    <div class="container-fluid d-flex flex-column align-items-center gap-8">
        <?php
        $lat = "10.3157"; // Latitude for Cebu
        $lon = "123.8854"; // Longitude for Cebu
        $url = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true";

        // Initialize cURL session
        $ch = curl_init();

        // Set options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // Execute cURL request
        $response = curl_exec($ch);

        // Check for errors connections
        if (curl_errno($ch)) {
            $error = "Failed to connect to the weather API: " . curl_error($ch);
            $temp = "N/A";
        } else {
            $data = json_decode($response, true);

            // Check if temperature data exists
            if (isset($data['current_weather']['temperature'])) {
                $temp = $data['current_weather']['temperature'];
                $error = "";
            } else {
                $temp = "N/A";
                $error = "Weather data unavailable at the moment.";
            }
        }

        // Close cURL session
        curl_close($ch);

        echo "<h4>Weather Report:</h4>";
        echo "<h5>Current temperature: Cebu " . $temp . "°C</h5>";
        ?>

        <!-- Optional: Show error if any -->
        <?php if ($error): ?>
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 max-w-md mx-auto text-center">
                <?php echo $error; ?>
            </div>
        <?php endif; ?>


        <?php if (!$error): ?>
            <!-- From Uiverse.io by zanina-yassine -->
            <div class="card">
                <div class="container">
                    <div class="cloud front">
                        <span class="left-front"></span>
                        <span class="right-front"></span>
                    </div>
                    <span class="sun sunshine"></span>
                    <span class="sun"></span>
                    <div class="cloud back">
                        <span class="left-back"></span>
                        <span class="right-back"></span>
                    </div>
                </div>

                <div class="card-header">
                    <span>Cebu<br>City</span>
                    <span><?php echo date("F j"); ?></span>
                </div>

                <span class="temp"><?php echo $temp; ?></span>

                <div class="temp-scale">
                    <span>Celcius</span>
                </div>
            </div>
        <?php endif; ?>



        <?php
        $url = "https://catfact.ninja/fact";

        // Fetch API response
        // $responseCat = file_get_contents($url);
        $ch = curl_init();

        // // Set options
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        // // Execute cURL request
        $response = curl_exec($ch);

        // Convert JSON to PHP array
        // $data = json_decode($responseCat, true);

        // Display random cat fact
        // echo "Cat Fact: " . $data['fact'];

        // Check if the responseCat is valid
        if (curl_errno($ch)) {
            // $errorcat = "Failed to connect to the Cat fact API.";
            $errorcat = "Failed to connect to the Cat fact API: " . curl_error($ch);
            $data = "N/A";
        } else {
            // Fetch API responseCat
            $responseCat = file_get_contents($url);

            $data = json_decode($responseCat, true);

            // Check if temperature data exists
            if (isset($data)) {

                $errorcat = "";
            } else {
                $temp = "N/A";
                $errorcat = "No Cat API available at the moment.";
            }
        }
        ?>

        <?php if ($errorcat): ?>
            <div class="bg-red-100 text-red-700 px-4 py-2 rounded mb-4 max-w-md mx-auto text-center">
                <?php echo $errorcat; ?>
            </div>
        <?php endif; ?>

        <!-- // reload for cat fact -->
        <!-- // display cat fact -->
        <div class="cardCat">
            <div class="card-content">
                <p id="catFact">Cat Fact that you should know</p>
            </div>
        </div>

        <!-- <p id="catFact">Cat Fact that you should know</p> -->
        <button
            class="buttonDesign"
            type="button"
            data-bs-toggle="modal"
            data-bs-target="#staticBackdrop">
            Click for Cat Fact
        </button>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Cat Confirmation Message🙀</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you a cat lover? 😸😸🐱🐈🐈‍⬛
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Nah😾</button>
                    <button type="button" class="btn btn-warning" data-bs-dismiss="modal" id="catFactButton">Of Course meow!😻</button>
                </div>
            </div>
        </div>
    </div>

    <script src="../js/dashboard.js"></script>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>