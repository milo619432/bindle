<?php
namespace App\models;
use Illuminate\Support\Facades\DB;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;

class issuesModel extends Model
{
    public function addIssue($issueDetails)
    {
        try
        {        
            $issueResults = 
            [
                'issueResult' => null,
                'issueMessage' => null
            ];
            
            if($issueDetails)
            {
                $issueInsert = DB::insert('INSERT INTO supportlog ('
                        . 'CustID, '
                        . 'HeartUserID, '
                        . 'product, '
                        . 'DateofIssue, '
                        . 'timeOfIssue, '
                        . 'Symptoms, '
                        . 'Resolution, '
                        . 'completionDate) '
                        . 'values(?,?,?,?,?,?,?,?)',
                        [
                            $issueDetails['custID'],
                            $issueDetails['tech'],
                            $issueDetails['product'],
                            $issueDetails['firstdate'],
                            $issueDetails['time'],
                            $issueDetails['symptoms'],
                            $issueDetails['fix'],
                            $issueDetails['completeddate']
                        ]);
                if(true == $issueInsert)
                {
                    $issueResults['issueResult'] = true;
                    $issueResults['issueMessage'] = "<div class='alert alert-success' style='text-align:center'>Issue successfully created</div>";
                }
                else
                {
                    $issueResults['issueResult'] = false;
                    $issueResults['issueMessage'] = "<div class='alert alert-danger' style='text-align:center'>There has been a problem, please contact a system administrator</div>";
                }
            }
            else
            {
                $issueResults['issueResult'] = false;
                $issueResults['issueMessage'] = "<div class='alert alert-danger' style='text-align:center'>No issue details supplied</div>";                
            }
            return ($issueResults);
            
        } catch (Exception $ex) {
            //todo log errors
        }
    }
    
    public function getIssues()
    {
        try
        {
            $issuesList = DB::select('SELECT supportlog.LogID ,
            supportlog.product, 
            supportlog.DateofIssue, 
            supportlog.statusID, 
            supportlog.Symptoms, 
            customers.CustName 
            FROM supportlog 
            INNER JOIN customers ON supportlog.CustID = customers.CustID;');           

            if(sizeof($issuesList))
            {
                echo json_encode($issuesList);
            }
            else
            {
                echo json_encode("No issues");
            }
        } catch (Exception $ex) {

        }
    }
    
    public function getSingleIssue($id)
    {
        try
        {
            $issueResult = DB::SELECT("SELECT supportlog.LogID ,
            supportlog.product, 
            supportlog.HeartUserID,
            supportlog.DateofIssue, 
            supportlog.statusID, 
            supportlog.Symptoms, 
            supportlog.Resolution,
            supportlog.completionDate,
            customers.CustName,
            heartuser.firstName,
            heartuser.lastName
            FROM supportlog 
            INNER JOIN customers ON supportlog.CustID = customers.CustID
            INNER JOIN heartuser ON supportlog.HeartUserID = heartuser.UserID 
            WHERE supportlog.LogID = " . $id . ";");
            if($issueResult)
            {
                return $issueResult;
            }
        } catch (Exception $ex) {

        }
    }
    
    public function getStats()
    {
        try
        {
            $issueStatsTotal = DB::SELECT("SELECT count(LogID) as COUNT FROM supportlog;");
            $issueOustanding = DB::SELECT("SELECT count(ifnull(completionDate,1)) as outstanding FROM supportlog;");
            $issuesToday = DB::SELECT("SELECT count(LogID) as TODAY FROM supportlog WHERE DateofIssue = curdate();");
            $stats = 
            [
                'total' => $issueStatsTotal,
                'outstanding' => $issueOustanding,
                'today' => $issuesToday
            ];
            return $stats;
        } catch (Exception $ex) {

        }
    }
    
    public function editIssue($issueForm)
    {
        try
        {
            $result = 
            [
                'status' => null,
                'message' => null
            ];
            if($issueForm)
            {                
                $issueUpdate = DB::update("UPDATE supportlog SET "
                        . "Symptoms ='" . $issueForm['symptoms'] . "', "
                        . "Resolution = '" . $issueForm['resolution'] . "', "
                        . "completionDate = '" . $issueForm['completedDate'] . "' "
                        . "WHERE LogID = " . $issueForm['id'] . ";");
                if($issueUpdate = 1)
                {
                    $result['status'] = 'success';
                    $result['message'] = "<div  class='alert alert-success' style='text-align:center'>Issue edited successfully</div>";
                }
                else
                {
                    $result['status'] = 'failed';
                    $result['message'] = "<div  class='alert alert-danger' style='text-align:center'>There was a problem submiting your changes. Please try again</div>";
                }
            }
            else
            {
                $result['status'] = 'failed';
                $result['message'] = "<div  class='alert alert-danger' style='text-align:center'>There was a problem submiting your changes. Please try again</div>";
            }
            return $result;
        } catch (Exception $ex) {

        }
    }
}