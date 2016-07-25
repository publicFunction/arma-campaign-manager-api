<?php

namespace ARMACMan\Http\Controllers\Community;


use ARMACMan\Http\Controllers\Controller;
use ARMACMan\Repositories\CommunityRepository;

class CommunityController extends Controller
{

    public function __construct(CommunityRepository $communityRepository)
    {
        $this->repository = $communityRepository;
    }

    public function index() {
        $user = \Auth::user();

        return $this->repository->getByOwner($user);
    }

}
