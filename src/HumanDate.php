<?php

/**
 * This file is part of cocur/human-date.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\HumanDate;

use Cocur\HumanDate\Translation\TranslationInterface;
use DateTime;
use InvalidArgumentException;

/**
 * HumanDate
 *
 * @package   cocur/human-date
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2012-2014 Florian Eckerstorfer
 * @license   http://opensource.org/licenses/MIT The MIT License
 */
class HumanDate
{
    /** @var TranslationInterface */
    private $translation;

    /**
     * @param TranslationInterface|null $translation Object to translate messages.
     */
    public function __construct($translation = null)
    {
        if (null !== $translation && !$translation instanceof TranslationInterface) {
            throw new InvalidArgumentException('$translation must be null or an instance ofr TranslationInterface');
        }

        $this->translation = $translation;
    }

    /**
     * @return TranslationInterface Object to translate messages.
     */
    public function getTranslation()
    {
        return $this->translation;
    }

    /**
     * Transforms the given date into a human-readable date.
     *
     * @param DateTime|string $date Input date.
     *
     * @return string Human-readable date.
     */
    public function transform($date)
    {
        if (!$date instanceof DateTime) {
            $date = new DateTime($date);
        }

        $current = new DateTime('now');

        if ($this->isToday($date)) {
            return $this->trans('Today');
        }

        if ($this->isYesterday($date)) {
            return $this->trans('Yesterday');
        }

        if ($this->isTomorrow($date)) {
            return $this->trans('Tomorrow');
        }

        if ($this->isNextWeek($date)) {
            return $this->trans('Next %weekday%', [ '%weekday%' =>  $date->format('l') ]);
        }

        if ($this->isLastWeek($date)) {
            return $this->trans('Last %weekday%', [ '%weekday%' => $date->format('l') ]);
        }

        if ($this->isThisYear($date)) {
            return $date->format('F j');
        }

        return $date->format('F j, Y');
    }

    /**
     * @param DateTime $date Date.
     *
     * @return boolean `true` if the given date is today, `false` otherwise.
     */
    protected function isToday(DateTime $date)
    {
        $today = new DateTime('now');
        $start = new DateTime($today->format('Y-m-d') . ' 00:00:00');
        $end   = new DateTime($today->format('Y-m-d') . ' 23:59:59');

        if ($date->getTimestamp() >= $start->getTimestamp() && $date->getTimestamp() <= $end->getTimestamp()) {
            return true;
        }
        return false;
    }

    /**
     * @param DateTime $date Date.
     *
     * @return boolean `true` if the given date is tomorrow, `false` otherwise.
     */
    protected function isTomorrow(DateTime $date)
    {
        $tomorrow = new DateTime('+1 day');
        $start = new DateTime($tomorrow->format('Y-m-d') . ' 00:00:00');
        $end   = new DateTime($tomorrow->format('Y-m-d') . ' 23:59:59');

        if ($date->getTimestamp() >= $start->getTimestamp() && $date->getTimestamp() <= $end->getTimestamp()) {
            return true;
        }
        return false;
    }

    /**
     * @param DateTime $date Date.
     *
     * @return boolean `true` if the given date is yesterday, `false` otherwise.
     */
    protected function isYesterday(DateTime $date)
    {
        $yesterday = new DateTime('-1 day');
        $start = new DateTime($yesterday->format('Y-m-d') . ' 00:00:00');
        $end   = new DateTime($yesterday->format('Y-m-d') . ' 23:59:59');

        if ($date->getTimestamp() >= $start->getTimestamp() && $date->getTimestamp() <= $end->getTimestamp()) {
            return true;
        }
        return false;
    }

    /**
     * @param DateTime $date Date.
     *
     * @return boolean `true` if the given date is next week, `false` otherwise.
     */
    protected function isNextWeek(DateTime $date)
    {
        $week = new DateTime('+7 days');

        if ($date->getTimestamp() >= time() && $date->getTimestamp() <= $week->getTimestamp()) {
            return true;
        }
        return false;
    }

    /**
     * @param DateTime $date Date.
     *
     * @return boolean `true` if the given date is last week, `false` otherwise.
     */
    protected function isLastWeek(DateTime $date)
    {
        $week = new DateTime('-7 days');

        if ($date->getTimestamp() <= time() && $date->getTimestamp() >= $week->getTimestamp()) {
            return true;
        }
        return false;
    }

    /**
     * @param DateTime $date Date.
     * @return boolean `true` if the given date is this year, `false` otherwise.
     */
    protected function isThisYear(DateTime $date)
    {
        if (date('Y') === $date->format('Y')) {
            return true;
        }
        return false;
    }

    /**
     * Translates the given message.
     *
     * @param string $id         The message id (may also be an object that can be cast to string).
     * @param array  $parameters An array of parameters for the message.
     *
     * @return string The translated message.
     */
    protected function trans($id, array $parameters = array())
    {
        if (null === $this->translation) {
            return str_replace(array_keys($parameters), array_values($parameters), $id);
        }

        return $this->translation->trans($id, $parameters);
    }
}
