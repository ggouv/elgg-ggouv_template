<?php $username = elgg_get_logged_in_user_entity()->username; ?>


<div id="TourMenu" class="hover">
	<div>Sommaire de la visite</div>
	<ul class="hidden pal ggouv-menu-child">
		<li data-tip="1">1. L'interface</li>
		<li data-tip="6">2. Le hub de communication</li>
		<li data-tip="11">3. Communiquer par micro-blogging</li>
		<li data-tip="15">4. Mon profil</li>
		<li data-tip="19">5. Le profil des groupes</li>
		<li data-tip="23">6. Les questions-réponses</li>
		<li data-tip="31">7. Les remue-méninges</li>
		<li data-tip="35">8. Les flux de travail</li>
		<li data-tip="39">9. Les wikis</li>
		<li data-tip="43">10. Le language Markdown</li>
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
		<p>Votre tableau de bord donne une vue d'ensemble de votre activité et de vos publications. Vous pouvez le paramétrer comme vous le souhaitez.</p>
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
		<p>Le hub est une sorte de tableau de bord. C'est cette page avec tout plein de colonnes.<br>Il permet de visualiser l'activité de vos abonnements, vos mentions, vos groupes... le tout classé en colonnes.</p>
		<p>Il est aussi possible d'intégrer les flux provenant d'autres réseaux comme Twitter et Facebook (en cours).</p>
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
		<p>Vous pouvez aussi mentionner un !groupe et insérer un #hashtag.<br>Les avatars des gitoyens, des groupes et les hashtags peuvent être pris et déposés dans le lanceur de message par un glisser-déposer.</p>
	</li>
	<li class="big" data-id="thewire-network" data-options="tipLocation:left" data-button="Ajouter un compte">
		<span class="preStep hidden">$('#thewire-network').addClass('extended');</span>
		<h2>Sélectionner la destination</h2>
		<p>Seul votre compte ggouv est sélectionné. Vous pouvez associer d'autres comptes provenant d'autres réseaux sociaux.</p>
		<p>Les comptes sélectionnés pour l'envoi du message sont en haut.<br>Les comptes en bas sont inactifs.</p>
		<p>Pour choisir la destination de vos messages, vous pouvez glisser-déposer les avatars d'en bas à en haut.</p>
		<p>Vous pouvez épingler un compte pour que celui-ci reste toujours en haut.<br>Vous pouvez aussi temporairement désactiver un compte en cliquant dessus.</p>
	</li>
	<li data-class="add_social_network" data-options="tipLocation:top" data-button="4. Mon profil">
		<span class="postStep hidden">$('#thewire-network').removeClass('extended');</span>
		<h2>Ajouter un compte</h2>
		<p>Cliquez ici pour ajouter un compte d'un réseau social.</p>
		<p>Vous pouvez gérer tous vos comptes dans vos paramètres.</p>
	</li>

	<li class="big" data-button="Modifier mon profil">
		<span class="preStep hidden">
			var origin = elgg.normalize_url(decodeURIComponent(window.location.href)).split("#")[0];
			History.pushState({origin: origin}, null, elgg.get_site_url()+'profile/<?php echo $username; ?>');
		</span>
		<h2>Mon profil</h2>
		<p>Votre profil est la page vous concernant. Elle peut être vue par tout le monde.</p>
		<p>Dans un souci de transparence, et pour vous faire connaître, il est plutôt conseillé de bien remplir cette page.<br>Les droits d'accès sont paramétrables pour toutes les informations que vous publiez sur cette page.</p>
	</li>
	<li data-class="profile-action-menu" data-options="tipLocation:right;" data-button="Ajouter des widgets">
		<h2>Modifier mon profil</h2>
		<p>Cliquez sur ces boutons pour modifier votre profil ou changer votre avatar.</p>
	</li>
	<li data-class="elgg-widget-add-control .elgg-button" data-options="tipLocation:left;tipAdjustmentY:-10px;" data-button="Mon profil en popup">
		<span class="preStep hidden">
			$('.elgg-widget-add-control a').click();
		</span>
		<span class="postStep hidden">
			$('.elgg-widget-add-control a').click();
			$('.net-profile.ggouv:first-child .user-info-popup').click();
		</span>
		<h2>Ajouter des widgets</h2>
		<p>Vous pouvez ajouter des widgets qui se remplieront au fur et à mesure de votre activité sur ggouv.</p>
		<p>Ces widgets ne sont pas affichés dans votre profil en popup. Ils sont paramétrables et vous pouvez régler les droits d'accès.</p>
	</li>
	<li data-id="user-info-popup" data-options="tipLocation:left" data-button="Le profil des groupes">
		<h2>Mon profil en popup</h2>
		<p>Cette popup s'affiche quand quelqu'un clique sur votre avatar ou sur @<?php echo $username; ?>. Vous pouvez faire de même avec les autres.</p>
		<p>En cliquant sur l'avatar dans la popup, vous accédez à la page de profil de la personne en question.<br>Vous pouvez regarder l'activité de la personne et ses mentions.</p>
		<p>Toutes les fenêtres popups peuvent être épinglées (en haut à droite de la popup) pour rester affichées lors de la navigation.</p>
	</li>

	<li class="big" data-button="Informations sur le groupe">
		<span class="preStep hidden">
			$('.elgg-menu-item-help .help-group-link').click();
		</span>
		<h2>Le profil des groupes</h2>
		<p>Vous êtes sur le profil du groupe aide. Tous les groupes ont un profil similaire.</p>
	</li>
	<li class="big" data-class="groups-profile" data-options="tipLocation:top;tipAdjustmentX:100%;" data-button="Activité">
		<h2>Informations sur le groupe</h2>
		<p>Vous pouvez voir ici toutes les informations sur le groupe.</p>
		<p>Tous les administrateurs du groupe sont affichés. Vous pouvez cliquer sur le titre des mandats pour voir leurs rôles, et vous porter candidat comme administrateur.</p>
		<p>Ci-dessous, vous trouverez un aperçu des éléments créés dans le groupe.</p>
	</li>
	<li data-id="group_activity_module" data-options="tipLocation:left;" data-button="Menu des outils">
		<h2>Activité du groupe</h2>
		<p>Toute l'activité du groupe est recensée ici.</p>
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
			$($('.elgg-list .answers').sort(function(a, b) {
				return $(a).find('div').text() > $(b).find('div').text() ? -1 : 1;
			})[0]).closest('.elgg-item').find('h3 a').click();
		</span>
		<h2>Poser une question</h2>
		<p>Écrivez tout simplement votre question dans ce champ.<br>Si aucune question ne correspond à la vôtre, vous pourrez alors la créer.</p>
	</li>
	<li data-button="Voter une question">
		<span class="inStep hidden">$('.joyride-modal-bg').hide();</span>
		<h2>Répondre à une question</h2>
		<p>Voici une question.<br>Le détail de la question est en haut, les réponses en bas.</p>
		<p>La meilleure réponse est placée en haut de la liste des réponses.</p>
	</li>
	<li data-class="elgg-item-question .score" data-options="tipLocation:right;tipAdjustmentY:-10px;" data-button="Commenter une question">
		<h2>Voter une question</h2>
		<p>Il est possible de voter +1 ou -1 une question afin de signaler son intérêt.</p>
	</li>
	<li data-id="comments" data-options="tipLocation:bottom;" data-button="Voter une réponse">
		<h2>Commenter une question</h2>
		<p>Vous pouvez commenter une question pour demander un éclaircissement ou des détails sur le problème posé.</p>
	</li>
	<li data-class="elgg-main .elgg-item-answer:nth-child(3) .score" data-options="tipLocation:right;tipAdjustmentY:-10px;" data-button="Commenter une réponse">
		<h2>Voter une réponse</h2>
		<p>Si vous trouvez qu'une réponse est satisfaisante, vous pouvez voter +1 pour celle-ci.<br>Cela permet de faire remonter les meilleures réponses dans le classement.</p>
		<p>A contrario, si vous trouvez qu'une réponse n'est pas du tout adaptée, vous pouvez voter -1 pour la faire descendre dans le classement.</p>
		<p>Les administrateurs du groupe et la personne qui a posé la question peuvent valider une réponse comme étant « la plus satisfaisante ». Elle est alors affichée en haut de la liste même si elle n'a pas le plus de vote.</p>
	</li>
	<li data-class="elgg-main .elgg-item-answer:nth-child(3) .elgg-comments" data-options="tipLocation:bottom;" data-button="Répondre à la question">
		<h2>Commenter une réponse</h2>
		<p>Vous pouvez commenter une réponse pour apporter des informations complémentaires ou réagir à la réponse donnée.</p>
	</li>
	<li data-class="elgg-form-answers-answer-save" data-options="tipLocation:top;" data-button="7. Les remue-méninges">
		<h2>Répondre à la question</h2>
		<p>Pour proposer une réponse, c'est tout en bas de la page !</p>
	</li>

	<li class="big" data-button="Proposer une idée">
		<span class="preStep hidden">
			var origin = elgg.normalize_url(decodeURIComponent(window.location.href)).split("#")[0];
			History.pushState({origin: origin}, null, '<?php if ($obj_guid = elgg_get_plugin_setting('objectives_home', 'elgg-ggouv_template')) echo elgg_get_site_url() . 'brainstorm/group/' . $obj_guid . '/top'; ?>');
		</span>
		<span class="inStep hidden">$('.joyride-tip-guide:visible').css('top', '33%');</span>
		<h2>Les remue-méninges</h2>
		<p>Vous voici dans le remue-méninges du groupe Objectifs_communs. Il permet de définir une feuille de route commune à long terme.</p>
		<p>Vous êtes cordialement invité à proposer et voter des idées.</p>
	</li>
	<li data-id="brainstorm-textarea" data-options="tipLocation:top;" data-button="Voter pour une idée">
		<h2>Proposer une idée</h2>
		<p>Écrivez tout simplement votre idée dans ce champ.<br>Si aucune idée ne correspond à la vôtre, vous pourrez alors la créer.</p>
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
	<li data-id="votesLeft" data-options="tipLocation:right;tipAdjustmentY:-5px;" data-button="8. Les flux de travail">
		<h2>Points restants</h2>
		<p>Vos votes sont limités. Seul 10 points peuvent être donnés aux idées. Cela permet de se focaliser sur les idées les plus souhaitables.</p>
		<p>Vous récupèrerez vos points lorsque les idées seront réalisées. Choisissez donc des idées réalisables !</p>
	</li>

	<li class="big" data-button="Ajouter une fiche">
		<span class="preStep hidden">
			var origin = elgg.normalize_url(decodeURIComponent(window.location.href)).split("#")[0];
			History.pushState({origin: origin}, null, '<?php if ($dev = elgg_get_plugin_setting('bugs_of_dev', 'elgg-ggouv_template')) echo $dev; ?>');
		</span>
		<h2>Les flux de travail</h2>
		<p>Vous voici dans le tableau de travail de gestion des bugs. Il permet aux gitoyens de signaler un bug, et aux développeurs de s'organiser pour le gérer.</p>
		<p>Dans ce tableau, chaque fiche est un bug et elles sont déplacées entre les colonnes suivant son traitement.</p>
		<p>Les fiches peuvent être assignées à quelqu'un, être commentées, avoir une date limite, une checklist...</p>
		<p>Pour vos besoins, vous pouvez créer autant de colonne que vous voulez, et les nommer comme bon vous semble.<br>(le plus classique étant : A faire, En cours, Fait)</p>
		<p>Les possibilités d'utilisation des flux de travail sont multiples : rédaction de documents, traduction de vidéos, gestion de stock...</p>
	</li>
	<li data-class="workflow-lists .workflow-list:first-child .elgg-input-plaintext" data-options="tipLocation:top;" data-button="Les participants">
		<h2>Ajouter une fiche</h2>
		<p>Vous pouvez ajouter une fiche dans une liste en bas de chaque colonnes.</p>
		<p>Ici, vous ne pourrez pas déplacer les fiches car cette possibilité est réservée aux administrateurs du groupe.<br>Pour le faire, il suffit de glisser-déposer de la fiche où l'on veut la mettre.</p>
	</li>
	<li data-class="elgg-module.participants" data-options="tipLocation:left;" data-button="L'activité du tableau">
		<h2>Les participants</h2>
		<p>Ici s'affiche tous les participants du tableau.</p>
		<p>Il est possible de prendre un avatar et de le glisser-déposer sur une fiche pour assigner cette personne à la fiche.</p>
		<p>Dans le hub, vous pouvez avoir une colonne regroupant toutes les fiches dont vous êtes assignés.</p>
	</li>
	<li data-class="elgg-module.river" data-options="tipLocation:left;" data-button="9. Les wikis">
		<h2>L'activité du tableau</h2>
		<p>Toute l'activité générée dans le tableau apparaît ici.</p>
		<p>Vous pouvez voir rapidement tout ce qui a été fait et qui a fait quoi.</p>
	</li>

	<li class="big" data-button="Créer une page wiki">
		<span class="preStep hidden">
			var origin = elgg.normalize_url(decodeURIComponent(window.location.href)).split("#")[0],
				wiki_of_help = '<?php if ($wiki = elgg_get_plugin_setting('wiki_of_help', 'elgg-ggouv_template')) echo $wiki; ?>';

			if (!wiki_of_help.match(elgg.get_site_url())) wiki_of_help = elgg.get_site_url() + 'u/' + wiki_of_help.split('/').slice(-1)[0];
			History.pushState({origin: origin}, null, wiki_of_help);
		</span>
		<h2>Les wikis</h2>
		<p>Vous êtes ici sur la page wiki principale de l'aide.</p>
		<p>Une page wiki est une page modifiable par tout le monde, et dont chaque modification est enregistrée. Ce qui permet de voir qui a édité quoi, et de revenir en arrière en cas d'erreur.</p>
		<p>Chaque groupe peut posséder son propre wiki.</p>
		<p>Il est possible de mettre un lien vers une page qui n'existe pas dans le wiki du groupe.<br>Le lien sera alors en rouge.</p>
	</li>
	<li data-class="elgg-form-markdown-wiki-search .elgg-input-text" data-options="tipLocation:left;tipAdjustmentY:-10px;" data-button="Le sommaire">
		<h2>Créer une page wiki</h2>
		<p>Faites d'abord une recherche avec le nom de la page que vous voulez créer.<br>Si elle n'existe pas, vous pourrez alors la créer !</p>
	</li>
	<li data-class="elgg-module.contents" data-options="tipLocation:left;tipAdjustmentY:-10px;" data-button="Le menu d'une page">
		<span class="inStep hidden">$('.joyride-tip-guide:visible').css('position', 'fixed');</span>
		<h2>Le sommaire</h2>
		<p>Le sommaire ci-dessous permet d'aller rapidement dans les différentes sections de la page.<br>Seul les 3 premiers niveaux de titre sont représentés.</p>
	</li>
	<li data-class="elgg-menu-entity" data-options="tipLocation:left;tipAdjustmentY:-15px;" data-button="10. L'éditeur Markdown">
		<h2>Le menu d'une page</h2>
		<p>Vous pouvez visiter l'historique des modifications d'une page, discuter de cette page ou éditer la page.</p>
	</li>

	<li class="big" data-button="Les boutons de l'éditeur">
		<span class="preStep hidden">
			var origin = elgg.normalize_url(decodeURIComponent(window.location.href)).split("#")[0],
				faq_of_help = '<?php if ($wiki = elgg_get_plugin_setting('faq_of_help', 'elgg-ggouv_template')) echo $wiki; ?>',
				newPage = faq_of_help.match(/\d+/)[0];
			History.pushState({origin: origin}, null, elgg.get_site_url()+'wiki/edit?q=tour&container_guid='+newPage);
		</span>
		<span class="postStep hidden">
			$('.elgg-form-markdown-wiki-edit .elgg-button-submit').prop('disabled', true).hide();
			$('.markdown-editor').removeClass('hidden').css({display: 'block'}).animate({top: -20, opacity: 1});
		</span>
		<h2>L'éditeur Markdown</h2>
		<p>Vous êtes ici sur une page wiki, mais tout ce que vous allez voir sur la syntaxe Markdown est possible de partout (blog, idée, question, commentaire...).</p>
		<p>La syntaxe Markdown est un language qui se veut le plus simple et le plus lisible possible.</p>
		<p>C'est dans le champ de gauche que l'on écrit. Le champ de droite est une prévisualisation en temps réel du rendu HTML.</p>
	</li>
	<li data-class="markdown-editor" data-options="tipLocation:left;tipAdjustmentY:-35px;" data-button="La prévisualisation">
		<span class="inStep hidden">
			$('.markdown-editor').stop(true, true);
			$('.input-markdown').click().keyup();
		</span>
		<h2>Les boutons de l'éditeur</h2>
		<p>Ces boutons permettent de rapidement mettre en forme votre texte.</p>
	</li>
	<li data-class="elgg-menu-markdown" data-options="tipLocation:left;tipAdjustmentY:-15px;" data-button="Le language Markdown">
		<h2>La prévisualisation</h2>
		<p>L'onglet prévisualisation permet de voir en temps réel le rendu HTML.</p>
		<p>L'onglet "Sortie HTML" affiche votre texte au format HTML.</p>
		<p>Et l'onglet "Guide" permet d'en savoir un peu plus sur la syntaxe Markdown.</p>
	</li>
	<li class="top" data-button="Les liens">
		<span class="preStep hidden">
			$('.input-markdown').val("Saut \nde \nligne \nseulement\n\n2 sauts à la ligne pour faire un nouveau paragraphe.  \nPour faire un saut à la ligne simple, il faut finir la ligne par 2 espaces (ou maj+return).\n\nMentionner quelqu'un : @<?php echo $username; ?> ou un groupe : !aide  \n  \nÉchapper un caractère : \\@<?php echo $username; ?>\n\n**Formatage simple :**\n\n**gras**  \n_italique_  \n~~barré~~\n\n**Les titres :**\n\n# titre1\n## titre2\n### titre3\n...\n###### titre6\n\n**Les listes :**\n\n- liste\n- à\n- puces\n - et plus\n\nnumérotation automatique :\n\n1. liste\n2. numéroté\n5. automatiquement\n\n**Citations :**\n> une citation !\n>> une autre\n>>>>>> et encore\n\n**Blocs de code :**\n\n    4 espaces pour mettre dans un bloc de code\n\n**Une image :**  \n![mon avatar](<?php echo elgg_get_logged_in_user_entity()->getIcon(); ?>)").keyup();
		</span>
		<span class="inStep hidden">$('.joyride-modal-bg').hide();</span>
		<h2>Le language Markdown</h2>
		<div class="row-fluid">
			<div class="span6"><p>Voici un exemple de la syntaxe de base du language Markdown.</p></div>
			<div class="span6"><p>Les raccourcis clavier les plus courant sont possible : ctrl+B, ctrl+I... (cmd pour Mac OS X)</p></div>
		</div>
	</li>
	<li class="top" data-button="Les blocs">
		<span class="preStep hidden">
			$(document).scrollTo(0, 300);
			$('.input-markdown').val("## Lien en dur\n\nhttp://unlien.fr\n\n&lt;http://unlien.fr&gt;\n\n[http://unlien.fr]()  \n\n## Lien sur un mot\n\n[un lien](http://unlien.fr)\n\n[un lien][] &lt;- la référence doit être identique   \n[un lien][1]\n\nLe lien est passé en référence n'importe où dans le texte.\n[un lien]: http://unlien.fr\n[1]: http://unlien.fr\n\n## Lien vers une page wiki du groupe  \n\n[la page d'accueil du groupe aide](accueil) &lt;- pointe vers la page \"accueil\"\n\n[accueil]() &lt;- le (ou les) mot est pris comme nom de page\n\n[cette page n'existe pas]() &lt;- pointe vers la page \"cette page n'existe pas\" qui n'existe pas (vous l'aurez compris).  \nLe lien sera en rouge et la page pourra être créée d'un simple clic.\n\n[la page d'accueil du groupe aide](group/aide/page/accueil) &lt;- \"group\"\n\n[la page d'accueil du groupe aide](groupe/aide/page/accueil) &lt;- \"groupe\"\n\n## Lien vers une page wiki d'un autre groupe\n\n[signaler un bug au groupe de développeurs](dev:signaler un bug)  \n[signaler un bug au groupe de développeurs](group/dev/page/signaler un bug)  \n[signaler un bug au groupe de développeurs](groupe/dev/page/signaler un bug)\n\n[signaler un bug au groupe de développeurs](dev:page qui n'existe pas) &lt;- ce lien sera en rouge").keyup();
		</span>
		<span class="inStep hidden">$('.joyride-modal-bg').hide();</span>
		<h2>Les liens</h2>
		<div class="row-fluid">
			<div class="span6"><p>Il y a différentes façons d'écrire un lien. Ci-dessous, les exemples permettent de voir toutes les syntaxes.</p></div>
			<div class="span6"><p>Les liens vers des pages wiki n'existant pas seront en rouge, mais ne le sont pas lors de la prévisualisation en temps réel.</p></div>
		</div>
	</li>
	<li class="top" data-button="FIN">
		<span class="preStep hidden">
			$(document).scrollTo(0, 300);
			$('.input-markdown').val("Les blocs sont représentés par le symbole {0} dans les boutons de l'éditeur.\n\nPour en savoir plus sur les blocs, visitez l'aide.\n\n# Quelques exemples de ce qu'il est possible de faire :\n\n## Informer\n\n{7i **Infos**\nLes blocs sont \"responsive design\" : ils passent les uns en dessous des autres lorsque la largeur de l'écran est trop petite.\n}\n{47d **09/07/1789**\nAssemblée nationale constituante.\n}\n{6I **Conseils**\nUtilisez les blocs avec parcimonie... \n}\n\n## Mettre en forme\n\n{9 Exemple\n}\n{9 pour \n}\n{9 faire des\n}\n{9 colonnes\n}\n\n## Débattre\n\n##### Est-il raisonnable de vouloir faire de la croissance à tout prix ?\n{1 **Pour**\nLe PIB, il n'y a que ça de vrai !\n}\n{3 **Contre**\nLa croissance a un coût !\n}\n\n# Une iframe\n\n&lt;iframe src=\"http://player.vimeo.com/video/52966011\" width=\"430\" height=\"243\"&gt;&lt;/iframe&gt;").keyup();
		</span>
		<span class="inStep hidden">$('.joyride-modal-bg').hide();</span>
		<span class="postStep hidden">
			$('#endTourAndReturn').click();
		</span>
		<h2>Les blocs</h2>
		<div class="row-fluid">
			<div class="span6"><p>Il est possible d'utiliser des blocs afin de mettre en forme votre texte.</p></div>
			<div class="span6"><p>Vous pouvez aussi intégrer une iframe d'une vidéo par exemple, mais elle ne s'affichera pas en temps réel.</p></div>
		</div>
	</li>

