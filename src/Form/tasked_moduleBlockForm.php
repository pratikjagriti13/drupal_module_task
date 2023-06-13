<?php

namespace Drupal\tasked_module\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;

/**
 * Lorem Ipsum block form
 */
class tasked_moduleBlockForm extends FormBase {

  /**
   * {@inheritdoc}
   */

  protected $database;

  // public function __construct(Connection $database){
  //   $this->database = $database;
  // }

  // public static function create(ContainerInterface $container) {
  //   return new static(
  //     $container->get('database')
  //   );
  // }

  
  public function getFormId() {
    return 'tasked_module_block_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    // How many paragraphs?
    // $options = new array();
    $options = array_combine(range(1, 10), range(1, 10));
    $form['paragraphs'] = [
      '#type' => 'select',
      '#title' => $this->t('Paragraphs'),
      '#options' => $options,
      '#default_value' => 4,
      '#description' => $this->t('How many?'),
    ];

    // How many phrases?
    $form['phrases'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Phrases'),
      '#default_value' => '20',
      '#description' => $this->t('Maximum per paragraph'),
    ];

    $date = '2008-12-31 00:00:00';

    $format = 'Y-m-d H:i';
 

    $form['employee_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t('Employee Name'),
    ]; 

    $form['employee_age'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Age'),
      '#description' => $this->t('Employee Age'),
    ]; 

    $form['employee_name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Name'),
      '#description' => $this->t('Employee Name'),
    ];
    
    $form['employee_dob'] = array(
      '#type' => 'datetime', 
      '#title' => $this->t('DOB'),
      '#default_value' => $date, 
      '#date_format' => $format,
      '#description' => $this->t('date picker')
    );

    // Submit. 
    $form['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Generate'),
    ];

    return $form;
  }
   /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    $phrases = $form_state->getValue('phrases');
    if (!is_numeric($phrases)) {
      $form_state->setErrorByName('phrases', $this->t('Please use a number.'));
    }

    if (floor($phrases) != $phrases) {
      $form_state->setErrorByName('phrases', $this->t('No decimals, please.'));
    }
    
    if ($phrases < 1) {
      $form_state->setErrorByName('phrases', $this->t('Please use a number greater than zero.'));
    }
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // $employee_name = $form_state->getValue('employee_name');
    // $employee_age = $form_state->getValue('employee_age');
    // $employee_dob = $form_state->getValue('employee_dob');
    $form_state->setRedirect('tasked_module.generate', [
      'paragraphs' => $form_state->getValue('paragraphs'),
      'phrases' => $form_state->getValue('phrases'),
    ]);
  }

}

// <script>
//   alert("presave trigger");
// </script>