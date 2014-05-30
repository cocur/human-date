<?php

/**
 * This file is part of cocur/human-date.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\HumanDate\Translation;

/**
 * TranslationInterface
 *
 * @package    cocur/human-date
 * @subpackage translation
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 */
interface TranslationInterface
{
    /**
     * Translates the given message.
     *
     * @param string $message    The message id (may also be an object that can be cast to string)
     * @param array  $parameters An array of parameters for the message
     *
     * @return string Translated message.
     */
    public function trans($message, array $parameters = array());
}