</ol>



<style type="text/css">
/*
 * Joyride : tour de présentation du site
 */

/* added for ggouv */
#TourMenu {
	position: fixed;
	top: 0;
	right: 0;
	z-index: 999;
	color: #fff;
}
#TourMenu > div {
	background: #1F2E3D;
	font-size: 2em;
	padding: 15px 20px 13px;
	font-weight: bold;
	float: right;
	height: 20px;
}
#TourMenu:hover ul, #TourMenu.hover ul {
	display: block;
}
#TourMenu ul {
	background: #1F2E3D;
	 -moz-border-radius: 0 0 0 4px;
	-webkit-border-radius: 0 0 0 4px;
			border-radius: 0 0 0 4px;
	margin-top: 48px;
	position: relative;
	overflow: visible;
}
#TourMenu li {
	font-size: 1.5em;
}
#endTourAndReturn {
	border-left: 1px solid #CCC;
}

#joyRideTipContent { display: none; }

.joyRideTipContent { display: none; }

/* Default styles for the container */
.joyride-tip-guide {
	position: absolute;
	background: rgba(18, 28, 39, 0.9);
	display: none;
	color: #fff;
	width: 300px;
	z-index: 101;
	top: 0; /* keeps the page from scrolling when calculating position */
	left: 0;
	font-weight: normal;
	 -moz-border-radius: 4px;
	-webkit-border-radius: 4px;
			border-radius: 4px;
}
.joyride-tip-guide.big {
	width: 500px;
}
.joyride-tip-guide.top {
	position: fixed;
	top: 0 !important;
	width: 700px;
	 -moz-border-radius: 0 0 4px 4px;
	-webkit-border-radius: 0 0 4px 4px;
			border-radius: 0 0 4px 4px;
}

