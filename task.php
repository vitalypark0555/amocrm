<?php
class Task {
    private $subdomain;

    public function __construct($subdomain) {
        $this->subdomain = $subdomain;
    }

    public function addTaskToLead($leadId, $text, $completeTill) {
        $task= [
            [
                'text'=> $text,
                'complete_till' => $completeTill,
                'entity_id' => $leadId,
                "entity_type" => "leads",
            ]
        ];

        $url = 'https://'.$this->subdomain.'.amocrm.ru/api/v4/tasks';
        $response = Curl::request($url, 'POST', $task);
        return $response['_embedded']['tasks'][0]['id'];
    }

    public function getAllTasks() {
        $url = 'https://'.$this->subdomain.'.amocrm.ru/api/v4/tasks';
        $response = Curl::request($url);
        return $response['_embedded']['tasks'];
    }
}
