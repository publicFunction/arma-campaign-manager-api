<?php

namespace ARMACMan\Transfomers\Community;


use ARMACMan\Models\Community;
use ARMACMan\Transfomers\Transformer;

class CommunityTransformer extends Transformer
{
    private $model;

    public function __construct(Community $community)
    {
        $this->model = $community;
    }

    public function transform($community) {

        $transformed = [
            'id' => $community->id,
            'name' => $community->name,
            'profile' => $community->profile,
            'owner' => $community->owner,
            'totalMembers' => count($community->members)
        ];
        return $transformed;
    }

}