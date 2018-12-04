<?php
/**
 * La configuration de base de votre installation WordPress.
 *
 * Ce fichier contient les réglages de configuration suivants : réglages MySQL,
 * préfixe de table, clefs secrètes, langue utilisée, et ABSPATH.
 * Vous pouvez en savoir plus à leur sujet en allant sur 
 * {@link http://codex.wordpress.org/fr:Modifier_wp-config.php Modifier
 * wp-config.php}. C'est votre hébergeur qui doit vous donner vos
 * codes MySQL.
 *
 * Ce fichier est utilisé par le script de création de wp-config.php pendant
 * le processus d'installation. Vous n'avez pas à utiliser le site web, vous
 * pouvez simplement renommer ce fichier en "wp-config.php" et remplir les
 * valeurs.
 *
 * @package WordPress
 */

// ** Réglages MySQL - Votre hébergeur doit vous fournir ces informations. ** //
/** Nom de la base de données de WordPress. */
define('DB_NAME', 'dreambodix_wp');

/** Utilisateur de la base de données MySQL. */
define('DB_USER', 'dreambodix_wp');

/** Mot de passe de la base de données MySQL. */
define('DB_PASSWORD', 'Technique01');

/** Adresse de l'hébergement MySQL. */
define('DB_HOST', 'mysql51-156.perso');

/** Jeu de caractères à utiliser par la base de données lors de la création des tables. */
define('DB_CHARSET', 'utf8');

/** Type de collation de la base de données. 
  * N'y touchez que si vous savez ce que vous faites. 
  */
define('DB_COLLATE', '');

/**#@+
 * Clefs uniques d'authentification et salage.
 *
 * Remplacez les valeurs par défaut par des phrases uniques !
 * Vous pouvez générer des phrases aléatoires en utilisant 
 * {@link https://api.wordpress.org/secret-key/1.1/salt/ le service de clefs secrètes de WordPress.org}.
 * Vous pouvez modifier ces phrases à n'importe quel moment, afin d'invalider tous les cookies existants.
 * Cela forcera également tous les utilisateurs à se reconnecter.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         'z8k:2`QQ*Y4]pb-F[gY,RV}i.><(P-$u3e$?Vmcq}}VW<t_~0nyL#Pb$#_z+}[$1');
define('SECURE_AUTH_KEY',  '2kQA-LULJi_+H5lv4sNhM)X8*8!+~|h/5*9H7R3|Lyrb]73}0iW+SMoZ~w!]I4(=');
define('LOGGED_IN_KEY',    'EoE|kBMw8-vaSx@VvyZ,zX:pBx#+GHdG%a!w~`~-C,~x3<~zETvU_{<f:J$XY}Ds');
define('NONCE_KEY',        '-:Q{3}GW*_Ro-*y+YV|-3NEy#Coqsvx(9lkW{BQWu#yj49E#4e04+HAJbd{8!hlf');
define('AUTH_SALT',        'a/^@-.t4]V>`y>G.k/w*]OIyBoO>bk2|A-cTrM_QAf8mpyQ8W`xzCQ$ouU0(ndpE');
define('SECURE_AUTH_SALT', 'C{SF2%]Au&3fv5Yh4JbMrJw|M>Rtq>*- -pTZz|yf<J|dz6SgR.ch}5[oXrHhEV&');
define('LOGGED_IN_SALT',   '`jXE{v 2ZSk#.mv3l,fZQ_]-!tuIe1.M@A6pk?>(/<N$U?W35|D5KYqpg%Jzd1uH');
define('NONCE_SALT',       'n_-k}Dsfoz+y/=~AEV@CEvxz=c-uJ<1ni|3n=/Hp5m:w}3(;t(-3nsa*J~*6 8`J');
/**#@-*/

/**
 * Préfixe de base de données pour les tables de WordPress.
 *
 * Vous pouvez installer plusieurs WordPress sur une seule base de données
 * si vous leur donnez chacune un préfixe unique. 
 * N'utilisez que des chiffres, des lettres non-accentuées, et des caractères soulignés!
 */
$table_prefix  = 'wp_';

/** 
 * Pour les développeurs : le mode deboguage de WordPress.
 * 
 * En passant la valeur suivante à "true", vous activez l'affichage des
 * notifications d'erreurs pendant votre essais.
 * Il est fortemment recommandé que les développeurs d'extensions et
 * de thèmes se servent de WP_DEBUG dans leur environnement de 
 * développement.
 */ 
define('WP_DEBUG', false); 

/* C'est tout, ne touchez pas à ce qui suit ! Bon blogging ! */

/** Chemin absolu vers le dossier de WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Réglage des variables de WordPress et de ses fichiers inclus. */
require_once(ABSPATH . 'wp-settings.php');