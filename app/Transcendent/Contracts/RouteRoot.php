<?php 

namespace App\Transcendent\Contracts;

interface RouteRoot {
    /**
     * Modify resources of every module name
     * 
     * @return array<mixed>
     */
    public function modifyResource(): array;

    public static function validateResource();
}