<?php

function xero_contact_search(){
        require_once(__DIR__ . '/vendor/autoload.php');
        $uid = get_current_user_id();
        // Configure OAuth2 access token for authorization: OAuth2
        $config = XeroAPI\XeroPHP\Configuration::getDefaultConfiguration()->setAccessToken( get_user_meta($uid, 'xero_access_token', true) );

        $apiInstance = new XeroAPI\XeroPHP\Api\AccountingApi(
                new GuzzleHttp\Client(),
                $config
        );
        $xeroTenantId = get_user_meta($uid, 'xero_tenant_id', true);
        $ifModifiedSince = null;
        $iDs = array();
        $page = 1;
        $order = "Name ASC";
        $includeArchived = true;
        $summaryOnly = true;
        $where = null;
        $searchTerm = "searchTerm=" .$_POST['sch']; //"searchTerm=Joe Bloggs";

        try {
            $result = $apiInstance->getContacts($xeroTenantId, $ifModifiedSince, $where, $order, $iDs, $page, $includeArchived, $summaryOnly, $searchTerm);
            $result = json_decode($result, true);
            $rt = "<div>" ;
            foreach($result['Contacts'] as $rr){
                    $rt .="<div class='clickable' ";
                    $rt .=" data-id = '" . $rr['ContactID'] . "' ";
                    $rt .= ">".$rr['Name']."</div>";
            }
            $rt .= "</div>";
            return $rt;
        } catch (Exception $e) {
            $result =  'Exception when calling AccountingApi->getContacts: ' . $e->getMessage();
        }

        return $result;
}

?>