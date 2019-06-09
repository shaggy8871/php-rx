<?php declare(strict_types=1);

namespace Rx;

use Symfony\Component\Yaml\Yaml;
use Rx\Exception\RxException;

final class RxLoader
{

    public static function load(string $filename): ?\stdClass
    {

        $fileContents = file_get_contents($filename);
        $fileExt = pathinfo($filename, PATHINFO_EXTENSION);

        if (in_array($fileExt, ['yaml', 'yml']) || substr($fileContents, 0, 3) == '---') {
            $contentsParsed = Yaml::parse($fileContents, Yaml::PARSE_OBJECT_FOR_MAP);
        } else {
            $contentsParsed = json_decode($fileContents);
            if (is_null($contentsParsed)) {
                throw new RxException(sprintf('Unable to parse %s contents in \'%s\'.', in_array($fileExt, ['json', 'js']) ? 'JSON' : 'Unknown', $filename));
            }
        }

        return $contentsParsed;

    }

}