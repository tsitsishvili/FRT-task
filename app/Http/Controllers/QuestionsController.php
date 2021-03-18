<?php

namespace App\Http\Controllers;

use App\Models\Questions;
use App\Models\Statistics;
use Illuminate\Http\Request;

class QuestionsController extends Controller
{
    private $TypeId = 0;
    private $BinaryTypeId = 2;
    private $MultipleChoiceTypeId = 1;
    private $StatusCode = 1;
    private $RespStatus = 200;

    private function GetQuestions()
    {
        $Questions = Questions::select('id', 'question')->where('type_id', $this->TypeId);

        if ($this->TypeId == $this->MultipleChoiceTypeId) {
            $Questions = $Questions->with('Answers');
        }

        return $Questions->get()->toJson(JSON_PRETTY_PRINT);
    }

    public function GetBinaryQuestions()
    {
        $this->TypeId = $this->BinaryTypeId;
        return $this->GetQuestions();
    }

    public function GetMultiChoiceQuestions()
    {
        $this->TypeId = $this->MultipleChoiceTypeId;
        return $this->GetQuestions();
    }

    private function CheckAnswer(Request $request)
    {
        if($request->has('QuestionId') && $request->has('AnswerId') && !is_null($Question = Questions::where('type_id', $this->TypeId)->find($request->QuestionId))) {
            if ($Question->is_correct != $request->AnswerId) {
                $this->StatusCode = 2;
            }

            $Data = $Question->is_correct;
        } else {
            $this->StatusCode = 0;
            $this->RespStatus = 404;
            $Data = 'Incorrect Request!';
        }

        return $Data;
    }

    public function CheckBinaryAnswer(Request $request)
    {
        $this->TypeId = $this->BinaryTypeId;
        $Resp = $this->CheckAnswer($request);
        return response(['StatusCode' => $this->StatusCode, 'Data' => $Resp], $this->RespStatus);
    }

    public function CheckMultiChoiceAnswer(Request $request)
    {
        $this->TypeId = $this->MultipleChoiceTypeId;
        $Resp = $this->CheckAnswer($request);
        return response(['StatusCode' => $this->StatusCode, 'Data' => $Resp], $this->RespStatus);
    }

    private function GetStatistics()
    {
        $Questions = Questions::select('id', 'statistic')->where('type_id', $this->TypeId)->get();
        $Statistics = Statistics::select('completed')->where('type_id', $this->TypeId)->get();
        return ['Questions' => $Questions, 'Statistics' => $Statistics];
    }

    public function GetBinaryStatistics()
    {
        $this->TypeId = $this->BinaryTypeId;
        return response(['StatusCode' => $this->StatusCode, 'Data' => $this->GetStatistics()], $this->RespStatus);
    }

    public function GetMultiChoiceStatistics()
    {
        $this->TypeId = $this->MultipleChoiceTypeId;
        return response(['StatusCode' => $this->StatusCode, $this->GetStatistics()], $this->RespStatus);
    }

    private function SaveStatistics(Request $request)
    {
        if ($request->has('Answers') && count($Answers = json_decode($request->Answers, true)) == Questions::where('type_id', $this->TypeId)->count()) {
            foreach ($Answers as $row) {
                if (is_null(Questions::where('type_id', $this->TypeId)->find($row['QuestionId']))) {
                    $this->RespStatus = 404;
                    $this->StatusCode = 0;
                    return false;
                }
            }

            foreach ($Answers as $row) {
                $Question = Questions::find($row['QuestionId']);
                if ($Question->is_correct == $row['AnswerId']) {
                    $Question->statistic++;
                    $Question->save();
                }
            }

            $Statistics = Statistics::where('type_id', $this->TypeId)->first();
            $Statistics->completed++;
            $Statistics->save();
        } else {
            $this->RespStatus = 404;
            $this->StatusCode = 0;
        }
    }

    public function SaveBinaryStatistics(Request $request)
    {
        $this->TypeId = $this->BinaryTypeId;
        $this->SaveStatistics($request);
        return response(['StatusCode' => $this->StatusCode], $this->RespStatus);
    }

    public function SaveMultiChoiceStatistics(Request $request)
    {
        $this->TypeId = $this->MultipleChoiceTypeId;
        $this->SaveStatistics($request);
        return response(['StatusCode' => $this->StatusCode], $this->RespStatus);
    }
}
