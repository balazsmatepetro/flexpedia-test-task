<?php

declare(strict_types=1);

namespace Flexpedia;

/**
 * Description of CsvOutput
 * 
 * @author Balázs Máté Petró <petrobalazsmate@gmail.com>
 */
final class CsvOutput
{
    /**
     * Formats and returns the given data as CSV.
     * 
     * @param array $data The data to format as CSV.
     * @param string $delimiter (optional) The delimiter.
     * @param string $enclosure (optional) The enclosure.
     * @return string
     */
    public static function render(array $data, string $delimiter = ',', string $enclosure = '"')
    {
        $handle = fopen('php://temp', 'r+');
        $output = '';

        foreach ($data as $line) {
            fputcsv($handle, $line, $delimiter, $enclosure);
        }

        rewind($handle);

        while (!feof($handle)) {
            $output .= fread($handle, 8192);
        }

        fclose($handle);

        return $output;
    }
}
