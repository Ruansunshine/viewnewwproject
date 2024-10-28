<?php


if (!isset($_SESSION['idUser'])) {
    // Mostra os dados recebidos via POST para depuração
    echo '<pre>';
    echo "Dados POST recebidos:\n";
    print_r($_POST); // Exibe os dados enviados no formulário
    echo '</pre>';

    header('Location: ../views/users/login.html?mensagem=Você precisa estar logado.');
    exit();
}
?>