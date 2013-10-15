<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_chamadas
 *
 * @copyright   Copyright (C) 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

require_once __DIR__ . '/helper.php';

//Chama a classe ModChamadasHelper
$chamadas = new ModChamadasHelper;

//Executa a função getChamadas
$lista_chamadas = $chamadas->getChamadas($params);

if(!empty($lista_chamadas)){
	require JModuleHelper::getLayoutPath('mod_chamadas', $params->get('layout', 'default'));
}