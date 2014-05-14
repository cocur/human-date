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

use Cocur\HumanDate\Bridge\Twig\HumanDateExtension;
use \Mockery as m;


/**
 * HumanDateExtensionTest
 *
 * @category   test
 * @package    cocur/human-date
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 * @group      unit
 */
class HumanDateExtensionTest extends \PHPUnit_Framework_TestCase
{
    /** @var HumanDate */
    private $humanDate;

    /** @var HumanDateExtension */
    private $extension;

    public function setUp()
    {
        $this->humanDate = m::mock('Cocur\HumanDate\HumanDate');
        $this->extension = new HumanDateExtension($this->humanDate);
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Twig\HumanDateExtension::getName()
     */
    public function getName($withDataSet = true)
    {
        $this->assertEquals('human_date', $this->extension->getName());
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Twig\HumanDateExtension::getFilters()
     */
    public function getFilters()
    {
        $filters = $this->extension->getFilters();

        $this->assertCount(1, $filters);
        $this->assertInstanceOf('\Twig_SimpleFilter', $filters[0]);
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Twig\HumanDateExtension::slugifyFilter()
     */
    public function slugifyFilter()
    {
        $this->humanDate->shouldReceive('transform')->with('2014-05-14')->once()->andReturn('Today');

        $this->assertEquals('Today', $this->extension->humanDateFilter('2014-05-14'));
    }
}
