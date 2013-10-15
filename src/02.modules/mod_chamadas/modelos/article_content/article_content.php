<?php
defined('_JEXEC') or die;

class ModeloArticle_content
{
	public function getListaModelo($params) 
	{
		//Permissão de acesso
		$user	= JFactory::getUser();
		$groups	= implode(',', $user->getAuthorisedViewLevels());

		//Conexão
		$db		= JFactory::getDbo();

		//Busca data - zerada e atual
		$nullDate = $db->getNullDate();
		$date = JFactory::getDate();
		$atual = $date->toSql();

		//Consulta
		$query	= $db->getQuery(true);
		$query->clear();
		$query->select('cont.id, cont.catid, cont.alias');
		$query->from('#__content cont');
		$query->from('#__categories cat');

		$query->where('cont.catid = cat.id');
		$query->where('cont.state=1');
		$query->where('cat.published = 1');
		$query->where('cont.access IN ('.$groups.')');
		$query->where('cat.access IN ('.$groups.')');
		$query->where('(cont.publish_up = '.$db->Quote($nullDate).' OR cont.publish_up <= '.$db->Quote($atual).')');
		$query->where('(cont.publish_down = '.$db->Quote($nullDate).' OR cont.publish_down >= '.$db->Quote($atual).')');

		//Valor 1 = todos que não são destaque
		if($params->get('destaque') == 1){
			$query->where('cont.featured = 0');
		}

		//Valor 2 = somente destaque
		elseif($params->get('destaque') == 2){
			$query->where('cont.featured = 1');
		}

		//Traz o resultado do título ou não
		if($params->get('exibir_title')){
			$query->select('cont.title');
		}

		//Traz o resultado da imagem ou não
		if($params->get('exibir_imagem')){
			$query->select('cont.images');
		}

		//Traz o resultado do introtext ou não
		if($params->get('exibir_introtext')){
			$query->select('cont.introtext');
		}

		if($params->get('somente_imagem')){
			$query->where('cont.images NOT LIKE \'{"image_intro":""%\'');
		}

		//Subquery para trazer os id's das categorias filhas
		if($params->get('visualizar_filho')){
			$subQuery = $db->getQuery(true);
			$subQuery->select('filho.id');
			$subQuery->from('#__categories AS pai');
			$subQuery->from('#__categories AS filho');
			$subQuery->where('pai.id IN ('.$params->get('catid').')');
			$subQuery->where('filho.lft >= pai.lft');
			$subQuery->where('filho.rgt <= pai.rgt');

			//Define o nível máximo da categoria
			if($params->get('nivel')){
				$subQuery->where('filho.level <= '. $params->get('nivel'));
			}

			//Filtra as categorias que deverão ser listadas.
			$query->where('cont.catid IN ('.$subQuery.')');
		}else{
			$query->where('cont.catid = '.$params->get('catid'));
		}

		$query->order('cont.'.$params->get('ordem'), $params->get('ordem_direction'));
		$db->setQuery($query,0,$params->get('quantidade'));
		$lista = $db->loadObjectList();
		return $lista;
	}
}