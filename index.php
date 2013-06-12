<?php

require_once('lib/Member.php');
require_once('lib/Team.php');
require_once('lib/Client.php');
require_once('lib/Project.php');

require_once('lib/ProjectFactory.php');
require_once('lib/ProjectController.php');

use Expo\ProjectController as ProjectController;

$directive = array_key_exists('PATH_INFO', $_SERVER) ? $_SERVER['PATH_INFO'] : '/';
$directives = explode('/', $directive);
array_shift($directives);

if(empty($directives[0]))
{
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