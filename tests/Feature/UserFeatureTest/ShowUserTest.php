<?php


namespace tests\Feature\UserFeatureTest;


class ShowUserTest extends \TestCase
{
    public function testStringInput()
    {
       $this->get('/api/users/string')->assertResponseStatus(422);
    }

    public function testNonIntegerInput()
    {
        $this->get('/api/users/23.4')->assertResponseStatus(422);
    }

    public function testNegativeIntegerInput()
    {
        $this->get('/api/users/-4')->assertResponseStatus(422);
    }

    public function testUserNotFound()
    {
        $this->get('/api/users/5000')->assertResponseStatus(404);
    }

    public function testUserFound()
    {
        $this->get('/api/users/2')->assertResponseStatus(200);
    }

}
