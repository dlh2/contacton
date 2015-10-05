<?php

$valid_passwords = array ("shizer" => "david" , "jose" => "vicente");
$valid_users = array_keys($valid_passwords);

$user = $_SERVER['PHP_AUTH_USER'];
$pass = $_SERVER['PHP_AUTH_PW'];

$validated = (in_array($user, $valid_users)) && ($pass == $valid_passwords[$user]);

if (!$validated) {
  header('WWW-Authenticate: Basic realm="Beware of crocodiles!!"');
  header('HTTP/1.0 401 Unauthorized');
  die ("Not authorized");
}

// If arrives here, is a valid user.
// Edit mode
function load_twig() {
	global $twig, $config;
	
	require $_SERVER['DOCUMENT_ROOT'] . '/lib/Twig/Autoloader.php';
	Twig_Autoloader::register();
	Twig_Autoloader::autoload('Twig_Extensions_Node_Trans');
	Twig_Autoloader::autoload('Twig_Extensions_TokenParser_Trans');
	Twig_Autoloader::autoload('Twig_Extensions_Extension_I18n');
	Twig_Autoloader::autoload('Twig_Extensions_Extension_Tinyboard');
	$config['dir']['template'] = getcwd() . '/templates';
	$loader = new Twig_Loader_Filesystem($config['dir']['template']);
	$loader->setPaths($config['dir']['template']);
	$twig = new Twig_Environment($loader, array(
		'autoescape' => false
	));
	$twig->addExtension(new Twig_Extensions_Extension_Tinyboard());
	$twig->addExtension(new Twig_Extensions_Extension_I18n());
}
function Element($templateFile, array $options) {
	global $config, $twig;
	
	if (!$twig)
		load_twig();
	
	// Read the template file
	if (@file_get_contents("{$config['dir']['template']}/${templateFile}")) {
		$body = $twig->render($templateFile, $options);
		return $body;
	} else {
		throw new Exception("Template file '${templateFile}' does not exist or is empty in '{$config['dir']['template']}'!");
	}
}

function mod_page($title, $template, $args, $subtitle = false) {
	global $config, $mod;
	
	echo Element('page.html', array(
		'config' => $config,
		'mod' => $mod,
		'title' => $title,
		'subtitle' => $subtitle,
		'nojavascript' => true,
		'body' => Element($template,
				array_merge(
					array('config' => $config, 'mod' => $mod), 
					$args
				)
			)
		)
	);
}

if( isset($_POST['listbox']) || isset($_POST['code']) ){
		$config_file =  $_POST['listbox'];
		$readonly = !(is_file($config_file) ? is_writable($config_file) : is_writable(dirname($config_file)));
		
		if (!$readonly && isset($_POST['code'])) {
			$code = $_POST['code'];
			file_put_contents($config_file, $code);
				header('Location: admin-editor.php', true, $config['redirect_http']);
				return;
		}
		
		$instance_config = file_get_contents($config_file);
		if ($instance_config === false) {
			$instance_config = "<?php\n\n// This file does not exist yet. You are creating it.";
		}
		mod_page(_('Contact On - Admin Editor'), 'admin-editor.html', array(
			'php' => $instance_config,
			'readonly' => $readonly,
			'file' => $config_file
		),'User modifying the file: ' . $user . ' - Return to <a href="admin-editor.php">Options</a>');
		return;
} else {

echo "<head>";
echo "<title>Contact On - Admin Editor</title>";
echo "<meta http-equiv=\"Content-Type\" content=\"text/html; charset=utf-8\">";
echo "<link id=\"pagestyle\" rel=\"stylesheet\" type=\"text/css\" href=\"http://www.w3schools.com/w3css/w3-theme-indigo.css\">";
echo "<link rel=\"stylesheet\" href=\"/base.css\">";
echo "<link href=\"/favicon.ico\" rel=\"shortcut icon\">";
echo "</head>";
echo "<body class=\"w3-blue-grey\">";
echo "<div class=\"w3-card-16 w3-margin-12\">";
echo "<header class=\"w3-container w3-theme-d4\">";
echo "<h1>Admin Editor</h1>";
echo "</header>";


echo "<div class=\"w3-container w3-theme-l2 w3-row\">";



echo "<div class=\"w3-card-8 w3-theme-d2 w3-padding-large w3-margin-8 w3-third\">";
echo "Select a file: " . $_POST['listbox'];
echo "<hr>";
echo "<form action=\"admin-editor.php\" method=\"post\">";
echo "Contact On - Basic Files<br>";
echo "<input type=\"radio\" name=\"listbox\" value=\"index.php\">Index<br>";
echo "<hr>";
echo "<hr>";
echo "No tocar (Solo Shizer) <br>";
echo "<input type=\"radio\" name=\"listbox\" value=\"admin-editor.php\">No tocar en serio...!<br>";
echo "<input type=\"radio\" name=\"listbox\" value=\"" . $_SERVER['DOCUMENT_ROOT'] . "/templates/page.html\">NOOOOO!<br>";
echo "<br>";
echo "<input type=\"submit\" value=\"Submit\" class=\"w3-theme-dark\">";
echo "</form> ";
echo "</div>";


echo "<div class=\"w3-card-8 w3-theme-d2 w3-padding-large w3-margin-8 w3-third\">";
echo "Local Files";
echo "<hr>";
echo "<form action=\"admin-editor.php\" method=\"post\">";
echo "<input type=\"radio\" name=\"listbox\" value=\"" . $_SERVER['DOCUMENT_ROOT'] . "/ERR/error404.html\">Error 404<br>";
echo "<hr>";
echo "<input type=\"submit\" value=\"Submit\" class=\"w3-theme-dark\">";
echo "</form> ";
echo "</div>";



echo "<div class=\"w3-card-8 w3-theme-d2 w3-padding-large w3-margin-8 w3-quarter\">";

echo "</div>";



echo "</div>";
echo "</div>";
echo "</body>";

}
	?>