.joyride-content-wrapper {
	padding: 10px 10px 18px 15px;
}

/* Mobile */
@media only screen and (max-width: 767px) {
	.joyride-tip-guide {
	width: 95% !important;
	-moz-border-radius: 0;
	-webkit-border-radius: 0;
	border-radius: 0;
	left: 2.5% !important;
	}
	.joyride-tip-guide-wrapper {
	width: 100%;
	}
}


/* Add a little css triangle pip, older browser just miss out on the fanciness of it */
.joyride-tip-guide span.joyride-nub {
	display: block;
	position: absolute;
	left: 22px;
	width: 0;
	height: 0;
	border: solid 14px;
	border: solid 14px;
}

.joyride-tip-guide span.joyride-nub.top {
	/*
	IE7/IE8 Don't support rgba so we set the fallback
	border color here. However, IE7/IE8 are also buggy
	in that the fallback color doesn't work for
	border-bottom-color so here we set the border-color
	and override the top,left,right colors below.
	*/
	border-color: #000;
	border-color: rgba(18, 28, 39, 0.9);
	border-top-color: transparent !important;
	border-left-color: transparent !important;
	border-right-color: transparent !important;
	top: -28px;
	bottom: none;
}

.joyride-tip-guide span.joyride-nub.bottom {
	/*
	IE7/IE8 Don't support rgba so we set the fallback
	border color here. However, IE7/IE8 are also buggy
	in that the fallback color doesn't work for
	border-top-color so here we set the border-color
	and override the bottom,left,right colors below.
	*/
	border-color: #000;
	border-color: rgba(18, 28, 39, 0.9) !important;
	border-bottom-color: transparent !important;
	border-left-color: transparent !important;
	border-right-color: transparent !important;
	bottom: -28px;
	bottom: none;
}

