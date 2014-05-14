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

use \DateTime;
use Cocur\HumanDate\HumanDate;

/**
 * HumanDateTest
 *
 * @category  test
 * @package   cocur/human-date
 * @author    Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright 2012-2014 Florian Eckerstorfer
 * @license   http://opensource.org/licenses/MIT The MIT License
 * @link      https://github.com/braincrafted/human-date-bundle BraincraftedHumanDateBundle
 * @group     unit
 */
class HumanDateTest extends \PHPUnit_Framework_TestCase
{
    /** @var HumanDateTransformer */
    protected $humanDate;

    public function setUp()
    {
        $this->humanDate = new HumanDate();
    }

    /**
     * @covers Cocur\HumanDate\HumanDate::transform()
     * @covers Cocur\HumanDate\HumanDate::isToday()
     * @covers Cocur\HumanDate\HumanDate::isToday()
     * @dataProvider provider
     */
    public function testTransform($date, $expected)
    {
        $this->assertEquals($expected, $this->humanDate->transform(new DateTime($date)));
    }

    /**
     * @covers Cocur\HumanDate\HumanDate::transform()
     * @covers Cocur\HumanDate\HumanDate::isToday()
     * @covers Cocur\HumanDate\HumanDate::isTomorrow()
     * @covers Cocur\HumanDate\HumanDate::isYesterday()
     * @covers Cocur\HumanDate\HumanDate::isNextWeek()
     * @covers Cocur\HumanDate\HumanDate::isLastWeek()
     * @covers Cocur\HumanDate\HumanDate::ISTHISYEAR()
     * @dataProvider provider
     */
    public function testTransformString($date, $expected)
    {
        $this->assertEquals($expected, $this->humanDate->transform($date));
    }

    public function provider()
    {
        return array(
            array('', 'Today'),
            array('-1 day', 'Yesterday'),
            array('+1 day', 'Tomorrow'),
            array('+3 days', 'Next '.date('l', strtotime('+3 days'))),
            array('-3 days', 'Last '.date('l', strtotime('-3 days'))),
            array('+30 days', date('F j', strtotime('+30 days'))),
            array('-30 days', date('F j', strtotime('-30 days'))),
            array((date('Y')+1).'-03-31', 'March 31, '.(date('Y')+1)),
            array((date('Y')-1).'-03-31', 'March 31, '.(date('Y')-1))
        );
    }
}
