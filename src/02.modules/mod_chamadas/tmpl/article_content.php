<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_chamadas
 *
 * @copyright   Copyright (C) 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

?>

<div>
	<?php foreach ($lista_chamadas as $lista): ?>
		<?php 
			//Defini link do artigo			
			$link = JRoute::_(ContentHelperRoute::getArticleRoute($lista->id, $lista->catid));			
		?>
	
	
		<?php if ($params->get('exibir_imagem')): ?>
			<div>
				<?php
					 $imagem = json_decode($lista->images);
				?>
				<a href="<?php echo $link ?>">
					<img src="<?php echo $imagem->image_intro ?>" />
				</a>	
			</div>
		<?php endif; ?>

		<?php if ($params->get('exibir_title')): ?>
			<div>
				<a href="<?php echo $link ?>">
					<?php echo $lista->title ?>
				</a>	
			</div>
		<?php endif; ?>

		<?php if ($params->get('exibir_introtext')): ?>
			<div>
				<?php if ($params->get('limitar_caractere')): ?>
					<?php
						$tam_texto = strlen($lista->introtext);
						if($tam_texto > $params->get('limite_caractere')){
							//Busca o total de caractere até a última palavra antes do limete.
							$limite_palavra = strrpos(substr(strip_tags($lista->introtext,'<b><i><strong><u><b>'), 0, $params->get('limite_caractere')), " ");
							$texto = trim(substr(strip_tags($lista->introtext,'<b><i><strong><u><b>'), 0, $limite_palavra)).'...';
						}
					?>
					<a href="<?php echo $link ?>">
						<?php echo $texto; ?>
					</a>
				<?php else: ?>
					<a href="<?php echo $link ?>">
						<?php echo strip_tags($lista->introtext, '<b><i><strong><u><b>') ?>
					</a>
				<?php endif; ?>	
			</div>
		<?php endif; ?>
	<?php endforeach; ?>
</div>