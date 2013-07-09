<?php $username = elgg_get_logged_in_user_entity()->username; ?>


<div id="TourMenu" class="hover">
	<div>Sommaire de la visite</div>
	<ul class="hidden pal ggouv-menu-child">
		<li data-tip="1">1. L'interface</li>
		<li data-tip="6">2. Le hub de communication</li>
		<li data-tip="11">3. Communiquer par micro-blogging</li>
		<li data-tip="15">4. Mon profile</li>
		<li data-tip="19">5. Le profile des groupes</li>
		<li data-tip="23">6. Les questions-réponses</li>
		<li data-tip="26">7. Les remue-méninges</li>
		<li data-tip="7">8. Les flux de travail</li>
		<li data-tip="8">9. Les wikis</li>
		<div class="ptm">
			<span id="endTour" class="link mrm"><?php echo elgg_echo('Arrêter la visite'); ?></span>
			<span id="endTourAndReturn" class="link plm"><?php echo elgg_echo("Arrêter et revenir à la page de départ"); ?></span>
		</div>
	</ul>
</div>



<ol id="GgouvTour" class="hidden">
	<li class="big" data-button="1. L'interface">
		<span class="preStep hidden">$('.elgg-menu-item-help').addClass('hover');</span>
		<span class="postStep hidden">$('.elgg-menu-item-help').removeClass('hover');</span>
		<h2>Visite guidée du site</h2>
		<div class="row-fluid">
			<div class="span6" style="font-weight: bold;line-height: 25px;"><p>Vous allez faire le tour des fonctionnalités de ggouv.<br>Vous serez guidé tout le long de la visite.</p><p>Pour commencer, cliquez sur le bouton bleu ci-dessous.</p></div>
			<div class="span6"><p>Le sommaire permet d'atteindre directement différentes parties de la visite.<br/><br/><br/>Vous pouvez appuyer sur la touche <kbd>↲ entrée</kbd> pour aller plus vite.</p></div>
		</div>
		<p>Vous pouvez relancer la visite depuis la bouée en bas à gauche.</p>
	</li>
	<li class="big" data-button="Le logo">
		<span class="inStep hidden">$('.joyride-modal-bg').hide();</span>
		<h2>1. L'interface</h2>
		<p><strong>A gauche :</strong> Le menu vertical<br>C'est le menu principal, il est toujours présent. Il permet d'accéder rapidement à vos contenus, vos groupes, vos paramètres...</p>
		<p><strong>En haut :</strong> Le bandeau bleu<br>C'est depuis ce bandeau que vous pourrez envoyer des messages ou effectuer des recherches. Il tourne sur lui-même à l'aide des flèches haut et bas.</p>
		<p><strong>A droite :</strong> La barre de côté (side bar)<br>Elle change en fonction de la page que vous êtes en train de visiter.<br>Elle peut contenir un menu, des informations supplémentaires sur la page, des raccourcis...</p>
	</li>
	<li data-class="elgg-menu-item-logo" data-options="tipLocation:right" data-button="Vos contenus">
		<span class="preStep hidden">$('.elgg-menu-item-logo').addClass('hover');</span>
		<span class="postStep hidden">$('.elgg-menu-item-logo').removeClass('hover');</span>
		<h2>Le logo</h2>
		<p>Cliquer sur le logo permet de revenir rapidement dans le hub de communication (le hub est expliqué en détail par la suite).</p>
	</li>
	<li data-class="elgg-menu-item-dashboard .ggouv-menu-child-shadow" data-options="tipLocation:right" data-button="Le menu &quot;gitoyens&quot;">
		<span class="preStep hidden">$('.elgg-menu-item-dashboard').addClass('hover');</span>
		<span class="postStep hidden">$('.elgg-menu-item-dashboard').removeClass('hover');</span>
		<h2>Vos contenus</h2>
		<p>Votre tableaux de bord donne une vue d'ensemble de votre activité et de vos publications. Vous pouvez le paramétrer comme vous le souhaitez.</p>
		<p>Vous pouvez accéder directement à vos contenus depuis ce menu. Ils sont classés par type.</p>
	</li>
	<li data-class="elgg-menu-item-at .ggouv-menu-child-shadow" data-options="tipLocation:right" data-button="Les groupes">
		<span class="preStep hidden">$('.elgg-menu-item-at').addClass('hover');</span>
		<span class="postStep hidden">$('.elgg-menu-item-at').removeClass('hover');</span>
		<h2>Le menu "gitoyens"</h2>
		<p>Les membres de ggouv, les "gitoyens", sont représentés par le caractère "@".<br>C'est un peu comme une adresse mail que vous pouvez utiliser de partout pour mentionner quelqu'un.</p>
		<p>Il est possible d'afficher des détails d'une personne en cliquant sur son avatar ou sur sa @mention.</p>
		<p>Cliquez sur "Tous les membres" et trouvez des personnes qui vous intéressent, vous pourrez alors suivre leur activité.</p>
	</li>
	<li data-class="elgg-menu-item-groups .ggouv-menu-child-shadow" data-options="tipLocation:right" data-button="2. Le hub de communication">
		<span class="preStep hidden">$('.elgg-menu-item-groups').addClass('hover');</span>
		<span class="postStep hidden">$('.elgg-menu-item-groups').removeClass('hover');</span>
		<h2>Les groupes</h2>
		<p>Les groupes sont représentés par le caractère "!".<br>Dans ce menu s'afficheront tous les groupes dont vous êtes membres ou que vous avez créés.
		<p>Vous pouvez, comme avec @, mentionner un groupe dans vos écrits avec ! puis le nom du groupe.</p>
	</li>

	<li class="big" data-button="Rafraîchir les colonnes">
		<span class="preStep hidden">
			var origin = elgg.normalize_url(decodeURIComponent(window.location.href)).split("#")[0];
			History.pushState({origin: origin}, null, elgg.get_site_url()+'activity');
		</span>
		<h2>Le hub de communication</h2>
		<p>Le hub est une sorte de tableau de bord. C'est cette page avec tout plein de colonnes.<br>Il permet de visualiser l'activité de vos abonnement, vos mentions, vos groupes... le tout classé en colonne.</p>
		<p>Il est aussi possible d'intégrer les flux provenants d'autres réseaux comme Twitter et Facebook (en cours).</p>
		<p>Le hub est mis en cache dans votre navigateur, ce qui permet de revenir très rapidement dessus.</p>
	</li>
	<li data-class="elgg-refresh-all-button" data-options="tipAdjustmentX:-12;" data-button="Ajouter une colonne">
		<h2>Rafraîchir les colonnes</h2>
		<p>Cliquer sur ce bouton rafraîchit toutes les colonnes et affiche pour chaque colonne le nombre de nouveaux éléments.</p>
		<p>Vous pouvez aussi rafraîchir chaque colonne individuellement.</p>
	</li>
	<li data-class="elgg-add-new-column" data-options="tipAdjustmentX:-21;" data-button="Configurer une colonne">
		<h2>Ajouter une colonne</h2>
		<p>Cliquer sur ce petit plus pour ajouter une colonne.</p>
		<p>Vous pouvez mettre 10 colonnes par onglet. Si vous avez trop de colonnes, vous pouvez ajouter un nouvel onglet en cliquant sur le "+" à droite des onglets.</p>
	</li>
	<li data-class="column-river:first-child .elgg-icon-settings-alt" data-options="tipAdjustmentX:-27;" data-button="Déplacer une colonne">
		<h2>Configurer une colonne</h2>
		<p>Paramétrez individuellement chaque colonne depuis cette icône.</p>
		<p>Vous pouvez complètement changer le type de colonne, ou filtrer la colonne pour n'obtenir que les messages et/ou les idées par exemple...</p>
	</li>
	<li data-class="column-river:first-child .column-header" data-options="tipAdjustmentX:100%;" data-button="3. Communiquer par micro-blogging">
		<h2>Déplacer une colonne</h2>
		<p>Vous pouvez classer les colonnes.</p>
		<p>Pour cela, vous devez attraper la colonne par son en-tête et la déplacer en faisant un "glisser-déposer" où vous le souhaitez.</p>
	</li>

	<li class="big" data-button="Envoyer un message">
		<h2>Communiquer par micro-blogging</h2>
		<p>Le principal mode de communication est ce qu'on appelle du "micro-blogging".</p>
		<p>Ce sont des messages courts (limités à 140 caractères) envoyés à tous vos abonnés ou à quelqu'un en particulier.</p>
	</li>
	<li class="big" data-id="thewire-textarea" data-options="tipLocation:top" data-button="Sélectionner la destination">
		<h2>Envoyer un message</h2>
		<p>Tapez votre message dans ce champ (le "lanceur de message").<br>Les messages que vous envoyez sont vus par tous vos abonnés. Il sont aussi affichés dans votre activité.</p>
		<p>Les messages sont publics, sauf si vous commencez le message en mentionnant quelqu'un avec @ ou un groupe avec !.<br>Le message sera alors semi-public : il ne sera vu que par la personne mentionnée, et par ceux qui viendront voir votre activité.</p>
		<p>Vous pouvez aussi mentionner un !groupe et insérer un #hashtag.<br>Les avatars des gitoyens, des groupes et les hashtags peuvent être pris et déposé dans le lanceur de message par un glissé-déposé.</p>
	</li>
	<li class="big" data-id="thewire-network" data-options="tipLocation:left" data-button="Ajouter un compte">
		<span class="preStep hidden">$('#thewire-network').addClass('extended');</span>
		<h2>Sélectionner la destination</h2>
		<p>Seul votre compte ggouv est sélectionné. Vous pouvez associer d'autres comptes provenant d'autres réseaux sociaux.</p>
		<p>Les comptes sélectionnés pour l'envoi du message sont en haut.<br>Les comptes en bas sont inactifs.</p>
		<p>Pour choisir la destination de vos messages, vous pouvez glisser-déposer les avatars d'en bas à en haut.</p>
		<p>Vous pouvez épingler un compte pour que celui-ci reste toujours en haut.<br>Vous pouvez aussi temporairement désactiver un compte en cliquant dessus.</p>
	</li>
	<li data-class="add_social_network" data-options="tipLocation:top" data-button="4. Mon profile">
		<span class="postStep hidden">$('#thewire-network').removeClass('extended');</span>
		<h2>Ajouter un compte</h2>
		<p>Cliquez ici pour ajouter un compte d'un réseau social.</p>
		<p>Vous pouvez gérer tous vos comptes dans vos paramètres.</p>
	</li>

	<li class="big" data-button="Modifier mon profile">
		<span class="preStep hidden">
			var origin = elgg.normalize_url(decodeURIComponent(window.location.href)).split("#")[0];
			History.pushState({origin: origin}, null, elgg.get_site_url()+'profile/<?php echo $username; ?>');
		</span>
		<h2>Mon profile</h2>
		<p>Votre profile est la page vous concernant. Elle peut être vue par tout le monde.</p>
		<p>Dans un soucis de transparence, et pour vous faire connaître, il est plutôt conseillé de bien remplir cette page.<br>Les droits d'accès sont paramétrables pour toutes les informations que vous publiez sur cette page.</p>
	</li>
	<li data-class="profile-action-menu" data-options="tipLocation:right;" data-button="Ajouter des widgets">
		<h2>Modifier mon profile</h2>
		<p>Cliquez sur ces boutons pour modifier votre profile ou changer votre avatar.</p>
	</li>
	<li data-class="elgg-widget-add-control .elgg-button" data-options="tipLocation:left;tipAdjustmentY:-10px;" data-button="Mon profile en popup">
		<span class="preStep hidden">
			$('.elgg-widget-add-control a').click();
		</span>
		<span class="postStep hidden">
			$('.elgg-widget-add-control a').click();
			$('.net-profile.ggouv:first-child .user-info-popup').click();
		</span>
		<h2>Ajouter des widgets</h2>
		<p>Vous pouvez ajouter des widgets qui se remplieront au fur et à mesure de votre activité sur ggouv.</p>
		<p>Ces widgets ne sont pas affichés dans votre profile en popup. Ils sont paramètrables et vous pouvez régler les droits d'accès.</p>
	</li>
	<li data-id="user-info-popup" data-options="tipLocation:left" data-button="Le profile des groupes">
		<h2>Mon profile en popup</h2>
		<p>Cette popup s'affiche quand quelqu'un clique sur votre avatar ou sur @<?php echo $username; ?>. Vous pouvez faire de même avec les autres.</p>
		<p>En cliquant sur l'avatar dans la popup, vous accédez à la page de profile de la personne en question.<br>Vous pouvez regarder l'activité de la personne et ses mentions.</p>
		<p>Toutes les fenêtres popups peuvent être épinglées (en haut à droite de la popup) pour rester affichées lors de la navigation.</p>
	</li>

	<li class="big" data-button="Informations sur le groupe">
		<span class="preStep hidden">
			$('.elgg-menu-item-help .help-group-link').click();
		</span>
		<h2>Le profile des groupes</h2>
		<p>Vous êtes sur le profile du groupe aide. Tous les groupes ont un profile similaire.</p>
	</li>
	<li class="big" data-class="groups-profile" data-options="tipLocation:top;tipAdjustmentX:100%;" data-button="Activité">
		<h2>Informations sur le groupe</h2>
		<p>Vous pouvez voir ici toutes les informations sur le groupe.</p>
		<p>Tous les administrateurs du groupe sont affichés. Vous pouvez cliquer sur le titre des mandats pour voir leur rôle, et vous porter candidat comme adiministrateur.</p>
		<p>Ci-dessous, vous trouverez un aperçu des éléments créé dans le groupe.</p>
	</li>
	<li data-id="group_activity_module" data-options="tipLocation:left;" data-button="Menu des outils">
		<h2>Activité du groupe</h2>
		<p>Toutes l'activité du groupe est recensée ici.</p>
	</li>
	<li data-class="elgg-menu-owner-block" data-options="tipLocation:left;" data-button="6. Les questions-réponses">
		<h2>Le menu des outils</h2>
		<p>Vous pouvez accéder aux différents outils du groupe par ce menu.</p>
		<p>Les outils peuvent être configurés par les administrateurs. Certains groupes n'ont pas tous les outils activés.</p>
	</li>

	<li class="big" data-button="Poser une question">
		<span class="preStep hidden">
			$('.elgg-menu-item-help .help-faq-link').click();
		</span>
		<h2>Les questions-réponses</h2>
		<p>C'est une sorte de "Foire aux questions" qui permet d'éviter les doublons de questions et fait remonter les meilleures réponses aux questions.</p>
	</li>
	<li data-id="answers-textarea" data-options="tipLocation:top;tipAdjustmentX:100%;" data-button="Répondre à une question">
		<span class="postStep hidden">
			$('.elgg-main .elgg-list-entity > li:first-child h3 > a').click();
		</span>
		<h2>Poser une question</h2>
		<p>Écrivez tout simplement votre question dans ce champ.<br>Si aucune question ne correspond à la votre, vous pourrez alors la créer.</p>
	</li>
	<li data-button="7. Les remue-méninges">
		<h2>Répondre à une question</h2>
		<p>Voici une question.<br>Vous pouvez voter pour la question afin de signaler que c'est une bonne question, ou une question sans intérêt.</p>
		<p>Vous pouvez commenter la question, ou chaque réponse.</p>
		<p>Et pour répondre, écrivez simplement votre réponse dans le champ "Répondre à cette question" en bas.</p>
	</li>

	<li class="big" data-button="Proposer une idée">
		<span class="preStep hidden">
			var origin = elgg.normalize_url(decodeURIComponent(window.location.href)).split("#")[0];
			History.pushState({origin: origin}, null, '<?php if ($obj_guid = elgg_get_plugin_setting('objectives_home', 'elgg-ggouv_template')) echo elgg_get_site_url() . 'brainstorm/group/' . $obj_guid . '/top'; ?>');
		</span>
		<h2>Les remue-méninges</h2>
		<p>Vous voici dans le remue-méninges du groupe Objectifs_communs. Il permet de définir une feuille de route commune à long terme.</p>
		<p>Vous êtes cordialement invité à proposer et voter des idées.</p>
	</li>
	<li data-id="brainstorm-textarea" data-options="tipLocation:top;" data-button="Voter pour une idée">
		<span class="preStep hidden">
			//$('.elgg-main .brainstorm-list > li:first-child a.idea-rate-button').click();
		</span>
		<h2>Proposer une idée</h2>
		<p>Écrivez tout simplement votre idée dans ce champ.<br>Si aucune idée ne correspond à la votre, vous pourrez alors la créer.</p>
	</li>
	<li data-class="elgg-main .brainstorm-list > li:first-child a.idea-rate-button" data-options="tipLocation:bottom;tipAdjustmentX:-10px;" data-button="Points restants">
		<span class="preStep hidden">
			$('.elgg-main .brainstorm-list > li:first-child a.idea-rate-button').click();
		</span>
		<span class="postStep hidden">
			$('body').click();
		</span>
		<h2>Voter pour une idée</h2>
		<p>Choisissez le nombre de points que vous souhaitez donner à une idée. Vous pouvez changer quand vous voulez.</p>
	</li>
	<li data-id="votesLeft" data-options="tipLocation:right;tipAdjustmentY:10px;" data-button="Voter pour une idée">
		<h2>Points restants</h2>
		<p>Vos votes sont limités. Seul 10 points peuvent être donnés aux idées. Cela permet de focaliser sur les idées les plus souhaitables.</p>
		<p>Vous récupèrerez vos points lorsque les idées seront réalisées. Choisissez donc des idées réalisables !</p>
	</li>
</ol>




