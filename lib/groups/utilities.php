<?php

//ville

/**
 * Get all datas of a city by postal code
 *
 * @param string $group_cp The postal code's
 *
 * @return GUID|false Depending on success
 */
function get_data_ville_by_cp($cp) {
	global $CONFIG, $DATA_VILLE_CACHE;

	$cp = sanitise_string($cp);

	if ($cp == "") {
		return false;
	}

/*	if (isset($DATA_VILLE_CACHE[$cp])) {
		return $DATA_VILLE_CACHE[$cp];
	}*/

	$result = get_data("SELECT * FROM villes_data vd
							JOIN regions_data rd ON rd.region=vd.region
							JOIN departements_data dd ON dd.dep=vd.dep
							WHERE cp='$cp'");

	if ($result) {
	/*	if (!$DATA_VILLE_CACHE) {
			$DATA_VILLE_CACHE = array();
		}

		$DATA_VILLE_CACHE[$cp] = $result;*/
		return $result;
	}

	return false;
}


/**
 * Get all datas of a city by postal code
 *
 * @param array $key the key to return
 * @param string $type the type of key to match
 * @param string $search the query search
 * @param bool|string $maxhab true to return villes ordered by number of habitants, string to custom query
 *
 * @return GUID|false Depending on success
 */
function get_data_key_ville_by($key, $type, $search, $maxhab = '') {
	$keys = implode(', ', $key);
	if ($maxhab === true) $maxhab = 'ORDER BY habitants30122008 DESC';
	$result = get_data("SELECT $keys FROM villes_data WHERE $type='$search' $maxhab");
	if ($result) return $result;
	return false;
}


/**
 * Get all datas of a city by name
 *
 * @param string $group_cp The name of the city
 *
 * @return GUID|false Depending on success
 */
function get_data_ville_by_name($city) {
	global $CONFIG, $DATA_VILLE_CACHE;

	$city = preg_replace('#^st #', 'saint ', $city);
	$city = preg_replace('#(^le |^la |^les |l\' )#', '', $city);
	$city = str_replace(' ', '-', trim($city));
	$city = sanitise_string($city);

	if ($city == "") {
		return false;
	}

/*	if (isset($DATA_VILLE_CACHE[$city])) {
		return $DATA_VILLE_CACHE[$city];
	}*/

	$result = get_data("SELECT * FROM villes_data vd
							JOIN regions_data rd ON rd.region=vd.region
							JOIN departements_data dd ON dd.dep=vd.dep
							WHERE ville='$city'");

	if ($result) {
	/*	if (!$DATA_VILLE_CACHE) {
			$DATA_VILLE_CACHE = array();
		}

		$DATA_VILLE_CACHE[$city] = $result;*/
		return $result;
	}

	return false;
}


// departement

/**
 * Get all datas of a prefecture by departement code
 *
 * @param string $group_cp The postal code's
 *
 * @return GUID|false Depending on success
 */
function get_data_pref_by_dep($dep) {
	global $CONFIG, $DATA_DEP_CACHE;

	$dep = sanitise_string($dep);

	if ($dep == "") {
		return false;
	}

/*	if (isset($DATA_DEP_CACHE[$cp])) {
		return $DATA_DEP_CACHE[$cp];
	}*/

	$result = get_data("SELECT * FROM villes_data
							WHERE insee=
							(SELECT cheflieu FROM departements_data WHERE dep='$dep')");

	if ($result) {
	/*	if (!$DATA_DEP_CACHE) {
			$DATA_DEP_CACHE = array();
		}

		$DATA_DEP_CACHE[$cp] = $result;*/
		return $result;
	}

	return false;
}

/**
 * Return GUID of group department from guid. eg: 46300 return 46, 97300 return 973
 * @param  integer           $group_guid The guid of a group which we want the department group
 * @return GUID         The department group GUID
 */
function get_dep_from_group_guid($group_guid) {
	if ($group_guid >= 97000) {
		return substr($group_guid, 0, 3);
	} else {
		return substr($group_guid, 0, 2);
	}
}


/**
 * Change group subtype
 *
 * @param string $group_guid GUID of the group
 *
 * @return true|false Depending on success
 */
function ggouv_change_group_subtype($group_guid, $subtype) {
	global $CONFIG;
	$group_subtype = add_subtype('group', $subtype);
	return update_data("UPDATE {$CONFIG->dbprefix}entities
							SET subtype = '$group_subtype'
							WHERE {$CONFIG->dbprefix}entities.guid = {$group_guid}");
}
