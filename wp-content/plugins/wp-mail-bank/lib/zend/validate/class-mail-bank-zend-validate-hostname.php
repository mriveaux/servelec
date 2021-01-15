<?php
/**
 * Zend Framework
 *
 * LICENSE
 *
 * This source file is subject to the new BSD license that is bundled
 * with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://framework.zend.com/license/new-bsd
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@zend.com so we can send you a copy immediately.
 *
 * @category  Zend
 * @package   Mail_Bank_Zend_Validate
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 * @version   $Id$
 */

if ( ! defined( 'ABSPATH' ) ) {
		exit;
} // Exit if accessed directly
/**
 * Includes Validate Abstract file

 * @see Mail_Bank_Zend_Validate_Abstract
 */
if ( file_exists( MAIL_BANK_DIR_PATH . 'lib/zend/validate/class-mail-bank-zend-validate-abstract.php' ) ) {
		include_once MAIL_BANK_DIR_PATH . 'lib/zend/validate/class-mail-bank-zend-validate-abstract.php';
}

/**
 * Includes IP File here.

 * @see Mail_Bank_Zend_Validate_Ip
 */
if ( file_exists( MAIL_BANK_DIR_PATH . 'lib/zend/validate/class-mail-bank-zend-validate-ip.php' ) ) {
		include_once MAIL_BANK_DIR_PATH . 'lib/zend/validate/class-mail-bank-zend-validate-ip.php';
}
/**
 * Please note there are two standalone test scripts for testing IDN characters due to problems
 * with file encoding.
 *
 * The first is tests/zend/validate/hostnameteststandalone.php which is designed to be run on
 * the command line.
 *
 * The second is tests/zend/validate/hostnametestform.php which is designed to be run via HTML
 * to allow users to test entering UTF-8 characters in a form.
 *
 * @category  Zend
 * @package   Mail_Bank_Zend_Validate
 * @copyright Copyright (c) 2005-2015 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */
