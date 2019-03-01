<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Document</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>
<body>

    <div class="container mt-4">
        <?php if($_SERVER['REQUEST_METHOD'] == 'POST'):?>
            <div class="alert alert-info">Você está enviando a requisição.</div>
            <ul class="list-group">
                <li class="list-group-item">
                    Nome: <?php echo $_POST['name'] ?>
                </li>

                <li class="list-group-item">
                    E-mail: <?php echo $_POST['email'] ?>
                </li>

                <li class="list-group-item">
                    Mensagem: <?php echo $_POST['message'] ?>
                </li>
            </ul>

            <?php
                $apiKey = '';
                $sendgridUrl = 'https://api.sendgrid.com/api/mail.send.json';

                $name = $_POST['name'];
                $email = $_POST['email'];
                $message = $_POST['message'];

                $params = [
                    'to' => 'hudson@grupomindsolutions.com.br',
                    'subject' => 'Contato pelo site grupomindsolutions.com.br',
                    'from' => $email,
                    'text' => "Nome: {$name}, Mensagem: {$message}",
                ];

                $ch = curl_init();

                curl_setopt_array($ch, [
                    CURLOPT_URL => $sendgridUrl,
                    CURLOPT_POST => true,
                    CURLOPT_POSTFIELDS => $params,
                    CURLOPT_RETURNTRANSFER => true,
                    CURLOPT_HTTPHEADER => [
                        "Authorization: Bearer {$apiKey}"
                    ],
                ]);

                $results = curl_exec($ch);
            ?>

            <div class="alert alert-info mt-1"><?php echo $results ?></div>

            <a class="btn btn-info mt-3 float-right" href="/">Voltar</a>
        <?php else: ?>
        <h1 class="display-3">Contato</h1>

        <form method="POST">
            <div class="form-group">
                <input type="text" name="name" placeholder="Nome" class="form-control">
            </div>
            <div class="form-group">
                <input type="text" name="email" placeholder="E-mail" class="form-control">
            </div>
            <div class="form-group">
                <textarea name="message" id="" cols="30" rows="10" placeholder="Mensagem" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="submit" value="Enviar" class="btn btn-primary form-control">
            </div>
        </form>

        <?php endif; ?>
    </div>
</body>
</html>
