<?php

namespace App\Interface;

interface ControllerInterface
{
    function index();

    function show($id);

    function store(array $dataToStore);

    function update($id);

    function destroy($id);

    function create();

    function edit($id);
}