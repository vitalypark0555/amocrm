<?php

class Lead
{
    private $subdomain;

    public function __construct($subdomain) {
        $this->subdomain = $subdomain;
    }

    public function getLeadsWithoutTasks() {
        $url = 'https://'.$this->subdomain.'.amocrm.ru/api/v2/leads';
        $response = Curl::request($url);
        $leads = $response['_embedded']['items'];

        $leadsWithoutTasks = [];

        foreach($leads as $lead) {
            if($lead['closest_task_at'] == 0) {
                $leadsWithoutTasks[] = $lead;
            }
        }

        return $leadsWithoutTasks;
    }
}
