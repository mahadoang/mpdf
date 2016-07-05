<?php

namespace Mpdf;

class SizeConvertorTest extends \PHPUnit_Framework_TestCase
{

	/**
	 * @var \Mpdf\SizeConvertor
	 */
	private $convertor;

	protected function setUp()
	{
		parent::setUp();

		$this->convertor = new SizeConvertor(96, NULL);
	}

	/**
	 * @dataProvider sizesProvider
	 *
	 * @param string $size
	 * @param float $maxsize
	 * @param mixed $fontsize
	 * @param boolean $usefontsize
	 * @param float $converted
	 */
	public function testConvert($size, $maxsize, $fontsize, $usefontsize, $converted)
	{
		//$this->markTestIncomplete('Refactored convert() methods awaits review');
		$this->assertSame($converted, $this->convertor->convert($size, $maxsize, $fontsize, $usefontsize));
	}

	public function sizesProvider()
	{
		return [
			['', 140.0, 3.5277777777777772, false, 0.0],

			[0, 127.0, 15.874999999999998, false, 0.0],
			[0, 153.00155555555551, 2.4694444444444441, false, 0.0],
			[0, 95.25, 15.874999999999998, false, 0.0],
			[1, 127.0, 15.874999999999998, false, 0.26458333333333334],
			[8.5888888888888886, 147.94322222222218, 3.1749999999999998, false, 2.2724768518518546],

			['0', 110.00155555555551, 2.822222222222222, false, 0.0],
			['2', 153.45833333333334, 3.8805555555555995, false, 0.52916666666666667],
			['10', 175.00155555555551, 3.5277777777777999, false, 2.6458333333333335],

			['-3500', 95.25, 4.7625000000000002, false, -926.04166666666663],
			['0.1', 153.45833333333334, 3.8805555555555995, false, 0.026458333333333334],
			['0.172', 153.45833333333334, 3.8805555555555995, false, 0.045508333333333331],
			['0.5', 153.45833333333334, 3.8805555555555995, false, 0.13229166666666667],
			['1', 105.83333333333333, 3.8793333333333329, false, 0.26458333333333334],

			['-0.015em', 9.1722222222222207, 9.1722222222222207, false, -0.13758333333333331],
			['-1.5em', 74.000777777777756, 3.8805555555555551, false, -5.8208333333333329],
			['0em', 97.200839999999971, 3.8805555555555551, false, 0.0],
			['0.1em', 247.00008333333329, 3.1749999999999998, false, 0.3175],
			['0.2em', 180.00155555555551, 3.8805555555555995, false, 0.77611111111111997],
			['0.2em', 3.5277777777777772, false, true, 0.70555555555555549],
			['0.5em', 180.00155555555551, 9.1722222222222207, false, 4.5861111111111104],
			['0.5em', 3.8805555555555551, false, true, 1.9402777777777775],

			['0.5rem', 0.0, false, true, 0.0],
			['1rem', 3.8805555555555551, false, true, 0.0],

			['0pt', 90.0, 3.8805555555555551, false, 0.0],
			['12pt', 0, false, true, 4.2333333333333325],
			['3.6pt', 3.1749999999999998, false, true, 1.27],
			['3.6pt', 3.8805555555555551, false, true, 1.27],
			['9pt', '3.175mm', false, true, 3.1749999999999998],
			['9pt', 3.1749999999999998, false, true, 3.1749999999999998],

			['10pc', 210, false, false, 42.333333333333336],

			['0px', 142.47238888888884, 3.1749999999999998, false, 0.0],
			['1px', 89.000041666666647, 3.8805555555555551, false, 0.26458333333333334],
			['126px', 247.00008333333329, 3.1749999999999998, false, 33.337499999999999],

			['-7.76mm', NULL, 3.8805555555555551, false, -7.76],
			['0mm', 97.200839999999971, 3.8805555555555551, false, 0.0],
			['0.1mm', 110.00155555555551, 3.8805555555555551, false, 0.10000000000000001],
			['12mm', 210.00155555555551, 3.8805555555555551, false, 12.0],
			['2.4694444444444mm', 2.4694444444444441, false, true, 2.4694444444444001],
			['3.175mm', 0, false, true, 3.1749999999999998],
			['3.175mm', 3.1749999999999998, false, true, 3.1749999999999998],
			['3.5mm', 180.00155555555551, 3.5277777777777772, false, 3.5],

			['0.075cm', 74.000777777777756, 9.1722222222222207, false, 0.75],
			['2.3cm', 210.00155555555551, false, true, 23.0],

			['11.69in', 0, false, true, 296.92599999999999],

			['10%', 150, false, true, 15.0],
			['10%', 210.00155555555551, false, true, 21.000155555555551],
			['10%', 250, false, true, 25.0],
			['10%', 297.00008333333329, false, true, 29.700008333333329],
			['30%', 173.59266666666662, 3.8805555555555551, false, 52.077799999999982],
			['100%', 0, false, true, 0.0],
			['100%', 87.500777777777756, false, true, 87.500777777777756],
			['100%', 90.0, 3.8805555555555551, false, 90.0],
			['117%', 2.4694444444444441, false, true, 2.8892499999999997],
			['200%', 3.5277777777777772, 3.5277777777777772, true, 7.0555555555555536],

			['auto', 164.27933333333328, 3.8805555555555551, false, 0.0],
			['bottom', 5.149341999999999, 3.8805555555555551, false, 0.0],
			['medium', 180.00155555555551, 3.5277777777777772, false, 0.79374999999999996],
			['medium', 180.00155555555551, 3.8805555555555551, false, 0.79374999999999996],

			['small', 210, 12, true, 0.0],

			['n', 3.1749999999999998, 3.1749999999999998, true, 0.0],
			['n', 3.5277777777777772, 3.5277777777777772, true, 0.0],
			['n', 3.8805555555555551, 3.8805555555555551, true, 0.0],
		];
	}

}
