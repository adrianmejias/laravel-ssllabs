<?php

namespace AdrianMejias\SslLabs\Contracts;

use AdrianMejias\SslLabs\Exceptions\SslLabsException;

/**
 * SSL Labs Contract
 *
 * @package AdrianMejias\SslLabs
 */
interface SslLabsWrapperContract
{
    /**
     * Get a list of SSL Lab grade levels.
     *
     * @return array|string[]
     */
    public function getGrades(): array;

    /**
     * Retrieve root certificates.
     *
     * This call returns the latest root certificates(Mozilla, Apple MacOS, Android, Java and Windows) used for trust validation.
     *
     * @see https://github.com/ssllabs/ssllabs-scan/blob/master/ssllabs-api-docs-v3.md#retrieve-root-certificates
     *
     * @param null|int $trustStore (1-Mozilla(default), 2-Apple MacOS, 3-Android, 4-Java, 5-Windows)
     * @return mixed
     * @throws SslLabsException
     */
    public function getRootCertsRaw(?int $trustStore = null);

    /**
     * Retrieve known status codes.
     *
     * This call will return one StatusCodes instance.
     *
     * @see https://github.com/ssllabs/ssllabs-scan/blob/master/ssllabs-api-docs-v3.md#retrieve-known-status-codes
     *
     * @return mixed
     * @throws SslLabsException
     */
    public function getStatusCodes();

    /**
     * Retrieve detailed endpoint information.
     *
     * @see https://github.com/ssllabs/ssllabs-scan/blob/master/ssllabs-api-docs-v3.md#retrieve-detailed-endpoint-information
     *
     * @param string $host
     * @param null|string $s endpoint IP address
     * @param bool $fromCache always deliver cached assessment reports if available; optional, defaults to "false". This parameter is intended for API consumers that don't want to wait for assessment results. Can't be used at the same time as the startNew parameter.
     * @return mixed
     * @throws SslLabsException
     */
    public function getEndpointData(
        string $host,
        ?string $s = null,
        bool $fromCache = false
    );

    /**
     * Invoke assessment and check progress in order to check minimum grade.
     *
     * This call is used to initiate an assessment, or to retrieve the status of an assessment in progress or in the cache. It will return a single Host object on success. The Endpoint object embedded in the Host object will provide partial endpoint results. Please note that assessments of individual endpoints can fail even when the overall assessment is successful (e.g., one server might be down). At this time, you can determine the success of an endpoint assessment by checking the statusMessage field; it should contain "Ready".
     *
     * @see https://github.com/ssllabs/ssllabs-scan/blob/master/ssllabs-api-docs-v3.md#invoke-assessment-and-check-progress
     *
     * @param string $host hostname; required.
     * @param null|string $minGrade
     * @param null|int $maxAge maximum report age, in hours, if retrieving from cache (fromCache parameter set).
     * @param bool $publish set to "true" if assessment results should be published on the public results boards; optional, defaults to "false".
     * @param bool $startNew if set to "true" then cached assessment results are ignored and a new assessment is started. However, if there's already an assessment in progress, its status is delivered instead. This parameter should be used only once to initiate a new assessment; further invocations should omit it to avoid causing an assessment loop.
     * @param bool $fromCache always deliver cached assessment reports if available; optional, defaults to "false". This parameter is intended for API consumers that don't want to wait for assessment results. Can't be used at the same time as the startNew parameter.
     * @param null|string|bool $all by default this call results only summaries of individual endpoints. If this parameter is set to "true", full information will be returned. If set to "done", full information will be returned only if the assessment is complete (status is READY or ERROR).
     * @param bool $ignoreMismatch set to "true" to proceed with assessments even when the server certificate doesn't match the assessment hostname. Set to "false" by default. Please note that this parameter is ignored if a cached report is returned.
     * @return bool
     * @throws SslLabsException
     */
    public function hasMinGrade(
        string $host,
        ?string $minGrade = 'A+',
        ?int $maxAge = null,
        bool $publish = false,
        bool $startNew = false,
        bool $fromCache = false,
        mixed $all = null,
        bool $ignoreMismatch = true
    ): bool;

    /**
     * Invoke assessment and check progress.
     *
     * This call is used to initiate an assessment, or to retrieve the status of an assessment in progress or in the cache. It will return a single Host object on success. The Endpoint object embedded in the Host object will provide partial endpoint results. Please note that assessments of individual endpoints can fail even when the overall assessment is successful (e.g., one server might be down). At this time, you can determine the success of an endpoint assessment by checking the statusMessage field; it should contain "Ready".
     *
     * @see https://github.com/ssllabs/ssllabs-scan/blob/master/ssllabs-api-docs-v3.md#invoke-assessment-and-check-progress
     *
     * @param string $host hostname; required.
     * @param null|int $maxAge maximum report age, in hours, if retrieving from cache (fromCache parameter set).
     * @param bool $publish set to "true" if assessment results should be published on the public results boards; optional, defaults to "false".
     * @param bool $startNew if set to "true" then cached assessment results are ignored and a new assessment is started. However, if there's already an assessment in progress, its status is delivered instead. This parameter should be used only once to initiate a new assessment; further invocations should omit it to avoid causing an assessment loop.
     * @param bool $fromCache always deliver cached assessment reports if available; optional, defaults to "false". This parameter is intended for API consumers that don't want to wait for assessment results. Can't be used at the same time as the startNew parameter.
     * @param null|string|bool $all by default this call results only summaries of individual endpoints. If this parameter is set to "true", full information will be returned. If set to "done", full information will be returned only if the assessment is complete (status is READY or ERROR).
     * @param bool $ignoreMismatch set to "true" to proceed with assessments even when the server certificate doesn't match the assessment hostname. Set to "false" by default. Please note that this parameter is ignored if a cached report is returned.
     * @return mixed
     * @throws SslLabsException
     */
    public function analyze(
        string $host,
        ?int $maxAge = null,
        bool $publish = false,
        bool $startNew = false,
        bool $fromCache = false,
        mixed $all = null,
        bool $ignoreMismatch = false
    );

    /**
     * Check SSL Labs availability.
     *
     * This call should be used to check the availability of the SSL Labs servers, retrieve the engine and criteria version, and initialize the maximum number of concurrent assessments. Returns one Info object on success.
     *
     * @see https://github.com/ssllabs/ssllabs-scan/blob/master/ssllabs-api-docs-v3.md#check-ssl-labs-availability
     *
     * @return mixed
     * @throws SslLabsException
     */
    public function info();

    /**
     * Parse params to array.
     *
     * @param array|mixed[] $params
     * @return array|mixed[]
     */
    public function parseParams(array $params): array;

    /**
     * Send request to SSL Labs api.
     *
     * @param string $uri
     * @param array|mixed[] $params
     * @return mixed
     * @throws SslLabsException
     */
    public function request(string $uri = '/', array $params = []);
}
