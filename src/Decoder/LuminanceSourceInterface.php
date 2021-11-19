<?php
/**
 * Interface LuminanceSourceInterface
 *
 * @created      18.11.2021
 * @author       smiley <smiley@chillerlan.net>
 * @copyright    2021 smiley
 * @license      MIT
 */

namespace chillerlan\QRCode\Decoder;

/**
 */
interface LuminanceSourceInterface{

	/**
	 * Fetches luminance data for the underlying bitmap. Values should be fetched using:
	 * {@code int luminance = array[y * width + x] & 0xff}
	 *
	 * @return array A row-major 2D array of luminance values. Do not use result.length as it may be
	 *         larger than width * height bytes on some platforms. Do not modify the contents
	 *         of the result.
	 */
	public function getMatrix():array;

	/**
	 * @return int The width of the bitmap.
	 */
	public function getWidth():int;

	/**
	 * @return int The height of the bitmap.
	 */
	public function getHeight():int;

	/**
	 * Fetches one row of luminance data from the underlying platform's bitmap. Values range from
	 * 0 (black) to 255 (white). Because Java does not have an unsigned byte type, callers will have
	 * to bitwise and with 0xff for each value. It is preferable for implementations of this method
	 * to only fetch this row rather than the whole image, since no 2D Readers may be installed and
	 * getMatrix() may never be called.
	 *
	 * @param int $y  The row to fetch, which must be in [0,getHeight())
	 *
	 * @return array An array containing the luminance data.
	 */
	public function getRow(int $y):array;


	public static function fromFile(string $path):self;
	public static function fromBlob(string $blob):self;

}
