<?php
namespace App\Contracts;

use Illuminate\Http\Request;

interface Repository
{
    public function getAll($perPage);

    public function getById($id);

    public function delete($id);

    public function add($resource);

    public function update($resource, $id);
}
