<?php

namespace ARMACMan\Http\Controllers\Community;


use ARMACMan\Http\Controllers\Controller;
use ARMACMan\Repositories\CommunityRepository;
use ARMACMan\Transfomers\Community\CommunityTransformer;

class CommunityController extends Controller
{

    public function __construct(CommunityRepository $communityRepository, CommunityTransformer $communityTransformer)
    {
        $this->repository = $communityRepository;
        $this->transformer = $communityTransformer;
    }

    public function index() {
        $user = \Auth::user();
        $community = $this->repository->getByUser($user);

        //return response()->json($community, 200);
        
        return response()->json($this->transformer->transform($community));
    }

}
