<!-- // import css from css folder -->
<!-- <link rel="stylesheet" href="../css/dashboard.css"> -->

<?php
session_start();
// import from tha backend directory
require_once "../../backend/config/database.php";


// Debug session
if (!isset($_SESSION['user_id'])) {
    echo "User ID is not set in session. Please log in again.";
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
</head>

<body>
    
    <?php include('components/navbar.php'); ?>
    
    <h2>Welcome, <?php echo $_SESSION['user']; ?>!</h2>

    <!-- <h3>Your email is: <?php echo $userinfo['email']; ?></h3>
    <h3>Your email is: <?php echo $userinfo['email']; ?></h3> -->

    <h4>Personal Email Account, <?php echo $_SESSION['useremail']; ?></h4>
    <h4>User ID, <?php echo $_SESSION['user_id']; ?></h4>

    <a href="joke.php">Joke Page</a>
    <br>
    <a href="../../logout.php">Logout</a>
    <br>
    <!-- <a href="../logout.php">Correct! Logout</a> -->

    <!-- problem solved -->
    <a href="/php-auth/frontend/logout.php">Final Logout</a>


    <!-- Add note == [POST] -->
    <div class="container-fluid">
        <h3>Add Note</h3>
        <form action="../../backend/controllers/notesController.php" method="POST">
            <input class="form-control" type="text" name="title" placeholder="Title" required><br>

            <!-- <input type="text" name="notetype" placeholder="Note Type" required><br> -->
            <select class="form-select" aria-label="Default select example" name="notetype" required>
                <option value="">Select Programming Language</option>
                <option value="HTML">HTML</option>
                <option value="CSS">CSS</option>
                <option value="Javascript">JavaScript</option>
                <option value="Reactjs">Reactjs</option>
                <option value="Nodejs">Nodejs</option>
                <option value="PHP">PHP</option>
                <option value="Laravel">Laravel</option>
            </select><br>
            <textarea class="form-control" name="comment" placeholder="Comment" required></textarea><br>
            <button type="submit" name="add_note">Add Note</button>
        </form>
    </div>


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


    <!-- Display notes -->
    <h3>Your Notes</h3>
    <table border="1">
        <tr>
            <th>Title</th>
            <th>Note Type</th>
            <th>Comment</th>
            <th>Action</th>
        </tr>
        <?php foreach ($notes as $note): ?>
            <tr>
                <td><?php echo htmlspecialchars($note['title']); ?></td>
                <td><?php echo htmlspecialchars($note['notetype']); ?></td>
                <td><?php echo htmlspecialchars($note['comment']); ?></td>
                <td>

                    <!-- Delete Form -->
                    <form action="../../backend/controllers/notesController.php" method="POST">
                        <input type="hidden" name="note_id" value="<?php echo $note['id']; ?>">
                        <button class="buttonDelete" type="submit" name="delete_note">Delete</button>
                    </form>

                    <!-- Update Button (Opens Update Form) -->
                    <button
                        onclick="openUpdateForm(<?php echo $note['id']; ?>, 
                        '<?php echo htmlspecialchars($note['title']); ?>', 
                        '<?php echo htmlspecialchars($note['notetype']); ?>', 
                        '<?php echo htmlspecialchars($note['comment']); ?>')">
                        Update
                    </button>

                </td>
            </tr>
        <?php endforeach; ?>
    </table>


    <!-- Update Form -->
    <div id="updateForm" style="display: none;">
        <h3>Update Note</h3>
        <form action="../../backend/controllers/notesController.php" method="POST">
            <input type="hidden" name="note_id" id="noteId">
            <input type="text" name="title" id="title" placeholder="Title" required><br>
            <input type="text" name="notetype" id="notetype" placeholder="Note Type" required><br>
            <textarea name="comment" id="comment" placeholder="Comment" required></textarea><br>
            <button type="submit" name="update_note">Update Note</button>
            <button type="button" onclick="document.getElementById('updateForm').style.display = 'none'">Cancel</button>
        </form>
    </div>



    <!-- Weather API -->
    <?php
    $lat = "14.5995"; // Latitude for Manila
    $lon = "120.9842"; // Longitude for Manila
    $url = "https://api.open-meteo.com/v1/forecast?latitude=$lat&longitude=$lon&current_weather=true";

    // Fetch API response
    $response = file_get_contents($url);

    // Convert JSON to PHP array
    $data = json_decode($response, true);

    // Extract temperature
    $temp = $data['current_weather']['temperature'];

    echo "<h4>Weather Report:</h4>";
    echo "<h5>Current temperature: Manila " . $temp . "°C</h5>";
    ?>

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
            <span>Manila<br>Tundo</span>
            <span>March 13</span>
        </div>

        <span class="temp"><?php echo $temp; ?></span>

        <div class="temp-scale">
            <span>Celcius</span>
        </div>
    </div>



    <?php
    $url = "https://catfact.ninja/fact";

    // Fetch API response
    $response = file_get_contents($url);

    // Convert JSON to PHP array
    $data = json_decode($response, true);

    // Display random cat fact
    // echo "Cat Fact: " . $data['fact'];
    ?>

    <!-- // reload for cat fact -->
    <!-- // display cat fact -->
    <div class="cardCat">
        <div class="card-content">
            <p id="catFact">Cat Fact that you should know</p>
        </div>
    </div>

    <!-- <p id="catFact">Cat Fact that you should know</p> -->
    <button id="catFactButton">Click for Cat Fact</button>

    <script>
        const catFactButton = document.getElementById("catFactButton");
        catFactButton.addEventListener('click', async () => {
            try {
                const response = await fetch("https://catfact.ninja/fact");
                const data = await response.json();
                console.log(data);

                const catFact = data.fact;
                const catFactElement = document.getElementById("catFact");

                // Generate Display and Render the Jokes 
                catFactElement.innerHTML = `Cat Fact: ${catFact}`;

            } catch (error) {
                console.error(error);
            }
        });
    </script>






    <br>
    <a href="../logout.php">Logout</a>


    <script>
        function openUpdateForm(noteId, title, notetype, comment) {
            document.getElementById("noteId").value = noteId;
            document.getElementById("title").value = title;
            document.getElementById("notetype").value = notetype;
            document.getElementById("comment").value = comment;
            document.getElementById("updateForm").style.display = "block";
        }
    </script>


    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Bootstrap JS (Popper.js and Bootstrap JS) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>

</body>

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
    button {
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

    button:hover {
        transform: translate(-0.05em, -0.05em);
        box-shadow: 0.15em 0.15em;
    }

    button:active {
        transform: translate(0.05em, 0.05em);
        box-shadow: 0.05em 0.05em;
    }
</style>


</html>