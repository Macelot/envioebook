<?php   
header("Access-Control-Allow-Origin: *");
error_reporting(E_ALL);

//token_ 
//nome__ 
//email__ 
if(isset($_POST['token_'])){ 
//echo "token ok";
	$token=$_POST['token_'];
	if($token=="xxx"){
		//echo "certo";
		// Inclui o arquivo class.phpmailer.php localizado na mesma pasta do arquivo php 
		include "PHPMailer-master/PHPMailerAutoload.php"; 
 		
 		//echo "<br>inserido";
 		
		// Inicia a classe PHPMailer 
		$mail = new PHPMailer(); 
 
		// Método de envio 
		$mail->IsSMTP(); 
 
		// Enviar por SMTP 
		//$mail->Host = "208.91.199.225";
		
 
		// Você pode alterar este parametro para o endereço de SMTP do seu provedor 
		//$mail->Port = 25; 
		$mail->Host = 'tls://smtp.pagina.com:587';
 
		// Usar autenticação SMTP (obrigatório) 
		$mail->SMTPAuth = true; 
		
		$mail->SMTPSecure = false;
 
		// Usuário do servidor SMTP (endereço de email) 
		// obs: Use a mesma senha da sua conta de email 
		$mail->Username = 'fulano@pagina.com'; 
		$mail->Password = 'password'; 
 
		// Configurações de compatibilidade para autenticação em TLS 
		$mail->SMTPOptions = array( 'ssl' => array( 'verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true ) ); 
 
		// Você pode habilitar esta opção caso tenha problemas. Assim pode identificar mensagens de erro. 
		// $mail->SMTPDebug = 2; 
 
		// Define o remetente 
		// Seu e-mail 
		$mail->From = "fulano@pagina.com"; 
 
		// Seu nome 
		$mail->FromName = "Fulano Teste"; 
 
		// Define o(s) destinatário(s) 		
		$email__ = filter_input(INPUT_POST, 'email__',FILTER_SANITIZE_STRING);
		$mail->AddAddress($email__, 'Contato'); 
		
 
		// Opcional: mais de um destinatário
		// $mail->AddAddress('ciclano@email.com'); 
 
		// Opcionais: CC e BCC
		// $mail->AddCC('beltrano@provedor.com', 'Beltrano'); 
		// $mail->AddBCC('ultrano@gmail.com', 'Ultrano'); 
 
		// Definir se o e-mail é em formato HTML ou texto plano 
		// Formato HTML . Use "false" para enviar em formato texto simples ou "true" para HTML.
		$mail->IsHTML(true); 
 
		// Charset (opcional) 
		$mail->CharSet = 'UTF-8'; 
 
		// Assunto da mensagem 
		//$assunto = filter_input(INPUT_POST, 'assunto_',FILTER_SANITIZE_STRING);
		
		$assunto = "Ebook ";
	
		$mail->Subject = $assunto; 
 
		// Corpo do email 
		//$corpo = filter_input(INPUT_POST, 'corpo_',FILTER_SANITIZE_STRING);
		
		$nome__ = filter_input(INPUT_POST, 'nome__',FILTER_SANITIZE_STRING);
		
		$nomehtml = mb_convert_case($nome__,MB_CASE_TITLE);
		
		$corpo = "<div  style='max-width:600px;font-family:Calibri,Times,sans-serif;font-size:16px'>";
		
		$corpo = $corpo."<p><span style='font-size:16px'>Olá <strong>".$nomehtml."</strong>.</span></p>";
		$corpo = $corpo."<p><span style='font-size:16px'>Tudo bem contigo?<br>Estou lhe enviando o material que solicitou sobre ....</span></p>";
		
		$corpo = $corpo."<br><span><p>Atenciosamente,</span></p>";
		
		$corpo = $corpo."<table><tr><td><img src='http://www.pagina.com/avatar.png' width='75px'></td>";
		$corpo = $corpo."<td>Fulano</td></tr></table>";	
			
		$mail->Body = $corpo; 
 
		// Opcional: Anexos 
		$mail->AddAttachment("/home/user/docs/ebook.pdf", "ebookquimica.pdf"); 
 
		// Envia o e-mail 
		$enviado = $mail->Send(); 
		
		//armazena email e nome em arquivo txt mno servidor
		$file=fopen("./ebook.txt","a");	
		$nomemail = $nome__.";".$email__.";".date("d/m/Y H:i:s").PHP_EOL;
		fwrite($file, $nomemail);
		fclose($file);
		
	}
	if ($enviado) { 
		echo "O Ebook foi enviado ao seu email."; 
	} else { 
		echo "Houve um erro no envio do email: ".$mail->ErrorInfo; 
	} 
}else{
	die();
}
 
?>