.joyride-tip-guide span.joyride-nub.right {
	border-color: #000;
	border-color: rgba(18, 28, 39, 0.9) !important;
	border-top-color: transparent !important;
	border-right-color: transparent !important;
	border-bottom-color: transparent !important;
	top: 12px;
	bottom: none;
	left: auto;
	right: -28px;
}

.joyride-tip-guide span.joyride-nub.left {
	border-color: #000;
	border-color: rgba(18, 28, 39, 0.9) !important;
	border-top-color: transparent !important;
	border-left-color: transparent !important;
	border-bottom-color: transparent !important;
	top: 12px;
	left: -28px;
	right: auto;
	bottom: none;
}

.joyride-tip-guide span.joyride-nub.top-right {
	border-color: #000;
	border-color: rgba(18, 28, 39, 0.9);
	border-top-color: transparent !important;
	border-left-color: transparent !important;
	border-right-color: transparent !important;
	top: -28px;
	bottom: none;
	left: auto;
	right: 28px;
}

/* Typography */
.joyride-tip-guide h1,.joyride-tip-guide h2,.joyride-tip-guide h3,.joyride-tip-guide h4,.joyride-tip-guide h5,.joyride-tip-guide h6 {
	line-height: 1.25;
	margin: 0;
	font-weight: bold;
	color: #fff;
	padding-bottom: 15px;
}
.joyride-tip-guide h1 { font-size: 30px; }
.joyride-tip-guide h2 { font-size: 26px; }
.joyride-tip-guide h3 { font-size: 22px; }
.joyride-tip-guide h4 { font-size: 18px; }
.joyride-tip-guide h5 { font-size: 16px; }
.joyride-tip-guide h6 { font-size: 14px; }
.joyride-tip-guide p {
	font-size: 16px;
	line-height: 20px;
	margin-bottom: 25px;
}
.joyride-tip-guide a {
	color: rgb(255,255,255);
	text-decoration: none;
	border-bottom: dotted 1px rgba(255,255,255,0.6);
}
.joyride-tip-guide a:hover {
	color: rgba(255,255,255,0.8);
	border-bottom: none;
}

