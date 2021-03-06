<?php
/**
 * @package     TJ-UCM
 * @subpackage  com_tjucm
 *
 * @author      Techjoomla <extensions@techjoomla.com>
 * @copyright   Copyright (C) 2009 - 2019 Techjoomla. All rights reserved.
 * @license     http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

defined('_JEXEC') or die;

// Include dependancies
jimport('joomla.application.component.controller');

JLoader::registerPrefix('Tjucm', JPATH_COMPONENT);
JLoader::register('TjucmController', JPATH_COMPONENT . '/controller.php');

// Load backend helper
$path = JPATH_ADMINISTRATOR . '/components/com_tjucm/helpers/tjucm.php';

// Load joomla icon media file
$doc = JFactory::getDocument();
$doc->addStyleSheet(JUri::root() . '/media/jui/css/icomoon.css');

if (!class_exists('TjucmHelper'))
{
	JLoader::register('TjucmHelper', $path);
	JLoader::load('TjucmHelper');
}

// Load required JS files
//JLoader::import('media.com_tjucm.js.load_js', JPATH_SITE);
require_once JPATH_SITE . '/media/com_tjucm/js/load_js.php';

$path = JPATH_COMPONENT_ADMINISTRATOR . '/classes/' . 'funlist.php';

if (!class_exists('TjucmFunList'))
{
	// Require_once $path;
	JLoader::register('TjucmFunList', $path);
	JLoader::load('TjucmFunList');
}

// Load tjassets
jimport('joomla.filesystem.file');
$tjStrapperPath = JPATH_SITE . '/media/techjoomla_strapper/tjstrapper.php';

if (JFile::exists($tjStrapperPath))
{
	require_once $tjStrapperPath;
	TjStrapper::loadTjAssets();
}

JLoader::register('TjucmHelpersTjucm', JPATH_SITE . '/components/com_tjucm/helpers/tjucm.php');
JLoader::load('TjucmHelpersTjucm');
TjucmHelpersTjucm::getLanguageConstantForJs();

// Execute the task.
$controller = JControllerLegacy::getInstance('Tjucm');

$controller->execute(JFactory::getApplication()->input->getCmd('task'));
$controller->redirect();
