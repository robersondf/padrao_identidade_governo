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
		
		/**	
			#Os campos das tabelas deverão ser nomeados de forma padrão.
			#Esses parametros deverão ser utilizados na tmpl.
			#O resultado deverá retornar objeto (loadObjectList() - para consulta bd).
			
			#Os dois primeiros campos são fundamentais para a criação do link,
			#para o padrão com_content.
				id 			-> id da tabela #__content
				catid 		-> catid da tabela #__content
			
			#Campos que farão parte das chamadas do tmpl.
				images		-> Imagem do artigo (matéria)
				title		-> Título do artigo (matéria)
				alias		-> Apelido que será utilizado na URL
				titlecat	-> Título da categoria (#__categories)
				introtext	-> Texto introdutório do artigo (matéria) 
				chapeu		-> Texto complementar, subtítulo
			
		**/
		
		$listamodelo = new $nomeclass;

 		//Executa a função getListaModelo (padrão).
		$lista = $listamodelo->getListaModelo($params);			

		return $lista;
	}	
}