<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SubmissionStageChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * The body of the message.
     *
     * @var string
     */
    public $holderSubmission;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($holderSubmission)
    {
        $this->holderSubmission     = $holderSubmission;
    }
    
    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $nextStageName  = config('constant.holderSubmissionStages.heading_titles.'.$this->holderSubmission->current_stage);
        return $this->view('emails.submission-stage-changed')->subject('New Evaluation - '.$nextStageName.' - '.$this->holderSubmission->submission_ref);
    }


}