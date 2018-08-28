<?php 
/**
* 
*/
class tax_rateRepository extends DbRepository
{
	
	public function now_tax_rate()
	{
		$sql = "SELECT tax_rate FROM tax_rate WHERE  CURRENT_TIME  < date_to AND date_from < CURRENT_TIME";

		return $this->fetch($sql,array(
		));
	}
}