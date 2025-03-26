<?php

declare(strict_types = 1);

namespace Evgeeen;

use Evgeeen\Models\Requests\GetCampaignRequest;
use Evgeeen\Models\Requests\GetCampaignStatisticRequest;
use Evgeeen\Models\Requests\GetReportsListRequest;
use Evgeeen\Models\Responses\CheckReportResponse;
use Evgeeen\Models\Responses\GetCampaignResponse;
use Evgeeen\Models\Responses\GetCampaignStatisticResponse;
use GuzzleHttp\RequestOptions;

class CampaignClient extends Client
{
    private const GET_CAMPAIGN = "/api/client/campaign";
    private const CREATE_STATISTIC = "/api/client/statistics";
    private const CHECK_REPORT_STATUS = "/api/client/statistics/{uuid}";
    private const GET_REPORT = "/api/client/statistics/report";
    private const GET_REPORT_LIST = "/api/client/statistics/externallist";

    public function get(GetCampaignRequest $request): GetCampaignResponse
    {
        $response = $this->sendRequest("GET", self::GET_CAMPAIGN, [
            RequestOptions::QUERY => $request->jsonSerialize(),
        ]);

        return GetCampaignResponse::fromPrimitives($this->getDecodedBody($response->getBody())['list']);
    }

    public function createReport(GetCampaignStatisticRequest $request): GetCampaignStatisticResponse
    {
        $response = $this->sendRequest("POST", self::CREATE_STATISTIC, [
            RequestOptions::JSON => $request->jsonSerialize(),
        ]);

        return GetCampaignStatisticResponse::fromPrimitives($this->getDecodedBody($response->getBody()));
    }

    public function checkReport(string $uuid): CheckReportResponse
    {
        $response = $this->sendRequest(
            "GET",
            $this->prepareUri(self::CHECK_REPORT_STATUS, ['uuid' => $uuid])
        );

        return CheckReportResponse::fromPrimitives($this->getDecodedBody($response->getBody()));
    }

    public function getReport(string $uuid): string
    {
        $response = $this->sendRequest("GET", self::GET_REPORT, [
            RequestOptions::QUERY => ['uuid' => $uuid],
        ]);

        return $response->getBody()->getContents();
    }

    public function getReports(GetReportsListRequest $request): GetReportsListResponse
    {

    }
}