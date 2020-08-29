<?php

namespace Katas\Tests\Service;

use Katas\Exception\MaximunArabicNumberValueException;
use Katas\Exception\MinimumArabicNumberValueException;
use Katas\Service\ConverterRomanToArabicNumberService;
use PHPUnit\Framework\TestCase;

class ConverterArabicToRomanNumberServiceTest extends TestCase
{
    /**
     * @Test
     *
     * @dataProvider arabicToRomanUnitsNumbersProvider
     * @dataProvider arabicToRomanTensNumbersProvider
     * @dataProvider arabicToRomanHundredsNumbersProvider
     * @dataProvider arabicToRomanThousandsNumbersProvider
     *
     * @param int    $arabicDoneNumber
     * @param string $romanExpectedNumber
     */
    public function testArabicToRomanConversion(int $arabicDoneNumber, string $romanExpectedNumber): void
    {
        $converter = new ConverterRomanToArabicNumberService();

        $romanNumber = $converter->convert($arabicDoneNumber);

        $this->assertEquals($romanExpectedNumber, $romanNumber, "Convert number $arabicDoneNumber");
    }

    /**
     * @Test
     */
    public function testItDoesNotAllowConversionOfNumbersLessThanOne()
    {
        $converter = new ConverterRomanToArabicNumberService();

        $this->expectException(MinimumArabicNumberValueException::class);

        $converter->convert(0);
    }

    /**
     * @Test
     */
    public function testItDoesNotAllowConversionOfNumbersEqualOrGreaterThanFourThousand()
    {
        $converter = new ConverterRomanToArabicNumberService();

        $this->expectException(MaximunArabicNumberValueException::class);

        $converter->convert(4000);
    }


    /**
     * Data providers
     */
    
    /**
     * @return array[]
     */
    public function arabicToRomanUnitsNumbersProvider(): array
    {
        return [
            [1, 'I'],
            [2, 'II'],
            [3, 'III'],
            [4, 'IV'],
            [5, 'V'],
            [6, 'VI'],
            [7, 'VII'],
            [8, 'VIII'],
            [9, 'IX'],
        ];
    }

    /**
     * @return array[]
     */
    public function arabicToRomanTensNumbersProvider(): array
    {
        return [
            [10, 'X'],
            [11, 'XI'],
            [12, 'XII'],
            [13, 'XIII'],
            [14, 'XIV'],
            [15, 'XV'],
            [16, 'XVI'],
            [19, 'XIX'],
            [23, 'XXIII'],
            [27, 'XXVII'],
            [30, 'XXX'],
            [33, 'XXXIII'],
            [38, 'XXXVIII'],
            [40, 'XL'],
            [44, 'XLIV'],
            [48, 'XLVIII'],
            [49, 'XLIX'],
            [50, 'L'],
            [53, 'LIII'],
            [60, 'LX'],
            [68, 'LXVIII'],
            [70, 'LXX'],
            [73, 'LXXIII'],
            [79, 'LXXIX'],
            [80, 'LXXX'],
            [84, 'LXXXIV'],
            [88, 'LXXXVIII'],
            [99, 'XCIX'],
        ];
    }

    /**
     * @return array[]
     */
    public function arabicToRomanHundredsNumbersProvider(): array
    {
        return [
            [100, 'C'],
            [104, 'CIV'],
            [249, 'CCXLIX'],
            [399, 'CCCXCIX'],
            [400, 'CD'],
            [900, 'CM'],
            [999, 'CMXCIX'],
        ];
    }

    /**
     * @return array[]
     */
    public function arabicToRomanThousandsNumbersProvider(): array
    {
        return [
            [1759, 'MDCCLIX'],
            [1999, 'MCMXCIX'],
            [2020, 'MMXX'],
            [3888, 'MMMDCCCLXXXVIII'],
        ];
    }
}
