<?php
//path of the controller
namespace Drupal\bssa\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\system\Form\SiteInformationForm;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;

/**
 * Class DefaultController.
 */
class DefaultController extends ControllerBase {
	
	public function jsonnodedata(){

		$site_config = $this->config('system.site');
		$serialapikey = $site_config->get('siteapikey');
		$serializer = \Drupal::service('serializer');
		$path = \Drupal::request()->getpathInfo();
		$arg  = explode('/',$path);
		$node = \Drupal\node\Entity\Node::load($arg[3]);
		$nodetype = $node->getType();

		/**
		 * Node type must be page and siteapikey must not empty.
		 */
		if(!empty($node) && ($nodetype == 'page') && ($arg[2] == $serialapikey)){
			$data = $serializer->serialize($node, 'json', ['plugin_id' => 'entity']);
			return [
				'#type' => 'markup',
				'#markup' => $data,
				'#cache' => ['max-age' => 0,],
			];
		}else{
			throw new AccessDeniedHttpException();
		}
	}
}
