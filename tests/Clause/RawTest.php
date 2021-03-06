<?php

/**
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 */

namespace Rezon73\PDOVertica\Test;

use Rezon73\PDOVertica\Clause;
use PHPUnit\Framework\TestCase;

class RawTest extends TestCase
{
    /** @var Clause\Raw $subject */
    private $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new Clause\Raw('test');
    }

    public function testToString()
    {
        $this->assertEquals('test', $this->subject->__toString());
    }

    public function testGetValues()
    {
        $this->assertIsArray($this->subject->getValues());
        $this->assertEmpty($this->subject->getValues());
    }
}
