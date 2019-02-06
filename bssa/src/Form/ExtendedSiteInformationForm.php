<?php

namespace Drupal\bssa\Form;

use Drupal\Core\Form\FormStateInterface;
use Drupal\system\Form\SiteInformationForm;


class ExtendedSiteInformationForm extends SiteInformationForm {
 
   /**
   * {@inheritdoc}
   */
	  public function buildForm(array $form, FormStateInterface $form_state) {
		$site_config = $this->config('system.site');
		$form =  parent::buildForm($form, $form_state);
		$form['site_information']['siteapikey'] = [
			'#type' => 'textfield',
			'#title' => t('Site API Key'),
			'#default_value' => $site_config->get('siteapikey') ?: 'No API Key yet',
			'#description' => t("Custom field to set the API Key"),
		];
			
		$form['actions']['submit'] = [
			'#type' => 'submit',
			'#value' => $this->t('Update Configuration'),
		];
		
		return $form;
	}
	
	  public function submitForm(array &$form, FormStateInterface $form_state) {
		$this->config('system.site')
		  ->set('siteapikey', $form_state->getValue('siteapikey'))
		  ->save();

		parent::submitForm($form, $form_state);
		drupal_set_message(
			$this->t('Site API Key has been saved with value : @label.',
			[
			'@label' => $form_state->getValue('siteapikey')
			]
			)
		);
	  }
}
