<?php
/**
 * Build voice applications for Amazon Alexa with phlexa and PHP
 *
 * @author     Ralf Eggert <ralf@travello.audio>
 * @license    http://opensource.org/licenses/MIT The MIT License (MIT)
 * @link       https://github.com/phoice/phlexa
 * @link       https://www.phoice.tech/
 * @link       https://www.travello.audio/
 */

declare(strict_types=1);

namespace PhlexaTest\Request\RequestType;

use Phlexa\Request\RequestType\PlaybackControllerPauseCommandIssuedType;
use PHPUnit\Framework\TestCase;

/**
 * Class PlaybackControllerPauseCommandIssuedTest
 *
 * @package PhlexaTest\Request\RequestType
 */
class PlaybackControllerPauseCommandIssuedTest extends TestCase
{
    /**
     *
     */
    public function testInstantiation()
    {
        $requestId = 'requestId';
        $timestamp = '2017-01-27T20:29:59Z';
        $locale    = 'de-DE';

        $launchRequest = new PlaybackControllerPauseCommandIssuedType(
            $requestId,
            $timestamp,
            $locale
        );

        $this->assertEquals('PlaybackController.PauseCommandIssued', $launchRequest->getType());
        $this->assertEquals($requestId, $launchRequest->getRequestId());
        $this->assertEquals($timestamp, $launchRequest->getTimestamp());
        $this->assertEquals($locale, $launchRequest->getLocale());
    }
}
