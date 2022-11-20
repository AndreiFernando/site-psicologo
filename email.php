<?php
$prefixoAssunto = '[Contato dúvidas]'; // Para exibição no título da mensagem
$destinatario = '<andrei.cfernando@gmail.com>'; // Coloque o e-mail de destino da mensagem entre < e >

// Pegue e trate os dados preenchidos no formulário
$nome    = stripslashes(trim($_POST['nome']));
$email   = stripslashes(trim($_POST['email']));
//$telefone   = stripslashes(trim($_POST['telefone']));
//$assunto = stripslashes(trim($_POST['assunto']));
$mensagem = stripslashes(trim($_POST['mensagem']));

// Parâmetros para o formato padrão de e-mail (NÃO ALTERE!)
$padrao  = '/[\r\n]|Content-Type:|Bcc:|Cc:/i'; 

// Verificação de segurança contra código malicioso (NÃO ALTERE!)
if (preg_match($padrao, $nome) || preg_match($padrao, $email)) {
    die("Injeção de código no header detectada!");
} //|| preg_match($padrao, $assunto)) ******obs o assunto estava dentro do () acima

// Validação de endereços de e-mail válidos (NÃO ALTERE!)
$emailValido = preg_match('/^[^0-9][A-z0-9._%+-]+([.][A-z0-9_]+)*[@][A-z0-9_]+([.][A-z0-9_]+)*[.][A-z]{2,4}$/', $email);

// Se todos os campos estiverem preenchidos corretamente... //*******&& $emailValido && $telefone && $assunto - estava dentro do () abaixo
if($nome && $email && $mensagem){
    // Monte o assunto e o corpo da mensagem
    $assunto = "$prefixoAssunto $assunto";
    $corpo = "Nome: ".$nome. "<br /> Email: ".$email. "<br /> Telefone: " .$telefone. " Mensagem: ". nl2br($mensagem);

    // Monte o cabeçalho da mensagem (NÃO ALTERE!)
    $headers  = 'MIME-Version: 1.1' . PHP_EOL;
    $headers .= 'Content-type: text/html; charset=utf-8' . PHP_EOL;
    $headers .= "From: $nome <$email>" . PHP_EOL;
    $headers .= "Return-Path: $destinatario" . PHP_EOL;
    $headers .= "Reply-To: $email" . PHP_EOL;
    $headers .= "X-Mailer: PHP/". phpversion() . PHP_EOL;

    // Envie a mensagem para o destinatario junto com o assunto, corpo e cabeçalho
    mail($destinatario, $assunto, $corpo, $headers);

    // Indique que o envio da mensagem deu certo (emailEnviado valendo true)
    $emailEnviado = true;
} else {
    // Caso contrário, indique que houve erro (deuErro valendo true)
    $deuErro = true;
}

// Se emailEnviado existe e for TRUE...
if(isset($emailEnviado) && $emailEnviado){ 
    echo "<p>Sua mensagem foi enviada com sucesso.</p>";
    echo "<p><a href=\"index.html\">Voltar para o site</a></p>";
} else {
    // Senão, se deuErro existe e for TRUE...
    if(isset($deuErro) && $deuErro){ 
        echo "<p>Houve um erro no envio, tente novamente mais tarde.</p>";
        echo "<p><a href=\"index.html\">Voltar para o site</a></p>";
    } 
}
?> 