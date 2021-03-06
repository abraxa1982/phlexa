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

namespace Phlexa\Request\RequestType;

/**
 * Class PlaybackControllerPreviousCommandIssuedType
 *
 * @package Phlexa\Request\RequestType
 */
class PlaybackControllerPreviousCommandIssuedType extends AbstractRequestType
{
    public const NAME = 'PlaybackController.PreviousCommandIssued';

    /** @var string */
    private $type = 'PlaybackController.PreviousCommandIssued';

    /**
     * PlaybackControllerPreviousCommandIssuedType constructor.
     *
     * @param string $requestId
     * @param string $timestamp
     * @param string $locale
     */
    public function __construct(
        string $requestId,
        string $timestamp,
        string $locale
    ) {
        $this->requestId = $requestId;
        $this->timestamp = $timestamp;
        $this->locale    = $locale;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }
}
