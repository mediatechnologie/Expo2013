<?php

require_once('lib/Session.php');

require_once('lib/Group.php');
require_once('lib/Member.php');
require_once('lib/Team.php');
require_once('lib/Client.php');
require_once('lib/Project.php');

require_once('lib/ProjectFactory.php');
require_once('lib/ProjectController.php');
require_once('lib/GroupStorage.php');

use Expo\ProjectController as ProjectController;
use Expo\GroupStorage as GroupStorage;
use Expo\Session as Session;

// we now create a session and append a GroupStorage object
// groupStorage will keep track during the entire session about the entirety of Group objects
Session::initialize();
Session::set('groupStorage', new GroupStorage());

$directive = array_key_exists('PATH_INFO', $_SERVER) ? $_SERVER['PATH_INFO'] : '/';
$directives = explode('/', $directive);
array_shift($directives);

if(empty($directives[0]))
{
	ProjectController::getAll(); // Groups need a full project initialization
	$template = 'templates/landing.phtml';
}
else if(ProjectController::isProject($directives[0]))
{
	$project  = ProjectController::getByIndex($directives[0]);
	$template = 'templates/project.phtml';
}
else
{
	$template = 'templates/notfound.phtml';
}

require_once('templates/header.phtml');
require_once($template);
require_once('templates/footer.phtml');