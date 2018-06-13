<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\issuesModel;
use App\models\newUser;

class issuesController extends controller
{
    public function getUsers()
    {
        try
        {
            $allUsers = new newUser();
            $allUsersResult = $allUsers->getAllUsers();
            $users = json_encode($allUsersResult);
            echo $users;
        } catch (Exception $ex) {

        }
        
    }
    
    public function getIssues()
    {
        try
        {
            $issue = new issuesModel();
            $allIssues = $issue->getIssues();            
        } catch (Exception $ex) {

        }
    }
    
    public function addIssue(Request $request)
    {
        try
        {
            $issueArray = 
            [
            'custID' => $request->issueAccount,
            'tech' => $request->assigned,
            'product' => $request->issueType,
            'firstdate' => $request->date,
            'time' => $request->firsttime,
            'symptoms' => $request->symptoms,
            'fix' => $request->resolution,
            'completeddate' => $request->completiondate
            ];

            $issue = new issuesModel();
            $addIssueResult = $issue->addIssue($issueArray);
            //, ['customers' => $allCustomers]
            return view('layouts.issues', ['result' => $addIssueResult['issueMessage']]);
        } catch (Exception $ex) {

        }
    }
    
    public function getSingleIssue()
    {
        try
        {
            $issueID = $_GET['queryString'];            
            $issueDetails = new issuesModel();
            $issueResult = $issueDetails->getSingleIssue($issueID);
            if($issueResult && $issueResult !== false)
            {
                $issueFields = json_encode($issueResult);
                echo $issueFields;
            }            
        } catch (Exception $ex) {

        }
    }
    
    public function issuesStats()
    {
        try 
        {
            $issueStats = new issuesModel();
            $issueStatResults = $issueStats->getStats();            
            $issueStatsFinal = json_encode($issueStatResults);
            echo $issueStatsFinal;
        } catch (Exception $ex) {

        }
    }
    
    public function editIssue(Request $request)
    {
        try
        {            
            $issueArray = 
            [
                'id' => $request->LogID,
                'symptoms' => htmlentities($request->symptoms),
                'resolution' => htmlentities($request->resolution),
                'completedDate' => $request->completionDate
            ];
            $issue = new issuesModel();
            $editIssueResult = $issue->editIssue($issueArray);
            $allIssues = $issue->getIssues();

            header('Location: /issues');
            die();
            
        } catch (Exception $ex) {

        }
    }
    
    public function deleteIssue(Request $request)
    {
        try
        {
            
        } catch (Exception $ex) {

        }
        
    }
}