/* Button Style */
.joyride-tip-guide .joyride-next-tip {
	width: auto;
	padding: 6px 18px 4px;
	font-size: 13px;
	text-decoration: none;
	color: rgb(255,255,255);
	border: solid 1px rgb(0,60,180);
	background: rgb(100, 173, 229);
	background: -moz-linear-gradient(top, rgb(100, 173, 229) 0%, rgb(0,85,214) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(100, 173, 229)), color-stop(100%,rgb(0,85,214)));
	background: -webkit-linear-gradient(top, rgb(100, 173, 229) 0%,rgb(0,85,214) 100%);
	background: -o-linear-gradient(top, rgb(100, 173, 229) 0%,rgb(0,85,214) 100%);
	background: -ms-linear-gradient(top, rgb(100, 173, 229) 0%,rgb(0,85,214) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#0063ff', endColorstr='#0055d6',GradientType=0 );
	background: linear-gradient(top, rgb(100, 173, 229) 0%,rgb(0,85,214) 100%);
	text-shadow: 0 -1px 0 rgba(0,0,0,0.5);
	-webkit-border-radius: 2px;
	 -moz-border-radius: 2px;
			border-radius: 2px;
	-webkit-box-shadow: 0px 1px 0px rgba(255,255,255,0.3) inset;
	 -moz-box-shadow: 0px 1px 0px rgba(255,255,255,0.3) inset;
			box-shadow: 0px 1px 0px rgba(255,255,255,0.3) inset;
}

