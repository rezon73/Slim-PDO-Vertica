<?php

/**
 * @license MIT
 * @license http://opensource.org/licenses/MIT
 */

namespace Rezon73\PDO\Test;

use Rezon73\PDO\Clause;
use Rezon73\PDO\PDOVertica;
use Rezon73\PDO\Statement;
use PDO;
use PHPUnit\Framework\TestCase;

class CallTest extends TestCase
{
    /** @var Statement\Call $subject */
    private $subject;

    public function setUp(): void
    {
        parent::setUp();

        $this->subject = new Statement\Call($this->createMock(PDOVertica::class));
    }

    public function testToString()
    {
        $this->subject->method(new Clause\Method('MyFunc'));

        $this->assertStringStartsWith('CALL', $this->subject->__toString());
    }

    public function testToStringWithoutMethod()
    {
        $this->expectError();
        $this->expectErrorMessageMatches('/^No method set for call statement/');

        $this->subject->__toString();
    }

    public function testGetValues()
    {
        $this->subject->method(new Clause\Method('MyFunc', 1, 2));

        $this->assertIsArray($this->subject->getValues());
        $this->assertCount(2, $this->subject->getValues());
    }
}
