<?php
use PHPUnit\Framework\TestCase;

class SecurityTest extends TestCase
{

    public function meaningfulTestFunctionName() {
        // arbitrary unit test
        $a = -1;
        $this->assertEquals(-1, $a->getAmount());
    }

}