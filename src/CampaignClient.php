<?php

declare(strict_types = 1);

namespace Evgeeen;

use Evgeeen\Models\Requests\GetCampaignRequest;
use Evgeeen\Models\Responses\GetCampaignResponse;
use GuzzleHttp\RequestOptions;

class CampaignClient extends Client
{
    private const GET_CAMPAIGN = "/api/client/campaign";

    public function get(GetCampaignRequest $request): GetCampaignResponse
    {
        dd($request);
        $response = $this->sendRequest("GET", self::GET_CAMPAIGN, [
            RequestOptions::QUERY => $request->jsonSerialize(),
        ]);

        return GetCampaignResponse::fromPrimitives($this->getDecodedBody($response->getBody())['list']);
    }
}