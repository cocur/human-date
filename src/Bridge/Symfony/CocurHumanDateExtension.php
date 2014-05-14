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

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;
use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * CocurHumanDateExtension
 *
 * @package    cocur/human-date
 * @subpackage bridge
 * @author     Florian Eckerstorfer <florian@eckerstorfer.co>
 * @copyright  2012-2014 Florian Eckerstorfer
 * @license    http://opensource.org/licenses/MIT The MIT License
 */
class CocurHumanDateExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $container->setDefinition('cocur_human_date', new Definition('Cocur\HumanDate\HumanDate'));
        $container
            ->setDefinition(
                'cocur_human_date.twig.human_date',
                new Definition(
                    'Cocur\HumanDate\Bridge\Twig\HumanDateExtension',
                    array(new Reference('cocur_human_date'))
                )
            )
            ->addTag('twig.extension')
            ->setPublic(false);
        $container->setAlias('human_date', 'cocur_human_date');
    }
}
