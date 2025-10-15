<?php
include __DIR__ . '/../env.php';
$titulo = "Generar Contraseña";
include "template/header.php";
include "template/menu.php";
?>

<div class="texto">
    <h1>Generador de constraseñas</h1>

    <form method="POST">
        <label>Introduce la longitud deseada:</label>
        <input type="number" name="length" id="length" value="12" min="4" max="64">
        <button type="submit">Generar</button>
    </form>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $length = (int)($_POST['length'] ?? 12);
        $chars = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_+-=';
        $password = '';
        $maxIndex = strlen($chars) - 1;

        for ($i = 0; $i < $length; $i++) {
            $password .= $chars[random_int(0, $maxIndex)];
        }

        echo '<p><strong>Contraseña generada:</strong> ' . htmlspecialchars($password) . '</p>';
    }
    ?>
</div>

<?php
include "template/footer.php";
