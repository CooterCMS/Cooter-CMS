<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

// Include our PDO Connection
include('application/config/pdo_db_connect.php');

class dynamic_route{
	
	public $pdo_db = FALSE;
		
	public function __construct(){
		 
	}
	private function query_routes(){
		try{
			
		$routes_query = $this->pdo_db->query('SELECT * FROM Routes ORDER BY `Order` ASC');

		if($routes_query){
			$return_data = array();	
			foreach($routes_query as $row) {
				$return_data[] = $row; 
			}
			return $return_data;

		}
			
		}catch(PDOException $e) {
			echo 'Please contact Admin: '.$e->getMessage();
		}
		
	}
	private function filter_route_data($data){
			
		$r_data = array();
		foreach($data as $row){
			$return_data = new stdClass;

			if(empty($row['Url_Variable']) ){
				$return_data->url = $row['Url'];
			}else{
				$return_data->url = $row['Url'].'/'.$row['Url_Variable'];
			}
			
			if(empty($row['Method']) && empty($row['Variable']) ){
				$return_data->route = $row['Class'];
				
			}elseif(!empty($row['Method']) && empty($row['Variable']) ){
				$return_data->route = $row['Class'].'/'.$row['Method'];
			}elseif(!empty($row['Method']) && !empty($row['Variable']) ){
				$return_data->route = $row['Class'].'/'.$row['Method'].'/'.$row['Variable'];
			}
			
		$r_data[] = $return_data;
		}
		return $r_data;
	}
	public function get_routes(){
		$route_data = $this->query_routes();
		$return_data = $this->filter_route_data($route_data);
		return $return_data;
	}		

}

$dynamic_route = new dynamic_route;
// Give dynamic route database connection
$dynamic_route->pdo_db = pdo_connect();
// Get the route data
$route_data = $dynamic_route->get_routes();
//Iterate over the routes
foreach($route_data as $row){
	$route[$row->url] = $row->route;
}

/* End of file routes.php */
/* Location: ./application/config/routes.php */