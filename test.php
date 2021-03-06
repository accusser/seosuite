<?php
require_once dirname(__FILE__).'/config.core.php';
require_once MODX_CORE_PATH . 'config/' . MODX_CONFIG_KEY . '.inc.php';
require_once MODX_CONNECTORS_PATH . 'index.php';

$corePath = $modx->getOption('seosuite.core_path', null, $modx->getOption('core_path', null, MODX_CORE_PATH) . 'components/seosuite/');
$seoSuite = $modx->getService(
    'seosuite',
    'SeoSuite',
    $corePath . 'model/seosuite/',
    array(
        'core_path' => $corePath
    )
);

$search = 'amelander-stranden-voor-de-27e-keer-onderscheiden-met-de-blauwe-vlag_23611.html';
$stopwords = $seoSuite->getStopWords();
$allWords = str_word_count(str_replace('-', '_', $search), 1, '1234567890');

echo 'Stopwords:<br>';
print_r($stopwords);
echo '<br>------<br>';
echo 'Search string:<br>';
echo $search;
echo '<br>------<br>';
echo 'Original:<br>';
print_r($allWords);
echo '<br>------<br>';
echo 'Without stopwords:<br>';
$filtered = array();
foreach ($allWords as $word) {
    if (!in_array($word, $stopwords)) {
        $filtered[] = $word;
    }
}
print_r($filtered);
echo '<br>------<br>';
echo 'Suggestions:<br>';
print_r($seoSuite->findRedirectSuggestions($search));