<?php



    // Only process POST reqeusts.

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        // Get the form fields and remove MORALspace.

        // NAME

        if(isset($_POST["name"])){
            $name = trim($_POST["name"]);
        }else{
            $name = "hi";
        }

        // EMAIL
        $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);

        // IF LAST NAME SET
        if(isset($_POST["l_name"])){
            $name_2 = trim($_POST["l_name"]);
        }else{
            $name_2 = "hi";
        }

        // IF SUBJECT SET
        if(isset($_POST["subject"])){
            $subject = trim($_POST["subject"]);
        }else{
            $subject = "hi";
        }

        // IF company SET
        if(isset($_POST["company"])){
            $subject = trim($_POST["company"]);
        }else{
            $subject = "hi";
        }

        // IF PHONE SET
        if(isset($_POST["phone"])){
            $phone = trim($_POST["phone"]);
        }else{
            $phone = "hi";
        }

        // IF MESSAGE SET
        if(isset($_POST["message"])){
            $message = trim($_POST["message"]);
        }else{
            $message = "hi";
        }


        // Check that data was sent to the mailer.

       if ( empty($name) OR empty($message) OR !filter_var($email, FILTER_VALIDATE_EMAIL)) {

            // Set a 400 (bad request) response code and exit.

            http_response_code(400);

            echo "Veuillez remplir le formulaire et réessayer.";

            exit;

        }


// 3. Préparation du destinataire et du sujet
    $recipient = "noel_colin@icloud.com";
    $sender_subject = "Nouveau contact de $name";
    $head = " /// Colin Noël - Portfolio \\\ ";

    // 4. CONSTRUCTION DU CONTENU (Doit être AVANT l'envoi)
    $email_content = "$head\n\n";
    $email_content .= "Nom: $name\n";
    $email_content .= "Email: $email\n";
    $email_content .= "Entreprise: $company\n";
    $email_content .= "Téléphone: $phone\n";
    $email_content .= "RGPD: $checkbox\n\n";
    $email_content .= "Message:\n$message\n";

    // 5. PRÉPARATION DES HEADERS
    $headers = "From: Portfolio <contact@colin-noel.fr>\r\n";
    $headers .= "Reply-To: $email\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8";

        if(isset($_POST["name"])){
            $email_content .= "Name: $name\n";
        }

        
        $email_content .= "Email: $email\n\n";

        // IF SET SUBJECT
        if(isset($_POST["subject"])){
            $email_content .= "Subject: $subject\n\n";
        }

        // IF SET SUBJECT
        if(isset($_POST["company"])){
            $email_content .= "Company: $subject\n\n";
        }

        // IF SET checkbox
        if(isset($_POST["checkbox"])){
            $email_content .= "checkbox: $subject\n\n";
        }

        // IF SET PHONE
        if(isset($_POST["phone"])){
            $email_content .= "Phone: $phone\n\n";
        }

        // IF SET PHONE
        if(isset($_POST["message"])){
            $email_content .= "Message:\n$message\n";
        }


        // Build the email headers.

        if(isset($_POST["name"])){
            $email_headers = "From: $name <$email>";
        }
        



        // Send the email.

        if (mail($recipient, $sender, $email_content, $email_headers)) {

            // Set a 200 (okay) response code.

            http_response_code(200);

            echo "Merci ! Votre message a été envoyé.";

        } else {

            // Set a 500 (internal server error) response code.

            http_response_code(500);

            echo "Oups ! Quelque chose s’est mal passé et nous n’avons pas pu envoyer votre message.";

        }



    } else {

        // Not a POST request, set a 403 (forbidden) response code.

        http_response_code(403);

        echo "Il y avait un problème avec votre soumission, veuillez réessayer.";

    }



?>

