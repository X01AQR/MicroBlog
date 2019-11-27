<?php


namespace tests\Feature\AuthFeatureTest;


use App\User;
use Laravel\Lumen\Testing\DatabaseMigrations;

class RegisterTest extends \TestCase
{
    use DatabaseMigrations;

   protected function setUp(): void
   {
       parent::setUp();
       $this->runDatabaseMigrations();
   }

   public function testRegistrationWithoutEmail()
   {
       $attributes = [
           'full_name' => 'Test name',
           'email' => null,
           'password' => 'password'
       ];

       $this->post('/api/auth/register', $attributes)->assertResponseStatus(422);
   }

   public function testRegistrationWithoutName()
   {
       $attributes = [
           'full_name' => null,
           'email' => 'test@email.com',
           'password' => 'password'
       ];

       $this->post('/api/auth/register', $attributes)->assertResponseStatus(422);
   }

   public function testRegistrationWithoutPassword()
   {
       $attributes = [
           'full_name' => 'Test name',
           'email' => 'test@email.com',
           'password' => null
       ];

       $this->post('/api/auth/register', $attributes)->assertResponseStatus(422);
   }

   public function testRegistrationWithoutInvalidEmail()
   {
       $attributes = [
           'full_name' => 'Test name',
           'email' => 'text',
           'password' => 'password'
       ];

       $this->post('/api/auth/register', $attributes)->assertResponseStatus(422);
   }

   public function testRegistrationWithDuplicatedEmail()
   {
       $user = User::create([
          'full_name' => 'User name',
          'email' => 'duplicated@email.com',
          'password' => 'password'
       ]);

       $attributes = [
         'full_name' => 'New user',
         'email' => 'duplicated@email.com',
         'password' => 'password'
       ];

       $this->post('/api/auth/register', $attributes)->assertResponseStatus(422);
   }

   public function testRegistrationSuccessfully()
   {
       $attributes = [
           'full_name' => 'New user',
           'email' => 'test@email.com',
           'password' => 'password'
       ];

       $this->post('/api/auth/register', $attributes)->assertResponseStatus(201);
   }

}
