<?php

namespace ARMACMan\Http\Controllers\Community;


use ARMACMan\Http\Controllers\Controller;
use ARMACMan\Repositories\CommunityRepository;
use ARMACMan\Repositories\ServersRepository;
use ARMACMan\Transfomers\Community\CommunityTransformer;
use ARMACMan\Transfomers\Community\ServerTransformer;

class CommunityController extends Controller
{

    private $user;
    private $community;

    public function __construct(CommunityRepository $communityRepository, CommunityTransformer $communityTransformer, ServersRepository $serversRepository, ServerTransformer $serverTransformer)
    {
        $this->repository = $communityRepository;
        $this->transformer = $communityTransformer;
        $this->server_transformer = $serverTransformer;
        $this->user = \Auth::user();
        $this->community = $this->repository->getByUser($this->user);
        $this->servers_repository = $serversRepository;
    }

    public function index() {
        return response()->json($this->transformer->transform($this->community));
    }

    public function servers() {
        $servers = $this->servers_repository->getByCommunity($this->community);
        return response()->json($this->server_transformer->transformMany($servers));
    }

    public function server($server_id) {
        $server = $this->servers_repository->getById($server_id);
        if(is_null($server)) {
            return response()->json(['message' => 'NotFound'], 404);
        }
        return response()->json($this->server_transformer->transform($server));
    }
}
