<?php

namespace ARMACMan\Http\Controllers\Community;


use ARMACMan\Helpers\ServerHelper;
use ARMACMan\Http\Controllers\Controller;
use ARMACMan\Repositories\ServersRepository;
use ARMACMan\Transfomers\Community\ServerTransformer;


class ServersController extends Controller
{
    private $repository;
    private $transformer;
    private $helper;

    public function __construct(ServersRepository $serversRepository, ServerTransformer $serverTransformer, ServerHelper $serverHelper)
    {
        $this->repository = $serversRepository;
        $this->transformer = $serverTransformer;
        $this->helper = new $serverHelper();
    }

    public function index()
    {
        return response()->json([], 404);
    }

    public function status($server_id)
    {
        $server = $this->repository->getById($server_id);
        var_dump($this->helper->getServerInfo($server));

    }

}
