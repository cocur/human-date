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

use DateTime;
use Cocur\HumanDate\HumanDate;
use Mockery as m;

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
     * @test
     * @covers Cocur\HumanDate\HumanDate::__construct()
     * @expectedException \InvalidArgumentException
     */
    public function constructorGetsInvalidTranslation()
    {
        new HumanDate('string');
    }

    /**
     * @test
     * @covers Cocur\HumanDate\HumanDate::transform()
     * @covers Cocur\HumanDate\HumanDate::isToday()
     * @covers Cocur\HumanDate\HumanDate::isTomorrow()
     * @covers Cocur\HumanDate\HumanDate::isYesterday()
     * @covers Cocur\HumanDate\HumanDate::isNextWeek()
     * @covers Cocur\HumanDate\HumanDate::isLastWeek()
     * @covers Cocur\HumanDate\HumanDate::isThisYear()
     * @covers Cocur\HumanDate\HumanDate::trans()
     * @dataProvider provider
     */
    public function transformDateTime($date, $expected)
    {
        $this->assertEquals($expected, $this->humanDate->transform(new DateTime($date)));
    }

    /**
     * @test
     * @covers Cocur\HumanDate\HumanDate::transform()
     * @covers Cocur\HumanDate\HumanDate::isToday()
     * @covers Cocur\HumanDate\HumanDate::isTomorrow()
     * @covers Cocur\HumanDate\HumanDate::isYesterday()
     * @covers Cocur\HumanDate\HumanDate::isNextWeek()
     * @covers Cocur\HumanDate\HumanDate::isLastWeek()
     * @covers Cocur\HumanDate\HumanDate::isThisYear()
     * @dataProvider provider
     */
    public function transformString($date, $expected)
    {
        $this->assertEquals($expected, $this->humanDate->transform($date));
    }

    /**
     * @return array[]
     */
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

    /**
     * @test
     * @covers Cocur\HumanDate\HumanDate::transform()
     * @covers Cocur\HumanDate\HumanDate::isToday()
     * @covers Cocur\HumanDate\HumanDate::isTomorrow()
     * @covers Cocur\HumanDate\HumanDate::isYesterday()
     * @covers Cocur\HumanDate\HumanDate::isNextWeek()
     * @covers Cocur\HumanDate\HumanDate::isLastWeek()
     * @covers Cocur\HumanDate\HumanDate::isThisYear()
     * @covers Cocur\HumanDate\HumanDate::trans()
     * @dataProvider translatedProvider
     */
    public function transformDateTimeWithTranslation($date, $expected)
    {
        $trans = m::mock('Cocur\HumanDate\Translation\TranslationInterface');
        $trans->shouldReceive('trans')->with('Today', [])->andReturn('Heute');
        $trans->shouldReceive('trans')->with('Yesterday', [])->andReturn('Gestern');
        $trans->shouldReceive('trans')->with('Tomorrow', [])->andReturn('Morgen');
        $trans
            ->shouldReceive('trans')
            ->with('Next %weekday%', [ '%weekday%' => date('l', strtotime('+3 days')) ])
            ->andReturn('Nächsten '.date('l', strtotime('+3 days')));
        $trans
            ->shouldReceive('trans')
            ->with('Last %weekday%', [ '%weekday%' => date('l', strtotime('-3 days')) ])
            ->andReturn('Letzten '.date('l', strtotime('-3 days')));

        $humanDate = new HumanDate($trans);
        $this->assertEquals($expected, $humanDate->transform(new DateTime($date)));
    }

    /**
     * @return array[]
     */
    public function translatedProvider()
    {
        return array(
            array('', 'Heute'),
            array('-1 day', 'Gestern'),
            array('+1 day', 'Morgen'),
            array('+3 days', 'Nächsten '.date('l', strtotime('+3 days'))),
            array('-3 days', 'Letzten '.date('l', strtotime('-3 days'))),
            array('+30 days', date('F j', strtotime('+30 days'))),
            array('-30 days', date('F j', strtotime('-30 days'))),
            array((date('Y')+1).'-03-31', 'March 31, '.(date('Y')+1)),
            array((date('Y')-1).'-03-31', 'March 31, '.(date('Y')-1))
        );
    }
}
