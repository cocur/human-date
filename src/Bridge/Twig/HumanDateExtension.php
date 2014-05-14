<?php

/**
 * This file is part of cocur/human-date.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\HumanDate\Bridge\Twig;

use \Twig_Extension;
use \Twig_SimpleFilter;
use \DateTime;

use Cocur\HumanDate\HumanDate;

/**
 * HumanDateExtension
 *
 * @package    cocur/human-date
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 */
class HumanDateExtension extends Twig_Extension
{
    /** @var HumanDate */
    private $humanDate;

    /**
     * @param HumanDate $humanDate
     */
    public function __construct(HumanDate $humanDate)
    {
        $this->humanDate = $humanDate;
    }

    /**
     * @return \Twig_SimpleFilter[]
     */
    public function getFilters()
    {
        return array(new Twig_SimpleFilter('humanDate', array($this, 'humanDateFilter')));
    }

    /**
     * @param DateTime $date
     *
     * @return string
     */
    public function humanDateFilter($date)
    {
        return $this->humanDate->transform($date);
    }

    /**
     * {@inheritDoc}
     */
    public function getName()
    {
        return 'human_date';
    }
}
