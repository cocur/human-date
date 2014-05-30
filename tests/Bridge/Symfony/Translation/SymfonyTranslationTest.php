<?php

namespace Cocur\HumanDate\Bridge\Symfony\Translation;

use Mockery as m;


/**
 * SymfonyTranslationTest
 *
 * @group unit
 */
class SymfonyTranslationTest extends \PHPUnit_Framework_TestCase
{
    /** @var string */
    private $symfonyTrans;

    /** @var SymfonyTranslation */
    private $trans;

    public function setUp()
    {
        $this->symfonyTrans = m::mock('Symfony\Component\Translation\TranslatorInterface');
        $this->trans = new SymfonyTranslation($this->symfonyTrans, 'foo', 'en');
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Symfony\Translation\SymfonyTranslation::__construct()
     * @covers Cocur\HumanDate\Bridge\Symfony\Translation\SymfonyTranslation::getTranslation()
     */
    public function getTranslation()
    {
        $this->assertEquals($this->symfonyTrans, $this->trans->getTranslation());
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Symfony\Translation\SymfonyTranslation::__construct()
     * @covers Cocur\HumanDate\Bridge\Symfony\Translation\SymfonyTranslation::getDomain()
     */
    public function getDomain()
    {
        $this->assertEquals('foo', $this->trans->getDomain());
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Symfony\Translation\SymfonyTranslation::__construct()
     * @covers Cocur\HumanDate\Bridge\Symfony\Translation\SymfonyTranslation::getLocale()
     */
    public function getLocale()
    {
        $this->assertEquals('en', $this->trans->getLocale());
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Symfony\Translation\SymfonyTranslation::trans()
     */
    public function trans()
    {
        $this->symfonyTrans
            ->shouldReceive('trans')
            ->with('string', [], 'foo', 'en')
            ->once()
            ->andReturn('translated string');

        $this->assertEquals('translated string', $this->trans->trans('string'));
    }

    /**
     * @test
     * @covers Cocur\HumanDate\Bridge\Symfony\Translation\SymfonyTranslation::trans()
     */
    public function transWithParameters()
    {
        $this->symfonyTrans
            ->shouldReceive('trans')
            ->with('string', [ 'key1' => 'val1' ], 'foo', 'en')
            ->once()
            ->andReturn('translated string');

        $this->assertEquals('translated string', $this->trans->trans('string', [ 'key1' => 'val1' ]));
    }
}
