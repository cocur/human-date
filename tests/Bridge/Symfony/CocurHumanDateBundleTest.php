<?php

/**
 * This file is part of cocur/human-date.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\HumanDate\Bridge\Symfony;

use Cocur\HumanDate\Bridge\Symfony\CocurHumanDateBundle;

/**
 * CocurHumanDateBundleTest
 *
 * @category   test
 * @package    cocur/human-date
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 * @group      unit
 */
class CocurHumanDateBundleTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->bundle = new CocurHumanDateBundle();
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Symfony\CocurHumanDateBundle::build()
     */
    public function build()
    {
        $container = $this->getMock(
            'Symfony\Component\DependencyInjection\ContainerBuilder',
            array('registerExtension')
        );
        $container->expects($this->once())
            ->method('registerExtension')
            ->with($this->isInstanceOf('Cocur\HumanDate\Bridge\Symfony\CocurHumanDateExtension'));

        $this->bundle->build($container);
    }
}

