<?php declare(strict_types=1);

namespace Rx;

use Symfony\Component\Yaml\Yaml;

final class RxLoader
{

    public static function load(string $filename): \stdClass
    {

        $fileContents = file_get_contents($filename);
        $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array($fileExt, ['yaml', 'yml']) || substr($fileContents, 0, 3) == '---') {
            return Yaml::parse($fileContents, Yaml::PARSE_OBJECT_FOR_MAP);
        } else {
            return json_decode($fileContents);
        }

    }

}