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

namespace PhlexaTest\Intent;

use Phlexa\Configuration\SkillConfiguration;
use Phlexa\Intent\AbstractIntent;
use Phlexa\Intent\IntentInterface;
use Phlexa\Intent\StopIntent;
use Phlexa\Request\RequestType\RequestTypeFactory;
use Phlexa\Response\AlexaResponse;
use Phlexa\Session\SessionContainer;
use Phlexa\TextHelper\TextHelper;
use PHPUnit\Framework\TestCase;

/**
 * Class StopIntentTest
 *
 * @package PhlexaTest\Intent
 */
class StopIntentTest extends TestCase
{
    /**
     * Test the instantiation of the class
     */
    public function testInstantiation(): void
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.StopIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $alexaRequest       = RequestTypeFactory::createFromData(json_encode($data));
        $alexaResponse      = new AlexaResponse();
        $textHelper         = new TextHelper();
        $skillConfiguration = new SkillConfiguration();

        $stopIntent = new StopIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);

        $this->assertInstanceOf(AbstractIntent::class, $stopIntent);
        $this->assertInstanceOf(IntentInterface::class, $stopIntent);
    }

    /**
     * Test the handling of the intent
     */
    public function testHandleSimple(): void
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.StopIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ]
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper   = new TextHelper();

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        $skillConfiguration = new SkillConfiguration();
        $skillConfiguration->setSmallFrontImage('https://image.server/small.png');
        $skillConfiguration->setLargeFrontImage('https://image.server/large.png');
        $skillConfiguration->setSmallBackgroundImage('https://image.server/small-background.png');
        $skillConfiguration->setMediumBackgroundImage('https://image.server/medium-background.png');
        $skillConfiguration->setLargeBackgroundImage('https://image.server/large-background.png');
        $skillConfiguration->setExtraLargeBackgroundImage('https://image.server/extra-large-background.png');
        $skillConfiguration->setNormalBodyAplDocument('{"type": "APL"}');

        $stopIntent = new StopIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);
        $stopIntent->handle();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stopMessage</speak>',
                ],
                'card'             => [
                    'type'  => 'Standard',
                    'title' => 'stopTitle',
                    'text'  => 'stopMessage',
                    'image' => [
                        'smallFrontImage' => 'https://image.server/small.png',
                        'largeFrontImage' => 'https://image.server/large.png',
                    ],
                ],
                'shouldEndSession' => true,
            ],
            'userAgent'         => 'phlexa-2.0 framework'
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     * Test the handling of the intent with display
     */
    public function testHandleWithDisplay(): void
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.StopIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ],
                'System'      => [
                    'application' => [
                        'applicationId' => 'amzn1.ask.skill.applicationId',
                    ],
                    'user'        => [
                        'userId' => 'userId',
                    ],
                    'device'      => [
                        'supportedInterfaces' => [
                            'Display' => [],
                        ],
                    ],
                ],
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper   = new TextHelper();

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        $skillConfiguration = new SkillConfiguration();
        $skillConfiguration->setSmallFrontImage('https://image.server/small.png');
        $skillConfiguration->setLargeFrontImage('https://image.server/large.png');
        $skillConfiguration->setSmallBackgroundImage('https://image.server/small-background.png');
        $skillConfiguration->setMediumBackgroundImage('https://image.server/medium-background.png');
        $skillConfiguration->setLargeBackgroundImage('https://image.server/large-background.png');
        $skillConfiguration->setExtraLargeBackgroundImage('https://image.server/extra-large-background.png');
        $skillConfiguration->setNormalBodyAplDocument('{"type": "APL"}');

        $stopIntent = new StopIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);
        $stopIntent->handle();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stopMessage</speak>',
                ],
                'directives'       => [
                    [
                        'type'     => 'Display.RenderTemplate',
                        'template' => [
                            'type'            => 'BodyTemplate6',
                            'token'           => 'stop',
                            'backButton'      => 'HIDDEN',
                            'textContent'     => [
                                'largeText'  => [
                                    'text' => '<font size="7"><b>stopTitle</b></font>',
                                    'type' => 'RichText',
                                ],
                                'mediumText' => [
                                    'text' => '<font size="3">stopMessage</font>',
                                    'type' => 'RichText',
                                ],
                                'shortText'  => [
                                    'text' => '',
                                    'type' => 'PlainText',
                                ],
                            ],
                            'backgroundImage' => [
                                'contentDescription' => 'stopTitle',
                                'sources'            => [
                                    [
                                        'url'  => 'https://image.server/medium-background.png',
                                        'type' => 'LARGE',
                                    ],
                                ],
                            ],
                            'title'           => 'stopTitle',
                        ],
                    ],
                ],
                'shouldEndSession' => true,
            ],
            'userAgent'         => 'phlexa-2.0 framework'
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }

    /**
     * Test the handling of the intent with APL
     */
    public function testHandleWithApl(): void
    {
        $data = [
            'version' => '1.0',
            'session' => [
                'new'         => true,
                'sessionId'   => 'sessionId',
                'application' => [
                    'applicationId' => 'amzn1.ask.skill.applicationId',
                ],
                'user'        => [
                    'userId' => 'userId',
                ],
            ],
            'request' => [
                'type'      => 'IntentRequest',
                'requestId' => 'requestId',
                'timestamp' => '2017-01-27T20:29:59Z',
                'locale'    => 'en-US',
                'intent'    => [
                    'name'  => 'AMAZON.StopIntent',
                    'slots' => [],
                ],
            ],
            'context' => [
                'AudioPlayer' => [
                    'playerActivity' => 'IDLE',
                ],
                'System'      => [
                    'application' => [
                        'applicationId' => 'amzn1.ask.skill.applicationId',
                    ],
                    'user'        => [
                        'userId' => 'userId',
                    ],
                    'device'      => [
                        'supportedInterfaces' => [
                            'Alexa.Presentation.APL' => [],
                        ],
                    ],
                ],
            ],
        ];

        $sessionContainer = new SessionContainer(['foo' => 'bar']);

        $alexaRequest = RequestTypeFactory::createFromData(json_encode($data));
        $textHelper   = new TextHelper();

        $alexaResponse = new AlexaResponse();
        $alexaResponse->setSessionContainer($sessionContainer);

        $skillConfiguration = new SkillConfiguration();
        $skillConfiguration->setSmallFrontImage('https://image.server/small.png');
        $skillConfiguration->setLargeFrontImage('https://image.server/large.png');
        $skillConfiguration->setSmallBackgroundImage('https://image.server/small-background.png');
        $skillConfiguration->setMediumBackgroundImage('https://image.server/medium-background.png');
        $skillConfiguration->setLargeBackgroundImage('https://image.server/large-background.png');
        $skillConfiguration->setExtraLargeBackgroundImage('https://image.server/extra-large-background.png');
        $skillConfiguration->setNormalBodyAplDocument('{"type": "APL"}');

        $stopIntent = new StopIntent($alexaRequest, $alexaResponse, $textHelper, $skillConfiguration);
        $stopIntent->handle();

        $expected = [
            'version'           => '1.0',
            'sessionAttributes' => [],
            'response'          => [
                'outputSpeech'     => [
                    'type' => 'SSML',
                    'ssml' => '<speak>stopMessage</speak>',
                ],
                'directives'       => [
                    [
                        'type'        => 'Alexa.Presentation.APL.RenderDocument',
                        'version'     => '1.0',
                        'document'    => [
                            'type'         => 'APL',
                            'version'      => '1.0',
                            'theme'        => 'dark',
                            'import'       => [],
                            'resources'    => [],
                            'styles'       => [],
                            'layouts'      => [],
                            'mainTemplate' => [],
                        ],
                        'token'       => 'stop',
                        'datasources' => [
                            'content' => [
                                'imageContent' => [
                                    'logoIcon'                  => null,
                                    'imageTitle'                => 'stopTitle',
                                    'smallFrontImage'           => 'https://image.server/small.png',
                                    'largeFrontImage'           => 'https://image.server/large.png',
                                    'smallBackgroundImage'      => 'https://image.server/small-background.png',
                                    'mediumBackgroundImage'     => 'https://image.server/medium-background.png',
                                    'largeBackgroundImage'      => 'https://image.server/large-background.png',
                                    'extraLargeBackgroundImage' => 'https://image.server/extra-large-background.png',
                                ],
                                'textContent'  => [
                                    'title'      => 'stopTitle',
                                    'largeText'  => 'stopMessage',
                                    'mediumText' => null,
                                    'hintText'   => null,
                                ],
                            ],
                        ],
                    ],
                ],
                'shouldEndSession' => true,
            ],
            'userAgent'         => 'phlexa-2.0 framework'
        ];

        $this->assertEquals($expected, $alexaResponse->toArray());
    }
}
