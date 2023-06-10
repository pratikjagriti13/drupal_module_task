<?php

namespace Drupal\loremipsum\Plugin\Block;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Provides a string block with which you can generate dummy text anywhere.
 *
 * @Block(
 *   id = "tasked_module_block",
 *   admin_label = @Translation("Tasked module block"),
 * )
 */
class tasked_moduleBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
    // Return the form @ Form/tasked_moduleForm.php.
    return \Drupal::formBuilder()->getForm('Drupal\tasked_module\Form\tasked_moduleBlockForm');
    }
    /**
     * {@inheritdoc}
     */
    protected function blockAccess(AccountInterface $account) {
        return AccessResult::allowedIfHasPermission($account, 'generate some string');
    }
    /**
     * {@inheritdoc}
     */
    public function blockForm($form, FormStateInterface $form_state) {
        $form = parent::blockForm($form, $form_state);
        $config = $this->getConfiguration();
        return $form;
    }
    /**
     * {@inheritdoc}
     */
    public function blockSubmit($form, FormStateInterface $form_state) {
        $this->setConfigurationValue('tasked_module_block_settings', $form_state
        ->getValue('tasked_module_block_settings'));
    }

}