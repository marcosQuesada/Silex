<?php

namespace Silex\tests;

use Silex\WebTestCase;

class BaseTestTest extends WebTestCase
{

    public function setUp()
    {
        parent::setUp();
    }

    public function createApplication()
    {
        $app = require __DIR__.'/../src/Core/app.php';
        $app['debug'] = true;
        $app['exception_handler']->disable();

        return $app;
    }

    public function testSkillPointsSetAndGet()
    {
        $this->assertTrue(true);
    }


    public function tearDown()
    {
        parent::tearDown();
    }
}
