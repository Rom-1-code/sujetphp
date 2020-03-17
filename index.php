<?php session_start() ?>
<?php require("user.php") ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sujet PHP</title>
</head>

<body>
    <?php
    try {
        $Base = new PDO('mysql:host=localhost; dbname=sujetphp; charset=utf8', 'root', 'root');
        $AfficherUser = $Base->query('SELECT * From user');
    } catch (Exception $e) {
        echo "Erreur ";
    }

    while ($afficher = $AfficherUser->fetch()) {
    ?>
        <table border=1>
            <tr>
                <td>
                    <?php echo $afficher['Login']; ?>
                </td>
                <td>
                    <?php echo $afficher['Mdp']; ?>
                </td>
            </tr>
        </table>
    <?php
    }
    ?>
    <?php
    if (!isset($_SESSION['Login'])) {
    ?>
        <h1>Connexion</h1>
        <form action="index.php" method="POST">
            <label>Login</label>
            <input type="text" name="Login">
            <p></p>
            <label>Password</label>
            <input type="password" name="Mdp">
            <p></p>
            <input type="submit">
            <input type="submit" name="deconnexion" value="Deconnexion">
        </form>
    <?php
    }
    ?>
    <?php //PHP pour la connection
    try {
        $Base = new PDO('mysql:host=localhost; dbname=sujetphp; charset=utf8', 'root', 'root');
    } catch (Exception $e) {
        echo "Erreur ";
    }

    if (isset($_POST['Login']) && isset($_POST['Mdp'])) {
        $LoginConnect = $_POST['Login'];
        $MdpConnect = $_POST['Mdp'];
        $requser = $Base->prepare("SELECT * FROM user WHERE `Login` = ? AND Mdp = ?");
        $requser->execute(array($LoginConnect, $MdpConnect));
        $Loginexist = $requser->rowCount();
        if ($Loginexist == 1) {
            $Logininfo = $requser->fetch();
            $_SESSION['Login'] = $Logininfo['Login'];
            echo "<p> Vous être connecté en tant que " . $Logininfo['Login'] . ". </p>";
        } else{
            echo "<p>Identifiant ou mot de passe incorrect !</p>";
        }
    }
    
        if (!isset($_POST['deconnexion'])) {
            session_destroy();
        } else {
            echo "Au revoir";
        }
    
    ?>


</body>

</html>