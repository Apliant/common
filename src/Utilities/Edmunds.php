<?php

namespace Digi\Utilities;

use Config;
use Log;
use GuzzleHttp\Client as GuzzleClient;
use Digi\Models\vehicle_make;
use Digi\Models\vehicle_model;
use Digi\Models\vehicle_submodel;
use Digi\Models\vehicle_year;
use Digi\Models\vehicle_model_vehicle_year;

class Edmunds{
	
	const BASE_URL = "https://api.edmunds.com";
	const API_ENDPOINT = "/api/vehicle/v2";
	const MAKES_ENDPOINT = "/makes";
	private $apiKey = null;

	public function __construct($apiKey = null)
	{
		if($apiKey == null)
		{
			$edmundsConfig = Config::get('services.edmunds');
			$this->apiKey = $edmundsConfig['apiKey'];
		}else
		{
			$this->apiKey = $apiKey;
		}
	}

	public function getEverything()
	{
		$client = new GuzzleClient();
		$result = $client->get(Edmunds::BASE_URL.Edmunds::API_ENDPOINT.Edmunds::MAKES_ENDPOINT.'?fmt=json&api_key='.$this->apiKey);
		$makes = json_decode($result->getBody());

		foreach($makes->makes as $make)
		{
			$vehicleMake = vehicle_make::where('make', '=', $make->name)->first();
			if($vehicleMake == null)
			{
				$vehicleMake = new vehicle_make();
				$vehicleMake->make = $make->name;
				$vehicleMake->save();
			}
			foreach($make->models as $model)
			{
				$vehicleModel = $vehicleMake->Models()->where('model', '=', $model->name)->first();
				if($vehicleModel == null)
				{
					$vehicleModel = new vehicle_model();
					$vehicleModel->model = $model->name;
					$vehicleModel->vehicle_make_id = $vehicleMake->id;
					$vehicleModel->save();
				}
				foreach($model->years as $year)
				{
					Log::info("year");
					$vehicleYear = $vehicleModel->Years()->where('year', '=', $year->year)->first();
					if($vehicleYear == null)
					{
						$vehicleYear == vehicle_year::where('year', '=', $year->year)->first();
						if($vehicleYear == null)
						{
							$vehicleYear = new vehicle_year();
							$vehicleYear->year = $year->year;
							$vehicleYear->save();
						}
						$vMvY = new vehicle_model_vehicle_year();
						$vMvY->vehicle_model_id = $vehicleModel->id;
						$vMvY->vehicle_year_id = $vehicleYear->id;
						$vMvY->save();
					}
				}
			}
		}

	}
}