.joyride-next-tip:before {
	font-family: ggouv;
	content: "→";
	font-size: 30px;
	vertical-align: -7px;
	margin: 0 5px 0 -10px;
}

.joyride-next-tip:hover {
	color: rgb(255,255,255) !important;
	border: solid 1px rgb(0,60,180) !important;
	background: rgb(43,128,255);
	background: -moz-linear-gradient(top, rgb(43,128,255) 0%, rgb(29,102,211) 100%);
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,rgb(43,128,255)), color-stop(100%,rgb(29,102,211)));
	background: -webkit-linear-gradient(top, rgb(43,128,255) 0%,rgb(29,102,211) 100%);
	background: -o-linear-gradient(top, rgb(43,128,255) 0%,rgb(29,102,211) 100%);
	background: -ms-linear-gradient(top, rgb(43,128,255) 0%,rgb(29,102,211) 100%);
	filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#2b80ff', endColorstr='#1d66d3',GradientType=0 );
	background: linear-gradient(top, rgb(43,128,255) 0%,rgb(29,102,211) 100%);
}

.joyride-timer-indicator-wrap {
	width: 50px;
	height: 3px;
	border: solid 1px rgba(255,255,255,0.1);
	position: absolute;
	right: 17px;
	bottom: 16px;
}
.joyride-timer-indicator {
	display: block;
	width: 0;
	height: inherit;
	background: rgba(255,255,255,0.25);
}

.joyride-close-tip {
	position: absolute;
	right: 5px;
	top: 10px;
	color: rgba(255,255,255,0.4) !important;
	text-decoration: none;
	font-size: 40px;
	border-bottom: none !important;
}

.joyride-close-tip:hover {
	color: rgba(255,255,255,0.9) !important;
}

.joyride-modal-bg {
	position: fixed;
	height: 100%;
	width: 100%;
	background: rgb(0,0,0);
	background: transparent;
	background: rgba(0,0,0, 0.5);
	-ms-filter:"progid:DXImageTransform.Microsoft.Alpha(Opacity=50)";
	filter: alpha(opacity=50);
	opacity: 0.5;
	z-index: 100;
	display: none;
	top: 0;
	left: 0;
	cursor: pointer;
}

.joyride-expose-wrapper {
	background-color: #ffffff;
	position: absolute;
	z-index: 102;
	-moz-box-shadow: 0px 0px 30px #ffffff;
	-webkit-box-shadow: 0px 0px 30px #ffffff;
	box-shadow: 0px 0px 30px #ffffff;
}

.joyride-expose-cover {
	background: transparent;
	position: absolute;
	z-index: 10000;
	top: 0px;
	left: 0px;
}


</style>


