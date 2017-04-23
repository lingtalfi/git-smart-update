<?php


require "bigbang.php";

$curDir = getcwd();
$readmeFile = $curDir . "/README.md";


function say($msg)
{
    echo "$msg" . PHP_EOL;
}

function error($msg)
{
    echo "Error: $msg" . PHP_EOL;
    exit;
}

function execute($cmd)
{
    passthru($cmd);
}

if (file_exists($readmeFile)) {

    $lines = file($readmeFile);

    // assuming the last version is at the top

    $historyLogSectionFound = false;
    $versionFound = false;
    $version = null;
    $text = null;
    foreach ($lines as $line) {
        if (true === $historyLogSectionFound) {
            if (false === $versionFound) {
                if (0 === strpos($line, '- ')) {
                    if (preg_match('!([0-9]+\.[0-9]+(\.[0-9]+)?) -- [0-9]{4}-[0-9]{2}-[0-9]{2}!', $line, $match)) {
                        $version = $match[1];
                        $versionFound = true;
                    }
                }
            } else {
                if (preg_match('!^\s+- (.*)!', $line, $match)) {
                    $text = $match[1];
                    break;
                }
            }
        } else {
            if ('History Log' === trim($line)) {
                $historyLogSectionFound = true;
            }
        }
    }

    if (false === $historyLogSectionFound) {
        error("History Log section not found in the readme file ($readmeFile)");
    } elseif (null !== $version && null !== $text) {
        say("found version: $version");
        say("found commit text: $text");
        say("executing git commands:");

        $gitCommand = "git snap update \"" . str_replace('"', '\"', $text) . "\"";
        say($gitCommand);
        execute($gitCommand);
        $gitCommand = "git t $version";
        say($gitCommand);
        execute($gitCommand);
        $gitCommand = "git pp";
        say($gitCommand);
        execute($gitCommand);

    } else {
        error("Could not find the version and/or the commit text from the Log History section");
    }

} else {
    error("README.md file not found in the current directory ($curDir)");
}

