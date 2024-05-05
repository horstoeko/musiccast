<?php

use horstoeko\musiccast\MusiccastConnection;
use horstoeko\musiccast\MusiccastConfiguration;
use horstoeko\musiccast\utils\MusiccastConstants;
use horstoeko\musiccast\operators\MusiccastOperatorZone;
use horstoeko\musiccast\operators\MusiccastOperatorTuner;
use horstoeko\musiccast\operators\MusiccastOperatorNetUsb;
use horstoeko\musiccast\operators\MusiccastOperatorSystem;
use horstoeko\musiccast\models\MusiccastTunerPresetInfoItemModel;

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
    writeNewLineIf($noNewLine === false);
}

function writeDelimiter(): void
{
    writeString(str_repeat("═", 70));
    writeNewLine();
}

function writeTableColumn(string $string, int $size, bool $lastColumn = false): void
{
    writeLn(str_pad(substr($string, 0, $size), $size, " ", STR_PAD_RIGHT), $lastColumn === false);
}

function writeTableDelimiter(int $size): void
{
    writeString(str_repeat("-", $size));
    writeNewLine();
}

function bool2str(bool $value): string
{
    return $value === true ? "Yes" : "No";
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

$zoneStatus = $musiccastOperatorZone->getStatus();

writeNewLine();
writeLn("Zone Status for zone {$conn->getZone()}");
writeDelimiter();
writeLn("Power ................. " . $zoneStatus->power);
writeLn("Input ................. " . $zoneStatus->input . " (" . $zoneStatus->inputText . ")");
writeLn("Volume ................ " . $zoneStatus->volume);
writeLn("Max Volume ............ " . $zoneStatus->maxVolume);
writeLn("Mute .................. " . bool2str($zoneStatus->mute));
writeDelimiter();

//$musiccastOperatorZone->powerOn();

$zoneStatus = $musiccastOperatorZone->getStatus();

if ($zoneStatus->isPoweredOn()) {
    $musiccastOperatorZone->setVolume(70);

    $zoneStatus = $musiccastOperatorZone->getStatus();

    writeLn("Power ................. " . $zoneStatus->power);
    writeLn("Input ................. " . $zoneStatus->input . " (" . $zoneStatus->inputText . ")");
    writeLn("Volume ................ " . $zoneStatus->volume);
    writeDelimiter();

    $musiccastOperatorZone->setInput("tuner");

    $zoneStatus = $musiccastOperatorZone->getStatus();

    writeLn("Power ................. " . $zoneStatus->power);
    writeLn("Input ................. " . $zoneStatus->input . " (" . $zoneStatus->inputText . ")");
    writeLn("Volume ................ " . $zoneStatus->volume);
    writeDelimiter();
}

// $musiccastOperatorZone->setVolumeDown();
// $musiccastOperatorZone->setMute();
// $musiccastOperatorZone->setInput("tuner");

/**
 * Tuner
 */

$tunerPlayInfo = $musiccastOperatorTuner->getPlayInfo();

foreach ([MusiccastConstants::TUNER_BAND_AM, MusiccastConstants::TUNER_BAND_FM, MusiccastConstants::TUNER_BAND_DAB] as $tunerBand) {
    $presetInfo = array_filter($musiccastOperatorTuner->getPresets($tunerBand)->presetInfo, function (MusiccastTunerPresetInfoItemModel $item) {
        return $item->number > 0;
    });

    if (empty($presetInfo)) {
        continue;
    }

    writeNewLine();
    writeLn("Tuner Presets for $tunerBand band");
    writeDelimiter();
    writeTableColumn("Number", 10);
    writeTableColumn("Name", 30, true);
    writeTableDelimiter(40);
    foreach ($presetInfo as $presetInfoItem) {
        writeTableColumn($presetInfoItem->number, 10);
        writeTableColumn($presetInfoItem->text, 30, true);
    }
    writeTableDelimiter(40);
}

var_dump($tunerPlayInfo);


/**
 * NetUsb
 */

$netUsbPlayInfo = $musiccastOperatorNetUsb->getPlayInfo();
var_dump($netUsbPlayInfo);


/**
 * After output
 */

writeNewLine();
