<?php

use horstoeko\musiccast\MusiccastConnection;
use horstoeko\musiccast\MusiccastConfiguration;
use horstoeko\musiccast\operators\MusiccastOperatorNetUsb;
use horstoeko\musiccast\operators\MusiccastOperatorZone;
use horstoeko\musiccast\operators\MusiccastOperatorTuner;
use horstoeko\musiccast\operators\MusiccastOperatorSystem;

require dirname(__FILE__) . "/../vendor/autoload.php";

/**
 * Functions
 */

function writeString(string $string): void
{
    echo $string;
}

function writeNewLine(): void
{
    echo PHP_EOL;
}

function writeNewLineIf(bool $condition): void
{
    if ($condition === true) {
        writeNewLine();
    }
}

function writeLn(string $string, bool $noNewLine = false): void
{
    writeString($string);
    writeNewLine($noNewLine === false);
}

function writeDelimiter(): void
{
    writeString(str_repeat("═", 70));
    writeNewLine();
}

/**
 * Init
 */

$conf = new MusiccastConfiguration();
$conf->setHostNameOrIp("192.168.1.248");

$conn = new MusiccastConnection($conf);

$musiccastOperatorSystem = new MusiccastOperatorSystem($conn);
$musiccastOperatorZone = new MusiccastOperatorZone($conn);
$musiccastOperatorTuner = new MusiccastOperatorTuner($conn);
$musiccastOperatorNetUsb = new MusiccastOperatorNetUsb($conn);

/**
 * Before output
 */

writeNewLine();

/**
 * Device Information
 */

$deviceInformation = $musiccastOperatorSystem->getDeviceInfo();

writeNewLine();
writeLn("Device Information");
writeDelimiter();
writeLn("Model Name ............ " . $deviceInformation->modelName);
writeLn("Device ID ............. " . $deviceInformation->deviceId);
writeLn("Operation Mode ........ " . $deviceInformation->operationMode);
writeDelimiter();

/**
 * Device features
 */

$deviceFeatures = $musiccastOperatorSystem->getDeviceFeatures();

/**
 * Zone
 */

$musiccastOperatorZone->setVolume(-2);

/**
 * After output
 */

writeNewLine();

/*
$deviceInfo = $conn->getDeviceInfo();
$deviceFeature = $conn->getDeviceFeature();
$deviceLocation = $conn->getLocationInfo();

//$conn->powerOn();
//$conn->recallTunerPreset("dab", 1); // Sunshine Live
//$conn->recallNetUsbPreset(5); //90s90s Techno

//$conn->setInput("tuner");
//$conn->recallTunerPreset("dab", 1);
//$conn->setInput("net_radio");
//$conn->powerOff();

//$setInput = $conn->setInput("tuner");
//$setTunerBand = $conn->setTunerBand("dab");
//$tunerPresets = $conn->getTunerPresets("dab");
//$netUsbPresets = $conn->getNetUsbPresets("dab");
//$recallTunerPreset = $conn->recallTunerPreset("dab", 1);

//var_dump($recallTunerPreset);

//var_dump($netUsbPresets->getIndexByText('Radio Paradise (Paradise/English)'));
//var_dump($netUsbPresets);
//var_dump($tunerPresets);
//var_dump($tunerPresets->getIndexByNumber(6));
//var_dump($setTunerBand);
//var_dump($deviceFeature);
//var_dump($deviceInfo);
//var_dump($tunerPresets);
//var_dump($netUsbPresets);
//var_dump($setInput);
//var_dump($deviceInfo);
//var_dump($deviceLocation);
//echo $deviceInfo->getOperationMessage() . PHP_EOL;
//var_dump($deviceFeature->system->inputList);
//echo gettype($deviceFeature).PHP_EOL;
*/