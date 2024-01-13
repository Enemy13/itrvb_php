<?php

namespace Tgu\Bazitov\Http\Actions;

use Tgu\Bazitov\Http\Request;

use Tgu\Bazitov\Http\Response;

interface ActionInterface
{
    public function handle(Request $request): Response;
}