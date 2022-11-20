<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\FeedbackModel;

class FeedbackController extends BaseController
{

    public function __construct()
    {
        $this->feedbackModel = new FeedbackModel();
    }
    public function index()
    {
        $data = $this->feedbackModel->get()->getResult();
        return view('merchant/feedback', compact('data'));
    }
    public function delete()
    {
        try {
            $id_feedback = $this->request->getVar('id_feedback');
            $this->feedbackModel->where('id_feedback', $id_feedback)->delete();
            return redirect()->back()->with('status', 'success');
        } catch (\Exception  $th) {
            return redirect()->back()->with('status', 'failed');
        }
    }
}
