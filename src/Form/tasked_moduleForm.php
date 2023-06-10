<?php

namespace Drupal\tasked_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

class tasked_moduleForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'tasked_module_form';
  }

  public function buildForm(array $form, FormStateInterface $form_state) {
    // Form constructor.
    $form = parent::buildForm($form, $form_state);
    // Default settings.
    $config = $this->config('tasked_module.settings');
    $form['page_title'] = [
        '#type' => 'textfield',
        '#title' => $this->t('String generator page title:'),
        '#default_value' => $config->get('tasked_module.page_title'),
        '#description' => $this->t('Give your string generator page a title.'),
      ];
      // Source text field.
      $form['source_text'] = [
        '#type' => 'textarea',
        '#title' => $this->t('Source text for string generation:'),
        '#default_value' => $config->get('tasked_module .source_text'),
        '#description' => $this->t('Write one sentence per line. Those sentences will be used to generate random text.'),
      ];
  
      return $form;
    }
    /**
     * {@inheritdoc}
     */
    public function validateForm(array &$form, FormStateInterface $form_state) {
    }
    /**
     * {@inheritdoc}
     */
    public function submitForm(array &$form, FormStateInterface $form_state) {
        $config = $this->config('tasked_module.settings');
        $config->set('tasked_module.source_text', $form_state->getValue('source_text'));
        $config->set('tasked_module.page_title', $form_state->getValue('page_title'));
        $config->save();
        return parent::submitForm($form, $form_state);
    }
    /**
     * {@inheritdoc}
     */
    protected function getEditableConfigNames() {
        return [
            'tasked_module.settings',
        ];
    }

}