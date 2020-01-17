<?php

Class ZiggeoConnect {

    private $application;
    private $config;

    function __construct($application, $baseUrl, $requestTimeout) {
        $this->application = $application;
        $this->baseUrl = $baseUrl;
        $this->requestTimeout = $requestTimeout;

        $this->config = new ZiggeoConfig($this);
    }

    private function curl($url) {
        $curl = curl_init($this->baseUrl . $url);
        curl_setopt($curl, CURLOPT_FAILONERROR, true);

        if( (ini_get('safe_mode') === 'Off' || ini_get('safe_mode') === false) && ini_get('open_basedir') === '' ) {
            //we can only make curl follow the redirects if the safe mod is off and open_basedir is not set, otherwise it would throw error
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
        }
        
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, false); 
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);
        curl_setopt($curl, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
        curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $this->requestTimeout);
        curl_setopt($curl, CURLOPT_TIMEOUT, $this->requestTimeout);
        curl_setopt($curl, CURLOPT_USERPWD, $this->application->token() . ":" . $this->application->private_key());

        return $curl;
    }

    private function singleRequest($request_type = 'POST', $url = '', $data) {

        $curl = $this->curl($url);

        //If the request type is POST we set up additional parameters as we need to handle data differently
        if($request_type === 'POST') {
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
        }
        elseif($request_type === 'DELETE') {
            curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "DELETE");
        }

        //Let us make the call
        $result_data = curl_exec($curl);

        //At this time both are supported, since later is legacy now soon it will be dropped, so future proofing
        if(version_compare('5.5.0', PHP_VERSION, '>=') && version_compare( '7.10.8', curl_version(['version']), '>=')) {
            $response_const = CURLINFO_RESPONSE_CODE;
        }
        else {
            $response_const = CURLINFO_HTTP_CODE;
        }

        //Let us get the info on the call
        $result_info = [
            //get the last response code
            'response_code' => curl_getinfo($curl, $response_const),
            //The CONNECT response code 
            'connect_code' => curl_getinfo($curl, CURLINFO_HTTP_CONNECTCODE),
            //Errno from a connect failure. The number is OS and system specific. 
            'os_code' => curl_getinfo($curl, CURLINFO_OS_ERRNO)
        ];

        //Lets prep the data
        $rez = [
            'response'  => $result_data,
            'info'      => $result_info,
            'error'     => false
        ];

        //Did an error occur?
        if(curl_errno($curl)) {
            //error occurred 
            $rez['error'] = [
                'error_number'  => curl_errno($curl),
                'error_message' => curl_error($curl)
            ];
        }

        // Close handle
        // curl_close($curl);

        return $rez;
    }

    public function makeRequest($request_type = 'POST', $url, $data = false) {

        $success = false;

        for($i = 0; $i < $this->config->get("resilience_factor"); $i++) {

            $result = $this->singleRequest($request_type, $url, $data);

            //Lets check if it is expected response - above 200 and under 500
            if( isset($result['info']) &&
                (int)$result['info']['response_code'] >= 200 && (int)$result['info']['response_code'] < 500) {

                //good to go
                return $result;
            }

        }

        //If failed return the default value
        $result['response'] = $this->config->get("resilience_onfail");

        if($result['info']['response_code'] === 0) {
            $result['info']['response_code'] = 900; //Just a unique code to recognize that the error is internal in nature. At this point you could grab more details from $result['error']
        }

        return $result;
    }

    private function assert_state($assert_states, $state, $result = array()) {
        if (!is_array($assert_states))
            $assert_states = array($assert_states);
        foreach ($assert_states as $assert_state)
            if ($assert_state == $state)
                return;
        throw new ZiggeoException($state, $result);
    }

    function get($url, $data = array(), $assert_state = ZiggeoException::HTTP_STATUS_OK) {
        if (count($data) > 0) {
            $url .= '?' . http_build_query($data);
        }

        $result = $this->makeRequest('GET', $url);

        $this->assert_state($assert_state, $result['info']['response_code'], $result['response']);

        return $result['response'];
    }

    function getJSON($url, $data = array(), $assert_state = ZiggeoException::HTTP_STATUS_OK) {
        return json_decode($this->get($url, $data, $assert_state));
    }

    function post($url, $data = array(), $assert_states = array(ZiggeoException::HTTP_STATUS_OK, ZiggeoException::HTTP_STATUS_CREATED)) {

        foreach ($data as $key=>$value) {
            if (is_array($value))
                $data[$key] = json_encode($value);
        }

        if (isset($data["file"]) && class_exists("CurlFile")) {
            $data["file"] = new CurlFile(str_replace("@", "", $data["file"]), "video/mp4", "video.mp4");
        }

        $result = $this->makeRequest('POST', $url, $data);

        $this->assert_state($assert_states, $result['info']['response_code'], $result['response']);
        return $result['response'];
    }

    function postJSON($url, $data = array(), $assert_states = array(ZiggeoException::HTTP_STATUS_OK, ZiggeoException::HTTP_STATUS_CREATED)) {
        return json_decode($this->post($url, $data, $assert_states));
    }

    function delete($url, $assert_state = ZiggeoException::HTTP_STATUS_OK) {

        $result = $this->makeRequest('DELETE', $url);

        $this->assert_state($assert_state, $result['info']['response_code'], $result['response']);
        return $result['response'];
    }

    function deleteJSON($url, $assert_state = ZiggeoException::HTTP_STATUS_OK) {
        return json_decode($this->delete($url, $assert_state));
    }
}
