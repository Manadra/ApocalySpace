<?php
		
	$activeSub = true;
	$activeLog = true;

	if( isset($_POST['subscribe']) )
	{
		echo "<script>$('html,body').animate({scrollTop: $('#links').offset().top}, 'slow');</script>";

		$fields = array('username' => $_POST['username'], 'password' => $_POST['password'], 'faction' => $_POST['faction']);
		$return = $Engine->checkParams( $fields );
		
		/* Champs valides */
		if( $return == 1 && $activeSub )
		{
			include_once(PATH_MODELS."myPDO.class.php");
			include_once(PATH_MODELS."user.class.php");
			
			$username = (String)htmlspecialchars(strtolower($_POST['username']));
			$password = (String)htmlspecialchars($_POST['password']);
			$faction = (String)htmlspecialchars(strtolower($_POST['faction']));
			
			/* Cet username n'est pas déjà attribué à un autre joueur. */
			if( User::checkUsernameExist( $username ) > 0 )
			{
				/* Cet username est supérieur à 4 caractères et inférieur à 20. */
				if( User::checkUsernameLength( $username ) )
				{
					/* Ce password est supérieur à 6 caractères. */
					if( User::checkPasswordLength( $password ) )
					{
						/* Inscription valide : enregistrement de l'utilisateur dans la base de donnée ! */
						$result = User::addUser( $username, $password, $faction );
						
						/* Echec ! */
						if( $result == 0 )
							$Engine->setError("Une erreur est survenue lors de l'ajout de votre compte dans notre base de données.<br />Merci de bien vouloir recommencer ou de contacter l'équipe si le problème persiste.");
						/* Succès  */
						else
						{
							$userId = (int)$result;
							
							/* Insertion des données utilisateurs */
							$result = User::addDataForUser( $userId );
							
							if( $result == 0)
								$Engine->setError("Une erreur est survenue lors de l'ajout des données de votre compte dans notre base de données.<br />Merci de bien vouloir contacter l'équipe et signaler cette erreur !");
							else
							{
								include_once(PATH_MODELS."planet.class.php");
								include_once(PATH_MODELS."map.class.php");
								/* Ajout de la planète dans la base de donnée en tant que planète primaire du joueur. */
								$result = Planet::addPlanet( $userId, $faction, 1 );
								
								if( $result == 0 )
									$Engine->setError("Une erreur est survenue lors de la création de votre planète.<br />Merci de bien vouloir contacter l'équipe et signaler cette erreur !");
								else
								{
									include_once("config_id.php");
									$planetId = (int)$result;
									/* Ajout des informations de base pour la planète. */
									$result = Planet::initializePlanet( $planetId );
									
									if( $result )
									{
										include_once(PATH_MODELS."communication.class.php");
										$subject = "Bonjour commandant !";
										$message = "Commandant ".$username.",
										
										Bonjour et bienvenu dans vos nouveaux quartiers, j'espère qu'ils vous conviendront.
										
										Nous avons très peu de choses à notre disposition mais l'équipage et moi-même avons foi en vous commandant. Oui, notre peuple va enfin pouvoir revivre !
										
										Certains de nos camarades on d'ors et déjà commencer à installer notre camp.										
										
										Bien des années ont passé mon commandant. Si vous avez besoin de conseils n'hésitez pas à cliquer sur le bouton symbolisant un '?' qui se trouve en dessous de l'heure sur la droite !										
										
										Bonne chance !
										
										Votre conseiller, Jibi.";
										
										Communication::addCommunications( $message, $subject, "", $userId, 1);
									
										/* Message de confirmation */
										$Engine->setSuccess("Votre inscription a été validée.");
										$Engine->setInfo("Bonjour <span class='italic'>commandant ".ucfirst ($username)."</span> !<br />Identifiez-vous pour votre première connexion.");
									}
									else
										$Engine->setError("Une erreur est survenue lors de l'initialisation de votre planète. Merci de bien vouloir contacter l'équipe et signaler cette erreur !");
								}
							}
						}
					}
					else
						$Engine->setError("Votre MOT DE PASSE doit être supérieur à 6 caractères.");
				}
				else
					$Engine->setError("Votre PSEUDONYME doit être supérieur à 4 caractères et être inférieur à 20 caractères.");
			}
			else
				$Engine->setError("Ce PSEUDONYME existe déjà. Veuillez en choisir un autre.");

		}
		/* Inscription désativée */
		else if( !$activeSub )
			$Engine->setInfo("L'inscription est momentanément désactivée. Revenez plus tard !");
		/* Champs invalides */
		else
		{
			$str = "Certains champs sont vides. Vérifier les champs suivants :<br />";
			if( $return['username'] == 0 )
				$str = $str."PSEUDONYME, ";
			if( $return['password'] == 0 )
				$str = $str."MOT DE PASSE";
			if( $return['faction'] == 0 )
				$str = $str."FACTION";
			$Engine->setError($str);
		}
	}
	else if( isset($_POST['signin']) )
	{
		echo "<script>$('html,body').animate({scrollTop: $('#links').offset().top}, 'slow');</script>";

		$fields = array('username' => $_POST['username'], 'password' => $_POST['password']);
		$return = $Engine->checkParams( $fields );
		
		/* Champs valides */
		if( $return == 1 && $activeLog )
		{
			include_once(PATH_MODELS."myPDO.class.php");
			include_once(PATH_MODELS."user.class.php");
			include_once(PATH_MODELS."planet.class.php");
			
			$username = (String)htmlspecialchars(strtolower($_POST['username']));
			$password = (String)htmlspecialchars($_POST['password']);
			$faction = (String)null;			
			
			/* Cet username n'est pas déjà attribué à un autre joueur. */
			if( User::checkUsernameExist( $username ) )
			{
				/* Check des tailles (vérifications) */
				if( User::checkUsernameLength( $username ) && User::checkPasswordLength( $password ))
				{
					/* Check si le compte existe (correspondances du pseudo/mdp) */
					if( $userId = User::checkUserAccountMatch( $username, $password ) )
					{
						/* Destruction de la session au cas où ! */
						$Engine->destroySession("SpaceEngineConnected");
						$Engine->destroySession("ApocalySpaceCurrentPlanet");
						/* Enregistrement de l'ID dans une session. */
						$Engine->createSession("ApocalySpaceCurrentPlanet", (int)Planet::getUserPrimaryPlanet($userId) );
						$Engine->createSession("SpaceEngineConnected", (int)$userId);
						
						$Engine->setSuccess("<span class='bold'>Connexion réussie.</span><br /><a href='index.connect.php'>Si la redirection ne se fait pas, cliquez ici</a> !");
					}
					else
						$Engine->setError("Votre PSEUDONYME ou votre MOT DE PASSE ne correspondent pas.");
				}
				else
					$Engine->setError("Votre PSEUDONYME doit être supérieur à 4 caractères et être inférieur à 20 caractères.<br />Votre MOT DE PASSE doit être supérieur à 6 caractères.");
			}
			else
				$Engine->setError("Ce PSEUDONYME n'existe pas dans notre base de données.");
		}
		/* Connexion désativée */
		else if( !$activeLog )
			$Engine->setInfo("La connexion est momentanément désactivée. Revenez plus tard !");
		/* Champs invalides */
		else
		{
			$str = "Certains champs sont vides. Vérifier les champs suivants :<br />";
			if( $return['username'] == 0 )
				$str = $str."PSEUDONYME, ";
			if( $return['password'] == 0 )
				$str = $str."MOT DE PASSE";
			$Engine->setError($str);
		}
	}
	
	/* Inclusion de la vue */
	include_once( $Engine->getViewPath() );