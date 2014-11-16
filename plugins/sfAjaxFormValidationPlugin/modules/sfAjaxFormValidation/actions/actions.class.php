<?php

/*
 * vim: set ts=2 sts=2 sw=2 et:
 *
 * This file is part of the sfAjaxFormValidationPlugin package.
 * (c) 2010 Yuri B. Lukyanov
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

class sfAjaxFormValidationActions extends sfActions {

    public function executeIndex(sfWebRequest $request) {
        $this->form = $this->getForm($request);

        $this->field_names = array();
        foreach ($this->form->getValidatorSchema()->getFields() as $name => $field) {
            if ($this->form->getCSRFFieldName() != $name)
                $this->field_names[] = $name;
        }

        $this->prepareView();
    }

    public function executeValidate(sfWebRequest $request) {
        $this->form = $this->getForm($request);
        $this->form->configure();

        $field_name = $request->getParameter('field');
        $field_value = $request->getParameter('value');

        $json = $this->validateField($this->form, $field_name, $field_value);

        $this->prepareView();

        return $this->renderText($json);
    }

    protected function getForm($request) {
        $form_name = $request->getParameter('form');
        $this->forward404Unless($this->isValidFormName($form_name));
        return new $form_name;
    }

    protected function prepareView() {
        $this->setLayout(false);
        $this->getResponse()->setHttpHeader('Content-type', 'text/javascript');
    }

    protected function isValidFormName($form_class_name) {
        return class_exists($form_class_name) && is_subclass_of($form_class_name, 'sfForm');
    }

    protected function validateField(sfForm $form, $field_name, $field_value) {
        $validator = $form->getValidator($field_name);
        try {
            $validator->clean($field_value);
            $json = true;
        } catch (sfValidatorError $validatorError) {

            sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
            $error = $validatorError->getMessage();
            $error = str_replace($field_value, "%value%", $error);
            $json = str_replace('%value%', $field_value, __($error));
        }

        if (is_bool($json) && $json != false) {
            $validator = $form->getValidatorSchema();
            try {
                $validator->clean(array($field_name => $field_value));
                $json = true;
            } catch (sfValidatorError $validatorError) {

                sfContext::getInstance()->getConfiguration()->loadHelpers('I18N');
                $error = $validatorError->getMessage();
                $error = strstr($error, $field_name);
                $error = substr($error, 0, strpos($error,"]"));
                $error = str_replace($field_name." [", "", $error);
                $error = str_replace('"'.$field_name.'"', '"%value%"', $error);
                $error = __($error);
                $json = str_replace('%value%', $field_value, $error);
            }
        }

        return json_encode($json);
    }

}