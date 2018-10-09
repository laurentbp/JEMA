<div id="contact" class="rubrique contact-container">
	<h2><span class="big-letter">N</span>ous contacter</h2>
	<h3>Une question ? Envoyez-nous un mail !</h3>
	<?php

	   $nom     = (isset($_POST['nom']))     ? Rec($_POST['nom'])     : '';
	   $email   = (isset($_POST['email']))   ? Rec($_POST['email'])   : '';

	   if (!preg_match("#^[a-z0-9._-]+@(hotmail|live|msn).[a-z]{2,4}$#", $email)) // On filtre les serveurs qui rencontrent des bogues.
	   {
	     $passage_ligne = "\r\n";
	   }
	   else
	   {
	     $passage_ligne = "\n";
	   }

	   $objet   = (isset($_POST['objet']))   ? Rec($_POST['objet'])   : '';
	   $message_content = (isset($_POST['message'])) ? Rec($_POST['message']) : '';
	   $email_confirm = (isset($_POST['email_confirm'])) ? Rec($_POST['email_confirm']) : '';
	   $message = 'Sender : '.$email.$passage_ligne;
	   $message .= 'Name : '.$nom.$passage_ligne;
	   $message .= 'Message : '.$message_content.$passage_ligne;

	   $err_nom=0;
	   $err_email=0;
	   $err_message=0;
	   $err_email_valide=0;
	   $err_email_confirm = 0;
	   $err_formulaire = false; // sert pour remplir le formulaire en cas d'erreur si besoin

	   if (isset($_POST['contact']))
	   {
	     // Si toutes les conditions du formulaire sont réunies (variables non vides, email valide et confirmation de l'email valide)...
	     if (($nom != '') && ($email != '') && ($message != '') && (IsEmail($email) != false) && ($email === $email_confirm))
	     {
	       // les 4 variables sont remplies, on génère puis envoie le mail
	       $headers  = 'From:'.$nom.' <noreply@laurentblancpattin.com>' . "\r\n";
	       $headers .= 'Reply-To: '.$email. "\r\n" ;
	       //$headers .= 'X-Mailer:PHP/'.phpversion();

	       // Remplacement de certains caractères spéciaux
	       $message = str_replace("&#039;","'",$message);
	       $message = str_replace("&#8217;","'",$message);
	       $message = str_replace("&quot;",'"',$message);
	       $message = str_replace('&lt;br&gt;','',$message);
	       $message = str_replace('&lt;br /&gt;','',$message);
	       $message = str_replace("&lt;","&lt;",$message);
	       $message = str_replace("&gt;","&gt;",$message);
	       $message = str_replace("&amp;","&",$message);

	       // Envoi du mail
	       if (mail($destinataire, $objet, $message, $headers)){
				echo '<body onLoad="alert(\'Message bien envoyé\')">';
	       }
	       else{
				echo '<body onLoad="alert(\'Envoi du message échoué, veuillez réessayer svp.\')">';
	       };
	     }
	     else
	     {
	       // toutes les conditions ne sont pas réunies...
	       if($nom == '') $err_nom=1;
	       if($email == '') $err_email=1;
	       if($message == '') $err_message=1;
	       if(IsEmail($email) == false) $err_email_valide=1;
	       if($email!=$email_confirm) $err_email_confirm=1;
	       $err_formulaire=true;
	     };
	   }; // fin du if (!isset($_POST['envoi']))

	  echo '
	    <div class="contact">
	      <form method="post" action="student.php#contact">
	           <fieldset>';
	             if($err_nom==0){
	               echo '<div class="form-group">
	                 <label for="nom">Nom* :</label>
	                 <input class="form-control" type="text" id="nom" name="nom" placeholder="Votre nom" value="'.stripslashes($nom).'" tabindex="1" />
	               </div>';
	             }
	             else{
	               echo '<div class="form-group has-warning">
	                 <label for="nom">Nom* :</label>
	                 <input class="form-control" type="text" id="nom" name="nom" placeholder="Votre nom" value="'.stripslashes($nom).'" tabindex="1" />
	                 <span class="help-block">Veuillez remplir ce champ</span>
	               </div>';
	             };
	             if($err_email==0 && $err_email_valide==0){
	               echo '<div class="form-group">
	                 <label for="email">Adresse mail* :</label>
	                 <input class="form-control" type="text" id="email" name="email" placeholder="Votre adresse mail" value="'.stripslashes($email).'" tabindex="2" />
	               </div>';
	             }
	             elseif($err_email==1){
	               echo '<div class="form-group has-warning">
	                 <label for="email">Adresse mail* :</label>
	                 <input class="form-control" type="text" id="email" name="email" placeholder="Votre adresse mail" value="'.stripslashes($email).'" tabindex="2" />
	                 <span class="help-block">Veuillez remplir ce champ</span>
	               </div>';
	             }
	             else{
	               echo '<div class="form-group has-error">
	                 <label for="email">Adresse mail* :</label>
	                 <input class="form-control" type="text" id="email" name="email" placeholder="Votre adresse mail" value="'.stripslashes($email).'" tabindex="2" />
	                 <span class="help-block">L\'adresse doit suivre le format suivant : "email@exemple.com"</span>
	               </div>';
	             };
	             if($err_email_confirm==0){
	               echo '<div class="form-group">
	                 <label for="email_confirm">Confirmez votre adresse mail* :</label>
	                 <input class="form-control" type="text" id="email_confirm" name="email_confirm" placeholder="Confirmez votre adresse mail" value="'.stripslashes($email_confirm).'" tabindex="3" />
	               </div>';
	             }
	             else{
	               echo '<div class="form-group has-error">
	                 <label for="email_confirm">Confirmez votre adresse mail* :</label>
	                 <input class="form-control" type="text" id="email_confirm" name="email_confirm" placeholder="Confirmez votre adresse mail" value="'.stripslashes($email_confirm).'" tabindex="3" />
	                 <span class="help-block">Les adresse mail ne correspondent pas</span>
	               </div>';
	             };
	               echo '<div class="form-group">
	                 <label for="objet">Objet de votre message :</label>
	                 <input class="form-control" type="text" id="objet" name="objet" placeholder="Objet du message" value="'.stripslashes($objet).'" tabindex="4" />
	               </div>';
	             
	             if($err_message==0){
	               echo '<div class="form-group">
	                 <label for="textarea">Votre message* :</label>
	                 <textarea id="message" name="message" class="form-control" rows="4">'.stripslashes($message_content).'</textarea>
	                 <p class="help-block">Vous pouvez agrandir cette fenêtre</p>
	               </div>';
	             }
	             else{
	               echo '<div class="form-group has-warning">
	                 <label for="textarea">Votre message* :</label>
	                 <textarea id="message" name="message" class="form-control" rows="4">'.stripslashes($message_content).'</textarea>
	                 <span class="help-block">Veuillez remplir ce champ</span>
	                 <p class="help-block">Vous pouvez agrandir cette fenêtre</p>
	               </div>';
	             };
	             ?>
	             <button class="btn btn-md btn-default submit_form" name="contact" type="submit">Envoyer</button>
	           </fieldset>
	         </form>
	    </div>	
</div>