class Mail_Bank_Zend_Validate_Hostname extends Mail_Bank_Zend_Validate_Abstract {
		const CANNOT_DECODE_PUNYCODE  = 'hostnameCannotDecodePunycode';
		const INVALID                 = 'hostnameInvalid';
		const INVALID_DASH            = 'hostnameDashCharacter';
		const INVALID_HOSTNAME        = 'hostnameInvalidHostname';
		const INVALID_HOSTNAME_SCHEMA = 'hostnameInvalidHostnameSchema';
		const INVALID_LOCAL_NAME      = 'hostnameInvalidLocalName';
		const INVALID_URI             = 'hostnameInvalidUri';
		const IP_ADDRESS_NOT_ALLOWED  = 'hostnameIpAddressNotAllowed';
		const LOCAL_NAME_NOT_ALLOWED  = 'hostnameLocalNameNotAllowed';
		const UNDECIPHERABLE_TLD      = 'hostnameUndecipherableTld';
		const UNKNOWN_TLD             = 'hostnameUnknownTld';
		/**
		 * Variable Declaration

		 * @var array
		 */
	protected $message_templates = array(
		self::CANNOT_DECODE_PUNYCODE  => "'%value%' appears to be a DNS hostname but the given punycode notation cannot be decoded",
		self::INVALID                 => 'Invalid type given. String expected',
		self::INVALID_DASH            => "'%value%' appears to be a DNS hostname but contains a dash in an invalid position",
		self::INVALID_HOSTNAME        => "'%value%' does not match the expected structure for a DNS hostname",
		self::INVALID_HOSTNAME_SCHEMA => "'%value%' appears to be a DNS hostname but cannot match against hostname schema for TLD '%tld%'",
		self::INVALID_LOCAL_NAME      => "'%value%' does not appear to be a valid local network name",
		self::INVALID_URI             => "'%value%' does not appear to be a valid URI hostname",
		self::IP_ADDRESS_NOT_ALLOWED  => "'%value%' appears to be an IP address, but IP addresses are not allowed",
		self::LOCAL_NAME_NOT_ALLOWED  => "'%value%' appears to be a local network name but local network names are not allowed",
		self::UNDECIPHERABLE_TLD      => "'%value%' appears to be a DNS hostname but cannot extract TLD part",
		self::UNKNOWN_TLD             => "'%value%' appears to be a DNS hostname but cannot match TLD against known list",
	);
		/**
		 * Variable Declaration

		 * @var array
		 */
	protected $message_variables = array(
		'tld' => '_tld',
	);
		/**
				* Allows Internet domain names (e.g., example.com)
				*/
		const ALLOW_DNS = 1;
		/**
				* Allows IP addresses
				*/
		const ALLOW_IP = 2;
		/**
				* Allows local network names (e.g., localhost, www.localdomain)
				*/
		const ALLOW_LOCAL = 4;
		/**
				* Allows all types of hostnames
				*/
		const ALLOW_URI = 8;
		/**
				* Allows all types of hostnames
				*/
		const ALLOW_ALL = 15;
		/**
		 * Array of valid top-level-domains
		 *
		 * Version 2015091800, Last Updated Fri Sep 18 07:07:01 2015 UTC
		 *
		 * @see http://data.iana.org/TLD/tlds-alpha-by-domain.txt    List of all TLDs by domain
		 * @see http://www.iana.org/domains/root/db/ Official list of supported TLDs
		 * @var array
		 */
	protected $valid_tlds = array(
		'aaa',
		'abb',
		'abbott',
		'abogado',
		'ac',
		'academy',
		'accenture',
		'accountant',
		'accountants',
		'aco',
		'active',
		'actor',
		'ad',
		'ads',
		'adult',
		'ae',
		'aeg',
		'aero',
		'af',
		'afl',
		'ag',
		'agency',
		'ai',
		'aig',
		'airforce',
		'airtel',
		'al',
		'allfinanz',
		'alsace',
		'am',
		'amica',
		'amsterdam',
		'android',
		'ao',
		'apartments',
		'app',
		'aq',
		'aquarelle',
		'ar',
		'aramco',
		'archi',
		'army',
		'arpa',
		'arte',
		'as',
		'asia',
		'associates',
		'at',
		'attorney',
		'au',
		'auction',
		'audio',
		'auto',
		'autos',
		'aw',
		'ax',
		'axa',
		'az',
		'azure',
		'ba',
		'band',
		'bank',
		'bar',
		'barcelona',
		'barclaycard',
		'barclays',
		'bargains',
		'bauhaus',
		'bayern',
		'bb',
		'bbc',
		'bbva',
		'bcn',
		'bd',
		'be',
		'beer',
		'bentley',
		'berlin',
		'best',
		'bet',
		'bf',
		'bg',
		'bh',
		'bharti',
		'bi',
		'bible',
		'bid',
		'bike',
		'bing',
		'bingo',
		'bio',
		'biz',
		'bj',
		'black',
		'blackfriday',
		'bloomberg',
		'blue',
		'bm',
		'bms',
		'bmw',
		'bn',
		'bnl',
		'bnpparibas',
		'bo',
		'boats',
		'bom',
		'bond',
		'boo',
		'boots',
		'boutique',
		'br',
		'bradesco',
		'bridgestone',
		'broker',
		'brother',
		'brussels',
		'bs',
		'bt',
		'budapest',
		'build',
		'builders',
		'business',
		'buzz',
		'bv',
		'bw',
		'by',
		'bz',
		'bzh',
		'ca',
		'cab',
		'cafe',
		'cal',
		'camera',
		'camp',
		'cancerresearch',
		'canon',
		'capetown',
		'capital',
		'car',
		'caravan',
		'cards',
		'care',
		'career',
		'careers',
		'cars',
		'cartier',
		'casa',
		'cash',
		'casino',
		'cat',
		'catering',
		'cba',
		'cbn',
		'cc',
		'cd',
		'ceb',
		'center',
		'ceo',
		'cern',
		'cf',
		'cfa',
		'cfd',
		'cg',
		'ch',
		'chanel',
		'channel',
		'chat',
		'cheap',
		'chloe',
		'christmas',
		'chrome',
		'church',
		'ci',
		'cipriani',
		'cisco',
		'citic',
		'city',
		'ck',
		'cl',
		'claims',
		'cleaning',
		'click',
		'clinic',
		'clothing',
		'cloud',
		'club',
		'clubmed',
		'cm',
		'cn',
		'co',
		'coach',
		'codes',
		'coffee',
		'college',
		'cologne',
		'com',
		'commbank',
		'community',
		'company',
		'computer',
		'condos',
		'construction',
		'consulting',
		'contractors',
		'cooking',
		'cool',
		'coop',
		'corsica',
		'country',
		'coupons',
		'courses',
		'cr',
		'credit',
		'creditcard',
		'cricket',
		'crown',
		'crs',
		'cruises',
		'csc',
		'cu',
		'cuisinella',
		'cv',
		'cw',
		'cx',
		'cy',
		'cymru',
		'cyou',
		'cz',
		'dabur',
		'dad',
		'dance',
		'date',
		'dating',
		'datsun',
		'day',
		'dclk',
		'de',
		'deals',
		'degree',
		'delivery',
		'dell',
		'delta',
		'democrat',
		'dental',
		'dentist',
		'desi',
		'design',
		'dev',
		'diamonds',
		'diet',
		'digital',
		'direct',
		'directory',
		'discount',
		'dj',
		'dk',
		'dm',
		'dnp',
		'do',
		'docs',
		'dog',
		'doha',
		'domains',
		'doosan',
		'download',
		'drive',
		'durban',
		'dvag',
		'dz',
		'earth',
		'eat',
		'ec',
		'edu',
		'education',
		'ee',
		'eg',
		'email',
		'emerck',
		'energy',
		'engineer',
		'engineering',
		'enterprises',
		'epson',
		'equipment',
		'er',
		'erni',
		'es',
		'esq',
		'estate',
		'et',
		'eu',
		'eurovision',
		'eus',
		'events',
		'everbank',
		'exchange',
		'expert',
		'exposed',
		'express',
		'fage',
		'fail',
		'faith',
		'family',
		'fan',
		'fans',
		'farm',
		'fashion',
		'feedback',
		'fi',
		'film',
		'final',
		'finance',
		'financial',
		'firmdale',
		'fish',
		'fishing',
		'fit',
		'fitness',
		'fj',
		'fk',
		'flights',
		'florist',
		'flowers',
		'flsmidth',
		'fly',
		'fm',
		'fo',
		'foo',
		'football',
		'forex',
		'forsale',
		'forum',
		'foundation',
		'fr',
		'frl',
		'frogans',
		'fund',
		'furniture',
		'futbol',
		'fyi',
		'ga',
		'gal',
		'gallery',
		'game',
		'garden',
		'gb',
		'gbiz',
		'gd',
		'gdn',
		'ge',
		'gea',
		'gent',
		'genting',
		'gf',
		'gg',
		'ggee',
		'gh',
		'gi',
		'gift',
		'gifts',
		'gives',
		'giving',
		'gl',
		'glass',
		'gle',
		'global',
		'globo',
		'gm',
		'gmail',
		'gmo',
		'gmx',
		'gn',
		'gold',
		'goldpoint',
		'golf',
		'goo',
		'goog',
		'google',
		'gop',
		'gov',
		'gp',
		'gq',
		'gr',
		'graphics',
		'gratis',
		'green',
		'gripe',
		'group',
		'gs',
		'gt',
		'gu',
		'gucci',
		'guge',
		'guide',
		'guitars',
		'guru',
		'gw',
		'gy',
		'hamburg',
		'hangout',
		'haus',
		'healthcare',
		'help',
		'here',
		'hermes',
		'hiphop',
		'hitachi',
		'hiv',
		'hk',
		'hm',
		'hn',
		'hockey',
		'holdings',
		'holiday',
		'homedepot',
		'homes',
		'honda',
		'horse',
		'host',
		'hosting',
		'hoteles',
		'hotmail',
		'house',
		'how',
		'hr',
		'hsbc',
		'ht',
		'hu',
		'hyundai',
		'ibm',
		'icbc',
		'ice',
		'icu',
		'id',
		'ie',
		'ifm',
		'iinet',
		'il',
		'im',
		'immo',
		'immobilien',
		'in',
		'industries',
		'infiniti',
		'info',
		'ing',
		'ink',
		'institute',
		'insure',
		'int',
		'international',
		'investments',
		'io',
		'ipiranga',
		'iq',
		'ir',
		'irish',
		'is',
		'ist',
		'istanbul',
		'it',
		'itau',
		'iwc',
		'jaguar',
		'java',
		'jcb',
		'je',
		'jetzt',
		'jewelry',
		'jlc',
		'jll',
		'jm',
		'jo',
		'jobs',
		'joburg',
		'jp',
		'jprs',
		'juegos',
		'kaufen',
		'kddi',
		'ke',
		'kg',
		'kh',
		'ki',
		'kia',
		'kim',
		'kinder',
		'kitchen',
		'kiwi',
		'km',
		'kn',
		'koeln',
		'komatsu',
		'kp',
		'kr',
		'krd',
		'kred',
		'kw',
		'ky',
		'kyoto',
		'kz',
		'la',
		'lacaixa',
		'lancaster',
		'land',
		'landrover',
		'lasalle',
		'lat',
		'latrobe',
		'law',
		'lawyer',
		'lb',
		'lc',
		'lds',
		'lease',
		'leclerc',
		'legal',
		'lexus',
		'lgbt',
		'li',
		'liaison',
		'lidl',
		'life',
		'lighting',
		'limited',
		'limo',
		'linde',
		'link',
		'live',
		'lixil',
		'lk',
		'loan',
		'loans',
		'lol',
		'london',
		'lotte',
		'lotto',
		'love',
		'lr',
		'ls',
		'lt',
		'ltd',
		'ltda',
		'lu',
		'lupin',
		'luxe',
		'luxury',
		'lv',
		'ly',
		'ma',
		'madrid',
		'maif',
		'maison',
		'man',
		'management',
		'mango',
		'market',
		'marketing',
		'markets',
		'marriott',
		'mba',
		'mc',
		'md',
		'me',
		'media',
		'meet',
		'melbourne',
		'meme',
		'memorial',
		'men',
		'menu',
		'mg',
		'mh',
		'miami',
		'microsoft',
		'mil',
		'mini',
		'mk',
		'ml',
		'mm',
		'mma',
		'mn',
		'mo',
		'mobi',
		'moda',
		'moe',
		'moi',
		'mom',
		'monash',
		'money',
		'montblanc',
		'mormon',
		'mortgage',
		'moscow',
		'motorcycles',
		'mov',
		'movie',
		'movistar',
		'mp',
		'mq',
		'mr',
		'ms',
		'mt',
		'mtn',
		'mtpc',
		'mtr',
		'mu',
		'museum',
		'mutuelle',
		'mv',
		'mw',
		'mx',
		'my',
		'mz',
		'na',
		'nadex',
		'nagoya',
		'name',
		'navy',
		'nc',
		'ne',
		'nec',
		'net',
		'netbank',
		'network',
		'neustar',
		'new',
		'news',
		'nexus',
		'nf',
		'ng',
		'ngo',
		'nhk',
		'ni',
		'nico',
		'ninja',
		'nissan',
		'nl',
		'no',
		'nokia',
		'np',
		'nr',
		'nra',
		'nrw',
		'ntt',
		'nu',
		'nyc',
		'nz',
		'obi',
		'office',
		'okinawa',
		'om',
		'omega',
		'one',
		'ong',
		'onl',
		'online',
		'ooo',
		'oracle',
		'orange',
		'org',
		'organic',
		'osaka',
		'otsuka',
		'ovh',
		'pa',
		'page',
		'panerai',
		'paris',
		'partners',
		'parts',
		'party',
		'pe',
		'pet',
		'pf',
		'pg',
		'ph',
		'pharmacy',
		'philips',
		'photo',
		'photography',
		'photos',
		'physio',
		'piaget',
		'pics',
		'pictet',
		'pictures',
		'pink',
		'pizza',
		'pk',
		'pl',
		'place',
		'play',
		'plumbing',
		'plus',
		'pm',
		'pn',
		'pohl',
		'poker',
		'porn',
		'post',
		'pr',
		'praxi',
		'press',
		'pro',
		'prod',
		'productions',
		'prof',
		'properties',
		'property',
		'protection',
		'ps',
		'pt',
		'pub',
		'pw',
		'py',
		'qa',
		'qpon',
		'quebec',
		'racing',
		're',
		'realtor',
		'realty',
		'recipes',
		'red',
		'redstone',
		'rehab',
		'reise',
		'reisen',
		'reit',
		'ren',
		'rent',
		'rentals',
		'repair',
		'report',
		'republican',
		'rest',
		'restaurant',
		'review',
		'reviews',
		'rich',
		'ricoh',
		'rio',
		'rip',
		'ro',
		'rocks',
		'rodeo',
		'rs',
		'rsvp',
		'ru',
		'ruhr',
		'run',
		'rw',
		'rwe',
		'ryukyu',
		'sa',
		'saarland',
		'sakura',
		'sale',
		'samsung',
		'sandvik',
		'sandvikcoromant',
		'sanofi',
		'sap',
		'sarl',
		'saxo',
		'sb',
		'sc',
		'sca',
		'scb',
		'schmidt',
		'scholarships',
		'school',
		'schule',
		'schwarz',
		'science',
		'scor',
		'scot',
		'sd',
		'se',
		'seat',
		'security',
		'seek',
		'sener',
		'services',
		'seven',
		'sew',
		'sex',
		'sexy',
		'sg',
		'sh',
		'shiksha',
		'shoes',
		'show',
		'shriram',
		'si',
		'singles',
		'site',
		'sj',
		'sk',
		'ski',
		'sky',
		'skype',
		'sl',
		'sm',
		'sn',
		'sncf',
		'so',
		'soccer',
		'social',
		'software',
		'sohu',
		'solar',
		'solutions',
		'sony',
		'soy',
		'space',
		'spiegel',
		'spreadbetting',
		'sr',
		'srl',
		'st',
		'stada',
		'starhub',
		'statoil',
		'stc',
		'stcgroup',
		'stockholm',
		'studio',
		'study',
		'style',
		'su',
		'sucks',
		'supplies',
		'supply',
		'support',
		'surf',
		'surgery',
		'suzuki',
		'sv',
		'swatch',
		'swiss',
		'sx',
		'sy',
		'sydney',
		'systems',
		'sz',
		'taipei',
		'tatamotors',
		'tatar',
		'tattoo',
		'tax',
		'taxi',
		'tc',
		'td',
		'team',
		'tech',
		'technology',
		'tel',
		'telefonica',
		'temasek',
		'tennis',
		'tf',
		'tg',
		'th',
		'thd',
		'theater',
		'theatre',
		'tickets',
		'tienda',
		'tips',
		'tires',
		'tirol',
		'tj',
		'tk',
		'tl',
		'tm',
		'tn',
		'to',
		'today',
		'tokyo',
		'tools',
		'top',
		'toray',
		'toshiba',
		'tours',
		'town',
		'toyota',
		'toys',
		'tr',
		'trade',
		'trading',
		'training',
		'travel',
		'trust',
		'tt',
		'tui',
		'tv',
		'tw',
		'tz',
		'ua',
		'ubs',
		'ug',
		'uk',
		'university',
		'uno',
		'uol',
		'us',
		'uy',
		'uz',
		'va',
		'vacations',
		'vc',
		've',
		'vegas',
		'ventures',
		'versicherung',
		'vet',
		'vg',
		'vi',
		'viajes',
		'video',
		'villas',
		'vin',
		'virgin',
		'vision',
		'vista',
		'vistaprint',
		'viva',
		'vlaanderen',
		'vn',
		'vodka',
		'vote',
		'voting',
		'voto',
		'voyage',
		'vu',
		'wales',
		'walter',
		'wang',
		'watch',
		'webcam',
		'website',
		'wed',
		'wedding',
		'weir',
		'wf',
		'whoswho',
		'wien',
		'wiki',
		'williamhill',
		'win',
		'windows',
		'wine',
		'wme',
		'work',
		'works',
		'world',
		'ws',
		'wtc',
		'wtf',
		'xbox',
		'xerox',
		'xin',
		'xn--11b4c3d',
		'xn--1qqw23a',
		'xn--30rr7y',
		'xn--3bst00m',
		'xn--3ds443g',
		'xn--3e0b707e',
		'xn--3pxu8k',
		'xn--42c2d9a',
		'xn--45brj9c',
		'xn--45q11c',
		'xn--4gbrim',
		'xn--55qw42g',
		'xn--55qx5d',
		'xn--6frz82g',
		'xn--6qq986b3xl',
		'xn--80adxhks',
		'xn--80ao21a',
		'xn--80asehdb',
		'xn--80aswg',
		'xn--90a3ac',
		'xn--90ais',
		'xn--9dbq2a',
		'xn--9et52u',
		'xn--b4w605ferd',
		'xn--c1avg',
		'xn--c2br7g',
		'xn--cg4bki',
		'xn--clchc0ea0b2g2a9gcd',
		'xn--czr694b',
		'xn--czrs0t',
		'xn--czru2d',
		'xn--d1acj3b',
		'xn--d1alf',
		'xn--efvy88h',
		'xn--estv75g',
		'xn--fhbei',
		'xn--fiq228c5hs',
		'xn--fiq64b',
		'xn--fiqs8s',
		'xn--fiqz9s',
		'xn--fjq720a',
		'xn--flw351e',
		'xn--fpcrj9c3d',
		'xn--fzc2c9e2c',
		'xn--gecrj9c',
		'xn--h2brj9c',
		'xn--hxt814e',
		'xn--i1b6b1a6a2e',
		'xn--imr513n',
		'xn--io0a7i',
		'xn--j1aef',
		'xn--j1amh',
		'xn--j6w193g',
		'xn--kcrx77d1x4a',
		'xn--kprw13d',
		'xn--kpry57d',
		'xn--kput3i',
		'xn--l1acc',
		'xn--lgbbat1ad8j',
		'xn--mgb9awbf',
		'xn--mgba3a3ejt',
		'xn--mgba3a4f16a',
		'xn--mgbaam7a8h',
		'xn--mgbab2bd',
		'xn--mgbayh7gpa',
		'xn--mgbbh1a71e',
		'xn--mgbc0a9azcg',
		'xn--mgberp4a5d4ar',
		'xn--mgbpl2fh',
		'xn--mgbx4cd0ab',
		'xn--mk1bu44c',
		'xn--mxtq1m',
		'xn--ngbc5azd',
		'xn--node',
		'xn--nqv7f',
		'xn--nqv7fs00ema',
		'xn--nyqy26a',
		'xn--o3cw4h',
		'xn--ogbpf8fl',
		'xn--p1acf',
		'xn--p1ai',
		'xn--pgbs0dh',
		'xn--pssy2u',
		'xn--q9jyb4c',
		'xn--qcka1pmc',
		'xn--rhqv96g',
		'xn--s9brj9c',
		'xn--ses554g',
		'xn--t60b56a',
		'xn--tckwe',
		'xn--unup4y',
		'xn--vermgensberater-ctb',
		'xn--vermgensberatung-pwb',
		'xn--vhquv',
		'xn--vuq861b',
		'xn--wgbh1c',
		'xn--wgbl6a',
		'xn--xhq521b',
		'xn--xkc2al3hye2a',
		'xn--xkc2dl3a5ee0h',
		'xn--y9a3aq',
		'xn--yfro4i67o',
		'xn--ygbi2ammx',
		'xn--zfr164b',
		'xperia',
		'xxx',
		'xyz',
		'yachts',
		'yamaxun',
		'yandex',
		'ye',
		'yodobashi',
		'yoga',
		'yokohama',
		'youtube',
		'yt',
		'za',
		'zara',
		'zip',
		'zm',
		'zone',
		'zuerich',
		'zw',
		'测试',
		'परीक��?षा',
		'佛山',
		'集团',
		'在线',
		'한국',
		'ভারত',
		'八�?�',
		'موقع',
		'বাংলা',
		'公益',
		'公�?�',
		'移动',
		'我爱你',
		'мо�?ква',
		'и�?пытание',
		'қаз',
		'онлайн',
		'�?айт',
		'�?рб',
		'бел',
		'테스트',
		'орг',
		'삼성',
		'சிங��?கப��?பூர��?',
		'商标',
		'商城',
		'дети',
		'мкд',
		'טעסט',
		'中文网',
		'中信',
		'中国',
		'中國',
		'谷歌',
		'భారత��?',
		'ලංක��?',
		'測試',
		'ભારત',
		'भारत',
		'آزمایشی',
		'பரிட��?சை',
		'संगठन',
		'网络',
		'укр',
		'香港',
		'δοκιμή',
		'إختبار',
		'�?�湾',
		'�?��?�',
		'手机',
		'мон',
		'الجزائر',
		'عمان',
		'ایران',
		'امارات',
		'بازار',
		'پاکستان',
		'الاردن',
		'بھارت',
		'المغرب',
		'السعودية',
		'سودان',
		'عراق',
		'مليسيا',
		'شبكة',
		'გე',
		'机构',
		'组织机构',
		'ไทย',
		'سورية',
		'ру�?',
		'рф',
		'تونس',
		'�?�ん�?�',
		'グーグル',
		'世界',
		'ਭਾਰਤ',
		'网�?�',
		'游��?',
		'vermögensberater',
		'vermögensberatung',
		'��?业',
		'مصر',
		'قطر',
		'广东',
		'இலங��?கை',
		'இந��?தியா',
		'հայ',
		'新加�?�',
		'�?لسطين',
		'テスト',
		'政务',
	);
		/** Tld Declaration.

		 * @var string
		 */
	protected $_tld;
		/**
		 * Array for valid Idns
		 *
		 * @see http://www.iana.org/domains/idn-tables/ Official list of supported IDN Chars
		 * (.AC) Ascension Island http://www.nic.ac/pdf/AC-IDN-Policy.pdf
		 * (.AR) Argentinia http://www.nic.ar/faqidn.html
		 * (.AS) American Samoa http://www.nic.as/idn/chars.cfm
		 * (.AT) Austria http://www.nic.at/en/service/technical_information/idn/charset_converter/
		 * (.BIZ) International http://www.iana.org/domains/idn-tables/
		 * (.BR) Brazil http://registro.br/faq/faq6.html
		 * (.BV) Bouvett Island http://www.norid.no/domeneregistrering/idn/idn_nyetegn.en.html
		 * (.CA) Canada http://www.iana.org/domains/idn-tables/tables/ca_fr_1.0.html
		 * (.CAT) Catalan http://www.iana.org/domains/idn-tables/tables/cat_ca_1.0.html
		 * (.CH) Switzerland https://nic.switch.ch/reg/ocView.action?res=EF6GW2JBPVTG67DLNIQXU234MN6SC33JNQQGI7L6#anhang1
		 * (.CL) Chile http://www.iana.org/domains/idn-tables/tables/cl_latn_1.0.html
		 * (.COM) International http://www.verisign.com/information-services/naming-services/internationalized-domain-names/index.html
		 * (.DE) Germany http://www.denic.de/en/domains/idns/liste.html
		 * (.DK) Danmark http://www.dk-hostmaster.dk/index.php?id=151
		 * (.ES) Spain https://www.nic.es/media/2008-05/1210147705287.pdf
		 * (.FI) Finland http://www.ficora.fi/en/index/palvelut/fiverkkotunnukset/aakkostenkaytto.html
		 * (.GR) Greece https://grweb.ics.forth.gr/CharacterTable1_en.jsp
		 * (.HU) Hungary http://www.domain.hu/domain/English/szabalyzat/szabalyzat.html
		 * (.INFO) International http://www.nic.info/info/idn
		 * (.IO) British Indian Ocean Territory http://www.nic.io/IO-IDN-Policy.pdf
		 * (.IR) Iran http://www.nic.ir/Allowable_Characters_dot-iran
		 * (.IS) Iceland http://www.isnic.is/domain/rules.php
		 * (.KR) Korea http://www.iana.org/domains/idn-tables/tables/kr_ko-kr_1.0.html
		 * (.LI) Liechtenstein https://nic.switch.ch/reg/ocView.action?res=EF6GW2JBPVTG67DLNIQXU234MN6SC33JNQQGI7L6#anhang1
		 * (.LT) Lithuania http://www.domreg.lt/static/doc/public/idn_symbols-en.pdf
		 * (.MD) Moldova http://www.register.md/
		 * (.MUSEUM) International http://www.iana.org/domains/idn-tables/tables/museum_latn_1.0.html
		 * (.NET) International http://www.verisign.com/information-services/naming-services/internationalized-domain-names/index.html
		 * (.NO) Norway http://www.norid.no/domeneregistrering/idn/idn_nyetegn.en.html
		 * (.NU) Niue http://www.worldnames.net/
		 * (.ORG) International http://www.pir.org/index.php?db=content/FAQs&tbl=FAQs_Registrant&id=2
		 * (.PE) Peru https://www.nic.pe/nuevas_politicas_faq_2.php
		 * (.PL) Poland http://www.dns.pl/IDN/allowed_character_sets.pdf
		 * (.PR) Puerto Rico http://www.nic.pr/idn_rules.asp
		 * (.PT) Portugal https://online.dns.pt/dns_2008/do?com=DS;8216320233;111;+PAGE(4000058)+K-CAT-CODIGO(C.125)+RCNT(100);
		 * (.RU) Russia http://www.iana.org/domains/idn-tables/tables/ru_ru-ru_1.0.html
		 * (.RS) Serbia http://www.iana.org/domains/idn-tables/tables/rs_sr-rs_1.0.pdf
		 * (.SA) Saudi Arabia http://www.iana.org/domains/idn-tables/tables/sa_ar_1.0.html
		 * (.SE) Sweden http://www.iis.se/english/IDN_campaignsite.shtml?lang=en
		 * (.SH) Saint Helena http://www.nic.sh/SH-IDN-Policy.pdf
		 * (.SJ) Svalbard and Jan Mayen http://www.norid.no/domeneregistrering/idn/idn_nyetegn.en.html
		 * (.TH) Thailand http://www.iana.org/domains/idn-tables/tables/th_th-th_1.0.html
		 * (.TM) Turkmenistan http://www.nic.tm/TM-IDN-Policy.pdf
		 * (.TR) Turkey https://www.nic.tr/index.php
		 * (.UA) Ukraine http://www.iana.org/domains/idn-tables/tables/ua_cyrl_1.2.html
		 * (.VE) Venice http://www.iana.org/domains/idn-tables/tables/ve_es_1.0.html
		 * (.VN) Vietnam http://www.vnnic.vn/english/5-6-300-2-2-04-20071115.htm#1.%20Introduction
		 *
		 * @var array
		 */
	protected $valid_idns = array(
		'AC'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿ�?ăąćĉċ�?�?đēėęě�?ġģĥħīįĵķĺļľŀłńņňŋőœŕŗřś�?şšţťŧūŭůűųŵŷźżž]{1,63}$/iu' ),
		'AR'       => array( 1 => '/^[\x{002d}0-9a-zà-ãç-êìíñ-õü]{1,63}$/iu' ),
		'AS'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿ�?ăąćĉċ�?�?đēĕėęě�?ğġģĥħĩīĭįıĵķĸĺļľłńņňŋ�?�?őœŕŗřś�?şšţťŧũūŭůűųŵŷźż]{1,63}$/iu' ),
		'AT'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿœšž]{1,63}$/iu' ),
		'BIZ'      => 'hostname/biz.php',
		'BR'       => array( 1 => '/^[\x{002d}0-9a-zà-ãçéíó-õúü]{1,63}$/iu' ),
		'BV'       => array( 1 => '/^[\x{002d}0-9a-zàáä-éêñ-ôöøü�?đńŋšŧž]{1,63}$/iu' ),
		'CA'       => array( 1 => '/^[\x{002d}0-9a-zàâæçéèêëîïôœùûüÿ\x{00E0}\x{00E2}\x{00E7}\x{00E8}\x{00E9}\x{00EA}\x{00EB}\x{00EE}\x{00EF}\x{00F4}\x{00F9}\x{00FB}\x{00FC}\x{00E6}\x{0153}\x{00FF}]{1,63}$/iu' ),
		'CAT'      => array( 1 => '/^[\x{002d}0-9a-z·àç-éíïòóúü]{1,63}$/iu' ),
		'CH'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿœ]{1,63}$/iu' ),
		'CL'       => array( 1 => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu' ),
		'CN'       => 'hostname/cn.php',
		'COM'      => 'hostname/com.php',
		'DE'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿăą�?ćĉ�?ċ�?đĕěėęēğ�?ġģĥħĭĩįīıĵķĺľļłńňņŋ�?ő�?œĸŕřŗś�?šşťßţŧŭůűũųūŵŷźžż]{1,63}$/iu' ),
		'DK'       => array( 1 => '/^[\x{002d}0-9a-zäéöüæøå]{1,63}$/iu' ),
		'ES'       => array( 1 => '/^[\x{002d}0-9a-zàáçèéíïñòóúü·]{1,63}$/iu' ),
		'EU'       => array(
			1 => '/^[\x{002d}0-9a-zà-öø-ÿ]{1,63}$/iu',
			2 => '/^[\x{002d}0-9a-z�?ăąćĉċ�?�?đēĕėęě�?ğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋ�?�?őœŕŗřś�?šťŧũūŭůűųŵŷźżž]{1,63}$/iu',
			3 => '/^[\x{002d}0-9a-zșț]{1,63}$/iu',
			4 => '/^[\x{002d}0-9a-z�?άέήίΰαβγδεζηθικλμνξοπ�?ςστυφχψωϊϋό�?ώ]{1,63}$/iu',
			5 => '/^[\x{002d}0-9a-zабвгдежзийклмнопр�?туфхцчшщъыь�?ю�?]{1,63}$/iu',
			6 => '/^[\x{002d}0-9a-zἀ-ἇ��?-ἕἠ-ἧἰ-ἷὀ-ὅ��?-ὗὠ-ὧὰ-ὼώᾀ-ᾇ��?-ᾗᾠ-ᾧᾰ-ᾴᾶᾷῂῃῄῆῇ��?-ῒ�?ῖῗῠ-ῧῲῳῴῶῷ]{1,63}$/iu',
		),
		'FI'       => array( 1 => '/^[\x{002d}0-9a-zäåö]{1,63}$/iu' ),
		'GR'       => array( 1 => '/^[\x{002d}0-9a-zΆΈΉΊΌΎ-ΡΣ-ώἀ-ἕἘ-��?ἠ-ὅὈ-��?��?-ὗὙὛ��?Ὗ-ώᾀ-ᾴᾶ-ᾼῂῃῄῆ-ῌ��?-ΐῖ-Ίῠ-Ῥῲῳῴῶ-ῼ]{1,63}$/iu' ),
		'HK'       => 'hostname/cn.php',
		'HU'       => array( 1 => '/^[\x{002d}0-9a-záéíóöúüőű]{1,63}$/iu' ),
		'IL'       => array(
			1 => '/^[\x{002d}0-9\x{05D0}-\x{05EA}]{1,63}$/iu',
			2 => '/^[\x{002d}0-9a-z]{1,63}$/i',
		),
		'INFO'     => array(
			1 => '/^[\x{002d}0-9a-zäåæéöøü]{1,63}$/iu',
			2 => '/^[\x{002d}0-9a-záéíóöúüőű]{1,63}$/iu',
			3 => '/^[\x{002d}0-9a-záæéíðóöúýþ]{1,63}$/iu',
			4 => '/^[\x{AC00}-\x{D7A3}]{1,17}$/iu',
			5 => '/^[\x{002d}0-9a-z�?�?ēģīķļņ�?ŗšūž]{1,63}$/iu',
			6 => '/^[\x{002d}0-9a-zą�?ėęįšūųž]{1,63}$/iu',
			7 => '/^[\x{002d}0-9a-zóąćęłńśźż]{1,63}$/iu',
			8 => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu',
		),
		'IO'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿăą�?ćĉ�?ċ�?đĕěėęēğ�?ġģĥħĭĩįīıĵķĺľļłńňņŋ�?ő�?œĸŕřŗś�?šşťţŧŭůűũųūŵŷźžż]{1,63}$/iu' ),
		'IS'       => array( 1 => '/^[\x{002d}0-9a-záéýúíóþæöð]{1,63}$/iu' ),
		'IT'       => array( 1 => '/^[\x{002d}0-9a-zàâäèéêëìîïòôöùûüæœçÿß-]{1,63}$/iu' ),
		'JP'       => 'hostname/jp.php',
		'KR'       => array( 1 => '/^[\x{AC00}-\x{D7A3}]{1,17}$/iu' ),
		'LI'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿœ]{1,63}$/iu' ),
		'LT'       => array( 1 => '/^[\x{002d}0-9ą�?ęėįšųūž]{1,63}$/iu' ),
		'MD'       => array( 1 => '/^[\x{002d}0-9ăâîşţ]{1,63}$/iu' ),
		'MUSEUM'   => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿ�?ăąćċ�?�?đēėęěğġģħīįıķĺļľłńņňŋ�?őœŕŗřśşšţťŧūůűųŵŷźżžǎ�?ǒǔ\x{01E5}\x{01E7}\x{01E9}\x{01EF}ə\x{0292}��?ẃẅỳ]{1,63}$/iu' ),
		'NET'      => 'hostname/com.php',
		'NO'       => array( 1 => '/^[\x{002d}0-9a-zàáä-éêñ-ôöøü�?đńŋšŧž]{1,63}$/iu' ),
		'NU'       => 'hostname/com.php',
		'ORG'      => array(
			1 => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu',
			2 => '/^[\x{002d}0-9a-zóąćęłńśźż]{1,63}$/iu',
			3 => '/^[\x{002d}0-9a-záäåæéëíðóöøúüýþ]{1,63}$/iu',
			4 => '/^[\x{002d}0-9a-záéíóöúüőű]{1,63}$/iu',
			5 => '/^[\x{002d}0-9a-zą�?ėęįšūųž]{1,63}$/iu',
			6 => '/^[\x{AC00}-\x{D7A3}]{1,17}$/iu',
			7 => '/^[\x{002d}0-9a-z�?�?ēģīķļņ�?ŗšūž]{1,63}$/iu',
		),
		'PE'       => array( 1 => '/^[\x{002d}0-9a-zñáéíóúü]{1,63}$/iu' ),
		'PL'       => array(
			1  => '/^[\x{002d}0-9a-z�?�?ēģīķļņ�?ŗšūž]{1,63}$/iu',
			2  => '/^[\x{002d}а-ик-ш\x{0450}ѓѕјљњќџ]{1,63}$/iu',
			3  => '/^[\x{002d}0-9a-zâîăşţ]{1,63}$/iu',
			4  => '/^[\x{002d}0-9а-�?ё\x{04C2}]{1,63}$/iu',
			5  => '/^[\x{002d}0-9a-zàáâèéêìíîòóôùúûċġħż]{1,63}$/iu',
			6  => '/^[\x{002d}0-9a-zàäåæéêòóôöøü]{1,63}$/iu',
			7  => '/^[\x{002d}0-9a-zóąćęłńśźż]{1,63}$/iu',
			8  => '/^[\x{002d}0-9a-zàáâãçéêíòóôõúü]{1,63}$/iu',
			9  => '/^[\x{002d}0-9a-zâîăşţ]{1,63}$/iu',
			10 => '/^[\x{002d}0-9a-záäéíóôúý�?�?ĺľňŕšťž]{1,63}$/iu',
			11 => '/^[\x{002d}0-9a-zçë]{1,63}$/iu',
			12 => '/^[\x{002d}0-9а-ик-шђјљњћџ]{1,63}$/iu',
			13 => '/^[\x{002d}0-9a-zć�?đšž]{1,63}$/iu',
			14 => '/^[\x{002d}0-9a-zâçöûüğış]{1,63}$/iu',
			15 => '/^[\x{002d}0-9a-záéíñóúü]{1,63}$/iu',
			16 => '/^[\x{002d}0-9a-zäõöüšž]{1,63}$/iu',
			17 => '/^[\x{002d}0-9a-zĉ�?ĥĵ�?ŭ]{1,63}$/iu',
			18 => '/^[\x{002d}0-9a-zâäéëîô]{1,63}$/iu',
			19 => '/^[\x{002d}0-9a-zàáâäåæçèéêëìíîïðñòôöøùúûüýć�?łńřśš]{1,63}$/iu',
			20 => '/^[\x{002d}0-9a-zäåæõöøüšž]{1,63}$/iu',
			21 => '/^[\x{002d}0-9a-zàáçèéìíòóùú]{1,63}$/iu',
			22 => '/^[\x{002d}0-9a-zàáéíóöúüőű]{1,63}$/iu',
			23 => '/^[\x{002d}0-9�?ά-ώ]{1,63}$/iu',
			24 => '/^[\x{002d}0-9a-zàáâåæçèéêëðóôöøüþœ]{1,63}$/iu',
			25 => '/^[\x{002d}0-9a-záäéíóöúüý�?�?ěňřšťůž]{1,63}$/iu',
			26 => '/^[\x{002d}0-9a-z·àçèéíïòóúü]{1,63}$/iu',
			27 => '/^[\x{002d}0-9а-ъью�?\x{0450}\x{045D}]{1,63}$/iu',
			28 => '/^[\x{002d}0-9а-�?ёіў]{1,63}$/iu',
			29 => '/^[\x{002d}0-9a-zą�?ėęįšūųž]{1,63}$/iu',
			30 => '/^[\x{002d}0-9a-záäåæéëíðóöøúüýþ]{1,63}$/iu',
			31 => '/^[\x{002d}0-9a-zàâæçèéêëîïñôùûüÿœ]{1,63}$/iu',
			32 => '/^[\x{002d}0-9а-щъыь�?ю�?ёєіїґ]{1,63}$/iu',
			33 => '/^[\x{002d}0-9�?-ת]{1,63}$/iu',
		),
		'PR'       => array( 1 => '/^[\x{002d}0-9a-záéíóúñäëïüöâêîôûàèùæçœãõ]{1,63}$/iu' ),
		'PT'       => array( 1 => '/^[\x{002d}0-9a-záàâãçéêíóôõú]{1,63}$/iu' ),
		'RS'       => array( 1 => '/^[\x{002D}\x{0030}-\x{0039}\x{0061}-\x{007A}\x{0107}\x{010D}\x{0111}\x{0161}\x{017E}]{1,63}$/iu)' ),
		'RU'       => array( 1 => '/^[\x{002d}0-9а-�?ё]{1,63}$/iu' ),
		'SA'       => array( 1 => '/^[\x{002d}.0-9\x{0621}-\x{063A}\x{0641}-\x{064A}\x{0660}-\x{0669}]{1,63}$/iu' ),
		'SE'       => array( 1 => '/^[\x{002d}0-9a-zäåéöü]{1,63}$/iu' ),
		'SH'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿăą�?ćĉ�?ċ�?đĕěėęēğ�?ġģĥħĭĩįīıĵķĺľļłńňņŋ�?ő�?œĸŕřŗś�?šşťţŧŭůűũųūŵŷźžż]{1,63}$/iu' ),
		'SI'       => array(
			1 => '/^[\x{002d}0-9a-zà-öø-ÿ]{1,63}$/iu',
			2 => '/^[\x{002d}0-9a-z�?ăąćĉċ�?�?đēĕėęě�?ğġģĥħĩīĭįıĵķĺļľŀłńņňŉŋ�?�?őœŕŗřś�?šťŧũūŭůűųŵŷźżž]{1,63}$/iu',
			3 => '/^[\x{002d}0-9a-zșț]{1,63}$/iu',
		),
		'SJ'       => array( 1 => '/^[\x{002d}0-9a-zàáä-éêñ-ôöøü�?đńŋšŧž]{1,63}$/iu' ),
		'TH'       => array( 1 => '/^[\x{002d}0-9a-z\x{0E01}-\x{0E3A}\x{0E40}-\x{0E4D}\x{0E50}-\x{0E59}]{1,63}$/iu' ),
		'TM'       => array( 1 => '/^[\x{002d}0-9a-zà-öø-ÿ�?ăąćĉċ�?�?đēėęě�?ġģĥħīįĵķĺļľŀłńņňŋőœŕŗřś�?şšţťŧūŭůűųŵŷźżž]{1,63}$/iu' ),
		'TW'       => 'hostname/cn.php',
		'TR'       => array( 1 => '/^[\x{002d}0-9a-zğıüşöç]{1,63}$/iu' ),
		'UA'       => array( 1 => '/^[\x{002d}0-9a-zабвгдежзийклмнопр�?туфхцчшщъыь�?ю�?�?ёђѓєѕіїјљњћќ�?ўџґӂʼ]{1,63}$/iu' ),
		'VE'       => array( 1 => '/^[\x{002d}0-9a-záéíóúüñ]{1,63}$/iu' ),
		'VN'       => array( 1 => '/^[À�?ÂÃÈÉÊÌ�?ÒÓÔÕÙÚ�?àáâãèéêìíòóôõùúýĂă�?đĨĩŨũƠơƯư\x{1EA0}-\x{1EF9}]{1,63}$/iu' ),
		'мон'      => array( 1 => '/^[\x{002d}0-9\x{0430}-\x{044F}]{1,63}$/iu' ),
		'�?рб'     => array( 1 => '/^[\x{002d}0-9а-ик-шђјљњћџ]{1,63}$/iu' ),
		'�?айт'    => array( 1 => '/^[\x{002d}0-9а-�?ёії�?йўґг]{1,63}$/iu' ),
		'онлайн'   => array( 1 => '/^[\x{002d}0-9а-�?ёії�?йўґг]{1,63}$/iu' ),
		'中国'       => 'hostname/cn.php',
		'中國'       => 'hostname/cn.php',
		'ලංක��?'   => array( 1 => '/^[\x{0d80}-\x{0dff}]{1,63}$/iu' ),
		'香港'       => 'hostname/cn.php',
		'�?�湾'     => 'hostname/cn.php',
		'�?��?�'   => 'hostname/cn.php',
		'امارات'   => array( 1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu' ),
		'الاردن'   => array( 1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu' ),
		'السعودية' => array( 1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu' ),
		'ไทย'      => array( 1 => '/^[\x{002d}0-9a-z\x{0E01}-\x{0E3A}\x{0E40}-\x{0E4D}\x{0E50}-\x{0E59}]{1,63}$/iu' ),
		'рф'       => array( 1 => '/^[\x{002d}0-9а-�?ё]{1,63}$/iu' ),
		'تونس'     => array( 1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu' ),
		'مصر'      => array( 1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu' ),
		'இலங��?கை' => array( 1 => '/^[\x{0b80}-\x{0bff}]{1,63}$/iu' ),
		'�?لسطين'  => array( 1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu' ),
		'شبكة'     => array( 1 => '/^[\x{0621}-\x{0624}\x{0626}-\x{063A}\x{0641}\x{0642}\x{0644}-\x{0648}\x{067E}\x{0686}\x{0698}\x{06A9}\x{06AF}\x{06CC}\x{06F0}-\x{06F9}]{1,30}$/iu' ),
	);
	/** Idn Length Declaration.

	 * @var array
	 */
	protected $idn_length = array(
		'BIZ'   => array(
			5  => 17,
			11 => 15,
			12 => 20,
		),
		'CN'    => array( 1 => 20 ),
		'COM'   => array(
			3 => 17,
			5 => 20,
		),
		'HK'    => array( 1 => 15 ),
		'INFO'  => array( 4 => 17 ),
		'KR'    => array( 1 => 17 ),
		'NET'   => array(
			3 => 17,
			5 => 20,
		),
		'ORG'   => array( 6 => 17 ),
		'TW'    => array( 1 => 20 ),
		'ایران' => array( 1 => 30 ),
		'中国'    => array( 1 => 20 ),
		'公�?�'  => array( 1 => 20 ),
		'网络'    => array( 1 => 20 ),
	);
	/** Options Declaration.

	 * @var array
	 */
	protected $_options = array(
		'allow' => self::ALLOW_DNS,
		'idn'   => true,
		'tld'   => true,
		'ip'    => null,
	);
		/**
		 * Sets validator options
		 *
		 * @see   http://www.iana.org/cctld/specifications-policies-cctlds-01apr02.htm Technical Specifications for ccTLDs
		 * @param array $options Validator options.
		 */
	public function __construct( $options = array() ) {
		if ( $options instanceof Mail_Bank_Zend_Config ) {
				$options = $options->toArray();
		} elseif ( ! is_array( $options ) ) {
				$options       = func_get_args();
				$temp['allow'] = array_shift( $options );
			if ( ! empty( $options ) ) {
					$temp['idn'] = array_shift( $options );
			}

			if ( ! empty( $options ) ) {
					$temp['tld'] = array_shift( $options );
			}

			if ( ! empty( $options ) ) {
					$temp['ip'] = array_shift( $options );
			}

				$options = $temp;
		}

			$options += $this->_options;
			$this->setOptions( $options );
	}
		/**
		 * Returns all set options
		 *
		 * @return array
		 */
	public function getOptions() {
			return $this->_options;
	}
		/**
		 * Sets the options for this validator
		 *
		 * @param  array $options MANDATORY.
		 * @return Mail_Bank_Zend_Validate_Hostname
		 */
	public function setOptions( $options ) {
		if ( array_key_exists( 'allow', $options ) ) {
				$this->setAllow( $options['allow'] );
		}

		if ( array_key_exists( 'idn', $options ) ) {
				$this->setValidateIdn( $options['idn'] );
		}

		if ( array_key_exists( 'tld', $options ) ) {
				$this->setValidateTld( $options['tld'] );
		}

		if ( array_key_exists( 'ip', $options ) ) {
				$this->setIpValidator( $options['ip'] );
		}

			return $this;
	}
		/**
		 * Returns the set ip validator
		 *
		 * @return Mail_Bank_Zend_Validate_Ip
		 */
	public function getIpValidator() {
			return $this->_options['ip'];
	}
		/** Function to Set IP Validator.

		 * @param Mail_Bank_Zend_Validate_Ip $ip_validator OPTIONAL.
		 * @return Mail_Bank_Zend_Validate_Hostname
		 */
	public function setIpValidator( Mail_Bank_Zend_Validate_Ip $ip_validator = null ) {
		if ( null === $ip_validator ) {
				$ip_validator = new Mail_Bank_Zend_Validate_Ip();
		}

			$this->_options['ip'] = $ip_validator;
			return $this;
	}
		/**
		 * Returns the allow option
		 *
		 * @return integer
		 */
	public function getAllow() {
			return $this->_options['allow'];
	}
		/**
		 * Sets the allow option
		 *
		 * @param  integer $allow MANDATORY.
		 * @return Mail_Bank_Zend_Validate_Hostname Provides a fluent interface
		 */
	public function setAllow( $allow ) {
			$this->_options['allow'] = $allow;
			return $this;
	}
		/**
		 * Returns the set idn option
		 *
		 * @return boolean
		 */
	public function getValidateIdn() {
			return $this->_options['idn'];
	}
		/**
		 * Set whether IDN domains are validated
		 *
		 * This only applies when DNS hostnames are validated
		 *
		 * @param  boolean $allowed Set allowed to true to validate IDNs, and false to not validate them.
		 * @return $this
		 */
	public function setValidateIdn( $allowed ) {
			$this->_options['idn'] = (bool) $allowed;
			return $this;
	}
		/**
		 * Returns the set tld option
		 *
		 * @return boolean
		 */
	public function getValidateTld() {
			return $this->_options['tld'];
	}
		/**
		 * Set whether the TLD element of a hostname is validated
		 *
		 * This only applies when DNS hostnames are validated
		 *
		 * @param  boolean $allowed Set allowed to true to validate TLDs, and false to not validate them.
		 * @return $this
		 */
	public function setValidateTld( $allowed ) {
			$this->_options['tld'] = (bool) $allowed;
			return $this;
	}
		/**
		 * Defined by Mail_Bank_Zend_Validate_Interface
		 *
		 * Returns true if and only if the $value is a valid hostname with respect to the current allow option
		 *
		 * @param  string $value MANDATORY.
		 * @throws Mail_Bank_Zend_Validate_Exception If a fatal error occurs for validation process.
		 * @return boolean
		 */
	public function is_valid( $value ) {
		if ( ! is_string( $value ) ) {
				$this->_error( self::INVALID );
				return false;
		}

			$this->set_value( $value );
			// Check input against IP address schema.
		if ( preg_match( '/^[0-9a-f:.]*$/i', $value )
					&& $this->_options['ip']->setTranslator( $this->getTranslator() )->is_valid( $value )
			) {
			if ( ! ( $this->_options['allow'] & self::ALLOW_IP ) ) {
					$this->_error( self::IP_ADDRESS_NOT_ALLOWED );
					return false;
			} else {
					return true;
			}
		}

			// RFC3986 3.2.2 states:
			//
			// The rightmost domain label of a fully qualified domain name
			// in DNS may be followed by a single "." and should be if it is
			// necessary to distinguish between the complete domain name and
			// some local domain.
			//
			// (see ZF-6363)
			// Local hostnames are allowed to be partitial (ending '.').
		if ( $this->_options['allow'] & self::ALLOW_LOCAL ) {
			if ( substr( $value, -1 ) === '.' ) {
					$value = substr( $value, 0, -1 );
				if ( substr( $value, -1 ) === '.' ) {
						// Empty hostnames (ending '..') are not allowed.
						$this->_error( self::INVALID_LOCAL_NAME );
						return false;
				}
			}
		}

			$domain_parts = explode( '.', $value );

			// Prevent partitial IP V4 adresses (ending '.').
		if ( ( 4 === count( $domain_parts ) ) && preg_match( '/^[0-9.a-e:.]*$/i', $value )
					&& $this->_options['ip']->setTranslator( $this->getTranslator() )->is_valid( $value )
			) {
				$this->_error( self::INVALID_LOCAL_NAME );
		}

			// Check input against DNS hostname schema.
		if ( ( count( $domain_parts ) > 1 ) && ( strlen( $value ) >= 4 ) && ( strlen( $value ) <= 254 ) ) {
				$status  = false;
				$origenc = 'UTF-8';
			if ( function_exists( 'iconv_get_encoding' ) ) {
					$origenc = PHP_VERSION_ID < 50600 ? iconv_get_encoding( 'internal_encoding' ) : ini_get( 'default_charset' );
			}

			if ( PHP_VERSION_ID < 50600 ) {
				if ( function_exists( 'iconv_get_encoding' ) ) {
						iconv_set_encoding( 'internal_encoding', 'UTF-8' );
				}
			} else {
					ini_set( 'default_charset', 'UTF-8' );
			}
			do {
					// First check TLD.
					$matches = array();
				if ( preg_match( '/([^.]{2,63})$/iu', end( $domain_parts ), $matches ) || ( array_key_exists( end( $domain_parts ), $this->valid_idns ) ) ) {
						reset( $domain_parts );

						// Hostname characters are: *(label dot)(label dot label); max 254 chars
						// label: id-prefix [*ldh{61} id-prefix]; max 63 chars
						// id-prefix: alpha / digit
						// ldh: alpha / digit / dash
						// Match TLD against known list.
						$this->_tld = $matches[1];
					if ( $this->_options['tld'] ) {
						if ( ! in_array( strtolower( $this->_tld ), $this->valid_tlds, true ) && ! in_array( $this->_tld, $this->valid_tlds, true ) ) {
								$this->_error( self::UNKNOWN_TLD );
								$status = false;
								break;
						}
							// We have already validated that the TLD is fine. We don't want it to go through the below
							// checks as new UTF-8 TLDs will incorrectly fail if there is no IDN regex for it.
							array_pop( $domain_parts );
					}

						/**
																* Match against IDN hostnames
																* Note: Keep label regex short to avoid issues with long patterns when matching IDN hostnames
																*
																* @see Mail_Bank_Zend_Validate_Hostname_Interface
																*/
						$regex_chars = array( 0 => '/^[a-z0-9\x2d]{1,63}$/i' );
					if ( $this->_options['idn'] && isset( $this->valid_idns[ strtoupper( $this->_tld ) ] ) ) {
						if ( is_string( $this->valid_idns[ strtoupper( $this->_tld ) ] ) ) {
								$regex_chars += include $this->valid_idns[ strtoupper( $this->_tld ) ];
						} else {
								$regex_chars += $this->valid_idns[ strtoupper( $this->_tld ) ];
						}
					}

						// Check each hostname part.
						$check = 0;
					foreach ( $domain_parts as $domain_part ) {
							// If some domain part is empty (i.e. zend..com), it's invalid.
						if ( empty( $domain_part ) && '0' !== $domain_part ) {
								$this->_error( self::INVALID_HOSTNAME );
								return false;
						}

							// Decode Punycode domainnames to IDN.
						if ( strpos( $domain_part, 'xn--' ) === 0 ) {
								$domain_part = $this->decodePunycode( substr( $domain_part, 4 ) );
							if ( false === $domain_part ) {
									return false;
							}
						}

									// Check dash (-) does not start, end or appear in 3rd and 4th positions.
						if ( ( strpos( $domain_part, '-' ) === 0 ) || ( ( strlen( $domain_part ) > 2 ) && ( 2 === strpos( $domain_part, '-', 2 ) ) && ( 3 === strpos( $domain_part, '-', 3 ) ) ) || ( strpos( $domain_part, '-' ) === ( strlen( $domain_part ) - 1 ) ) ) {
								$this->_error( self::INVALID_DASH );
								$status = false;
								break 2;
						}

									// Check each domain part.
									$checked = false;
						foreach ( $regex_chars as $regex_key => $regex_char ) {
								$status = preg_match( $regex_char, $domain_part );
							if ( $status > 0 ) {
									$length = 63;
								if ( array_key_exists( strtoupper( $this->_tld ), $this->idn_length ) && ( array_key_exists( $regex_key, $this->idn_length[ strtoupper( $this->_tld ) ] ) ) ) {
										$length = $this->idn_length[ strtoupper( $this->_tld ) ];
								}

								if ( function_exists( 'iconv_strlen' ) ) {
									if ( iconv_strlen( $domain_part, 'UTF-8' ) > $length ) {
											$this->_error( self::INVALID_HOSTNAME );
									} else {
											$checked = true;
											break;
									}
								} else {
										$checked = true;
										break;
								}
							}
						}
						if ( $checked ) {
								++$check;
						}
					}

								// If one of the labels doesn't match, the hostname is invalid.
					if ( count( $domain_parts ) !== $check ) {
							$this->_error( self::INVALID_HOSTNAME_SCHEMA );
							$status = false;
					}
				} else {
						// Hostname not long enough.
						$this->_error( self::UNDECIPHERABLE_TLD );
						$status = false;
				}
			} while ( false );

			if ( PHP_VERSION_ID < 50600 ) {
				if ( function_exists( 'iconv_get_encoding' ) ) {
						iconv_set_encoding( 'internal_encoding', $origenc );
				}
			} else {
					ini_set( 'default_charset', $origenc );// @codingStandardsIgnoreLine.
			}
					// If the input passes as an Internet domain name, and domain names are allowed, then the hostname passes validation.
			if ( $status && ( $this->_options['allow'] & self::ALLOW_DNS ) ) {
					return true;
			}
		} elseif ( $this->_options['allow'] & self::ALLOW_DNS ) {
				$this->_error( self::INVALID_HOSTNAME );
		}

			// Check for URI Syntax (RFC3986).
		if ( $this->_options['allow'] & self::ALLOW_URI ) {
			if ( preg_match( "/^([a-zA-Z0-9-._~!$&\'()*+,;=]|%[[:xdigit:]]{2}){1,254}$/i", $value ) ) {
					return true;
			} else {
					$this->_error( self::INVALID_URI );
			}
		}

			// Check input against local network name schema; last chance to pass validation.
			$regex_local = '/^(([a-zA-Z0-9\x2d]{1,63}\x2e)*[a-zA-Z0-9\x2d]{1,63}[\x2e]{0,1}){1,254}$/';
			$status      = preg_match( $regex_local, $value );

			// If the input passes as a local network name, and local network names are allowed, then the hostname passes validation.
			$allow_local = $this->_options['allow'] & self::ALLOW_LOCAL;
		if ( $status && $allow_local ) {
				return true;
		}

			// If the input does not pass as a local network name, add a message.
		if ( ! $status ) {
				$this->_error( self::INVALID_LOCAL_NAME );
		}

			// If local network names are not allowed, add a message.
		if ( $status && ! $allow_local ) {
				$this->_error( self::LOCAL_NAME_NOT_ALLOWED );
		}

			return false;
	}
		/**
		 * Decodes a punycode encoded string to it's original utf8 string
		 * In case of a decoding failure the original string is returned
		 *
		 * @param  string $encoded Punycode encoded string to decode.
		 * @return string
		 */
	protected function decodePunycode( $encoded ) {
		if ( ! preg_match( '/^[a-z0-9-]+$/i', $encoded ) ) {
				// no punycode encoded string.
				$this->_error( self::CANNOT_DECODE_PUNYCODE );
				return false;
		}

			$decoded   = array();
			$separator = strrpos( $encoded, '-' );
		if ( $separator > 0 ) {
			for ( $x = 0; $x < $separator; ++$x ) {
					// prepare decoding matrix.
					$decoded[] = ord( $encoded[ $x ] );
			}
		}

			$lengthd = count( $decoded );
			$lengthe = strlen( $encoded );

			// decoding.
			$init  = true;
			$base  = 72;
			$index = 0;
			$char  = 0x80;

		for ( $indexe = ( $separator ) ? ( $separator + 1 ) : 0; $indexe < $lengthe; ++$lengthd ) {
			for ( $old_index = $index, $pos = 1, $key = 36; 1; $key += 36 ) {// @codingStandardsIgnoreLine.
					$hex   = ord( $encoded[ $indexe++ ] );
					$digit = ( $hex - 48 < 10 ) ? $hex - 22 : ( ( $hex - 65 < 26 ) ? $hex - 65 : ( ( $hex - 97 < 26 ) ? $hex - 97 : 36 ) );

					$index += $digit * $pos;
					$tag    = ( $key <= $base ) ? 1 : ( ( $key >= $base + 26 ) ? 26 : ( $key - $base ) );
				if ( $digit < $tag ) {
						break;
				}

					$pos = (int) ( $pos * ( 36 - $tag ) );
			}

				$delta  = intval( $init ? ( ( $index - $old_index ) / 700 ) : ( ( $index - $old_index ) / 2 ) );
				$delta += intval( $delta / ( $lengthd + 1 ) );
			for ( $key = 0; $delta > 910 / 2; $key += 36 ) {
					$delta = intval( $delta / 35 );
			}

				$base   = intval( $key + 36 * $delta / ( $delta + 38 ) );
				$init   = false;
				$char  += (int) ( $index / ( $lengthd + 1 ) );
				$index %= ( $lengthd + 1 );
			if ( $lengthd > 0 ) {
				for ( $i = $lengthd; $i > $index; $i-- ) {
						$decoded[ $i ] = $decoded[ ( $i - 1 ) ];
				}
			}

				$decoded[ $index++ ] = $char;
		}

			// convert decoded ucs4 to utf8 string.
		foreach ( $decoded as $key => $value ) {
			if ( $value < 128 ) {
					$decoded[ $key ] = chr( $value );
			} elseif ( $value < ( 1 << 11 ) ) {
					$decoded[ $key ]  = chr( 192 + ( $value >> 6 ) );
					$decoded[ $key ] .= chr( 128 + ( $value & 63 ) );
			} elseif ( $value < ( 1 << 16 ) ) {
					$decoded[ $key ]  = chr( 224 + ( $value >> 12 ) );
					$decoded[ $key ] .= chr( 128 + ( ( $value >> 6 ) & 63 ) );
					$decoded[ $key ] .= chr( 128 + ( $value & 63 ) );
			} elseif ( $value < ( 1 << 21 ) ) {
					$decoded[ $key ]  = chr( 240 + ( $value >> 18 ) );
					$decoded[ $key ] .= chr( 128 + ( ( $value >> 12 ) & 63 ) );
					$decoded[ $key ] .= chr( 128 + ( ( $value >> 6 ) & 63 ) );
					$decoded[ $key ] .= chr( 128 + ( $value & 63 ) );
			} else {
					$this->_error( self::CANNOT_DECODE_PUNYCODE );
					return false;
			}
		}

			return implode( $decoded );
	}
}
