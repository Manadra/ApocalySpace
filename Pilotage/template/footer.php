﻿		</div>
	</section>
</main>

<footer>
	<section>
		<div class="row">
			<nav class="large-6 columns center">
				<p>
					<a class="pointer" id="returnTop">Retourner en haut</a> - <a href="https://github.com/JulienBernard/ApocalySpace">Dépôt sur GitHub</a><br />
					Apocalyspace est un projet libre développé par Julien Bernard.
				</p>
			</nav>
			<article class="large-6 columns center">
					<p>
						© Apocalyspace 2012 - 2014<br />
						<a href="#">Contact</a> - <a href="#">Privacy</a> - <a href="./docs/">Version 1.7</a>
					</p>
			</article>
		</div>
	</section>
</footer>

	<!-- Modals -->
	<div id="loginModal" class="small reveal-modal">
		<a class="close-reveal-modal">&#215;</a>
		<h2 class="center">Connexion</h2>
		<p class="secondary center">Déjà un compte sur ApocalySpace. Super, connecte-toi !</p>
		
		<form action="index.php" method="POST">
			<div class="row large-10 collapse">
				<div class="large-2 columns">
					<span class="prefix"><label for="usr"><img src="./img/login.png" width="22" style="margin-top: -4px;" /></label></span>
				</div>
				<div class="large-9 columns">
					<input id="usr" type="text" name="username" placeholder="Nom d'utilisateur" />
				</div>
				<div class="large-1 columns">
					<span class="postfix">*</span>
				</div>
				<div class="large-2 columns">
					<span class="prefix"><label for="pws"><img src="./img/password.png" width="22" style="margin-top: -4px;" /></label></span>
				</div>
				<div class="large-9 columns">
					<input id="pws" type="password" name="password" placeholder="Mot de passe" />
				</div>
				<div class="large-1 columns">
					<span class="postfix">*</span>
				</div>
				<div class="large-12 columns">
					<p class="smaller secondary center">
						Impossible de retrouver ton mot de passe ? <a href="">Pas de panique !</a>
					</p>
					<input class="large-12 button" type="submit" name="login" value="Se connecter" />
					<a class="smaller pointer" data-reveal-id="registerModal">Pas de compte ? Je m'inscris !</a>
					<p class="smaller right">* Informations requises</p>
				</div>
			</div>
		</form>
	</div>
	
	<div id="registerModal" class="small reveal-modal">
		<a class="close-reveal-modal">&#215;</a>
		<h2 class="center">Inscription</h2>
		<p class="secondary center">Imaginer votre propre empire en moins d'une minute !</p>

		<form action="index.php" method="POST">
			<div class="row large-10 collapse">
				<div class="large-2 columns">
					<span class="prefix"><label for="username"><img src="./img/login.png" width="22" style="margin-top: -4px;" /></label></span>
				</div>
				<div class="large-9 columns">
					<input id="username" type="text" name="username" placeholder="Nom d'utilisateur" />
				</div>
				<div class="large-1 columns">
					<span class="postfix">*</span>
				</div>
				<div class="large-2 columns">
					<span class="prefix"><label for="password"><img src="./img/password.png" width="22" style="margin-top: -4px;" /></label></span>
				</div>
				<div class="large-9 columns">
					<input id="password" type="password" name="password" placeholder="Mot de passe" />
				</div>
				<div class="large-1 columns">
					<span class="postfix">*</span>
				</div>
				<div class="large-2 columns">
					<span class="prefix"><label for="empire"><img src="./img/empire.png" width="24" style="margin-top: -4px;" /></label></span>
				</div>
				<div class="large-9 columns">
					<input id="empire" type="text" name="empire" placeholder="Nom de votre empire" />
				</div>
				<div class="large-1 columns">
					<span class="postfix">*</span>
				</div>
				<div class="large-12 center">
					<span class="small button" id="fI">Impériaux</span>
					<span class="small button" id="fV">Vagabonds</span>
					<span class="small button" id="fR">Républicains</span>
				</div>
				<div class="large-12 columns">
					<p class="smaller secondary center">
						Besoin d'aide ? <a href="galerie.php">Visite la galerie</a>, <a href="">lis la FAQ</a> ou <a href="histoire.php">savoure l'histoire du jeu</a> !
					</p>
					<input type="hidden" id="faction" name="faction" value="vagabonds" />
					<input class="large-12 success button" type="submit" name="subscribe" value="Commencer l'aventure !" />
					<a class="smaller pointer" data-reveal-id="loginModal">J'ai déjà un compte. Je me connecte !</a>
					<p class="smaller right">* Informations requises</p>
				</div>
			</div>
		</form>
	</div>

	<!--
		Script de Foundation 4.
		Foundation 4 script.
	-->
	<script>
		document.write('<script src=' +
		('__proto__' in {} ? 'js/vendor/zepto' : 'js/vendor/jquery') +
		'.js><\/script>')
	</script>
	
	<script src="js/foundation.min.js"></script>
	<script src="js/foundation/foundation.orbit.js"></script>
	
	<script>
		$(function(){
			$(document).foundation();    
		})
		
		// JQuery Script: return to the top of the page with a animation
		$(document).ready( function () {
			$('#returnTop').click(function() {
				$('html,body').animate({scrollTop: $("#main").offset().top}, 'slow');
			});
			
			/* Provisoire */
			$('#fI').click(function() {
				$('#faction').val('imp');
				$('#fI').css("background","#2980b9");
				$('#fV').css("background","#46B8EA");
				$('#fR').css("background","#46B8EA");
			});
			$('#fV').click(function() {
				$('#faction').val('vag');
				$('#fI').css("background","#46B8EA");
				$('#fV').css("background","#2980b9");
				$('#fR').css("background","#46B8EA");
			});
			$('#fR').click(function() {
				$('#faction').val('rep');
				$('#fI').css("background","#46B8EA");
				$('#fV').css("background","#46B8EA");
				$('#fR').css("background","#2980b9");
			});
		})
								
		/*window.onload = function(){
			setInterval("displayServerTime()", 1000);
		}
		var ctime = '<?php echo date( "F d, Y H:i:s", time() ); ?>';
		var sdate = new Date(ctime);*/
	</script>
</body>
</html>
