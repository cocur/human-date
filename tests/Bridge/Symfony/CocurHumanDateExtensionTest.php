<?php

/**
 * This file is part of cocur/human-date.
 *
 * (c) Florian Eckerstorfer <florian@eckerstorfer.co>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Cocur\HumanDate\Bridge\Bundle;

use Cocur\HumanDate\Bridge\Symfony\CocurHumanDateExtension;
use \Mockery as m;


/**
 * CocurHumanDateExtensionTest
 *
 * @category   test
 * @package    cocur/human-date
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://www.opensource.org/licenses/MIT The MIT License
 * @group      unit
 */
class CocurHumanDateExtensionTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->extension = new CocurHumanDateExtension();
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Symfony\CocurHumanDateExtension::load()
     */
    public function load()
    {
        $twigDefinition = m::mock('Symfony\Component\DependencyInjection\Definition');
        $twigDefinition
            ->shouldReceive('addTag')
            ->with('twig.extension')
            ->once()
            ->andReturn($twigDefinition);
        $twigDefinition
            ->shouldReceive('setPublic')
            ->with(false)
            ->once();

        $container = m::mock('Symfony\Component\DependencyInjection\ContainerBuilder');
        $container
            ->shouldReceive('setDefinition')
            ->with('cocur_human_date', m::type('Symfony\Component\DependencyInjection\Definition'))
            ->once();
        $container
            ->shouldReceive('setDefinition')
            ->with('cocur_human_date.twig.human_date', m::type('Symfony\Component\DependencyInjection\Definition'))
            ->once()
            ->andReturn($twigDefinition);
        $container
            ->shouldReceive('setAlias')
            ->with('human_date', 'cocur_human_date')
            ->once();

        $this->extension->load(array(), $container);
    }
}

