<?php
/**
 * Application requirement checker script.
 *
 * In order to run this script use the following console command:
 * php requirements.php
 *
 * In order to run this script from the web, you should copy it to the web root.
 * If you are using Linux you can create a hard link instead, using the following command:
 * ln ../requirements.php requirements.php
 */

// you may need to adjust this path to the correct Yii framework path
// uncomment and adjust the following line if Yii is not located at the default path
//$frameworkPath = dirname(__FILE__) . '/vendor/yiisoft/yii2';


if (!isset($frameworkPath)) {
    $searchPaths = [
        dirname(__FILE__) . '/../../../../vendor/yiisoft/yii2',
        dirname(__FILE__) . '/../../vendor/yiisoft/yii2',
    ];
    foreach($searchPaths as $path) {
        if (is_dir($path)) {
            $frameworkPath = $path;
            break;
        }
    }
}

if (!isset($frameworkPath) || !is_dir($frameworkPath)) {
    $message = "<h1>Error</h1>\n\n"
        . "<p><strong>The path to yii framework seems to be incorrect.</strong></p>\n"
        . '<p>You need to install Yii framework via composer or adjust the framework path in file <abbr title="' . __FILE__ . '">' . basename(__FILE__) . "</abbr>.</p>\n"
        . '<p>Please refer to the <abbr title="' . dirname(__FILE__) . "/README.md\">README</abbr> on how to install Yii.</p>\n";

    if (!empty($_SERVER['argv'])) {
        // do not print HTML when used in console mode
        echo strip_tags($message);
    } else {
        echo $message;
    }
    exit(1);
}

require_once($frameworkPath . '/requirements/YiiRequirementChecker.php');
$requirementsChecker = new YiiRequirementChecker();

$gdMemo = $imagickMemo = 'Either GD PHP extension with FreeType support or ImageMagick PHP extension with PNG support is required for image CAPTCHA.';
$gdOK = $imagickOK = false;

if (extension_loaded('imagick')) {
    $imagick = new Imagick();
    $imagickFormats = $imagick->queryFormats('PNG');
    if (in_array('PNG', $imagickFormats)) {
        $imagickOK = true;
    } else {
        $imagickMemo = 'Imagick extension should be installed with PNG support in order to be used for image CAPTCHA.';
    }
}

if (extension_loaded('gd')) {
    $gdInfo = gd_info();
    if (!empty($gdInfo['FreeType Support'])) {
        $gdOK = true;
    } else {
        $gdMemo = 'GD extension should be installed with FreeType support in order to be used for image CAPTCHA.';
    }
}

/**
 * Adjust requirements according to your application specifics.
 */
$requirements = array(
    // Database :
    array(
        'name' => 'PDO extension',
        'mandatory' => true,
        'condition' => extension_loaded('pdo'),
        'by' => 'All DB-related classes',
    ),
    array(
        'name' => 'PDO SQLite extension',
        'mandatory' => true,
        'condition' => extension_loaded('pdo_sqlite'),
        'by' => 'All DB-related classes',
        'memo' => 'Required for SQLite database.',
    ),
    array(
        'name' => 'PDO MySQL extension',
        'mandatory' => true,
        'condition' => extension_loaded('pdo_mysql'),
        'by' => 'All DB-related classes',
        'memo' => 'Required for MySQL database.',
    ),
);

// OPcache check
if (!version_compare(phpversion(), '5.5', '>=')) {
    $requirements[] = array(
        'name' => 'APC extension',
        'mandatory' => false,
        'condition' => extension_loaded('apc'),
        'by' => '<a href="http://www.yiiframework.com/doc-2.0/yii-caching-apccache.html">ApcCache</a>',
    );
}

$result = $requirementsChecker->checkYii()->check($requirements)->getResult();
//print_r($result);
return $result;
//$requirementsChecker->render();
//exit($result['summary']['errors'] === 0 ? 0 : 1);
