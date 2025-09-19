<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
Use DateTime;
use Response;

class DefaultsController extends Controller
{
     public function getApplicant($id) {
        return $id;
    }

    public function getDemograph()
    {
        $country = DB::table('sett_ph_country')->orderBy('name')
        ->get();
        $region = DB::table('sett_ph_region')->orderBy('regDesc')
        ->get();
        $province = DB::table('sett_ph_province')->orderBy('provDesc')
        ->get();
        $city = DB::table('sett_ph_city')->orderBy('citymunDesc')
        ->get();
        $barangay = DB::table('sett_ph_barangay')->orderBy('brgyDesc')
        ->get();
        $gender = DB::table('sett_gender')->orderBy('gen_id')
        ->where('gen_status', '=' , 1)
        ->get();
        $nationality = DB::table('sett_nationality')->orderBy('nat_desc')
        ->where('nat_status', '=' , 1)
        ->get();
        $civilstatus = DB::table('sett_civil_status')->orderBy('cv_id')
        ->where('cv_status', '=' , 1)
        ->get();

        $demograph = [
            'country' => $country,
            'region' => $region,
            'province' => $province,
            'city' => $city,
            'barangay' => $barangay,
            'gender' => $gender,
            'nationality' => $nationality,
            'civilstatus' => $civilstatus,
            'status' => 200,
        ];

        return response()->json($demograph);

    }

    public function addApplicant(Request $request) {
        
        $data = json_decode($request->getContent());

        $format1 = substr($data->personal->per_firstname, 0, 2);
        $format2 = substr($data->personal->per_middlename, 0, 2);
        $format3 = substr($data->personal->per_lastname, 0, 2);

        $randomizer = uniqid();

        $famid = 'fam-' .strtoupper($format1) . strtoupper($format2) . strtoupper($format3) . '-' .  $randomizer;
        $awrid = 'awr-' .strtoupper($format1) . strtoupper($format2) . strtoupper($format3) . '-' .  $randomizer;
        $attid = 'att-' .strtoupper($format1) . strtoupper($format2) . strtoupper($format3) . '-' .  $randomizer;
        $perid = 'per-' .strtoupper($format1) . strtoupper($format2) . strtoupper($format3) . '-' .  $randomizer;

        try{
            //date time saving last to fix naten
            date_default_timezone_set('Asia/Manila');
            $date = date('Y-m-d h:i:s', time());
            $primary = DB::table('def_person')->insert([
                'per_firstname' => $data->personal->per_firstname,
                'per_middlename' => $data->personal->per_middlename,
                'per_lastname' => $data->personal->per_lastname,
                'per_suffixname' => $data->personal->per_suffixname,
                'per_birthday' => $data->personal->per_birthday,
                'per_birth_country' => $data->personal->per_birth_country,
                'per_birth_province' => $data->personal->per_birth_province,
                'per_birth_city' => $data->personal->per_birth_city,
                'per_birth_zipcode' => $data->personal->per_birth_zipcode,
                'per_gender' => $data->personal->per_gender,
                'per_civilstatus' => $data->personal->per_civilstatus,
                'per_nationality' => $data->personal->per_nationality,
                'per_contact' => $data->personal->per_contact,
                'per_email' => $data->personal->per_email,
                'per_curr_home' => $data->personal->per_curr_home,
                'per_curr_region' => $data->personal->per_curr_region,
                'per_curr_province' => $data->personal->per_curr_province,
                'per_curr_city' => $data->personal->per_curr_city,
                'per_curr_barangay' => $data->personal->per_curr_barangay,
                'per_curr_zipcode' => $data->personal->per_curr_zipcode,
                'per_perm_home' => $data->personal->per_perm_home,
                'per_perm_region' => $data->personal->per_perm_region,
                'per_perm_province' => $data->personal->per_perm_province,
                'per_perm_city' => $data->personal->per_perm_city,
                'per_perm_barangay' => $data->personal->per_perm_barangay,
                'per_perm_zipcode' => $data->personal->per_perm_zipcode,
                'per_educid' => $awrid,
                'per_famid' => $famid,
                'per_attainmentid' => $attid,
                'per_personid' => $perid,
                'per_regtype' => $data->personal->per_regtype,
                'per_dateapplied' =>$date,
                'per_user' =>$data->personal->per_user,
                
            ]);

            // Family
            if (!empty($data->family)) {
                foreach ($data->family as $member) {
                    DB::table('def_person_family')->insert([
                        'fam_personid' => $famid,
                        'fam_firstname' => $member->fam_firstname,
                        'fam_middlename' => $member->fam_middlename,
                        'fam_lastname' => $member->fam_lastname,
                        'fam_suffixname' => $member->fam_suffixname,
                        'fam_relationship' => $member->fam_relationship,
                        'fam_contact' => $member->fam_contact,
                        'fam_email' => $member->fam_email,
                        'fam_user' => 0,
                        'fam_guardian' => $member->fam_guardian,
                    ]);
                }
            }

            // Awards
            if (!empty($data->awards)) {
                foreach ($data->awards as $award) {
                    DB::table('def_person_award')->insert([
                        'awr_personid' => $awrid,
                        'awr_desc' => $award->awr_desc,
                        'awr_year' => $award->awr_year,
                        'awr_user' => 0,
                    ]);
                }
            }

            // Educational attainment
            if (!empty($data->attainment)) {
                foreach ($data->attainment as $school) {
                    DB::table('def_person_attainment')->insert([
                        'pered_personid' => $attid,
                        'pered_school' => $school->pered_school,
                        'pered_from' => $school->pered_from,
                        'pered_to' => $school->pered_to,
                        'pered_user' => 0,
                    ]);
                }
            }



            return $data = [
                'per_personid' => $perid,
                'fam_id' => $famid,
                'educ_id' => $awrid,
                'att_id' => $attid,
                'status' => 204,
            ];
        }
        catch (Exception $ex) {
            return $data = [
                'status' => 500,
            ];
        }
    }
}
