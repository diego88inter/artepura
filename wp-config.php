<?php
/**
 * Il file base di configurazione di WordPress.
 *
 * Questo file viene utilizzato, durante l’installazione, dallo script
 * di creazione di wp-config.php. Non è necessario utilizzarlo solo via web
 * puoi copiare questo file in «wp-config.php» e riempire i valori corretti.
 *
 * Questo file definisce le seguenti configurazioni:
 *
 * * Impostazioni MySQL
 * * Chiavi Segrete
 * * Prefisso Tabella
 * * ABSPATH
 *
 * * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Impostazioni MySQL - È possibile ottenere queste informazioni dal proprio fornitore di hosting ** //
/** Il nome del database di WordPress */
define( 'DB_NAME', 'wordpress' );

/** Nome utente del database MySQL */
define( 'DB_USER', 'root' );

/** Password del database MySQL */
define( 'DB_PASSWORD', '' );

/** Hostname MySQL  */
define( 'DB_HOST', 'localhost:3306' );

/** Charset del Database da utilizzare nella creazione delle tabelle. */
define( 'DB_CHARSET', 'utf8mb4' );

/** Il tipo di Collazione del Database. Da non modificare se non si ha idea di cosa sia. */
define('DB_COLLATE', '');

/**#@+
 * Chiavi Univoche di Autenticazione e di Salatura.
 *
 * Modificarle con frasi univoche differenti!
 * È possibile generare tali chiavi utilizzando {@link https://api.wordpress.org/secret-key/1.1/salt/ servizio di chiavi-segrete di WordPress.org}
 * È possibile cambiare queste chiavi in qualsiasi momento, per invalidare tuttii cookie esistenti. Ciò forzerà tutti gli utenti ad effettuare nuovamente il login.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'Qi8#k:eRvYO6T.u~vgw#KRYuROu3Hs}PfGoew4kp~W,J3r!/PS9O9 o`|bU%q8d;' );
define( 'SECURE_AUTH_KEY',  'QXI@A/fFyxQ=Ow1#Q^i4oKp_.==$S5C_dIi(()ND@pqX<vch_68fEaR(?y!pIiFW' );
define( 'LOGGED_IN_KEY',    '@^Nq]h( rZC)NKFUfy2J+H>Ye,JsaOmV6,XH!%{Xuq5?eRxu7aoS2%ll3cbw{|SC' );
define( 'NONCE_KEY',        '@X.,<+VF/?xgM9,i;@{GPAq5w)Kjf*{kP3pd -F-7{=!/DOR:e3qoW3qB*!Q6_3;' );
define( 'AUTH_SALT',        '5V`mh!t#5/wC?Kt&58?!s?gd:)<m{mRhkde#t(z,1kc~e0Cuk~47) j%v--#qL%?' );
define( 'SECURE_AUTH_SALT', '<t_|jL|{j4B$ JVm/9(p0^rZj`1%ZVExY&9Jvs?IOT .UZ!rf>dU0{^67hr<]cCk' );
define( 'LOGGED_IN_SALT',   '6CpM7Pd5UxcR._F&NVRR!Nuxq-xWqfQ]$tD`NR#r|^#%(=wz|FR0?/0~cjcZjFm1' );
define( 'NONCE_SALT',       '^}.blcAX!.x*9uoT5M_F9Xdy$#fO~xEgCHen$Fa=ro}O^apbqFd=8#{DK, Ivkfv' );

/**#@-*/

/**
 * Prefisso Tabella del Database WordPress.
 *
 * È possibile avere installazioni multiple su di un unico database
 * fornendo a ciascuna installazione un prefisso univoco.
 * Solo numeri, lettere e sottolineatura!
 */
$table_prefix = 'wp_';

/**
 * Per gli sviluppatori: modalità di debug di WordPress.
 *
 * Modificare questa voce a TRUE per abilitare la visualizzazione degli avvisi durante lo sviluppo
 * È fortemente raccomandato agli svilupaptori di temi e plugin di utilizare
 * WP_DEBUG all’interno dei loro ambienti di sviluppo.
 *
 * Per informazioni sulle altre costanti che possono essere utilizzate per il debug,
 * leggi la documentazione
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* Finito, interrompere le modifiche! Buon blogging. */

/** Path assoluto alla directory di WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Imposta le variabili di WordPress ed include i file. */
require_once(ABSPATH . 'wp-settings.php');
