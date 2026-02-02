<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // 1. RECUPERATION DES DONNEES
    $name = !empty($_POST["name"]) ? trim($_POST["name"]) : "hi";
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $company = !empty($_POST["company"]) ? trim($_POST["company"]) : "Non précisée";
    $phone = !empty($_POST["phone"]) ? trim($_POST["phone"]) : "Non précisé";
    $message = !empty($_POST["message"]) ? trim($_POST["message"]) : "hi";
    $checkbox = isset($_POST["checkbox"]) ? "Accepté" : "Non coché";

    // 2. VALIDATION (Pour éviter l'erreur 400)
    if (empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        http_response_code(400);
        echo "Veuillez remplir le formulaire et réessayer.";
        exit;
    }

    // 3. PREPARATION DU DESTINATAIRE ET SUJET
    $recipient = "noel_colin@icloud.com";
    $subject_mail = "Nouveau contact de $name";
    $head = " /// Colin Noël - Portfolio \\\ ";

    // 4. CONSTRUCTION DU CONTENU (Une seule fois, proprement)
    $email_content = "$head\n\n";
    $email_content .= "Nom: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Entreprise: $company\n";
    $email_content .= "Téléphone: $phone\n";
    $email_content .= "RGPD: $checkbox\n\n";
    $email_content .= "Message:\n$message\n";

    // 5. PREPARATION DES HEADERS (Crucial pour l'erreur 500)
    $headers = "From: Portfolio <contact@colin-noel.fr>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

    // 6. ENVOI FINAL
    if (mail($recipient, $subject_mail, $email_content, $headers)) {
        http_response_code(200);
        echo "Merci ! Votre message a été envoyé.";
    } else {
        http_response_code(500);
        echo "Oups ! Une erreur technique empêche l'envoi de l'email.";
    }

} else {
    http_response_code(403);
    echo "Il y avait un problème avec votre soumission, veuillez réessayer.";
}
?> 