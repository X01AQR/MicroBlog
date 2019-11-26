<?php


namespace tests\Feature\UserFeatureTest;


class GetAllUsersTest extends \TestCase
{
    public function testUsersFound()
    {
        $this->get('/api/users')->assertResponseStatus(200);
    }

}
