<?php
session_start();
include "database.php";

if (!isset($_SESSION["id"]) || !isset($_SESSION["username"]) || !isset($_SESSION["email"])) {
    header("Location: login.php");
    exit();
}

if (isset($_GET['id'])) {
    $user_id = $_GET['id'];
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($conn, $query);

    if (!$result) {
        die("Query failed: " . mysqli_error($conn));
    }

    $user_data = mysqli_fetch_assoc($result);
} else {
    header("Location: kullaniciliste.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    function validate($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }

    $update_username = validate($_POST["update_username"]);
    $update_email = validate($_POST["update_email"]);
    $update_password = validate($_POST["update_password"]);
    $update_re_password = validate($_POST["update_re_password"]);

    if (empty($update_username) || empty($update_email) || empty($update_password) || empty($update_re_password)) {
        $error = "empty_fields";
    } elseif ($update_password != $update_re_password) {
        $error = "passwords_not_matched";
    } else {
        $update_password = md5($update_password);

        $update_query = "UPDATE users SET username = '$update_username', email = '$update_email', password = '$update_password' WHERE id = '$user_id'";
        $update_result = mysqli_query($conn, $update_query);

        if ($update_result) {
            $_SESSION["username"] = $update_username;
            $_SESSION["email"] = $update_email;

            header("Location: kullaniciliste.php");
            exit();
        } else {
            $error = "update_failed";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil</title>
    <link rel="stylesheet" type="text/css" href="./css/signup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.1/css/all.min.css" integrity="sha512-MV7K8+y+gLIBoVD59lQIYicR65iaqukzvf/nwasF0nqhPay5w/9lJmVM2hMDcnK1OnMGCdVK+iQrJ7lzPJQd1w==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;500;600&display=swap" rel="stylesheet">
</head>

<body>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) . '?id=' . $user_id; ?>" method="POST">
        <h3>Profil Güncelle</h3>
        <?php if (isset($error) && !empty($error)) { ?>
            <div class="error"><?php echo $error; ?></div>
        <?php } ?>
        <label for="update_username">Kullanıcı Adı</label>
        <input type="text" name="update_username" placeholder="Kullanıcı Adı" value="<?php echo $user_data['username']; ?>" required>
        <label for="update_email">Email</label>
        <input type="email" name="update_email" placeholder="Email" value="<?php echo $user_data['email']; ?>" required>
        <label for="update_password">Şifre</label>
        <input type="password" name="update_password" placeholder="Şifre" required>
        <label for="update_re_password">Şifre Tekrar</label>
        <input type="password" name="update_re_password" placeholder="Şifre Tekrar" required>
        <button>Güncelle</button>
    </form>
</body>

</html>
