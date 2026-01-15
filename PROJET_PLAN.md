# Otakool - Plan de Développement

## Phase 1 : Les Fondations (Infrastructure)

* [ ] **Dockerisation :** Configurer `docker-compose.yml` (PHP 8.2, Postgres, Nginx, Mailpit, Adminer).
* [ ] **Symfony Init :** Création du projet, installation des packs de base (ORM, Maker, Twig).
* [ ] **Base de Données :**
* [ ] Création de la `BaseEntity` (Abstraite).
* [ ] Création du Trait `IdentifiableTrait` (ID + UUID).
* [ ] Génération des entités Core (`User`, `Post`, `Interaction`).
* [ ] Génération des entités Gamification & Social (`Follow`, `Badge`, `Notification`, `Invitation`).
* [ ] **Assets :** Installation de TailwindCSS et Webpack Encore (ou AssetMapper).

## Phase 2 : Identité & Profils (L'Otaku)

*Objectif : On peut s'inscrire et avoir un profil stylé.*

* [ ] **Auth :** Inscription, Connexion, Mot de passe oublié (Symfony Security).
* [ ] **Settings :** Formulaire d'édition de profil (Bio, changement pseudo).
* [ ] **Uploads :** Mise en place de **VichUploader** pour Avatar et Bannière.
* [ ] **Gamification Base :** Logique d'attribution d'XP à la connexion/inscription.
* [ ] **Vue Profil :** Affichage de la "Carte d'identité" Otaku (Niveau, Barre d'XP).

## Phase 3 : Le Cœur Social (Shout & Feed)

*Objectif : L'app prend vie.*

* [ ] **CRUD Post :** Créer un post, supprimer son post.
* [ ] **Timeline :** Afficher les posts des gens qu'on suit (QueryBuilder).
* [ ] **Interactions :** Système de Like (AJAX/Turbo) et calcul du compteur.
* [ ] **Thread :** Système de réponse (Reply) et affichage en cascade.
* [ ] **Dates Relatives :** Installation de `KnpTimeBundle` ("Il y a 2 min").

## Phase 4 : Interactions Avancées & Modération

*Objectif : Gérer la communauté.*

* [ ] **Follow System :** Bouton Suivre/Ne plus suivre.
* [ ] **Block System :** Masquer les contenus des bloqués.
* [ ] **Modération :**
* [ ] Entité `ModerationVote`.
* [ ] Masquage auto si > 10 signalements.
* [ ] Dashboard Admin (EasyAdminBundle) pour gérer les bans.



## Phase 5 : Messagerie & Invitations (Consent-First)

*Objectif : Communication privée et virale.*

* [ ] **Système d'Invitation :**
* [ ] Envoi d'email avec Token.
* [ ] Page d'atterrissage "Accepter l'invitation".


* [ ] **Messagerie UI :** Liste des conversations.
* [ ] **Messagerie Logic :** Envoi de message, marquer comme lu.
* [ ] **Notifications :**
* [ ] Listener sur les Events (Like, Follow, Invite).
* [ ] Pastille rouge dans la navbar.



## Phase 6 : Gamification Avancée (The Fun Layer)

*Objectif : Rendre l'app addictive.*

* [ ] **Système de Badges :** Déclencheurs automatiques (ex: "Premier Post").
* [ ] **Boss Raid Engine :**
* [ ] Logique d'affichage de la barre de vie (Likes = Dégâts).
* [ ] Calcul du rang "Slayer" basé sur l'historique.


* [ ] **Premium Assets :** Débloquer des bordures/thèmes via `User.preferences`.
* [ ] **Custom Titles :** Le choix du titre au niveau 60.

## Phase 7 : Polissage & Optimisation

* [ ] **UX :** Transitions fluides avec Turbo Drive.
* [ ] **Responsive :** Vérification mobile parfaite.
* [ ] **Sécurité :** Audit des droits (Voter).

