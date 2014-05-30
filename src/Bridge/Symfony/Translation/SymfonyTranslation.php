<?php

/**
 * This file is part of cocur/human-date.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\HumanDate\Bridge\Symfony\Translation;

use Cocur\HumanDate\Translation\TranslationInterface;
use Symfony\Component\Translation\TranslatorInterface as SymfonyTranslationInterface;

/**
 * SymfonyTranslation provides an adapter to translate strings using the Symfony Translation component.
 *
 * @package    cocur/human-date
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 */
class SymfonyTranslation implements TranslationInterface
{
    /** @var SymfonyTranslationInterface */
    private $translation;

    /** @var string */
    private $domain;

    /** @var string */
    private $locale;

    /**
     * @param SymfonyTranslationInterface $translation Symfony translation
     * @param string                      $domain      The domain for the message or null to use the default
     * @param string                      $locale      The locale or null to use the default
     */
    public function __construct(SymfonyTranslationInterface $translation, $domain = null, $locale = null)
    {
        $this->translation = $translation;
        $this->domain      = $domain;
        $this->locale      = $locale;
    }

    /**
     * @return SymfonyTranslationInterface
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * @return string The domain for the message or null to use the default
     */
    public function getDomain()
    {
        return $this->domain;
    }

    /**
     * @return string The locale or null to use the default
     */
    public function getLocale()
    {
        return $this->locale;
    }

    /**
     * Translates the given message.
     *
     * @param string $message    The message id (may also be an object that can be cast to string)
     * @param array  $parameters An array of parameters for the message
     *
     * @return string The translated string
     */
    public function trans($message, array $parameters = array())
    {
        return $this->translation->trans($message, $parameters, $this->domain, $this->locale);
    }
}
