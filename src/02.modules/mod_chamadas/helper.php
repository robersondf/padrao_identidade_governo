<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_chamadas
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper para mod_chamadas
 *
 * @package     Joomla.Site
 * @subpackage  mod_chamadas
 */
class ModChamadasHelper
{
	public function getChamadas($params)
	{
		//Carrega Modelo
		$modelo = $params->get('modelo');

		//Chama modelo que deverá ser executado
		require_once __DIR__ . '/modelos/'.$modelo.'/'.$modelo.'.php';
		$nomeclass = 'Modelo'.ucfirst($modelo);
		$listamodelo = new $nomeclass;

 		//Executa a função getListaModelo (padrão).
		$lista = $listamodelo->getListaModelo($params);			

		return $lista;
	}	
}