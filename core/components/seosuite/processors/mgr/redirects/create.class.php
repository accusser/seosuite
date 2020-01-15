<?php

/**
 * SeoSuite
 *
 * Copyright 2019 by Sterc <modx@sterc.com>
 */

class SeoSuiteRedirectCreateProcessor extends modObjectCreateProcessor
{
    /**
     * @access public.
     * @var String.
     */
    public $classKey = 'SeoSuiteRedirect';

    /**
     * @access public.
     * @var Array.
     */
    public $languageTopics = ['seosuite:default'];

    /**
     * @access public.
     * @var String.
     */
    public $objectType = 'seosuite.redirect';

    /**
     * @access public.
     * @return Mixed.
     */
    public function initialize()
    {
        $this->modx->getService('seosuite', 'SeoSuite', $this->modx->getOption('seosuite.core_path', null, $this->modx->getOption('core_path') . 'components/seosuite/') . 'model/seosuite/');

        if ($this->getProperty('active') === null) {
            $this->setProperty('active', 0);
        }

        if ($this->getProperty('context_key') === 'seosuite_all') {
            $this->setProperty('context_key', '');
        }

        return parent::initialize();
    }

    /**
     * @access public.
     * @return Mixed.
     */
    public function beforeSave()
    {
        $criteria = [
            'id:!='       => $this->object->get('id'),
            'context_key' => $this->object->get('context_key'),
            'old_url'     => $this->modx->seosuite->formatUrl($this->object->get('old_url'))
        ];

        if ($this->doesAlreadyExist($criteria)) {
            $this->addFieldError('old_url', $this->modx->lexicon('seosuite.redirect_error_exists'));
        }

        $this->object->set('new_url', $this->modx->seosuite->formatUrl($this->getProperty('new_url')));

        return parent::beforeSave();
    }
}

return 'SeoSuiteRedirectCreateProcessor';
