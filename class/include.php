<?php
include_once(dirname(__FILE__) . '/Database.php');
include_once(dirname(__FILE__) . '/User.php');
include_once(dirname(__FILE__) . '/UserType.php');
include_once(dirname(__FILE__) . '/Upload.php');
include_once(dirname(__FILE__) . '/Helper.php');
include_once(dirname(__FILE__) . '/Country.php');
include_once(dirname(__FILE__) . '/Company.php');
include_once(dirname(__FILE__) . '/JobRole.php');
include_once(dirname(__FILE__) . '/Staff.php');
include_once(dirname(__FILE__) . '/Province.php');
include_once(dirname(__FILE__) . '/District.php');
include_once(dirname(__FILE__) . '/Project.php');
include_once(dirname(__FILE__) . '/Course.php');
include_once(dirname(__FILE__) . '/Job.php');
include_once(dirname(__FILE__) . '/Career.php');
include_once(dirname(__FILE__) . '/JobListing.php');
include_once(dirname(__FILE__) . '/SkillsTrainingApplication.php');
include_once(dirname(__FILE__) . '/ForeignEmploymentApplication.php');
include_once(dirname(__FILE__) . '/StudentCountryVisa.php');
include_once(dirname(__FILE__) . '/VisaConsultancyApplication.php');
include_once(dirname(__FILE__) . '/VisaType.php');

function dd($data)
{
    var_dump($data);
    exit();
}

function redirect($url)
{
    $string = '<script type="text/javascript">';
    $string .= 'window.location = "' . $url . '"';
    $string .= '</script>';
    echo $string;
    exit();
}
function base_url()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
    $host = $_SERVER['HTTP_HOST'];
    $script = $_SERVER['SCRIPT_NAME'];

    // Remove the file name and path from the script
    $path = dirname($script);

    // Combine the protocol, host, and path
    $baseURL = $protocol . $host . $path;

    return $baseURL;
}
