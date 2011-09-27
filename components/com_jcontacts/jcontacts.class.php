<?


defined( '_JEXEC' ) or die( 'Direct Access to this location is not allowed.' );





class leads extends JTable {


	var $id = null;


	var $first_name = null;


	var $last_name = null;


	var $company_name = null;


	var $email = null;


	var $phone = null;


	var $status = null;


	var $message = null;


	var $notes = null;


	var $converted = null;


	var $created = null;


	var $modified = null;


	var $published = null;


	var $manager_id = null;





	function leads(&$db){


		parent::__construct('#__jleads', 'id', $db);


	}


}





class contacts extends JTable {


	var $id = null;


	var $jid = null;


	var $title_name = null;


	var $first_name = null;


	var $last_name = null;


	var $account_id = null;


	var $title = null;


	var $department = null;


	var $birthdate = null;


	var $reports_to = null;


	var $lead_source = null;


	var $phone = null;


	var $home_phone = null;


	var $mobile_phone = null;


	var $other_phone = null;


	var $fax = null;


	var $assistant = null;


	var $asst_phone = null;


	var $email = null;


	var $email_opt_out = null;


	var $mailing_street = null;


	var $mailing_city = null;


	var $mailing_state = null;


	var $mailing_zip = null;


	var $mailing_country = null;


	var $other_street = null;


	var $other_city = null;


	var $other_state = null;


	var $other_zip = null;


	var $other_country = null;


	var $lat = null;


	var $lng = null;


	var $other_lat = null;


	var $other_lng = null;


	var $notes = null;


	var $created = null;


	var $modified = null;


	var $published = null;


	var $manager_id = null;





	function contacts(&$db){


		parent::__construct('#__jcontacts', 'id', $db);


	}


}





class contact_relation extends JTable {


	var $id = null;


	var $contact_id = null;


	var $account_id = null;





	function contact_relation(&$db){


		parent::__construct('#__jcontact_relations', 'id', $db);


	}


}





class accounts extends JTable{


	var $id = null;


	var $name = null;


	var $site = null;


	var $parent_account_id = null;


	var $account_number = null;


	var $type = null;


	var $industry = null;


	var $annual_revenue = null;


	var $rating = null;


	var $phone = null;


	var $fax = null;


	var $website = null;


	var $ticker_symbol = null;


	var $ownership = null;


	var $employees = null;


	var $sic_code = null;


	var $billing_street = null;


	var $billing_city = null;


	var $billing_state = null;


	var $billing_zip = null;


	var $billing_country = null;


	var $shipping_street = null;


	var $shipping_city = null;


	var $shipping_state = null;


	var $shipping_zip = null;


	var $shipping_country = null;


	var $notes = null;


	var $created = null;


	var $modified = null;


	var $published = null;


	var $manager_id = null;





	function accounts(&$db) {


		parent::__construct('#__jaccounts', 'id', $db);


	}


}











?>