<?php

namespace App\Tests\Api;

use App\Lib\api as LibApi;

use PHPUnit\Framework\TestCase;

class ApiTest extends TestCase
{
    public function testGetCharacter()
    {

        $Api = new LibApi;
        for($Id = 1; $Id < 70; $Id++)
        {
            $Character = $Api->getCharacters($Id);
            $this->assertIsArray($Character);
            $this->assertArrayNotHasKey('Error' , $Character);
        }
    }
}
