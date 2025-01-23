<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmissionReportDeliver extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The body of the message.
     *
     * @var string
     */
    public $holderSubmission;
    public $recipentData;
    public $reportLink;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($holderSubmission, $recipentData, $reportLink)
    {
        $this->holderSubmission     = $holderSubmission;
        $this->recipentData         = $recipentData;
        $this->reportLink           = $reportLink;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.submission-report-to-recipent')->subject('Completed Evaluation Report - '.$this->holderSubmission->submission_ref)
                    ->with(['holderSubmission'=> $this->holderSubmission, 'recipentData'=> $this->recipentData])->attach($this->reportLink);
    }


}