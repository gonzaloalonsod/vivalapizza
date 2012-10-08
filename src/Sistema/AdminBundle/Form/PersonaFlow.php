<?php

namespace Sistema\AdminBundle\Form;

use Craue\FormFlowBundle\Form\FormFlow;

class PersonaFlow extends FormFlow {

    protected $maxSteps = 2;
    
//    protected function loadStepDescriptions() {
//        return array(
//            'Persona',
//            'Cajero',
//        );
//    }
    
    public function getFormOptions($formData, $step, array $options = array()) {
        $options = parent::getFormOptions($formData, $step, $options);

        if ($step > 1) {
            if ($formData->getTipo() != 'cajero'){
                $options['required'] = false;
                $options['disabled'] = true;
            }
        }

        return $options;
    }

}